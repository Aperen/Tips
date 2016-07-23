<?php
/**
 * Created by PhpStorm.
 * User: 季俊潇
 * Date: 2016/7/23
 * Time: 11:01
 */
session_start();            //开启会话
require "../common/func_db.php";        //引入数据库类
$regUserName=$_SESSION['regUserName'];
//路径信息与会话信息进行校对
if(base64_decode($_GET['x'])==$regUserName){
    //将用户信息写入数据库
    $table='user';              //写入的表名
    $k=Array('username','password','email','role_id');        //写入的字段
    $v=Array(base64_decode($_GET['x']),md5(base64_decode($_GET['z'])),base64_decode($_GET['y']),'');     //写入的字段值
    $ret=Db::dbInsertOne($table,$k,$v);                  //将新注册的用户插入数据库
    if($ret){             //插入成功
        unset($_SESSION['regUserName']);        //销毁临时会话
        header("Location:http://tips.xiaoaix.cn");   //跳转到网站主页
        exit;           //确保重定向之后代码不会被执行
    }else{
        echo "新增用户失败，请联系网站管理员！";       //输出错误信息
    }
}else{          //访问路径遭到篡改，于会话信息不一致
    echo "非法的访问路径";
}