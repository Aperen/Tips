<?php
/**
 * Created by PhpStorm.
 * User: 季俊潇
 * Date: 2016/7/26
 * Time: 20:55
 */
ignore_user_abort(TRUE);// 设定关闭浏览器也执行程序
set_time_limit(0);     // 设定响应时间不限制，默认为30秒
require "../common/func_db.php";        //引入数据库操作类
require "../common/email.class.php";    //引入发送邮件类
error_reporting(0);                     //屏蔽掉邮件发送之后的警告信息
$con = Db::dbConnect();
//定义语句查出时间距离最近的一条,执行状态不为0，表示没有执行过的
$sql = "SELECT * FROM task where status =0 ORDER BY exce_time LIMIT 0,1";
while(TRUE) {
    //sleep(300);          // 每5分钟执行一次
    //查出距离现在最近的一条记录，查找5分钟后执行的任务
    date_default_timezone_set("Asia/Shanghai"); //设置时区为亚洲上海
    $ret=Db::dbQueryOne($con,$sql);         //执行 SQL
    $sql2="SELECT * FROM user WHERE id={$ret['user_id']}";
    $ret2=Db::dbQueryOne($con,$sql2);
    var_dump($ret2['email']);
    //如果时间剩下不到5分钟
    if(strtotime($ret['exce_time'])-strtotime(date("Y-m-d h:i:sa"))<300){
        //******************** 邮件配置信息 ********************************
        $smtpserver = "smtp.163.com";//SMTP服务器
        $smtpserverport =25;//SMTP服务器端口
        $smtpusermail = "xiaotingyizhan@163.com";//SMTP服务器的用户邮箱
        $smtpemailto =$ret2['email'];//发送给谁
        $smtpuser = "xiaotingyizhan";//SMTP服务器的用户帐号
        $smtppass = "Wxiao741895623&";//SMTP服务器的用户密码
        $mailtitle = "TIPS五百里加急";//邮件主题
        $mailcontent = "<a href='{$url}'>小主，您有最新的提醒，快来看一看哦：{$ret['content']}";//邮件内容
        $mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
        $smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
        $smtp->debug = false;//是否显示发送的调试信息
        $state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);
        $statusSql="UPDATE task SET status =1 WHERE id={$ret['id']}";   //定义SQL语句，修改状态为1，表示已执行
        $statusRet=Db::dbUpdate($statusSql);        //执行更新语句并返回影响条数
    }
}