<?php
/*
 * 创建人：季俊潇
 * 创建日期：2016年7月21日
 * 修改日期：2016年7月22日 11:06
 * 描述：首页展示
 */
session_start();				//开启会话
require ("./common/func_db.php");			//引入数据库类
if(isset($_SESSION["userName"])){
	$con=Db::dbConnect();			//数据库连接
	$sql="SELECT * FROM tips  WHERE author='{$_SESSION["userName"]}' ORDER BY DATE DESC Limit 0,5";
	$ret=Db::dbQueryAll($con,$sql);
	$flag=false;
}else{
	$flag=true;
}
?>
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
						<li><a href="#">我的留言</a></li>
						<li class="dropdown">
						  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">更多 <span class="caret"></span></a>
						  <ul class="dropdown-menu">
						  <!-- 这里下拉列表框的选项 -->
							<?php 
								if(isset($_SESSION['userName'])){
									echo "<li><a onclick='\$login.\$sendLogoutInfo();'>注销</a></li>";
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
	
	<!--主体容器-->
	<div class="container">
		<?php 
			if(!$flag){
				for($i=0;$i<count($ret);$i++){
					echo "<div class='row box'>";
					echo 	"<div class='col-lg-12'>";
					echo 		"<h4>提醒日期:{$ret[$i]['date']}</h4>";
					echo		"<p>提醒内容:".mb_substr($ret[$i]['content'],0,30)."</p>";
					echo	"</div>";
					echo "</div>";
					echo "<br /><br />";
				}
			}else{
				echo "<div class='row box'>";
				echo 	"<div class='col-lg-8'>";
				echo 		"<div>请您先登录哦~</div>";
				echo 	"</div>";
				echo "</div>";
			}

		?>
	</div>
	
	<!--登录模态框-->
	<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		<div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="exampleModalLabel">登录</h4>
		  </div>
		  <div class="modal-body">
			<form>
			  <div class="form-group">
				<label for="recipient-name" class="control-label">用户名:</label>
				<input type="text" class="form-control" id="loginName">
			  </div>
			  <div class="form-group">
				<label for="message-text" class="control-label">密码:</label>
				<input type="password" class="form-control" id="loginPw">
			  </div>
			</form>
			<p class="bg-danger" style="font-size:22px;margin:5px;" id="danger"></p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">退出</button>
			<button type="button" class="btn btn-primary" id="btnLogin" onclick="$login.$sendLoginInfo()">登录</button>
		  </div>
		</div>
	  </div>
	</div>

	<!--注册模态框-->
	<div class="modal fade" id="registModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">欢迎您注册成为本网站用户</h4>
			</div>
			<div class="modal-body">
				<!--注册表单内容-->
				<form>
					<div class="form-group">
						<label for="InputEmail1">邮箱地址</label>
						<input type="email" class="form-control" id="regEmail" placeholder="邮箱，例如：zhansan@163.com">
					</div>
					<div class="form-group">
						<label for="InputUsername">用户名</label>
						<input type="text" class="form-control" id="regUsername" placeholder="用户名:支持中英文字符，20个以内">
					</div>
					<div class="form-group">
						<label for="InputPassword">密码</label>
						<input type="password" class="form-control" id="regPassword" placeholder="密码，请设置高强度密码">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">再考虑考虑</button>
				<button type="button" class="btn btn-primary" onclick="$login.$sendRegistInfo();">让我们愉快的玩耍吧</button>
			</div>
		</div>
	</div>
	</div>

	<!--记录模态框-->
	<div class="modal fade" id="addTipModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="exampleModalLabel">写一条提示吧</h4>
		  </div>
		  <div class="modal-body">
			<form>
			  <div class="form-group">
				<label for="recipient-name" class="control-label">日期:</label>
				<input type="datetime-local" class="form-control" id="tipDate">
			  </div>
			  <div class="form-group">
				<label for="message-text" class="control-label">提示内容:</label>
				<textarea class="form-control" id="tipMsg"></textarea>
			  </div>
			</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
			<button type="button" class="btn btn-primary" onclick="$tips.$addTip();">记录</button>
		  </div>
		</div>
	  </div>
	</div>

	<!--联系模态框-->
	<div class="modal fade" id="sayModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">给我留言</h4>
		  </div>
		  <div class="modal-body">
			<input type="text" placeholder="请输入标题" class="form-control" />
			<br>
			<textarea class="form-control" rows="3" placeholder="你想对我说什么?"></textarea>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">退出</button>
			<button type="button" class="btn btn-primary" id="sendEmail">发送</button>
		  </div>
		</div>
	  </div>
	</div>
	
	<!--关于模态框-->
	<div class="modal fade" id="aboutModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">关于本网站</h4>
		  </div>
		  <div class="modal-body">
			<p>作者:苏近之</p>
			<p>GitHub:www.iyii.vip</p>
			<p>邮箱:xiaotingyizhan@163.com</p>
			<p>手机:18969143101</p>
			<p>谨以此献给我亲爱的言与！</p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">确定</button>
		  </div>
		</div>
	  </div>
	</div>
	
	<!---- JS IMPORT ------->
<script type="text/javascript" src="./js/jquery.min.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/index.js"></script>
</body>
</html>