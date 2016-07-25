<?php
/**
 * Created by PhpStorm.
 * User: 季俊潇
 * Date: 2016/7/22
 * Time: 15:22
 */
session_start();            //开启会话
//error_reporting(0);                     //屏蔽掉邮件发送之后的警告信息
require "../common/email.class.php";        //引入发送邮件类
require "../common/func_db.php";            //引入数据库操作类
//获取前台的传参
$email=$_POST['regEmail'];              // 邮箱
$userName=$_POST['regUserName'];        // 用户名
$PassWd=$_POST['regPassword'];          // 密码
//对传参进行强校验
if(!isset($userName)){           // 如果用户名为空
    echo "1001";          //用户名字段不能为空
}
if(!isset($PassWd)){             //如果密码为空
    echo "1002";                //用户名字段不能为空
}
if(!isset($email)){
    echo "1003";            //邮箱字段不能为空
}else{
    //检查用户表中是否存在相同的邮箱
    $con=Db::dbConnect();
    $sql="Select * FROM user WHERE email = '{$email}'";
    $ret=Db::dbQueryOne($con,$sql);
    if(mysqli_affected_rows($con)>0){
        echo "1004";        //该邮箱已被注册
    }else{
        $_SESSION['regUserName']=$userName;     //将用户名写入会话
        //发送验证电子邮件
        $x=base64_encode($userName);
        $y=base64_encode($email);
        $z=base64_encode($PassWd);
        $url = "tips.xiaoaix.cn/controllers/CallEmialUrlController.php?x=".$x."&y=".$y."&z=".$z;
        //******************** 邮件配置信息 ********************************
        $smtpserver = "smtp.163.com";//SMTP服务器
        $smtpserverport =25;//SMTP服务器端口
        $smtpusermail = "xiaotingyizhan@163.com";//SMTP服务器的用户邮箱
        $smtpemailto =$email;//发送给谁
        $smtpuser = "xiaotingyizhan";//SMTP服务器的用户帐号
        $smtppass = "Wxiao741895623&";//SMTP服务器的用户密码
        $mailtitle = "TIPS 需要验证你的邮箱地址";//邮件主题
        $mailcontent = "<a href='{$url}'>请点击链接:验证邮箱</a><br />如果链接无法访问，请复制如下路径粘贴在浏览器的地址栏中，进行访问：{$url}";//邮件内容
        $mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
        $smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
        $smtp->debug = false;//是否显示发送的调试信息
        $state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);
        echo "1005";            //等待验证邮箱
    }
}

?>