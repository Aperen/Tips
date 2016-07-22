//全局公共常量
var $objPub ={
	//控制器常量
	$baseUrl:"./controllers/",				//基础路径
	$loginController:"LoginController.php",	//登录控制器
	$logoutController:"LogoutController.php",//注销控制器
	$addTipController:"AddTipController.php",//添加提醒控制器
};
//登录对象
var $login = {
	$userName:$("#loginName"),			//获取用户名
	$passWd:$("#loginPw"),				//获取密码
	//向后台发出登录请求
	$sendLoginInfo:function(){
		//调用校验对象，校验元素存在
		$flag=$checkObj.$isSet(new Array(this.$userName.val(),this.$passWd.val()));		
		if($flag){			//如果元素存在
			$url = $objPub.$baseUrl+$objPub.$loginController;				//请求路径
			$msg = "userName="+this.$userName.val()+"&"+"passWord="+this.$passWd.val();		//请求数据
			$func =function($data){											//请求的回调函数
				if($data=1000){
					$('#loginModal').modal('hide');
				}else{		//登录失败
					$("#danger").text("用户名和密码不正确！");
				}
				window.location.href="index.php";				//刷新页面
			}
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
	//判断是否已经登录
	$isLogin:function(){
		$flag =$("#session").val();						//获取会话信息
		if($flag==1){					//如果已经登录
			return true;	//返回为真
		}else{							//如果没有登录
			return false;	//返回为假
		}
	}
};

var $tips ={
	$datetime:$("#tipDate"),			//获取提示日期元素
	$tipContent:$("#tipMsg"),			//获取提示内容元素
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
			$msg = "datetime="+this.$datetime.val()+"&"+"tipContent="+this.$tipContent.val();		//请求数据
			$func = function($data){				//回调函数
				if($data==3000){
					//插入成功
					$('#addTipModal').modal('hide');		//隐藏记录模块框
				}else{
					$sendM.$print("插入记录失败");
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
			success:$func					//成功后的回调函数
		});
	},
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
$("<div />").appendTo("#bodyShow");