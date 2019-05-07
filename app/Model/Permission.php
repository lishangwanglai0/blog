<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    /** 权限 */

    /** 创建
     * @param $data
     * @return array
     */
    public function create($data)
    {
        try{
            $state=static::insert($data);
            return !empty($state) ? result('SUCCESS','权限创建成功') : result('FALT','权限创建失败');

        }catch (\Exception $exception){
            exception($exception,'VideoResource');
            return result('FAIL',$exception->getMessage());
        }
    }

    /**
     * 删除
     */
    public function del($id)
    {
        try {
            $start = static::where('id', $id)->delete();
            $eowsf=RolePermission::where('permission_id',$id)->first();
            $scie=1;
            if($eowsf){
                $scie= RolePermission::where('permission_id',$id)->delete();
            }
            return !empty($start)&&!empty($scie) ? result('SUCCESS','权限删除成功') : result('FALT','权限删除失败,请您刷新后重试');
        }catch (\Exception $exception){
            exception($exception,'VideoResource');
            return result('FAIL',$exception->getMessage());
        }
    }
}
