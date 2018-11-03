<?php
/**
 * Created by PhpStorm.
 * User: fugui
 * Date: 2018/10/2
 * Time: 20:54
 */

/*
 * 获取文章详细信息api
 * */

namespace app\api\controller;

use app\api\model\Article;
use think\Session;

class Detail extends Base
{
    public function get_article_detail()
    {
        //获取数据
        $skey = input('skey');
        $article_id = input('article_id');

        //验证身份
        $this->check_login($skey);

        //处理数据，获取结果

        //修改visit_sum
        $one_article = Article::get(['article_id' => $article_id]);
        $one_article->visit_sum += 1;
        $update_res = $one_article->isUpdate(true)->save();

        if($update_res === false){
            $this->return_msg('509','数据库错误');
        }

        //detail
        $mod_article = model('Article');//实例化文章表模型
        $sql = 'select *from article where article_id = ? limit 1';
        $res = $mod_article->query($sql, [$article_id]);

        if ($res === false) {
            $this->return_msg('507', '数据库错误');
        }

        //获取该用户是否收藏信息
        $uid = Session::get($skey);
        $one_collection = \app\api\model\Collection::get(['uid'=>$uid,'article_id'=>$article_id]);
        if($one_collection !== false && $one_collection != null){
            $is_collect = [
                'is_collect'=>true
            ];
        }else{
            $is_collect = [
                'is_collect'=>false
            ];
        }

        //返回结果
        $this->return_msg('200', 'ok', [$res,$is_collect]);
    }

}