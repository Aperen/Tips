<?php
/**
 * Created by PhpStorm.
 * User: xiaoaix
 * Date: 2016/7/29
 * Time: 15:09
 */
require '../../common/func_db.php';     //引入数据库操作类
$msgId=$_POST['msgId'];
$con=Db::dbConnect();
$sql="SELECT date,content FROM tips WHERE id=".$msgId;
$ret=Db::dbQueryOne($con,$sql);
echo json_encode($ret);

