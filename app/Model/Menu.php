<?php

namespace App\Model;

use App\Http\Requests\administrator\MenuRequest;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /** 菜单*/
    /**
     *菜单创建
     * @param $data
     * @return array
     */
    public function create($data)
    {
        try{

            $resu=static::insert($data);

            return !empty($resu) ?  result('SUCCESS','菜单创建成功') :  result('SUCCESS','菜单创建失败');

        }catch (\Exception $exception){
            exception($exception,'VideoResource');
            return result('FAIL',$exception->getMessage());
        }
    }

    /**
     * 删除菜单
     * @param $id
     * @return array
     */
    public function del($id)
    {
        try {
            $data = static::where('parent_id', $id)->first();
            if ($data) return result('FALT', '您的菜单下还有子菜单，请先删除子菜单');

            $start = static::where('id', $id)->delete();
           return isset($start) ? result('SUCCESS','菜单删除成功') : result('FALT','菜单删除失败,请您刷新后重试');

        }catch (\Exception $exception){
            exception($exception,'VideoResource');
            return result('FAIL',$exception->getMessage());
        }
    }

    /**
     * 获取菜单
     */
    public function list()
    {

    }
}
