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
<?php require "./layout/header.php"; //引入头部文件 ?>

	
	<!--主体容器-->
	<div class="container">
		<?php 
			if(!$flag){				//如果已经登录
				for($i=0;$i<count($ret);$i++){		//遍历记录
					if($ret[$i]['id']){			//如果存在记录
						$content=$ret[$i]['content'];
						echo "<div class='row box'>";
						echo 	"<div class='col-lg-12'>";
						echo 		"<h4>提醒日期:{$ret[$i]['date']}</h4>";
						echo		"<p>提醒内容:".$ret[$i]['content']."</p>";
						echo	"</div>";
						echo "</div>";
						echo "<br /><br />";
					}
				}
			}else{
				echo "<div class='row'>";
				echo 	"<div class='col-lg-12'>";
				echo 		"<h1 style='font-size:10rem;color:#f0f8ff;'>我们可以做的更好的</h1>";
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
						<input type="text" class="form-control" id="regUsername" placeholder="用户名:支持英文字符，20个字符以内">
					</div>
					<div class="form-group">
						<label for="InputPassword">密码</label>
						<input type="password" class="form-control" id="regPassword" placeholder="密码，请设置高强度密码">
					</div>
					<p id="errorInfo"></p>				<!--输出错误信息-->
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
				<div class="form-group">
					<label>
						<input type="checkbox" id="is_email" onclick="$tips.$isEmail=this.checked"> 是否邮件推送
					</label>
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
			<p>系统版本:<?php echo $config['version'] ?></p>
			<p>GitHub:www.iyii.vip</p>
			<p>邮箱:xiaotingyizhan@163.com</p>
			<p>手机:18969143101</p>
			<p>谨以此献给我挚爱的言与！</p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">确定</button>
		  </div>
		</div>
	  </div>
	</div>
	
<?php require "./layout/footer.php"; ?>