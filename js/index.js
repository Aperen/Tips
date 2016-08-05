//全局公共常量
var $objPub ={
	//控制器常量
	$baseUrl:"./controllers/",				//前台基础路径
	$loginController:"LoginController.php",	//登录控制器
	$logoutController:"LogoutController.php",//注销控制器
	$addTipController:"AddTipController.php",//添加提醒控制器
	$registController:"RegistController.php",//注册控制器
	$getSessionController:"GetSessionController.php",	//获取Session
	$adminBaseUrl:"./admin/controllers/",			//后台基础路径
};

//用户对象
var $login = {
	$userName:$("#loginName"),			//获取登录用户名
	$passWd:$("#loginPw"),				//获取登录密码
	$regEmail:$("#regEmail"),				//获取注册邮箱
	$regUserName:$("#regUsername"),		//获取注册用户名
	$regPassword:$("#regPassword"),		//获取注册密码
	$regCaptchaCode:$("#verification"),	//获取注册验证码

	//向后台发送登录请求
	$sendLoginInfo:function(){
		//调用校验对象，校验元素存在
		$flag=$checkObj.$isSet(new Array(this.$userName.val(),this.$passWd.val()));		
		if($flag){			//如果元素存在
			$url = $objPub.$baseUrl+$objPub.$loginController;				//请求路径
			$msg = "userName="+this.$userName.val()+"&"+"passWord="+this.$passWd.val();		//请求数据
			$func =function($data){											//请求的回调函数
				layer.close($ii);
				if($data==1000){
					$('#loginModal').modal('hide');
					window.location.href="index.php";				//刷新页面
				}else{		//登录失败
					$("#danger").text("用户名和密码不正确！");
				}
			};
			var $ii=layer.load();
			$sendMsg.$sendAjax("POST",$url,$msg,$func);			//调用消息对象发送 Ajax 请求
		}else{			//用户名和密码为空
			$("#danger").text("用户名和密码不能为空！");
		}
	},
	//向后台发出注销请求
	$sendLogoutInfo:function(){
		$type = "POST";
		$url = $objPub.$baseUrl+$objPub.$logoutController;
		$msg="";
		$func = function($data){
			if($data=2000){
				$sendMsg.$print("注销成功");
			}
			window.location.href="index.php";				//刷新页面
		};
		$sendMsg.$sendAjax($type,$url,$msg,$func);
	},
	//向后台发出注册请求
	$sendRegistInfo:function(){
		//调用校验对象，校验元素存在
		$flag=$checkObj.$isSet(new Array(this.$regEmail.val(),this.$regUserName.val(),this.$regPassword.val()),this.$regCaptchaCode.val());
		if($flag){				//如果元素存在
			$type="POST";			//请求类型
			$url=$objPub.$baseUrl+$objPub.$registController;		//请求路径
			$msg = "regEmail="+this.$regEmail.val()+"&"+"regUserName="+this.$regUserName.val()+"&"+"regPassword="+this.$regPassword.val()+"&regCaptchaCode="+this.$regCaptchaCode.val();		//请求数据
			$func =function($date){											//请求的回调函数
				$errInfo=$sendMsg.$sendError($date);
				if($errInfo.$errorNo==1005){
					$("#registModal").modal('hide');					//注册模态框隐藏
				}else{
					$("#errorInfo").text("错误信息("+$errInfo.$errorNo+":"+$errInfo.$errorInfo+")");	//输出错误信息
				}

			},
			$sendMsg.$sendAjax($type,$url,$msg,$func);			//发送请求
		}else{				//如果元素不存在或者为空
			$sendMsg.$print("注册的邮箱/用户名/密码不能为空！");		//控制台输出
		}


	},
	//判断验证邮箱是否验证成功
	$isVerificationEmail:function(){
		$func=function($data){
			$flag=$data;
			if($flag==false){					//如果验证成功
				$("#info").text("验证成功，3秒之后返回首页");
				setTimeout(function(){						//设置3秒延时
					window.location.href="index.php";	//返回首页
				},3000);
			}else{							//如果验证失败
				$("#info").text("验证失败，网络可能存在一定延迟");
			}
		};
		$sendMsg.$sendAjax('POST',$objPub.$baseUrl+$objPub.$getSessionController,'',$func);
	},
	//判断是否已经登录
	$isLogin:function(){
		$flag =$("#session").val();						//获取会话信息
		if($flag==1){					//如果已经登录
			return true;	//返回为真
		}else{							//如果没有登录
			return false;	//返回为假
		}
	},
};

