<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class User extends Model
{
    /** 用户 */
    /**
     *用户创建
     * @param $data
     * @return array
     */
    public function create($data)
    {
        try{
            $data['password'] = Hash::make($data['password']);
            $resu=static::insert($data);
            return isset($resu) ?  result('SUCCESS','用户创建成功') :  result('SUCCESS','用户创建失败');

        }catch (\Exception $exception){
            exception($exception,'VideoResource');
            return result('FAIL',$exception->getMessage());
        }
    }

    /**
     * 删除用户
     * @param $id
     * @return array
     */
    public function del($id)
    {
        try {
            $start = static::where('id', $id)->delete();
            return isset($start) ? result('SUCCESS','用户删除成功') : result('FALT','用户删除失败,请您刷新后重试');
        }catch (\Exception $exception){
            exception($exception,'VideoResource');
            return result('FAIL',$exception->getMessage());
        }
    }

    /**
     * 获取用户
     */
    public function list()
    {

    }
}