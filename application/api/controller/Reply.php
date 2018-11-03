<?php
/**
 * Created by PhpStorm.
 * User: fugui
 * Date: 2018/10/4
 * Time: 19:59
 */

/*
 * 回复api
 * */

namespace app\api\controller;

use think\Session;
use app\api\model\Article;

class Reply extends Base
{

    public function article_reply()
    {
        //获取数据
        $skey = input('skey');
        $content = input('content');
        $headimgUrl = input('headimgUrl');
        $nickName = input('nickName');
        $article_id = input('article_id');

        //校验登录
        $this->check_login($skey);

        try {
            //处理数据
            //修改reply_sum
            $one_article = Article::get(['article_id'=>$article_id]);
            $one_article->reply_sum += 1;
            $update_res = $one_article->isUpdate(true)->save();

            if($update_res === false){
                $this->return_msg('509','数据库错误');
            }

            //插入数据
            $m_reply = model('Replies');//实例化回复模型
            $insert_data = [
                'reply_id' => $this->create_reply_id($article_id),
                'uid' => Session::get($skey),
                'article_id' => $article_id,
                'headimgUrl' => $headimgUrl,
                'content' => $content,
                'nickName' => $nickName
            ];
            $res = $m_reply->allowField(true)->save($insert_data);//存入数据库
            if ($res === false) {
                $this->return_msg('503', '服务器错误，请你重试');
            }

        } catch (\Exception $e) {
            $this->return_msg('508', '评论错误', $e->getMessage());
        }

        //返回成功的结果
        $this->return_msg('200', '评论成功');
    }

    //自定义回复id
    public function create_reply_id($article_id)
    {
        return $article_id . time();
    }

}