//添加提醒对象
var $tips ={
	$datetime:$("#tipDate"),			//获取提示日期元素
	$tipContent:$("#tipMsg"),			//获取提示内容元素
	$isEmail:"",			//获取是否邮件推送元素

	//根据登录状态弹出模态框
	$byLoginStatusByModal:function(){
		//判断是否已经登录
		$flag=$login.$isLogin();
		if($flag){										//如果已经登录
			$("#addTipModal").modal("show");
		}else{											//如果没有登录
			//弹出登录模态框
			$('#loginModal').modal('show');
		}
		//$sendMsg.$print($flag);
	},
	//发送添加一条提醒请求
	$addTip:function(){
		//检查对象是否为空
		$flag = $checkObj.$isSet(new Array(this.$datetime.val(),this.$tipContent.val()));
		if($flag){				//如果元素存在且不为空
			//向后台发送一条请求
			$type = "POST";			//请求类型
			$url = $objPub.$baseUrl+$objPub.$addTipController;		//请求路径
			$msg = "datetime="+this.$datetime.val()+"&"+"tipContent="+this.$tipContent.val()+"&"+"isEmail="+this.$isEmail;	//请求数据
			$func = function($data){				//回调函数
				if($data==0){
					$sendMsg.$print("插入记录失败");
				}
				window.location.href="index.php";				//刷新页面
			};
			$sendMsg.$sendAjax($type,$url,$msg,$func);
		}else{
			$sendMsg.$print("提醒日期和内容不能为空");
		}

	},
};

//消息对象
var $sendMsg ={
	//在控制台输出信息
	$print : function($title,$content){
		console.log($title,$content);
	},
	//发送 Ajax 请求
	$sendAjax : function($type,$url,$msg,$func){
		$.ajax({
			type:$type,		//请求类型
			url:$url,									//请求路径
			dataType:'json',				//数据类型
			data:$msg,			//请求数据
			success:$func,					//成功后的回调函数
		});
	},
	//发送错误信息
	$sendError : function ($errno) {
		$errInfo={};
		$errInfo.$errorNo=$errno;
		switch($errno){
			case 1001:
				$errInfo.$errorInfo="用户名不能为空";
				break;
			case 1002:
				$errInfo.$errorInfo="密码不能为空";
				break;
			case 1003:
				$errInfo.$errorInfo="邮箱不能为空";
				break;
			case 1004:
				$errInfo.$errorInfo="邮箱已经被注册";
				break;
			case 1005:
				$errInfo.$errorInfo="等待邮箱验证";
				break;
			case 1006:
				$errInfo.$errorInfo="用户名已经被注册";
				break;
			case 1007:
				$errInfo.$errorInfo="验证码不能为空";
				break;
			case 1008:
				$errInfo.$errorInfo="验证码不正确";
				break;
			default:
				$errInfo.$errorInfo="未知错误，请联系网站管理员";
		}
		return $errInfo;
	}
};

//校验对象
var $checkObj={
	//校验对象不为空
	$isSet:function($arr){
		$flag = 1;												//树立旗帜，默认为真
		$.each($arr,function($n,$value){						//遍历数组
			if($value=="" || $value == "undefined"){			//元素为空或者不存在
				$flag=0;			//更改旗帜为假
				return false;		//退出遍历
			}
		});
		return $flag?true:false;	//根据旗帜返回布尔值
	}
};

