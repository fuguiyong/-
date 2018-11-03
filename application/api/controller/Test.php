<?php
/**
 * Created by PhpStorm.
 * User: fugui
 * Date: 2018/9/21
 * Time: 21:14
 */

namespace app\api\controller;

use app\api\model\Article;

class Test extends Base
{
    public function test()
    {
        /**
         * 触发器test
         */
        try{
            $one_article = Article::get(['article_id'=>'ou2WW5B9Yek_22WE4dLV_IN8TqG8_1538377904']);
            $one_article->visit_sum = '10';
            $res = $one_article->isUpdate(true)->save();

            if($res === false){
                echo '更新失败';
            }else{
                echo '更新成功';
            }
        }catch (\Exception $e){
            echo $e->getMessage();
        }

//
//        try {
//            //处理数据
//            $m_collection = model('Collection');
//
//            $insert_data = [
//                'collection_id' => 'hjvvfggh',
//                'uid' =>'iiiiiii',
//                'article_id' => 'rrffcxdsc',
//            ];
//
//            $res = $m_collection->allowField(true)->save($insert_data);
//            dump($res);
//        }catch (\Exception $e){
//            $this->return_msg('500',$e->getMessage());
//
//        }
//        $data = [
//            'reply_id'=>'dadhakjdajb',
//            'article_id'=>'dajdajbdkaj',
//            'uid'=>'rftvahdajbd',
//            'content'=>'这篇文章很好，这家商店很好'
//        ];
//
//        $m_repliy = model('Replies');
//        $res = $m_repliy->allowField(true)->save($data);
//        dump($res);

//        //获取数据数据
//        $article = model('Article');//实例化model
//        $sql = 'select * from article order by create_time DESC limit ?,?';
//
//        // $res = $article->page($page, $limit)->select();
//        $res = $article->query($sql, [1, 10]);
//        if ($res === false) {
//            $this->return_msg('504', '数据查询错误');
//        }
//        dump($res);

//       $img = \think\Image::open(ROOT_PATH.'application/public/static/test.png');
//        $type = $img->type();
//
//        echo $type;

        //$article = new Article();
//        $article = model('Article');
//        $insert_data = [
//            'article_id'=>'aaaaaa',
//            'uid'=>'ufgybjndaljlkxbay',
//            'title'=>'php+mysql+apache',
//            'content'=>'PHP（外文名:PHP: Hypertext Preprocessor，中文名：“超文本预处理器”）是一种通用开源脚本语言。语法吸收了C语言、Java和Perl的特点，利于学习，使用广泛，主要适用于Web开发领域。PHP 独特的语法混合了C、Java、Perl以及PHP自创的语法。它可以比CGI或者Perl更快速地执行动态网页。用PHP做出的动态页面与其他的编程语言相比，PHP是将程序嵌入到HTML（标准通用标记语言下的一个应用）文档中去执行，执行效率比完全生成HTML标记的CGI要高许多；PHP还可以执行编译后代码，编译可以达到加密和优化代码运行，使代码运行更快。',
//            'good'=>1,
//            'top'=>1,
//            'visit_sum'=>'123',
//            'reply_sum'=>'22',
//            'push_time'=>date('Y-m-d'),
//            'zan_sum'=>'99'
//        ];
//       $res = $article->allowField(true)->save($insert_data);
//       dump($res);
//        $sql = 'select * from article';
//        $res = $article->query($sql);
//        dump($res);

    }

}