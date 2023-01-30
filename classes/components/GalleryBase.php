<?php namespace Hounddd\lightGallery\Classes\Components;

use Event;
use Lang;
use Cms\Classes\ComponentBase;
use Hounddd\lightGallery\Models\Gallery;

class GalleryBase extends ComponentBase
{
    /**
     * @var Hounddd\lightGallery\Models\Gallery Gallery to display
     */
    public $gallery;

    /**
     * @var string Message to display when there are no images in gallery.
     */
    public $noImagesMessage;

    /**
     * @var Array True and false options for dropdown
     */
    public static $truefalse = [
        'true' => 'hounddd.lightgallery::lang.common.yes',
        'false' => 'hounddd.lightgallery::lang.common.no'
    ];

    /**
     * @var Array Transistion options for dropdown
     */
    public static $transitions = [
        'lg-slide'                    => 'Slide',
        'lg-fade'                     => 'Fade',
        'lg-zoom-in'                  => 'Zoom In',
        'lg-zoom-in-big'              => 'Zoom In Big',
        'lg-zoom-out'                 => 'Zoom Out',
        'lg-zoom-out-big'             => 'Zoom Out Big',
        'lg-zoom-out-in'              => 'Zoom Out In',
        'lg-zoom-in-out'              => 'Zoom In Out',
        'lg-soft-zoom'                => 'Soft Zoom',
        'lg-scale-up'                 => 'Scale Up',
        'lg-slide-circular'           => 'Slide Circular',
        'lg-slide-circular-vertical'  => 'Slide Circular Vertical',
        'lg-slide-vertical'           => 'Slide Vertical',
        'lg-slide-vertical-growth'    => 'Slide Vertical Growth',
        'lg-slide-skew-only'          => 'Slide Skew Only',
        'lg-slide-skew-only-rev'      => 'Slide Skew Only Reverse',
        'lg-slide-skew-only-y'        => 'Slide Skew Only-Y',
        'lg-slide-skew-only-y-rev'    => 'Slide Skew Only-Y Reverse',
        'lg-slide-skew'               => 'Slide Skew',
        'lg-slide-skew-rev'           => 'Slide Skew Reverse',
        'lg-slide-skew-cross'         => 'Slide Skew Cross',
        'lg-slide-skew-cross-rev'     => 'Slide Skew Cross Reverse',
        'lg-slide-skew-ver'           => 'Slide Skew Vertical',
        'lg-slide-skew-ver-rev'       => 'Slide Skew Vertical Reverse',
        'lg-slide-skew-ver-cross'     => 'Slide Skew Vertical Cross',
        'lg-slide-skew-ver-cross-rev' => 'Slide Skew Vertical Cross Reverse',
        'lg-lollipop'                 => 'Lollipop',
        'lg-lollipop-rev'             => 'Lollipop Reverse',
        'lg-rotate'                   => 'Rotate',
        'lg-rotate-rev'               => 'Rotate Reverse',
        'lg-tube'                     => 'Tube',
    ];

    /**
     * @var Array Plugins available in lightGallery
     */
    public static $pluginsList = [
        'lgAutoplay',
        'lgComment',
        'lgFullscreen',
        'lgHash',
        'lgMediumZoom',
        'lgPager',
        'lgRotate',
        'lgShare',
        'lgThumbnail',
        // 'lgVideo',
        'lgZoom',
    ];

    /**
     * Returns information about this component.
     */
    public function componentDetails()
    {
        return [];
    }

