<?php
/**
 * Created by PhpStorm.
 * User: 季俊潇
 * Date: 2016/8/3
 * Time: 10:05
 * Description:通过新浪新闻接口，定时获取今日新闻,5分钟更新一次
 */
require "../common/func_db.php";            //引入数据库操作类
//获取内容
$str = file_get_contents('http://api.sina.cn/sinago/list.json?channel=news_toutiao');
//转为 Json 格式
$array = json_decode($str);
$t='news';      //定义写入的数据表
Db::dbDeleteAll($t);
$k=Array('title','sour','intro','article_date','kpic');        //定义写入数据表的字段
$article=$array->data->list;            //新闻数组
//遍历新闻数据写入数据表
for($i=0;$i<count($article);$i++){
    $v=Array($article[$i]->title,$article[$i]->source,$article[$i]->intro,$article[$i]->articlePubDate,$article[$i]->kpic);
    $ret=Db::dbInsertOne($t,$k,$v);         //写入数据库
}
