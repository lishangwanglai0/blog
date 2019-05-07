<?php


namespace App\Support\traits;


use mysql_xdevapi\Result;

trait Rolesales
{
    /**
     * 是否有权限访问
     * @param $id
     * @return bool
     */
    public function safety($id)
    {
       $role=is_role($id);
//       return \result('FALT','请登录');
       $url=substr($_SERVER["REQUEST_URI"],4);
//       dd($url,$role);
       if(!in_array($url,$role)){
           return false;
       }
       return true;
    }
}