<?php

namespace App\Http\Controllers\administrator\auth;

use App\Http\Requests\administrator\permissionRequest;
use App\Model\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    /** 权限 */
    /**
     * 创建权限
     */
    public function create(permissionRequest $request,Permission $permission)
    {
        $data=$request->only('name','http_path','http_method');
        return $permission->create($data);
    }

    /**
     * 删除权限
     * @param permissionRequest $request
     * @param Permission $permission
     */
    public function del(permissionRequest $request,Permission $permission)
    {
        $data=$request->only('id');
        return $permission->del($data['id']);
    }
}
