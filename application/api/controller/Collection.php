<?php
/**
 * Created by PhpStorm.
 * User: fugui
 * Date: 2018/10/5
 * Time: 21:12
 */

/*
 * 收藏api
 * */

namespace app\api\controller;


use think\Session;

class Collection extends Base
{
    public function collection()
    {
        //获取数据
        $skey = input('skey');
        $is_collect = input('is_collect');
        $article_id = input('article_id');

        //校验身份
        $this->check_login($skey);

        if ($is_collect) {//已经收藏
            $this->cancel_collect($article_id, $skey);
        } else {//没有收藏
            $this->collect($article_id, $skey);
        }

    }

    //取消收藏函数
    public function cancel_collect($article_id, $skey)
    {

        //处理数据
        $uid = Session::get($skey);

        $one_collection = \app\api\model\Collection::get(['article_id' => $article_id, 'uid' => $uid]);
        $del_res = $one_collection->delete();

        if ($del_res === false) {
            $this->return_msg('504', '数据库错误');
        }

        //返回成功结果
        $this->return_msg('200', '取消收藏成功');

    }

    //收藏函数
    public function collect($article_id, $skey)
    {
        try {
            //处理数据
            $m_collection = model('Collection');

            $insert_data = [
                'collection_id' => $this->create_id($article_id, $skey),
                'uid' => Session::get($skey),
                'article_id' => $article_id,
            ];


            $res = $m_collection->allowField(true)->save($insert_data);
        } catch (\Exception $e) {
            $this->return_msg('500', $e->getMessage());

        }


        if ($res === false) {
            $this->return_msg('503', '数据库错误');
        }

        //返回成功结果
        $this->return_msg('200', '收藏成功');
    }


    //自定义收藏id
    public function create_id($article_id, $skey)
    {
        $uid = Session::get($skey);
        $collection_id = md5($uid . $article_id . time());
        return $collection_id;

    }

}