<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::group(['namespace' => '\App\Http\Controllers\administrator','middleware' => 'api'], function () {
Route::post('/loginsa', 'auth\LoginController@login');       //登录
    Route::post('/aa', 'auth\LoginController@aa');



});



Route::group(['namespace' => '\App\Http\Controllers\administrator','middleware' => 'lbbuoe'], function () {

    Route::post('/register', 'auth\LoginController@register');  //注册用户
    Route::post('/roleadd', 'auth\RoleController@createrole');  //创建角色
    Route::post('/roledel', 'auth\RoleController@del');         //删除角色
    Route::post('/rolelist', 'auth\RoleController@index');         //角色列表
    Route::post('/roleperm', 'auth\RoleController@rolePermissionCreate');         //新增角色权限
    Route::post('/rolepermdel', 'auth\RoleController@rolePermissionDel');         //删除角色权限
    Route::post('/rolemenu', 'auth\RoleController@rolemenuadd');                    //新增角色菜单
    Route::post('/rolemenudel', 'auth\RoleController@rolePermissionDel');         //删除角色菜单
    Route::post('/menuadd', 'auth\MenuController@createmenu');  //创建菜单
    Route::post('/menudel', 'auth\MenuController@del');         //菜单删除
    Route::post('/menulist', 'auth\MenuController@index');         //菜单列表
    Route::post('/userrole', 'UserController@userandrole');     //用户添加角色
    Route::post('/userroledel', 'UserController@userRoleDel');     //用户删除角色
    Route::post('/userlist', 'UserController@index');           //用户列表
    Route::post('/perdel', 'auth\PermissionController@del');    //删除权限
    Route::post('/peradd', 'auth\PermissionController@create');  //新增权限
    Route::post('/perlist', 'auth\PermissionController@index');  //权限列表
    Route::post('/logout', 'auth\LoginController@logout');       //退出

});

