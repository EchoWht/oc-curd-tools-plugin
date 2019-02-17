<?php namespace Blskye\CurdTools\Controllers\API;
use Backend\Classes\Controller;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

use Blskye\Package\Models\Url;
use Blskye\Curdtools\Classes\JsonResponseBuilder;
use Blskye\Curdtools\Classes\UserToken;

class UrlApiController extends Controller
{
    protected $userModel;
    public function __construct()
    {
        parent::__construct();
        $this->userModel=UserToken::getUserFromToken();

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

        $data = Url::where('id',$id)
            ->where('user_id',$this->userModel->id)
            ->first();
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

        $data['user_id']=$this->userModel->id;

        $validation = Validator::make($data, $Url->rules);
        if( $validation->passes() ){
            while ( $tmp = current($data)) {
                $Url->{key($data)} = $tmp;
                next($data);
            }
            $Url->save();
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

        $validation = Validator::make($data, $Url->rules);
        if( $validation->passes() ){
            $status = Url::where('id',$id)
                ->where('user_id',$this->userModel->id)
                ->update($data);

            if( $status ){
                return JsonResponseBuilder::accepted(Url::find($id));
            }else{
                return JsonResponseBuilder::badRequest(['message'=>'数据不存在，或没有修改权限']);
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
            ->where('user_id',$this->userModel->id)
            ->delete();
        if ($status){
            return JsonResponseBuilder::ok($status);
        }else{
            return JsonResponseBuilder::badRequest(['message'=>'数据不存在，或没有修改权限']);
        }

    }
}