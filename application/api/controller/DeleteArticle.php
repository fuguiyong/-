<?php
/**
 * Created by PhpStorm.
 * User: fugui
 * Date: 2018/10/10
 * Time: 11:01
 */

/**
 *删除文章api
 */
namespace app\api\controller;

use app\api\model\Article;
use think\Session;

class DeleteArticle extends Base
{
    public function delete_article()
    {
        //获取提交数据
        $skey = input('skey');
        $article_id = input('article_id');

        //校验身份
        $this->check_login($skey);

        //处理数据
        try{
            $uid = Session::get($skey);
            $one_article = Article::get(['uid'=>$uid,'article_id'=>$article_id]);
            $del_res = $one_article->delete();
            if($del_res === false){
                $this->return_msg('505','数据库错误');
            }
        }catch (\Exception $e){
            $this->return_msg('506',$e->getMessage());
        }


        //返回成功结果
        $this->return_msg('200','ok');
    }

}