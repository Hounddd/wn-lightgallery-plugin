<?php namespace Hounddd\lightGallery\Components;

use Lang;
use Hounddd\lightGallery\Classes\Components\GalleryBase;
use Hounddd\lightGallery\Models\Gallery as GalleryModel;

class GalleryId extends GalleryBase
{
    /**
     * @var Hounddd\lightGallery\Models\Gallery Gallery to display
     */
    public $gallery;

    public function componentDetails()
    {
        return [
            'name'        => 'hounddd.lightgallery::lang.common.gallery',
            'description' => 'hounddd.lightgallery::lang.settings.gallery_show',
        ];
    }

    public function defineProperties()
    {
        $parentProperties = parent::defineProperties();

        /**
         * Winter does not support properties of type `set`,
         * so set lightGallery plugin as a succession of checkbox
         */
        // $parentProperties['plugins']['type'] = 'dropdown';
        unset($parentProperties['plugins']);

        $plugins = static::$pluginsList;

        foreach ($plugins as $key => $plugin) {
            $plugins[$plugin] = [
                'title'       => Lang::get('hounddd.lightgallery::lang.settings.plugins.'. $plugin),
                'group'       => 'hounddd.lightgallery::lang.settings.groups.plugins',
                'type'        => 'checkbox',
                'default'     => in_array($plugin, ['lgThumbnail', 'lgZoom'])  ,
                // 'options'     => static::$truefalse,
            ];
            unset($plugins[$key]);
        }

        $parentProperties = $this->array_insert_after($parentProperties, 'nextHtml', $plugins);

        return array_merge([
            'idGallery'    => [
                'title'       => 'hounddd.lightgallery::lang.common.gallery',
                'description' => 'hounddd.lightgallery::lang.settings.gallery.description',
                'type'        => 'dropdown',
            ]
        ], $parentProperties);
    }


    protected function loadGallery()
    {
        $gallery = GalleryModel::find($this->property('idGallery'));

        return $gallery;
    }


    public function getidGalleryOptions()
    {
        return GalleryModel::orderBy('name')->lists('name', 'id');
    }

    /**
     * Insert a value or key/value pair after a specific key in an array.  If key doesn't exist, value is appended
     * to the end of the array.
     *
     * @param array $array
     * @param string $key
     * @param array $new
     *
     * @return array
     */
    function array_insert_after(array $array, $key, array $new)
    {
        $keys = array_keys($array);
        $index = array_search($key, $keys);
        $pos = false === $index ? count($array) : $index + 1;

        return array_merge(array_slice($array, 0, $pos), $new, array_slice($array, $pos));
    }
}
