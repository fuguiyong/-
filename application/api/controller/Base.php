<?php
/**
 * Created by PhpStorm.
 * User: fugui
 * Date: 2018/9/19
 * Time: 8:51
 */

namespace app\api\controller;

use think\Controller;
use think\Session;

class Base extends Controller
{
    //返回信息函数
    public function return_msg($errcode='', $errmsg = '', $data = null)
    {
        header('Content-type: application/json');

        $backInfo = [
            'errcode' => $errcode,
            'errmsg' => $errmsg,
            'data' => $data
        ];

        echo json_encode($backInfo,JSON_UNESCAPED_UNICODE);
        die;
    }

    //判断是否登陆函数
    public function check_login($skey)
    {
        if(!Session::has($skey)){
            $this->return_msg('502','登录标识失效，正在重新登录');
        }
    }

}