<?php
/**
 * Created by PhpStorm.
 * User:季俊潇
 * Date: 2016/7/30
 * Time: 10:27
 * Description:项目配置文件
 */

$config=Array(
    "siteName"=>"TIPS社区",          //站点名称
    "version"=>'VO.8.1',           //系统版本
    "smtpServer"=>'smtp.163.com',       //SMTP 服务器
    "smtpPost"=>25,             //SMTP 端口
    "emailAddress"=>'xiaotingyizhan@163.com',    //发件人邮箱
    "stmpUser"=>'xiaotingyizhan',               //发件人用户名
    "stmpPw" => 'Wxiao741895623&',              //邮箱密码
    "mailType"=>'HTML',                 //邮件类型
);
return $config;         //返回配置数组