//后台管理对象
var $adminMarge={
	//向控制器发送注销请求
	$logout:function(){
		$type = "POST";
		$url = $objPub.$baseUrl+$objPub.$logoutController;
		$msg="";
		$func = function($data){
			if($data=2000){
				$sendMsg.$print("注销成功");
			}
			window.location.href="../index.php";				//刷新页面
		};
		$sendMsg.$sendAjax($type,$url,$msg,$func);
	}
};

//消息盒子对象
var $msgBox={
	$id:"",
	$isMail:"",
	//查看消息详情
	$showMsg:function($id){					//传入 a 标签的 ID
		$msgId=$("#"+$id).attr("data-num");	//读取提醒记录的 ID
		$url="./controllers/QueryMsgController.php";
		$data= "msgId="+$msgId;		//向后台发送记录的 ID
		var $ii = layer.load();		//开启 loading 弹出层
		$func=function($data){		//Ajax 回调函数
			layer.close($ii);	//关闭 loading 弹出层
			layer.open({		//开启弹出层，显示提醒详情
				type: 1,
				title:"提醒详情",
				area: ['320px', '220px'], //宽高
				content:"<p style='font-size: 16px;margin:10px'><br>"+
					"提醒时间:"+$data.date+"<br /><br />"+
				"提醒内容:"+$data.content+"<br /><br /></p>"
			});
		};
		$sendMsg.$sendAjax("POST",$url,$data,$func);	//向后台发送 Ajax 请求
	},
	//删除一条提醒
	$delMsg:function($id){
		$delId=$("#"+$id).attr("data-num");
		$url="./controllers/DelMsgController.php";
		$data="delId="+$delId;
		var $ii =layer.load();
		$func=function($data){
			layer.close($ii);
			window.location.href="msgbox.php";
		};
		$sendMsg.$sendAjax("POST",$url,$data,$func);	//向后台发送 Ajax 请求
	},
	//更新提醒界面数据
	$updateMsg:function($id){
		this.$id=$id;
		$("#updateTipModal").modal();
	},
	//向后台请求更新提醒信息
	$saveMsg:function(){
		$updateId=$("#"+this.$id).attr("data-num");
		$date=$("#tipDate");
		$content=$("#tipMsg");
		//console.log($updateId+"/"+$date.val()+"/"+$content.val()+"/"+this.$isMail);
		//向后台发送更新提醒的Ajax请求
		$url="./controllers/UpdateMsgController.php";
		$msg = "datetime="+$date.val()+"&"+"tipContent="+$content.val()+"&"+"isEmail="+this.$isMail+"&"+"updateId="+$updateId;	//请求数据
		$ii= layer.load();			//开启 loading 弹出层
		$func=function($data){
			layer.close($ii);		//关闭 loading 弹出层
			window.location.href="msgbox.php";		//刷新页面
		};
		$sendMsg.$sendAjax("POST",$url,$msg,$func);	//发送更新请求
	}
};

