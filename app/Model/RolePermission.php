<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    /** 角色权限关联模型 */
    /**
     * 添加角色权限
     */
    public function create($data)
    {
        try {
            $scale=static::where('role_id',$data['role_id'])->pluck('permission_id')->toArray();
            //取出差集
            $multi= isset($roleuser) ? array_diff($data['permission_id'],$scale)  : $data['permission_id'];

            foreach ($multi as $v) {
                static::insert(['role_id' => $data['role_id'], 'permission_id' => $v]);
            }
            return result('SUCCESS','角色权限添加成功');
        }catch (\Exception $exception){
            exception($exception,'VideoResource');
            return result('FAIL',$exception->getMessage());
        }
    }

    /**
     * 删除角色权限
     * @param $data
     */
    public function del($data)
    {
        try {
            foreach ($data['permission_id'] as $v) {
                static::where(['role_id' => $data['role_id'], 'permission_id' => $v])->delete();
            }
            return result('SUCCESS','角色权限删除成功');
        }catch (\Exception $exception){
            exception($exception,'VideoResource');
            return result('FAIL',$exception->getMessage());
        }
    }

}
