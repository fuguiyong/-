<?php
/**
 * Created by PhpStorm.
 * User: fugui
 * Date: 2018/10/4
 * Time: 22:43
 */

/*
 * 获取文章评论接口
 * */

namespace app\api\controller;


class GetReplies extends Base
{
    public function get_replies()
    {
        //获取数据
        $skey = input('skey');
        $article_id = input('article_id');
        $page = input('page');
        $limit = input('limit');

        //验证登录状态
        $this->check_login($skey);

        //处理数据
        $m_reply = model('Replies');//实例化评论表模型
        $sql = 'select *from replies where article_id = ? order by create_time DESC limit ?,?';
        $res = $m_reply->query($sql, [$article_id, ($page - 1) * $limit, $limit]);

        if ($res === false) {
            $this->return_msg('503', '服务器错误，请重试');
        }

        //返回成功结果
        $this->return_msg('200', 'ok', $res);
    }
}