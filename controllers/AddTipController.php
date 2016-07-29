<?php
session_start();				//开启会话
require ("../common/func_db.php");			//引入数据库类
//接受传参
$datetime = $_POST['datetime'];
$tipContent = $_POST['tipContent'];
$isEmail =$_POST['isEmail'];
//对传参强校验
if(!$datetime){
	echo "日期不能为空！";
}
if(!$tipContent){
	echo "提醒内容不能为空！";
}
//对日期进行格式化
$d=substr($datetime,0,10)." ".substr($datetime,11,15).":30";
//连接数据库
$con=Db::dbConnect();
if(isset($_SESSION["userName"])){
	$author = $_SESSION['userName'];
}else{
	echo $_SESSION['userName'];
}

//将数据写入数据库
$t="tips";			//插入表名
$isEmail=$isEmail?1:0;	//是否推送邮件
$k=Array("content","date","author","is_mail");//插入字段
$v=Array($tipContent,$d,$author,$isEmail);	//插入字段值
$ret=Db::dbInsertOne($t,$k,$v);		//插入数据库
//返回上一次插入记录的ID
$parentId=Db::dbQueryOne($con,"select max(id) from tips")['max(id)'];
//如果提醒推送邮件
if($isEmail){
	$sql="SELECT * FROM user WHERE username='{$author}'";
	$ret1=Db::dbQueryOne($con,$sql);
	$t="task";
	$k=Array("user_id","exce_time","content","status","parent_id");
	$v=Array($ret1['id'],$datetime,$tipContent,'0',$parentId);
	$ret=Db::dbInsertOne($t,$k,$v);
}
echo 1;
?>