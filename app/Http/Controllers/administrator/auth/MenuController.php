<?php


namespace App\Http\Controllers\administrator\auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\administrator\MenuRequest;
use App\Model\Menu;

class MenuController extends Controller
{
    public function index()
    {

    }
    /** 创建菜单
     * @param Menu $menu
     * @param MenuRequest $request
     * @return array
     */
    public function createmenu(Menu $menu,MenuRequest $request)
    {

        $data=$request->only('parent_id','title','uri');
        return $menu->create($data);
    }

    /**删除菜单
     * @param MenuRequest $request
     * @param Menu $menu
     * @return array
     */
    public function del(MenuRequest $request,Menu $menu)
    {
        $id=$request->only('id');
        return $menu->del($id);
    }
}