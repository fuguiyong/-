<?php
/**
 * Created by PhpStorm.
 * User: fugui
 * Date: 2018/9/25
 * Time: 22:36
 */

namespace app\api\controller;

use think\Session;

class UploadFile extends Base
{
    protected $allow_upload_type = [
        'image/jpeg', 'image/jpg', 'image/gif', 'image/png','video/mp4'
    ];//允许上传类型

    public function get_files()
    {
        //获取文件数据
        $skey = input('skey');
        $error = $_FILES['file']['error'];
        $type = $_FILES['file']['type'];
        $size = $_FILES['file']['size'];
        $name = $_FILES['file']['name'];//太长了
        $tmp_name = $_FILES['file']['tmp_name'];

        //验证用户身份，是否登陆
        $this->check_login($skey);

        //过滤文件
        if ($error > 0) {//判断文件是否上传错误
            $this->return_msg('401', '上传文件错误');
        }

        if (!in_array($type, $this->allow_upload_type)) {//判断类型
            $this->return_msg('402', '文件类型不允许');
        }

        if($size > 500000){//文件大于5mb不允许
            $this->return_msg('403', '文件过大');
        }

        //压缩文件

        //保存文件
        $save_name = ROOT_PATH . 'public/static/uploadImgs/' . $name;//保存文件位置

        if(!file_exists($save_name)){//文件不存在时再上传
          //  file_put_contents('file.txt','文件不存在');
            $move_res = move_uploaded_file($tmp_name, $save_name);
            if (!$move_res) {//上传失败
                $this->return_msg('501', '保存文件失败');
            }
        }

        //返回结果（文件位置）
        $file_name = 'http://119.23.78.140/public/static/uploadImgs/'.$name;
        $this->return_msg('200','ok',$file_name);


    }

    //文件命名
    protected function create_file_name($skey)
    {
        $openid = Session::get($skey);
        return $openid.time();

    }

}