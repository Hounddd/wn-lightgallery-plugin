<?php namespace Hounddd\lightGallery\Components;

use BackendAuth;
use Hounddd\lightGallery\Classes\Components\GalleryBase;
use Hounddd\lightGallery\Models\Gallery as GalleryModel;

class GallerySlug extends GalleryBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'hounddd.lightgallery::lang.common.gallery',
            'description' => 'hounddd.lightgallery::lang.settings.gallery_show',
        ];
    }

    public function defineProperties()
    {
        return array_merge([
            'slug' => [
                'title'       => 'hounddd.lightgallery::lang.settings.gallery.slug',
                'description' => 'hounddd.lightgallery::lang.settings.gallery.slug_description',
                'default'     => '{{:slug}}',
                'type'        => 'string',
            ]
        ], parent::defineProperties());
    }


    protected function loadGallery()
    {
        $slug = $this->property('slug');

        $gallery = new GalleryModel;
        $query = $gallery->query();

        if ($gallery->isClassExtendedWith('Winter.Translate.Behaviors.TranslatableModel')) {
            $query->transWhere('slug', $slug);
        } else {
            $query->where('slug', $slug);
        }

        if (!$this->checkEditor()) {
            $query->isPublished();
        }

        $gallery = $query->first();

        return $gallery;
    }

    protected function checkEditor()
    {
        $backendUser = BackendAuth::getUser();

        return $backendUser && $backendUser->hasAccess('hounddd.lightgallery.access_galleries');
    }
}