    public function defineProperties()
    {
        return [
            'inline' => [
                'title'       => 'hounddd.lightgallery::lang.settings.inline',
                'description' => 'hounddd.lightgallery::lang.settings.inline_description',
                'type'        => 'checkbox',
                'default'     => false,
                // 'options'     => static::$truefalse,
            ],
            'noImagesMessage' => [
                'title'             => 'hounddd.lightgallery::lang.settings.gallery.no_images_message',
                'description'       => 'hounddd.lightgallery::lang.settings.gallery.no_images_message_description',
                'type'              => 'string',
                'default'           => Lang::get('hounddd.lightgallery::lang.settings.gallery.no_images_default'),
                'showExternalParam' => false,
            ],
            'plugins' => [
                'title'       => 'hounddd.lightgallery::lang.settings.plugins_title',
                'description' => 'hounddd.lightgallery::lang.settings.plugins_description',
                'group'       => 'hounddd.lightgallery::lang.settings.groups.lightgallery',
                'type'        => 'set',
                'default'     => ['lgThumbnail', 'lgZoom'],
            ],
            'preload' => [
                'title'             => 'hounddd.lightgallery::lang.settings.preload_title',
                'description'       => 'hounddd.lightgallery::lang.settings.preload_description',
                'group'             => 'hounddd.lightgallery::lang.settings.groups.lightgallery',
                'type'              => 'string',
                'validationPattern' => '^[\d]+$',
                'validationMessage' => 'hounddd.lightgallery::lang.setting.preload_validation',
                'default'           => '2',
            ],
            'mode' => [
                'title'       => 'hounddd.lightgallery::lang.settings.mode_title',
                'description' => 'hounddd.lightgallery::lang.settings.mode_description',
                'group'       => 'hounddd.lightgallery::lang.settings.groups.lightgallery',
                'type'        => 'dropdown',
                'default'     => 'lg-slide',
                'options'     => static::$transitions,
            ],
            'speed' => [
                'title'             => 'hounddd.lightgallery::lang.settings.speed_title',
                'description'       => 'hounddd.lightgallery::lang.settings.speed_description',
                'group'             => 'hounddd.lightgallery::lang.settings.groups.lightgallery',
                'type'              => 'string',
                'validationPattern' => '^[\d]+$',
                'validationMessage' => 'hounddd.lightgallery::lang.settings.speed_validation',
                'default'           => '600',
            ],
            'loop' => [
                'title'       => 'hounddd.lightgallery::lang.settings.loop_title',
                'description' => 'hounddd.lightgallery::lang.settings.loop_description',
                'group'       => 'hounddd.lightgallery::lang.settings.groups.lightgallery',
                'type'        => 'checkbox',
                'default'     => true,
                // 'options'     => static::$truefalse,
            ],
            'pause' => [
                'title'             => 'hounddd.lightgallery::lang.settings.pause_title',
                'description'       => 'hounddd.lightgallery::lang.settings.pause_description',
                'group'             => 'hounddd.lightgallery::lang.settings.groups.lightgallery',
                'type'              => 'string',
                'validationPattern' => '^[\d]+$',
                'validationMessage' => 'hounddd.lightgallery::lang.settings.pause_validation',
                'default'           => '5000',
            ],
            'counter' => [
                'title'       => 'hounddd.lightgallery::lang.settings.counter_title',
                'description' => 'hounddd.lightgallery::lang.settings.counter_description',
                'group'       => 'hounddd.lightgallery::lang.settings.groups.lightgallery',
                'type'        => 'checkbox',
                'default'     => true,
                // 'options'     => static::$truefalse,
            ],
            'controls' => [
                'title'       => 'hounddd.lightgallery::lang.settings.controls_title',
                'description' => 'hounddd.lightgallery::lang.settings.controls_description',
                'group'       => 'hounddd.lightgallery::lang.settings.groups.lightgallery',
                'type'        => 'checkbox',
                'default'     => true,
                // 'options'     => static::$truefalse,
            ],
            'download' => [
                'title'       => 'hounddd.lightgallery::lang.settings.download_title',
                'description' => 'hounddd.lightgallery::lang.settings.download_description',
                'group'       => 'hounddd.lightgallery::lang.settings.groups.lightgallery',
                'type'        => 'checkbox',
                'default'     => true,
                // 'options'     => static::$truefalse,
            ],
            'escKey' => [
                'title'       => 'hounddd.lightgallery::lang.settings.escKey_title',
                'description' => 'hounddd.lightgallery::lang.settings.escKey_description',
                'group'       => 'hounddd.lightgallery::lang.settings.groups.lightgallery',
                'type'        => 'checkbox',
                'default'     => true,
                // 'options'     => static::$truefalse,
            ],
            'prevHtml' => [
                'title'       => 'hounddd.lightgallery::lang.settings.prevHtml_title',
                'description' => 'hounddd.lightgallery::lang.settings.prevHtml_description',
                'group'       => 'hounddd.lightgallery::lang.settings.groups.lightgallery',
                'type'        => 'string',
                'default'     => '',
            ],
            'nextHtml' => [
                'title'       => 'hounddd.lightgallery::lang.settings.nextHtml_title',
                'description' => 'hounddd.lightgallery::lang.settings.nextHtml_description',
                'group'       => 'hounddd.lightgallery::lang.settings.groups.lightgallery',
                'type'        => 'string',
                'default'     => '',
            ],
            'width' => [
                'title'             => 'hounddd.lightgallery::lang.settings.resizer.width_title',
                'description'       => 'hounddd.lightgallery::lang.settings.resizer.width_description',
                'group'             => 'hounddd.lightgallery::lang.settings.groups.thumbs',
                'type'              => 'string',
                'validationPattern' => '^[\d]+$',
                'validationMessage' => 'hounddd.lightgallery::lang.settings.width_validation',
                'default'           => '300',
            ],
            'height' => [
                'title'             => 'hounddd.lightgallery::lang.settings.resizer.height_title',
                'description'       => 'hounddd.lightgallery::lang.settings.resizer.height_description',
                'group'             => 'hounddd.lightgallery::lang.settings.groups.thumbs',
                'type'              => 'string',
                'validationPattern' => '^[\d]+$',
                'validationMessage' => 'hounddd.lightgallery::lang.settings.height_validation',
                'default'           => '300',
            ],
            'resizer' => [
                'title'       => 'hounddd.lightgallery::lang.settings.resizer.title',
                'description' => 'hounddd.lightgallery::lang.settings.resizer.description',
                'group'       => 'hounddd.lightgallery::lang.settings.groups.thumbs',
                'type'        => 'dropdown',
                'default'     => 'auto',
                'options'     => [
                    'auto'      => 'hounddd.lightgallery::lang.settings.resizer.options.auto',
                    'exact'     => 'hounddd.lightgallery::lang.settings.resizer.options.exact',
                    'portrait'  => 'hounddd.lightgallery::lang.settings.resizer.options.portrait',
                    'landscape' => 'hounddd.lightgallery::lang.settings.resizer.options.landscape',
                    'crop'      => 'hounddd.lightgallery::lang.settings.resizer.options.crop',
                ],
            ],
        ];
    }


