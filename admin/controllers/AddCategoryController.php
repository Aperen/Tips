<?php
/**
 * Created by PhpStorm.
 * User: 季俊潇
 * Date: 2016/7/30
 * Time: 15:49
 * Description:新增分类控制器
 */
require "../../common/func_db.php";
//获取传值
$addCategoryName=$_POST['addCategoryName']; //分类名
$currentUserId=$_POST['currentUserId'];     //当前登录用户ID
//对传值进行校验
if(!isset($addCategoryName)){
    echo "分类名称不能为空";
}
if(!isset($currentUserId)){
    echo "用户环境异常，用户ID为空";
}
//将数据保存到文章分类表中
$t="category";          //表名：文章分类表
$k=Array("name","user_id");       //指分类名字段
$v=Array($addCategoryName,$currentUserId);     //指分类名称字段的值
$ret=Db::dbInsertOne($t,$k,$v);     //插入一条记录并返回结果
echo 1;     //表示返回成功