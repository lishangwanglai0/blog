<?php


namespace App\Http\Controllers\administrator\auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\administrator\RoleRequest;
use App\Model\Role;
use App\Model\RoleMenu;
use App\Model\RolePermission;

class RoleController extends Controller
{
    /** 角色 */
    /**
     *
     */
    public function index()
    {

    }

    /** 角色创建
     * @param RoleRequest $request
     * @param Role $role
     * @return array
     */
    public function createrole(RoleRequest $request,Role $role)
    {
        $data=$request->only('name');
        return $role->create($data);
    }

    /**
     * 角色删除
     * @param RoleRequest $request
     * @param Role $role
     * @return array
     */
    public function del(RoleRequest $request,Role $role)
    {
        $data=$request->only('id');
        return $role->del($data);
    }

    /**
     *添加角色菜单
     */
    public function rolemenuadd(RoleRequest $request,RoleMenu $roleMenu)
    {
        $data=$request->only('role_id','menu_id');
        return $roleMenu->create($data);
    }

    /**
     * 删除角色菜单
     * @param RoleRequest $request
     * @param RoleMenu $roleMenu
     * @return array
     */
    public function rolemenudel(RoleRequest $request,RoleMenu $roleMenu)
    {
        $data=$request->only('role_id','menu_id');
        return $roleMenu->del($data);
    }

    /**
     * 添加角色权限
     * @param RoleRequest $request
     * @param RolePermission $permission
     * @return array
     */
    public function rolePermissionCreate(RoleRequest $request,RolePermission $permission)
    {
        $data=$request->only('role_id','permission_id');
        return $permission->create($data);
    }

    /**
     * 删除角色权限
     * @param RoleRequest $request
     * @param RolePermission $permission
     * @return array
     */
    public function rolePermissionDel(RoleRequest $request,RolePermission $permission)
    {
        $data=$request->only('role_id','permission_id');
        return $permission->del($data);
    }
}