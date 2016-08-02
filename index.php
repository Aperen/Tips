<?php
/*
 * 创建人：季俊潇
 * 创建日期：2016年7月21日
 * 修改日期：2016年7月22日 11:06
 * 描述：首页展示
 */

require "./layout/header.php"; //引入头部文件

?>

	
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
	
<?php require "./layout/footer.php"; ?>