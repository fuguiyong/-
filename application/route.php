<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;


//================start==============
Route::any('test$','index/index/test');
Route::any('daytest$','api/Test/test');


Route::post('apitest$','api/XiaoLogin/login');//登录api
Route::post('getarticles$','api/GetArticles/get_page_articles');//获取文章api
Route::post('uploadfiletest$','api/UploadFile/get_files');//上传文件api
Route::post('apitest/publishtest$','api/Publish/publish_article');//发表文章api
Route::post('detailtest$','api/Detail/get_article_detail');//获取文章详细api
Route::post('replies$','api/Reply/article_reply');//评论api
Route::post('getReplies$','api/GetReplies/get_replies');//获取评论api
Route::post('collection$','api/Collection/collection');//收藏文章api
Route::post('getUserArticles$','api/GetUserArticles/get_user_articles');//获取自己发表文章api
Route::post('deleteArticle$','api/DeleteArticle/delete_article');//删除文章api
Route::post('getCollections$','api/GetCollections/get_collections');//获取用户收藏文章api

//===============end================


return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];
