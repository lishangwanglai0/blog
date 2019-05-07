<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RoleMenu extends Model
{
    /** 角色菜单关联表 */
    /**
     * 添加角色菜单
     */
    public function create($data)
    {
        try {
            $scale=static::where('role_id',$data['role_id'])->pluck('menu_id')->toArray();
            //取出差集
            $multi= isset($roleuser) ? array_diff($data['menu_id'],$scale)  : $data['menu_id'];

            foreach ($multi as $v) {
                static::insert(['role_id' => $data['role_id'], 'menu_id' => $v]);
            }
            return result('SUCCESS','角色菜单添加成功');
        }catch (\Exception $exception){
            exception($exception,'VideoResource');
            return result('FAIL',$exception->getMessage());
        }
    }

    /**
    * 删除角色菜单
    * @param $data
    */
    public function del($data)
    {
        try {
            foreach ($data['menu_id'] as $v) {
                static::where(['role_id' => $data['role_id'], 'menu_id' => $v])->delete();
            }
            return result('SUCCESS','角色菜单删除成功');
        }catch (\Exception $exception){
            exception($exception,'VideoResource');
            return result('FAIL',$exception->getMessage());
        }
    }

}
