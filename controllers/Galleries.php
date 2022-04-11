<?php namespace Hounddd\lightGallery\Controllers;

use Flash;
use Lang;
use BackendMenu;
use Backend\Classes\Controller;
use Hounddd\lightGallery\Models\Gallery;

/**
 * Galleries Back-end Controller
 */
class Galleries extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Hounddd.lightGallery', 'gallery', 'galleries');
    }

    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {
            foreach ($checkedIds as $itemId) {
                if (!$slider = Gallery::find($itemId)) {
                    continue;
                }

                $slider->delete();
            }

            Flash::success(Lang::get('hounddd.lightgallery::lang.galleries.delete_success'));
        }

        return $this->listRefresh();
    }
}
