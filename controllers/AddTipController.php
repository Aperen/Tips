<?php
session_start();				//开启会话
//接受传参
$datetime = $_POST['datetime'];
$tipContent = $_POST['tipContent'];
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
$con=mysqli_connect("localhost","root","","tips");
if(!$con){			//如果连接失败
	echo "数据库连接失败：".mysqli_connect_error;		//输出连接错误信息
}
if(isset($_SESSION["userName"])){
	$author = $_SESSION['userName'];
}else{
	echo $_SESSION['userName'];
}

mysqli_query($con,"SET NAMES UTF8");		//设置数据库编码
//将数据写入数据库
$sql="INSERT INTO tips (`content`,`date`,`author`) VALUES ('{$tipContent}','{$d}','{$author}')";
$ret=mysqli_query($con,$sql);
if(mysqli_affected_rows($con)>=0){			//如果受影响的行数大于0
	echo 3000;					//表示插入成功
}else{				//否则
	echo 3001;				//插入失败
}
?>