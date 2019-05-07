<?php


namespace App\Model;


use function foo\func;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role extends Model
{

    /**
     * 角色列表
     */
    public function list()
    {

    }

    /** 创建角色
     * @param $data
     * @return array
     */
    public function create($data)
    {
        try{
            $resu=static::insert($data);
           return isset($resu) ?  result('SUCCESS','角色创建成功') :  result('SUCCESS','角色创建失败');

        }catch (\Exception $exception){
            exception($exception,'VideoResource');
            return result('FAIL',$exception->getMessage());
        }

    }

    /**
     * 删除角色
     * @param $id
     * @return array
     */
    public function del($id)
    {
        try{
            /** @var 检查用户是否还有该角色 $eowsf */
            $eowsf=DB::table('role_users')->rightJoin('users',function ($join){
               $join->on('role_users.user_id','=','users.id');
                })
                ->where('role_users.role_id',$id)
                ->pluck('name')
                ->toArray();

            if(!empty($eowsf)){
                $str=implode(',',$eowsf);
                return result('FALT',$str.'：用户下面还有该角色,请先移除用户下的角色');
            }

            $scie=RoleUser::where('role_id',$id)->first();
            $status=1;
            if($scie){
                $status=RoleUser::where('role_id',$id)->delete();
            }

            $state=static::where('id',$id)->delete();
            return !empty($status)&&!empty($state) ? result('SUCCESS','角色删除成功') : result('FALT','角色删除失败,请您刷新后重试');
        }catch (\Exception $exception){
            exception($exception,'VideoResource');
            return result('FAIL',$exception->getMessage());
        }
    }
}