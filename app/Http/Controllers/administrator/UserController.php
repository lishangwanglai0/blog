<?php

namespace App\Http\Controllers\administrator;

use App\Http\Requests\administrator\UserRequest;
use App\Model\RoleUser;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * 用户创建
     * @param UserRequest $request
     * @param User $user
     * @return array
     */
    public function create(UserRequest $request,User $user)
    {
        $data=$request->only('name','email','password');
        return $user->create($data);
    }

    /**
     * 用户删除
     * @param UserRequest $request
     * @param User $user
     */
    public function del(UserRequest $request,User $user)
    {
        $id=$request->only('id');
        return $user->del($id['id']);
    }

    /**
     * 添加用户角色
     */
    public function userandrole(UserRequest $request,RoleUser $roleuser)
    {
        $data=$request->only('id','roleIds');
        return $roleuser->create($data);
    }

    /**\
     * 删除用户角色
     */
    public function userRoleDel(UserRequest $request,RoleUser $roleuser)
    {
        $data=$request->only('id','roleIds');
        return $roleuser->del($data);
    }

}
