<?php namespace Blskye\CurdTools\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use blskye\curdtools\classes\FileBuilder;
use Illuminate\Filesystem\Filesystem;
use Blskye\CurdTools\Models\CurdtoolsData as CurdtoolsDataModel;

class CurdToolsData extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    protected $files;
    protected $path = "/api/";

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        BackendMenu::setContext('Blskye.CurdTools', 'main-menu-item', 'side-menu-item');
        $this->files         = $files;
    }
//    public function create_onSave(){
//        \Flash::success('我把保存方法覆盖掉了!');
//    }
    public function formAfterSave($model){
        $data=[];
        $modelname  = explode("\\", $model->model);
        $data['modelname']  = $modelname[count($modelname)-1];
        $data['model']=$model->model;
        $data['controllername']	=ucwords($data['modelname']);
        $endpoint		= $model->endpoint;
        $fileBuilder=new FileBuilder();
        $fileBuilder->apiControllerFile($data);
    }
}
