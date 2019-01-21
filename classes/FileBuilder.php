<?php
/**
 * Created by PhpStorm.
 * User: wanghaotian
 * Date: 2019-01-21
 * Time: 23:38
 */

namespace blskye\curdtools\classes;

use Illuminate\Filesystem\Filesystem;

class FileBuilder
{
    protected $files;
    protected $path = "/../controllers/api/";
    public function __construct()
    {
        $files=new Filesystem;
        $this->files = $files;
    }

    /**
     * 生成apicontroller文件
     * @param $data
     */
    public  function apiControllerFile($data){
        $this->files->put(__DIR__ . $this->path .$data['controllername']. 'Api.php',$this->genApiFileContent($data));
    }

    /**
     * 根据模版生成内容
     * @param $data
     * @return mixed
     */
    private function genApiFileContent($data){
        $template = $this->files->get(__DIR__ .'/../template/controllers/controller-api-base.dot');
        $template = $this->replaceAttribute($template, $data);
        return $template;
    }
    public function replaceAttribute($template, $data){
        if( isset( $data['model'] ) ){
            $template = str_replace('{{model}}', $data['model'], $template);
        }
        $template = str_replace('{{modelname}}', $data['modelname'], $template);
        $template = str_replace('{{controllername}}', $data['controllername'], $template);
        return $template;
    }
}