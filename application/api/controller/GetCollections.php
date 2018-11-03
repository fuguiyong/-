<?php
/**
 * Created by PhpStorm.
 * User: fugui
 * Date: 2018/10/10
 * Time: 14:20
 */

/**
 * 获取用户收藏文章api
 */
namespace app\api\controller;

use think\Session;

class GetCollections extends Base
{
    public function get_collections()
    {
        //获取提交数据
        $skey = input('skey');
        $limit = input('limit');
        $page = input('page');

        //校验身份
        $this->check_login($skey);

        try{
            //处理数据
            $uid = Session::get($skey);
            $m_collect = model('Article');
            $sql = 'select *from article where article_id in (select article_id from collection where uid = ?) order by create_time DESC limit ?,?';
            $query_res = $m_collect->query($sql,[$uid,($page - 1) * $limit, $limit]);
            if($query_res === false){
                $this->return_msg('505','数据库错误');
            }
        }catch (\Exception $e){
            $this->return_msg('508','数据库错误');
        }

        //返回成功结果
        $this->return_msg('200','ok',$query_res);
    }

}