<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

if( !function_exists("result") ) {
    /**
     * @param string $return_code FAIL SUCCESS  返回状态码
     * @param string $return_msg 返回信息
     */
    function result($return_code, $return_msg)
    {
        return ['return_code' => $return_code, 'return_msg' => $return_msg];
    }

    /**
     * 权限安全
     * @return \Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
     */
     function is_role($id)
    {

        if(!session('menuurl'.$id)){
            $data=DB::table('role_users')->leftJoin('role_permissions','role_users.role_id','=','role_permissions.role_id')
                ->join('permissions','role_permissions.permission_id','=','permissions.id')
                ->where('role_users.user_id',$id)
                ->select('permissions.id','permissions.name','permissions.http_path','permissions.http_method')
                ->get();

            if(!is_array($data)) result('FALT','此用户没用权限访问');
            $list=[];
            $url=[];
            foreach ($data as $val){
                $list[]=$val;
                $url[]=$val->http_path;
            }
            session(['permissionurl'.$id=>$url]);
            session(['permissionlist'.$id=>$list]);

        }
        return session('permissionurl'.$id);

    }

    /**
     * @param string $exception 异常
     * @param string $logFileName  文件名
     */
    function exception($exception,$logFileName)
    {
        $obj = '{
            "message": '.$exception->getMessage().',
            "code": '.$exception->getCode().',
            "file": '.$exception->getFile().',
            "line": '.$exception->getLine().',
        }';

        $log = new Logger('Error:Info');
        $log->pushHandler(new StreamHandler(storage_path('logs/'.$logFileName.'-'.date('Y-m-d',time()).'.log'),Logger::ERROR) );
        $log->addError($obj);
    }
}