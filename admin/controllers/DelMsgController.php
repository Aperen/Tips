<?php
/**
 * Created by PhpStorm.
 * User: xiaoaix
 * Date: 2016/7/29
 * Time: 16:36
 */
require '../../common/func_db.php';     //引入数据库操作类
$delId=$_POST['delId'];     //获取记录ID
$ret=Db::dbDelete("tips",$delId);
echo 1;
