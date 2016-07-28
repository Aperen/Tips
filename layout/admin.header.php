<?php
/**
 * Created by PhpStorm.
 * User: xiaoaix
 * Date: 2016/7/28
 * Time: 15:54
 */
session_start();                                    //开启会话
if(!isset($_SESSION['userName'])) {              //如果尚没有登录
    header("Location:../index.php");            //跳转至主页
}else{
    $userName=$_SESSION['userName'];               //将会话中的用户名复制给变量
}
require "../common/func_db.php";            //引入数据库操作类
$con= Db::dbConnect();
$sql="SELECT * FROM user WHERE username = '{$userName}'";
$ret=Db::dbQueryOne($con,$sql);
?>

<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>用户后台管理—TIPS</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>