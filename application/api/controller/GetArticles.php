<?php
/**
 * Created by PhpStorm.
 * User: fugui
 * Date: 2018/9/22
 * Time: 8:43
 */

namespace app\api\controller;


class GetArticles extends Base
{
    public function get_page_articles()
    {
        //获取提交的数据
        $skey = input('skey');
        $tab = input('tab');
        $page = input('page');//获取页数
        $limit = input('limit');//每页文章数量

        //验证登录
        $this->check_login($skey);

        //获取数据数据
        $article = model('Article');//实例化model
        switch ($tab) {
            //全部
            case 'all':
                $sql = 'select * from article order by create_time DESC limit ?,?';
                break;
            //精品
            case 'good':
                $sql = 'select * from article where good = 1 order by create_time DESC limit ?,?';
                break;

        }
        $res = $article->query($sql, [($page - 1) * $limit, $limit]);
        if ($res === false) {
            $this->return_msg('504', '数据查询错误');
        }

        //返回数据
        $this->return_msg('200', 'ok', $res);//返回结果

    }

}