//文章对象
var $article={
	//显示分类弹窗
	$showAddCategory:function(){
		layer.open({		//开启弹出层，显示提醒详情
			type: 5,			//弹出层类别
			title:"添加分类",					//弹出层标题
			area: ['350px', '220px'], //宽高
			content:"<br><br>"+					//弹出层内容
			"<div class='row'><div class='col-lg-10  col-lg-offset-1'><input type='text' class='form-control' id='addCategoryName' placeholder='新增分类名称'/></div></div>" +
			"<br><div class='row'><div class='col-lg-10 col-lg-offset-1'><button class='btn btn-primary' style='width:100%' onclick='$article.$addCategory();'>确定</button></div></div>"
		});
	},
	//添加一个分类
	$addCategory:function(){
		//获取新增分类名
		$addCategoryName=$("#addCategoryName");
		//获取用户ID
		$currentUserId=$("#userId");
		//发送请求
		$url="./controllers/AddCategoryController.php";			//请求路径
		$data="addCategoryName="+$addCategoryName.val()+"&currentUserId="+$currentUserId.val();
		var $ii=layer.load();	//开启 Loading 弹出层
		$func=function(){
			//将分类名写入界面中的分类列表
			$("<option />").appendTo("#selectCategory").text($addCategoryName.val());
			layer.closeAll();		//关闭所有弹出层
		};
		$sendMsg.$sendAjax("POST",$url,$data,$func);	//向后台发送请求
		console.log($addCategoryName.val());
	},
	//添加一篇文章
	$addArticle:function(){
		var $ii= layer.load();		//开启Loading弹出层
		$url="./controllers/AddArticleController.php";		//新增文章控制器地址
		$data="categoryName="+$("#selectCategory option:selected").text()
			+"&auth="+$("#selectAuth option:selected").text()
			+"&articleTitle="+$("#articleTitle").val()		//向后台发送的数据
			+"&articleContent="+$("#articleContent").val();
		$func=function($data){
			layer.close($ii);			//关闭Loading弹出层
			window.location.href='./articlemarge.php';
		};
		//向后台发送一个Ajax请求，增加一篇文章
		$sendMsg.$sendAjax("POST",$url,$data,$func);
	},
	//编辑一篇文章
	$updateArticle:function($id){
		$updateId=$('#'+$id).attr('data-num');			//获取编辑文章的ID
		window.location.href='./updatearticle.php?updateId='+$updateId;	//跳转到编辑页面并传送ID
	},
	//保存文章更新
	$saveArticleUpdate:function($id){
		var $ii= layer.load();		//开启Loading弹出层
		$url="./controllers/UpdateArticleController.php";		//新增文章控制器地址
		$data="updateId="+$id
			+"&categoryName="+$("#selectCategory option:selected").text()
			+"&auth="+$("#selectAuth option:selected").text()
			+"&articleTitle="+$("#articleTitle").val()		//向后台发送的数据
			+"&articleContent="+$("#articleContent").val();
		$func=function($data){
			layer.close($ii);			//关闭Loading弹出层
			window.location.href='./articlemarge.php';
		};
		//向后台发送一个Ajax请求，增加一篇文章
		$sendMsg.$sendAjax("POST",$url,$data,$func);
	},
	//删除一篇文章
	$delArticle:function($id){
		$delId=$("#"+$id).attr("data-num");		//获取删除文章的ID
		$url="./controllers/DelArticleController.php";		//删除文章控制器的路径
		$data="delId="+$delId;			//传送的文章ID
		var $ii= layer.load();			//显示 Loading　弹出层
		$func=function ($data) {		//Ajax 回调函数
			layer.close($ii);			//关闭 Loading 弹出层
			window.location.href="./articlemarge.php";			//刷新页面
		};
		$sendMsg.$sendAjax("POST",$url,$data,$func);		//向后台发送Ajax请求，删除文章
	},
	//上一篇新闻
	$upNew:function(){
		$newId=$("#idNew");
		if($newId.val()>1){
			$upId=$newId.val()-1;
			window.location.href="news_details.php?id="+$upId;
		}else{
			layer.open({		//开启弹出层，显示提醒详情
				type: 1,			//弹出层类别
				title:"我笑笑不说话",					//弹出层标题
				area: ['250px', '120px'], //宽高
				content:"<br>&nbsp;&nbsp;已经是第一篇了"
			});
		}
	},
	$downNew:function(){
		$newId=$("#idNew");			//当前新闻ID
		$newCount=$("#newCount");		//当前新闻总数
		//如果当前新闻ID 小于 当前新闻总数
		if(parseInt($newId.val())<parseInt($newCount.val())){
			$downId=parseInt($newId.val())+1;						//下一篇文章ID加 1
			window.location.href="news_details.php?id="+$downId;	//跳转到下一篇文章
		}else{				//如果当前新闻ID 大于等于 当前新闻总数
			layer.open({		//开启弹出层，显示提醒详情
				type: 1,			//弹出层类别
				title:"我笑笑不说话",					//弹出层标题
				area: ['250px', '120px'], //宽高
				content:"<br>&nbsp;&nbsp;"+"已经是最后一篇了哦~"
			});
		}
	}
}