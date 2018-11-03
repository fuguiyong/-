<?php
/**
 * Created by PhpStorm.
 * User: fugui
 * Date: 2018/10/5
 * Time: 21:20
 */

namespace app\api\model;

use think\Model;

class Collection extends Model
{
    protected $table = 'collection';
    protected $autoWriteTimestamp = 'datetime';
}