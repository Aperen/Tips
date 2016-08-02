<?php
/**
 * Created by PhpStorm.
 * User: 季俊潇
 * Date: 2016/8/2
 * Time: 16:30
 * Description:更新文章控制器
 */
session_start();        //开启会话
require "../../common/func_db.php";     //引入数据库控制类
$con=Db::dbConnect();
$id=$_POST["updateId"];
$articleTitle=$_POST['articleTitle'];       //从前台获取文章标题
$articleContent=$_POST['articleContent'];   //从前台获取文章内容
$author=$_SESSION['userName'];          //从会话中当前用户的用户名
//从数据库的用户表中查询用户当前登录的用户记录
$retUser=Db::dbQueryOne($con,"SELECT id FROM user WHERE username ='{$author}'");
$authorId=$retUser['id'];           //从用户记录中获取用户ID
$auth=$_POST['auth'];           //从前台获取文章权限，是否公开
//将汉字转换为数字的布尔值
if($auth=="公开"){
    $auth=1;
}
if($auth=="不公开"){
    $auth=0;
}
$categoryName=$_POST['categoryName'];     //从前台获取文章分类名称
//根据分类名从数据库中查出分类ID
$retCategory=Db::dbQueryOne($con,"SELECT id FROM category WHERE name='{$categoryName}'");
$categoryId=$retCategory['id'];         //获取文章分类ID
$sql="UPDATE article ".
  " set title='{$articleTitle}', ".
  " content='{$articleContent}', ".
  " author={$authorId}, ".
  " auth ={$auth}, ".
    "category_id={$categoryId} ".
    "WHERE id={$id}";
$retUpdate=Db::dbUpdate($sql);
echo 1;