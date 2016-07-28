<!doctype html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tips</title>
	<link rel="stylesheet" href="./css/bootstrap.min.css">
	<link rel="stylesheet" href="./css/style.css">
</head>
<body>
<!--头部容器-->
<div class="container-fluid">
	<!--头部导航栏-->
	<div class="row">
		<!--隐藏域记录会话信息-->
		<input type="hidden" id="session" value="<?php echo isset($_SESSION["userName"])?1:0; ?>">
		<input type="hidden" id="verificationEmail" value="<?php echo isset($_SESSION["regUserName"])?0:1; ?>">
		<div class="col-lg-12">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#">Tips</a>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li class="active"><a onclick="$tips.$byLoginStatusByModal()">添加提醒<span class="sr-only">(current)</span></a></li>
							<li><a href="#">文章社区</a></li>
							<li><a href="#">云存储</a></li>
							<li><a href="#">个人中心</a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">更多 <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<!-- 这里下拉列表框的选项 -->
									<?php
									if(isset($_SESSION['userName'])){
										echo "<li><a onclick='\$login.\$sendLogoutInfo();'>注销(".$_SESSION["userName"].")</a></li>";
									}else{
										echo "<li><a data-toggle='modal' data-target='#loginModal'>登录</a></li>";
										echo "<li><a data-toggle='modal' data-target='#registModal'>注册</a></li>";
									}
									?>

									<li><a  data-toggle="modal" data-target="#sayModal">联系</a></li>
									<li><a data-toggle="modal" data-target="#aboutModal">关于</a></li>
								</ul>
							</li>
						</ul>
						<form class="navbar-form navbar-left" role="search">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Search">
							</div>
							<button type="submit" class="btn btn-default" >检索</button>
						</form>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>
		</div>
	</div>
</div>