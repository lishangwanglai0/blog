<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    /** 用户角色关联表 */
    /**
     * 用户添加角色
     */
    public function create($data)
    {
        try {
            $roleuser=static::where('user_id',$data['id'])->pluck('role_id')->toArray();
            //取出差集
            $roleIds= isset($roleuser) ? array_diff($data['roleIds'],$roleuser)  : $data['roleIds'];

            foreach ($roleIds as $v) {
                static::insert(['user_id' => $data['id'], 'role_id' => $v]);
            }
            return result('SUCCESS','角色添加成功');
        }catch (\Exception $exception){
            exception($exception,'VideoResource');
            return result('FAIL',$exception->getMessage());
        }
    }

    /**
     * 删除用户角色
     * @param $data
     */
    public function del($data)
    {
        try {
            foreach ($data['roleIds'] as $v) {
                static::where(['user_id' => $data['id'], 'role_id' => $v])->delete();
            }
            return result('SUCCESS','角色删除成功');
        }catch (\Exception $exception){
            exception($exception,'VideoResource');
            return result('FAIL',$exception->getMessage());
        }
    }
}
