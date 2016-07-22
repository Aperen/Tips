<?php 
session_start();				//开启会话
unset($_SESSION['userName']);	//删除会话
echo 2000;                      //返回信息代码
?>