<?php
/**
 * Created by PhpStorm.
 * User: fugui
 * Date: 2018/9/18
 * Time: 22:46
 */

namespace app\api\controller;

use weixin_all\xiao_login\Login;//小程序登录接口
use think\Session;

class XiaoLogin extends Base
{
    //小程序登录接口请求的函数
    public function login()
    {
        //获取code
        $code = input('code');
        //使用微信提供api
        $new_xiao = new Login();//封装的登录类
        //配置参数
        $new_xiao->set_appid(config('appid'));
        $new_xiao->set_secret(config('secret'));
        $new_xiao->set_code($code);
        //开始请求api,获取返回的数据
        $res = $new_xiao->get_request();
        //设置自定义登录态
        $openid = $this->get_openid($res);
        $skey = $this->get_skey($res);
        //存入session
        Session::set($skey,$openid);
        $session_id = session_id();////发给小程序，用户维持session会话
        //返回小程序
        $back_data = [
            'skey'=>$skey,
            'session_id'=>$session_id
        ];
        $this->return_msg('200','ok',$back_data);

    }

    //自定义登录态函数
    private function get_skey($res)
    {
        $arr = json_decode($res,true);
        $openid = $arr['openid'];
        $skey = sha1(md5($openid)+md5(time()));
        return $skey;

    }

    //获取openid
    private function get_openid($res)
    {
        $arr = json_decode($res,true);
        $openid = $arr['openid'];
        return $openid;
    }

}