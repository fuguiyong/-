<?php
/**
 * Created by PhpStorm.
 * User: fugui
 * Date: 2018/9/26
 * Time: 21:30
 * 发表文章api
 */

namespace app\api\controller;

use think\Session;
use think\Request;

class Publish extends Base
{
    protected $request;//操作请求变量

    //发表接口函数
    public function publish_article()
    {
        $this->request = Request::instance();

        //判断用户否登录
        $skey = $this->request->param('skey');
        $this->check_login($skey);

        //获取数据
        $openid = Session::get($skey);
        $title = $this->request->param('title');
        $content = $this->request->param('content');
        $headimgUrl = $this->request->param('headimgUrl');
        $nickName = $this->request->param('nickName');
        $imgs = @$this->request->param('imgs');

        //处理数据
        //1组装要写入数据库的数据
        $insert_data = [
            'article_id' => $this->create_article_id($openid),
            'uid' => $openid,
            'title' => $title,
            'content' => $content,
            'imgs' => $imgs,
            'nickName' => $nickName,
            'headimgUrl' => $headimgUrl,
            'good' => 0,
            'top' => 0,
            'visit_sum' => '0',
            'reply_sum' => '0',
            'push_time' => date('Y-m-d'),
            'zan_sum' => '0'
        ];

        if($imgs == null || $imgs == '[null]')
        {
            unset($insert_data['imgs']);
        }

        //插入数据库
        $m_article = model('Article');//实例化模型
        try {
            $insert_res = $m_article->allowField(true)->save($insert_data);

            if ($insert_res === false) {
                $this->return_msg('503', '服务器错误');
            }
        } catch (\Exception $e) {
            $this->return_msg('508', '发表错误', $e->getMessage());
        }


        //返回成功结果
        $this->return_msg('200', '发表成功', $insert_data);

    }

    //文章id生成规则
    protected function create_article_id($openid)
    {
        return $openid . '_' . time();
    }

}