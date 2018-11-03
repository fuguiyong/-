<?php
/**
 * Created by PhpStorm.
 * User: fugui
 * Date: 2018/9/21
 * Time: 21:11
 */

namespace app\api\model;

use think\Model;

class Article extends Model
{
    protected $table = 'article';
    // 开启自动写入时间戳
    protected $autoWriteTimestamp = 'datetime';

    //修改器
//    public function setNickNameAttr($value){
//        return base64_encode($value);
//    }

//    public function setTitleAttr($value){
//        return base64_encode($value);
//    }
//
//    public function setContentAttr($value){
//        return base64_encode($value);
//    }

    //获取器
//    public function getNickNameAttr($value){
//        return base64_decode($value);
//    }

//    public function getTitleAttr($value){
//        return base64_decode($value);
//    }
//
//    public function getContentAttr($value){
//        return base64_decode($value);
//    }
}