<?php namespace Hounddd\lightGallery\Models;

use Model;
use Hounddd\lightGallery\Models\Gallery;

/**
 * Gallery Model
 */
class Category extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'hounddd_lightgallery_categories';

    public $implement = ['@Winter.Translate.Behaviors.TranslatableModel'];

    /*
     * Validation
     */
    public $rules = [
        'name' => 'required|between:3,64',
        'slug' => 'required|between:3,64|unique:hounddd_lightgallery_categories',
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
     * @var array Relations
     */
    public $belongsToMany = [
        'galleries' => ['Hounddd\lightGallery\Models\Gallery',
                'table'  => 'hounddd_lightgallery_galleries_categories',
                'order'  => 'published_at desc',
                'scope'  => 'isPublished'
        ]
    ];

    //
    // Events
    //

    public function beforeValidate()
    {
        // Generate a URL slug for this model
        if (!$this->exists && !$this->slug) {
            $this->slug = Str::slug($this->name);
        }
    }

    public function afterDelete()
    {
        $this->galleries()->detach();
    }

    //
    // Attributes
    //

    /**
     * Count galleries in this category
     * @return int
     */
    public function getGalleriesCountAttribute()
    {
        return $this->galleries()->count();
    }


    /**
     * Sets the "url" attribute with a URL to this object
     * @param string $pageName
     * @param Cms\Classes\Controller $controller
     *
     * @return string
     */
    public function setUrl($pageName, $controller)
    {
        $params = [
            'id' => $this->id,
            'slug' => $this->slug,
        ];

        return $this->url = $controller->pageUrl($pageName, $params, false);
    }
}
