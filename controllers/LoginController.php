<?php 
session_start();				//开启会话
require "../common/func_db.php";			//引入数据库操作类
require "../common/log.class.php";
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
$con=Db::dbConnect();
//读取数据库信息校验用户名和密码
$sql="SELECT * FROM user WHERE (username ='".$userName."' OR email='".$userName."') AND password='".md5($passWord)."'";
$ret=Db::dbQueryOne($con,$sql);							//查询该用户
if(mysqli_affected_rows($con)){		//如果该用户存在
	//用户名和密码正确,用户名写入会话
	$_SESSION['userName']=$ret['username'];
	mysqli_close($con);			//关闭数据库连接
	echo 1000;
}else{
	mysqli_close($con);
	echo 1001;
}
?>