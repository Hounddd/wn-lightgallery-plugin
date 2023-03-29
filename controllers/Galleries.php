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
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
        \Backend\Behaviors\RelationController::class,
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $relationConfig = 'config_relation.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Hounddd.lightGallery', 'gallery', 'galleries');


        //
        // Sortable
        //
        // Legacy (v1)
        if (!class_exists('System')) {
            $this->addJs("/plugins/hounddd/lightgallery/assets/js/Sortable.min.js");
        }
        $this->addJs("/plugins/hounddd/lightgallery/assets/js/Galleries.min.js");
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



    //
    // Sortables
    //
    public function onReorderRelation()
    {
        $records = request()->input('rcd');
        $model = Gallery::findOrFail($this->params[0]);

        $relationModel = 'complex_images';
        $model->setRelationOrder($relationModel, $records, range(1, count($records)));

        Flash::success(trans('hounddd.lightgallery::lang.reorder.updated'));
    }
}
