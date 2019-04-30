<?php



if( !function_exists("result") ) {
    /**
     * @param string $return_code FAIL SUCCESS  返回状态码
     * @param string $return_msg 返回信息
     */
    function result($return_code, $return_msg)
    {
        return ['return_code' => $return_code, 'return_msg' => $return_msg];
    }
}