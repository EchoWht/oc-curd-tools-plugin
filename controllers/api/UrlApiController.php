<?php namespace Blskye\CurdTools\Controllers\API;
use Backend\Classes\Controller;
use BackendMenu;
use Blskye\Curdtools\Classes\JsonResponseBuilder;
use blskye\curdtools\classes\UserToken;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

use Blskye\Package\Models\Url;
use October\Test\Models\User;

class UrlApiController extends Controller
{
    protected $helpers;
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 所有记录
     * @route_demo /data?sort=id,-name&filter=title:test
     * @return mixed
    */
    public function index(){

        $query=Url::query();

        //排序
        if (Request::has('sort')){
            $sorts=explode(',',Request::input('sort'));
            foreach ($sorts as $sortCol){
                $sortDir=starts_with($sortCol,'-')?'desc':'asc';
                $sortCol=ltrim($sortCol,'-');
                $query->orderBy($sortCol,$sortDir);
            }
        }

        //过滤
        if (Request::has('filter')){
            list($criteria,$value)=explode(':',Request::input('filter'));
            $query->where($criteria,$value);
        }

        return $query->paginate(10);

    }
    /**
     * 单条记录
     * @param $id
     * @return mixed
     */
    public function show($id){
        $data = Url::find($id);
        if($data){
            return JsonResponseBuilder::ok($data);
        }
        return JsonResponseBuilder::notFound($data);
    }

    /**
     * 保存方法(新增)
     * @return mixed
     */
    public function store(){
        $Url=new Url();
        $fillable=$Url->getFillable();
        $data=Request::only($fillable);

        $userModel = UserToken::getUserFromToken();//获取用户Model
        $data['user_id']=$userModel->id;

        $validation = Validator::make($data, $Url->rules);
        if( $validation->passes() ){
            $Url=Url::create($data);
            return JsonResponseBuilder::created($Url);
        }else{
            return JsonResponseBuilder::badRequest($validation->errors() );
        }
    }
    /**
     * 修改方法
     * @param $id
     * @return mixed
     */
    public function update($id){

        $Url=new Url();
        $fillable=$Url->getFillable();
        $data=Request::only($fillable);

        $userModel = UserToken::getUserFromToken();//获取用户Model

        $validation = Validator::make($data, $Url->rules);
        if( $validation->passes() ){
            $status = Url::where('id',$id)
                ->where('user_id',$userModel->id)
                ->update($data);

            if( $status ){
                return JsonResponseBuilder::accepted(Url::find($id));
            }else{
                return JsonResponseBuilder::forbidden([]);
            }
        }else{
            return JsonResponseBuilder::badRequest($validation->errors() );
        }
    }

    /**
     * 删除资源
     * @param $id
     * @return mixed
     */
    public function destroy($id){

        $status=Url::where('id',$id)
            ->delete();
        if ($status){
            return JsonResponseBuilder::ok($status);
        }else{
            return JsonResponseBuilder::badRequest($status);
        }

    }


}