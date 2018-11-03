<?php
/**
 * Created by PhpStorm.
 * User: fugui
 * Date: 2018/10/3
 * Time: 22:29
 */
/*
 * 回复表模型
 * */
namespace app\api\model;

use think\Model;

class Replies extends Model
{
    protected $table = 'replies';//绑定表
    protected $autoWriteTimestamp = 'datetime';//设置自动写入时间

}