<?php namespace Hounddd\lightGallery\Components;

use Lang;
use Redirect;
use BackendAuth;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use Hounddd\lightGallery\Models\Gallery;
use Hounddd\lightGallery\Models\Category;

class Galleries extends ComponentBase
{
    /**
     * @var Collection A collection of galleries to display
     */
    public $galleries;

    /**
     * If the gallery list should be filtered by a category, the model to use
     *
     * @var Model
     */
    public $category;

    /**
     * @var string Message to display when there are no messages.
     */
    public $noGalleriesMessage;

    /**
     * @var string Reference to the page name for linking to galleries.
     */
    public $galleryPage;

    /**
     * @var string Reference to the page name for linking to categories.
     */
    public $categoryPage;

    /**
     * Parameter to use for the page number
     *
     * @var string
     */
    public $pageParam;

    public function componentDetails()
    {
        return [
            'name'        => 'hounddd.lightgallery::lang.settings.gallerylist.title',
            'description' => 'hounddd.lightgallery::lang.settings.gallerylist.description',
        ];
    }

    public function defineProperties()
    {
        return [
            'galleryPage' => [
                'title'         => 'hounddd.lightgallery::lang.settings.gallery_page',
                'description'   => 'hounddd.lightgallery::lang.settings.gallery_page_description',
                'group'         => 'hounddd.lightgallery::lang.settings.groups.links',
                'type'          => 'dropdown',
                'default'       => 'galleries/gallery',
                'options'       => $this->listThemePages(),
            ],
            'categoryPage' => [
                'title'         => 'hounddd.lightgallery::lang.settings.category_page',
                'description'   => 'hounddd.lightgallery::lang.settings.category_page_description',
                'group'         => 'hounddd.lightgallery::lang.settings.groups.links',
                'type'          => 'dropdown',
                'default'       => 'galleries/category',
                'options'       => $this->listThemePages(),
            ],
            'galleriesPerPage' => [
                'title'             => 'hounddd.lightgallery::lang.settings.galleries_per_page',
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'hounddd.lightgallery::lang.settings.galleries_per_page_validation',
                'default'           => '9',
            ],
            'pageNumber' => [
                'title'       => 'hounddd.lightgallery::lang.settings.galleries_pagination',
                'description' => 'hounddd.lightgallery::lang.settings.galleries_pagination_description',
                'type'        => 'string',
                'default'     => '{{ :page }}',
            ],
            'noGalleriesMessage' => [
                'title'         => 'hounddd.lightgallery::lang.settings.gallerylist.no_galleries_message',
                'description'   => 'hounddd.lightgallery::lang.settings.gallerylist.no_galleries_message_description',
                'type'          => 'string',
                'default'       => Lang::get('hounddd.lightgallery::lang.settings.gallerylist.no_galleries_default'),
                'showExternalParam' => false,
            ]
        ];
    }


    public function onRun()
    {
        $this->addCss('assets/css/gallery.min.css');

        $this->prepareVars();


        $this->category = $this->page['category'] = $this->loadCategory();
        $this->galleries = $this->page['galleries'] = $this->listGalleries();

        /*
         * If the page number is not valid, redirect
         */
        if ($pageNumberParam = $this->paramName('pageNumber')) {
            $currentPage = $this->property('pageNumber');

            if ($currentPage > ($lastPage = $this->galleries->lastPage()) && $currentPage > 1) {
                return Redirect::to($this->currentPageUrl([$pageNumberParam => $lastPage]));
            }
        }
    }

    public function onRender()
    {
        if (empty($this->galleries)) {
            $this->galleries = $this->page['galleries'] = $this->listGalleries();
        }
    }


    protected function prepareVars()
    {
        $this->pageParam = $this->page['pageParam'] = $this->paramName('pageNumber');
        $this->noGalleriesMessage = $this->page['noGalleriesMessage'] = $this->property('noGalleriesMessage');

        /*
         * Page links
         */
        $this->galleryPage = $this->page['galleryPage']= $this->property('galleryPage');
        $this->categoryPage = $this->page['categoryPage']= $this->property('categoryPage');
    }

    protected function listGalleries()
    {
        $category = $this->category ? $this->category->id : null;
        $categorySlug = $this->category ? $this->category->slug : null;

        $isPublished = !$this->checkEditor();

        // $galleries = Gallery::isPublished()->get();
        $galleries = Gallery::with(['categories'])->listFrontEnd([
            'page'             => $this->property('pageNumber'),
            'sort'             => $this->property('sortOrder'),
            'perPage'          => $this->property('galleriesPerPage'),
            'search'           => trim(input('search')),
            'category'         => $category,
            'published'        => $isPublished,
        ]);

        /*
        * Set url's for each gallery
        */
        $galleries->each(function ($gallery) use ($categorySlug) {

            $gallery->setUrl($this->galleryPage, $this->controller, ['category' => $categorySlug]);

            $gallery->categories->each(function ($category) {
                $category->setUrl($this->categoryPage, $this->controller);
            });
        });

        return $galleries;
    }

    /**
     * Set dropdown options for gallery and category page properties
     * @return array
     */
    protected function listThemePages()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }


    protected function loadCategory()
    {
        if (!$slug = $this->property('categoryFilter')) {
            return null;
        }

        $category = new Category;

        $category = $category->isClassExtendedWith('Winter.Translate.Behaviors.TranslatableModel')
            ? $category->transWhere('slug', $slug)
            : $category->where('slug', $slug);

        $category = $category->first();

        return $category ?: null;
    }

    protected function checkEditor()
    {
        $backendUser = BackendAuth::getUser();

        return $backendUser && $backendUser->hasAccess('hounddd.lightgallery.access_galleries');
    }
}
