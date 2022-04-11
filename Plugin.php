<?php namespace Hounddd\lightGallery;

use App;
use Event;
use Backend;
use System\Classes\PluginBase;

/**
 * galleries Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'hounddd.lightgallery::lang.plugin.name',
            'description' => 'hounddd.lightgallery::lang.plugin.description',
            'author'      => 'Hounddd',
            'icon'        => 'icon-picture-o',
            'homepage'    => 'https://github.com/Hounddd/wn-lightgallery-plugin',
            'replaces' => [
                'Raviraj.Rjgallery' => '<=1.2.2'
            ],
        ];
    }

    public function registerComponents()
    {
        return [
            'Hounddd\lightGallery\Components\Galleries' => 'galleriesList',
            'Hounddd\lightGallery\Components\GallerySlug' => 'gallerySlug',
        ];
    }

    public function registerPageSnippets()
    {
        return [
            'Hounddd\lightGallery\Components\GalleryId' => 'galleryId',
        ];
    }

    public function registerNavigation()
    {
        return [
            'gallery' => [
                'label' => 'hounddd.lightgallery::lang.common.menu_label',
                'url'   => Backend::url('hounddd/lightgallery/galleries'),
                'icon'        => 'icon-picture-o',
                'permissions' => ['hounddd.lightgallery.*'],
                'order'       => 500,

                'sideMenu' => [
                    'new_gallery' => [
                        'label'       => 'hounddd.lightgallery::lang.galleries.new_gallery',
                        'icon'        => 'icon-plus',
                        'url'         => Backend::url('hounddd/lightgallery/galleries/create'),
                        'permissions' => ['hounddd.lightgallery.access_galleries']
                    ],
                    'galleries' => [
                        'label'       => 'hounddd.lightgallery::lang.common.galleries',
                        'icon'        => 'icon-file-image-o',
                        'url'         => Backend::url('hounddd/lightgallery/galleries'),
                        'permissions' => ['hounddd.lightgallery.access_galleries']
                    ],
                    'new_category' => [
                        'label'       => 'hounddd.lightgallery::lang.categories.new_category',
                        'icon'        => 'icon-plus',
                        'url'         => Backend::url('hounddd/lightgallery/categories/create'),
                        'permissions' => ['hounddd.lightgallery.access_galleries']
                    ],
                    'categories' => [
                        'label'       => 'hounddd.lightgallery::lang.common.categories',
                        'icon'        => 'icon-server',
                        'url'         => Backend::url('hounddd/lightgallery/categories'),
                        'permissions' => ['hounddd.lightgallery.access_categories']
                    ]
                ]
            ],
        ];
    }

    public function registerPermissions()
    {
        return [
            'hounddd.lightgallery.*' => [
                'tab' => 'hounddd.lightgallery::lang.plugin.name',
                'label' => 'hounddd.lightgallery::lang.permissions.all'
            ]
        ];
    }
}
