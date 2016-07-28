<?php
/**
 * Created by PhpStorm.
 * User: xiaoaix
 * Date: 2016/7/28
 * Time: 18:04
 */
session_start();				//开启会话
unset($_SESSION['userName']);	//删除会话
echo 2000;
?>

