<?php namespace Hounddd\lightGallery\Models;

use DB;
use Model;
use ValidationException;
use Lang;
use Carbon\Carbon;
use System\Models\File;
use Hounddd\lightGallery\Models\Category;

/**
 * Gallery Model
 */
class Gallery extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'hounddd_lightgallery_galleries';
    public $implement = ['@Winter.Translate.Behaviors.TranslatableModel'];

    /*
     * Validation
     */
    public $rules = [
        'name' => 'required|between:3,64',
        'slug' => ['required', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'unique:hounddd_lightgallery_galleries'],
    ];

    /**
     * @var array Attributes that support translation, if available.
     */
    public $translatable = [
        'name',
        'description',
        ['slug', 'index' => true],
    ];

    /**
     * The attributes that should be mutated to dates.
     * @var array
     */
    protected $dates = ['published_at'];

    /**
     * @var array Relations
     */
    public $belongsToMany = [
        'categories' => [
            'Hounddd\lightGallery\Models\Category',
            'table' => 'hounddd_lightgallery_galleries_categories',
            'order' => 'name'
        ]
    ];

    /**
     * @var array Relations
     */
    public $hasMany = [
        'complex_images' => [
            'Hounddd\lightGallery\Models\Image',
            'table'  => 'hounddd_lightgallery_images',
            'order' => 'sort_order asc',
            'otherKey' => 'id',
            'key'      => 'gallery_id',
        ],
    ];

    /**
     * @var array Attachemnts
     */
    public $attachMany = [
        'images' => [
            'System\Models\File',
            'order' => 'sort_order'
        ],
    ];


    /**
     * The attributes on which the post list can be ordered.
     * @var array
     */
    public static $allowedSortingOptions = [
        'title asc'         => 'hounddd.lightgallery::lang.sorting.title_asc',
        'title desc'        => 'hounddd.lightgallery::lang.sorting.title_desc',
        'created_at asc'    => 'hounddd.lightgallery::lang.sorting.created_asc',
        'created_at desc'   => 'hounddd.lightgallery::lang.sorting.created_desc',
        'updated_at asc'    => 'hounddd.lightgallery::lang.sorting.updated_asc',
        'updated_at desc'   => 'hounddd.lightgallery::lang.sorting.updated_desc',
        'published_at asc'  => 'hounddd.lightgallery::lang.sorting.published_asc',
        'published_at desc' => 'hounddd.lightgallery::lang.sorting.published_desc',
        'random'            => 'hounddd.lightgallery::lang.sorting.random'
    ];

    //
    // Events
    //

    /**
     *
     */
    public function afterValidate()
    {
        if ($this->published && !$this->published_at) {
            throw new ValidationException([
               'published_at' => Lang::get('hounddd.lightgallery::lang.exeptions.publish_date_validation')
            ]);
        }
    }

    //
    // Attributes
    //

    /**
     * Get number of images in this gallery
     *
     * @return int
     */
    public function getImagesCountAttribute()
    {
        return $this->images()->count();
    }

    /**
     * Get first image of gallery
     * @return System\Models\File
     */
    public function getFeaturedImageAttribute()
    {
        if ($this->images->count()) {
            $image = $this->images->first();
        } else {
            $image = (new \System\Models\File)->fromFile(
                plugins_path('hounddd/lightgallery/assets/images/no-photos.png')
            );
        }

        return $image;
    }

    //
    // Query Scopes
    //

    /**
     * Published scope
     *
     * @param Illuminate\Query\Builder $query
     * @return Illuminate\Query\Builder
     */
    public function scopeIsPublished($query)
    {
        return $query
            ->whereNotNull('published')
            ->where('published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<', Carbon::now());
    }

    /**
     * Lists galleries for the frontend
     *
     * @param        $query
     * @param  array $options Display options
     * @return Gallery
     */
    public function scopeListFrontEnd($query, $options)
    {
        /*
         * Default options
         */
        extract(array_merge([
            'page'             => 1,
            'perPage'          => 9,
            'sort'             => 'created_at',
            'categories'       => null,
            'category'         => null,
            'search'           => '',
            'published'        => true,
        ], $options));

        $searchableFields = ['title', 'slug', 'description'];

        if ($published) {
            $query->isPublished();
        }

        /*
         * Sorting
         */
        if (in_array($sort, array_keys(static::$allowedSortingOptions))) {
            if ($sort == 'random') {
                $query->inRandomOrder();
            } else {
                @list($sortField, $sortDirection) = explode(' ', $sort);

                if (is_null($sortDirection)) {
                    $sortDirection = "desc";
                }

                $query->orderBy($sortField, $sortDirection);
            }
        }

        /*
         * Search
         */
        $search = trim($search);
        if (strlen($search)) {
            $query->searchWhere($search, $searchableFields);
        }

        /*
         * Category
         */
        if ($category !== null) {
            $query->whereHas('categories', function ($q) use ($category) {
                $q->where('id', $category);
            });
        }

        return $query->paginate($perPage, $page);
    }

    //
    // Internal setters
    //

    /**
     * Sets the "url" attribute with a URL to this object
     * @param string $pageName
     * @param Cms\Classes\Controller $controller
     * @param array $params Override request URL parameters
     *
     * @return string
     */
    public function setUrl($pageName, $controller, $params = [])
    {
        $params = array_merge([
            'id'   => $this->id,
            'slug' => $this->slug,
        ], $params);

        if (empty($params['category'])) {
            $params['category'] = $this->categories->count() ? $this->categories->first()->slug : null;
        }

        return $this->url = $controller->pageUrl($pageName, $params);
    }



    //
    // Sortable
    //
    public function setRelationOrder($relationName, $itemIds, $itemOrders = null, $sortKey = 'sort_order')
    {
        if ( ! is_array($itemIds)) {
            $itemIds = [$itemIds];
        }

        if ($itemOrders === null) {
            $itemOrders = $itemIds;
        }

        if (count($itemIds) != count($itemOrders)) {
            throw new Exception('Invalid setRelationOrder call - count of itemIds do not match count of itemOrders');
        }

        foreach ($itemIds as $index => $id) {
            $order    = $itemOrders[$index];
            $relation = $this->getRelationDefinition($relationName);
            // debug($relation);
            DB::table($relation['table'])
              ->where($relation['key'], $this->id)
              ->where($relation['otherKey'], $id)
              ->update([$sortKey => $order]);
        }
    }
}
