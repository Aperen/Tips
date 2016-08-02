<?php
/**
 * Created by PhpStorm.
 * User: 季俊潇
 * Date: 2016/8/2
 * Time: 18:02
 * Description:删除文章控制器
 */
require "../../common/func_db.php";         //引入数据库操作类
$id = $_POST['delId'];
$ret=Db::dbDelete("article",$id);           //根据ID删除文章
echo 1;         //返回成功
