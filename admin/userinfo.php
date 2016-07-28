<?php
/**
 * Created by PhpStorm.
 * User: 季俊潇
 * Date: 2016/7/28
 * Time: 21:21
 * Description:用户信息
 */
?>
<?php require "../layout/admin.header.php";   //引入后台头部文件 ?>

<div class="container">
    <br><br>
    <div class="row">
        <div class="col-lg-7">
            <!--用户基本信息填写-->
            <div class="panel panel-default">
                <div class="panel-heading">
                    用户基本信息设置
                </div>
                <div class="panel-body">
                    昵称: <input type="text" max="10" class="form-control"><br>
                    头像: <input type="file" class="form-control"><br>
                    出生年月: <input type="date" class="form-control"><br>
                    性别: <label class="radio-inline">
                        <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> 男
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> 女
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3"> 保密
                    </label><br><br>
                    心情：<label class="radio-inline">
                        <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> 好
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> 一般
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3"> 不好
                    </label><br><br>
                    座右铭：
                    <textarea class="form-control" ></textarea><br>
                    <button type="submit" class="btn btn-default">提交</button>

                </div>
            </div>
        </div>

        <!--用户实时信息显示-->
        <div class="col-lg-4 col-lg-offset-1">
            <!--用户基本信息填写-->
            <div class="panel panel-default">
                <div class="panel-heading">
                    登录账户信息
                </div>
                <div class="panel-body">
                    IP地址: 192.168.12.127<br><br>
                    登录地点: 浙江省杭州市<br><br>
                    登录次数： 15<br><br>
                    操作系统:Windows NT <br><br>
                    浏览器:    Google Chrome
                    <hr>
                    账户余额：245元<br><br>
                    积分：1232<br><br>
                    短信剩余条数：500 条<br><br>
                    云存储空间：150 GB<br>
                    <hr>
                    注册日期：2016年6月1日


                </div>
            </div>
        </div>
</div>

<?php require "../layout/admin.footer.php";   //引入后台底部文件 ?>


