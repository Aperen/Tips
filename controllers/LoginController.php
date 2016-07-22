<?php 
session_start();				//开启会话
//接受数据并校验
$userName=$_POST['userName'];
$passWord=$_POST['passWord'];
if(!$userName){				//如果用户名为空或不存在
	echo "用户名不能为空！";
}
if(!$passWord){				//如果密码为空或不存在
	echo "密码不能为空！";
}
//连接数据库
$con=mysqli_connect("localhost","root","","tips");
if(!$con){			//如果连接失败
	echo "数据库连接失败：".mysqli_connect_error;		//输出连接错误信息
}
mysqli_query($con,"SET NAMES UTF8");		//设置数据库编码
//读取数据库信息校验用户名和密码
$sql="SELECT * FROM user WHERE username ='".$userName."'AND password='".md5($passWord)."'";
$ret=mysqli_query($con,$sql);							//查询该用户
if(mysqli_affected_rows($con)){		//如果该用户存在
	//用户名和密码正确,用户名写入会话
	$_SESSION['userName']=$userName;
	mysqli_close($con);			//关闭数据库连接
	echo 1000;
}else{
	mysqli_close($con);
	echo 1001;
}
?>