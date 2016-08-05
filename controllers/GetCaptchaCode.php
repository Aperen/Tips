<?php
/**
 * Created by PhpStorm.
 * User: xiaoaix
 * Date: 2016/8/5
 * Time: 10:10
 */
session_start();
require '../common/GetVerificationCode.php';  //先把类包含进来，实际路径根据实际情况进行修改。
$_vc = new ValidateCode();  //实例化一个对象
$_vc->doimg();
$_SESSION['authnum_session'] = $_vc->getCode();//验证码保存到SESSION中



