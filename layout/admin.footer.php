<?php
/**
 * Created by PhpStorm.
 * User: 季俊潇
 * Date: 2016/7/28
 * Time: 15:50
 */

?>
<nav class="navbar navbar-default navbar-fixed-bottom">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                <img alt="face" src="<?php echo $retCurrentUser['face_url']; ?>" width="38px" style="margin:-10px;" class="img-circle">
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="../index.php">首页<span class="sr-only">(current)</span></a></li>
                <li><a href="msgbox.php">消息盒子</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">用户中心<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="userinfo.php">用户信息（开发中）</a></li>
                        <li><a href="#">资源报表（开发中）</a></li>
                        <li><a href="#">平台设置（开发中）</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">文章管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="articlemarge.php">文章管理</a></li>
                        <li><a href="article.php">新增文章</a></li>
                        <li><a href="#">分类管理(开发中)</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">多媒体管理(开发中)</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a onclick="$adminMarge.$logout();">注销</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<!--底部导航栏-->







<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../layer/layer.js"></script>
<script type="text/javascript" src="../js/index.js"></script>
</body>
</html>
