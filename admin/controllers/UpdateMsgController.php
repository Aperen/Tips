<?php
/**
 * Created by PhpStorm.
 * User: 季俊潇
 * Date: 2016/7/29
 * Time: 17:28
 * Description:更新一条提醒记录
 */
session_start();				//开启会话
require "../../common/func_db.php";			//引入数据库类
//接受传参
$datetime = $_POST['datetime'];         //更新的提醒时间
$tipContent = $_POST['tipContent'];     //更新的提醒内容
$isEmail =$_POST['isEmail'];            //是否删除任务
$updateId=$_POST['updateId'];           //更新的ID
//对传参强校验
if(!$datetime){
    echo "日期不能为空！";
}
if(!$tipContent){
    echo "提醒内容不能为空！";
}
//对日期进行格式化
$d=substr($datetime,0,10)." ".substr($datetime,11,15).":00";
//连接数据库
$con=Db::dbConnect();
if(isset($_SESSION["userName"])){
    $author = $_SESSION['userName'];
}else{
    echo $_SESSION['userName'];
}
//如果不为真，则表示需要删除任务
if(!$isEmail){
    $sql="DELETE FROM task WHERE parent_id=".$updateId;
    $ret=mysqli_query($con,$sql);
}
//将数据库中的数据更新
$isEmail=$isEmail?1:0;
$sql="UPDATE tips 
SET content='{$tipContent}',
date='{$datetime}',
author='{$author}',
is_mail={$isEmail}
WHERE id={$updateId}";
$ret=Db::dbUpdate($sql);
echo 1;