    public function init()
    {
        Event::listen('translate.localePicker.translateParams', function ($page, $params, $oldLocale, $newLocale) {
            $newParams = $params;

            if (isset($params['slug'])) {
                $records = Gallery::transWhere('slug', $params['slug'], $oldLocale)->first();
                if ($records) {
                    $records->translateContext($newLocale);
                    $newParams['slug'] = $records['slug'];
                }
            }

            return $newParams;
        });
    }

    public function onRun()
    {
        $this->prepareVars();

        $this->gallery = $this->page['gallery'] = $this->loadGallery();

        if (!$this->gallery) {
            $this->setStatusCode(404);
            return $this->controller->run('404');
        }

        $this->addCss('assets/css/gallery.css');

        $this->addCss('assets/css/lightgallery-bundle.min.css');
        $this->addJs('assets/js/lightgallery.min.js');
        // lightgallery plugins
        $this->addJs('assets/js/plugins/lg-autoplay.min.js');
        $this->addJs('assets/js/plugins/lg-comment.min.js');
        $this->addJs('assets/js/plugins/lg-fullscreen.min.js');
        $this->addJs('assets/js/plugins/lg-hash.min.js');
        $this->addJs('assets/js/plugins/lg-medium-zoom.min.js');
        $this->addJs('assets/js/plugins/lg-pager.min.js');
        $this->addJs('assets/js/plugins/lg-relative-caption.min.js');
        $this->addJs('assets/js/plugins/lg-rotate.min.js');
        $this->addJs('assets/js/plugins/lg-share.min.js');
        $this->addJs('assets/js/plugins/lg-thumbnail.min.js');
        $this->addJs('assets/js/plugins/lg-video.min.js');
        $this->addJs('assets/js/plugins/lg-zoom.min.js');
    }

    public function onRender()
    {
        if (empty($this->gallery)) {
            $this->gallery = $this->page['gallery'] = $this->loadGallery();
        }
    }


    protected function prepareVars()
    {
        $this->noImagesMessage = $this->page['noImagesMessage'] = $this->property('noImagesMessage');

        /*
         * Page links
         */
        // $this->categoryPage = $this->page['categoryPage']= $this->property('categoryPage');
    }

    public function getPluginsOptions()
    {
        $plugins = [];

        foreach (static::$pluginsList as $key) {
            $plugins[$key] = Lang::get('hounddd.lightgallery::lang.settings.plugins.' . $key);
        }

        return $plugins;
    }
}
