<?php
/**
 * Created by PhpStorm.
 * User: fugui
 * Date: 2018/10/9
 * Time: 22:43
 */

/*
 * 获取对应用户的发表的文章
 * */

namespace app\api\controller;

use think\Session;

class GetUserArticles extends Base
{
    public function get_user_articles()
    {
        //获取 数据
        $skey = input('skey');
        $page = input('page');//获取页数
        $limit = input('limit');//每页文章数量

        //校验登陆状态
        $this->check_login($skey);

        try{
            //处理数据
            $userName = Session::get($skey);
            $article = model('Article');//实例化model
            $sql = 'select * from article where uid = ? order by create_time DESC limit ?,?';
            $res = $article->query($sql, [$userName,($page - 1) * $limit, $limit]);
            if ($res === false) {
                $this->return_msg('504', '数据查询错误');
            }
        }catch (\Exception $e){
            $this->return_msg('509',$e->getMessage());
        }

        //返回成功结果
        $this->return_msg('200','ok',$res);

    }

}