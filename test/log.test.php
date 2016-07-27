<?php
/**
 * Created by PhpStorm.
 * User: xiaoaix
 * Date: 2016/7/27
 * Time: 14:12
 * Description:日志类测试
 */
require "../common/log.class.php";  //引入日志类

$log=new Log();
date_default_timezone_set("Asia/Shanghai");
$log->insertLog(date("Y-m-d h:i:sa"),"log.test","OK");