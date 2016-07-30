<?php
/**
 * Created by PhpStorm.
 * User:季俊潇
 * Date: 2016/7/29
 * Time: 9:27
 * Description:消息盒子界面
 */
require "../layout/admin.header.php";   //引入后台头部文件
$con=Db::dbConnect();			//数据库连接
$sql="SELECT tips.id,tips.author,
  tips.content,tips.date,
tips.is_mail,task.status
from user left join tips
  on user.username= tips.author
  LEFT join task
  on user.id = task.user_id
where user.username='".$_SESSION['userName']."'"
."GROUP BY tips.id
ORDER BY tips.date DESC";
$tipRet=Db::dbQueryAll($con,$sql);

?>

<div class="container">
    <br>
<table class="table">
    <tr>
        <th>编号</th>
        <th>内容</th>
        <th>提醒时间</th>
        <th>是否邮件推送</th>
        <th>推送状态</th>
        <th>操作</th>
    </tr>
    <?php if((isset($tipRet[0]['content']))){  ?>
        <?php for($i=0;$i<count($tipRet);$i++){ ?>
            <tr>
                <!--编号-->
                <td><?php echo $i+1; ?></td>
                <!--提醒内容-->
                <td>
                    <?php
                    if(mb_strlen($tipRet[$i]['content'],"utf-8")>15){
                        echo mb_substr($tipRet[$i]['content'],0,15,'utf-8').'...';
                    }else{
                        echo $tipRet[$i]['content'];
                    } ?>
                </td>
                <!--日期-->
                <td><?php echo $tipRet[$i]['date']; ?></td>
                <!--是否推送-->
                <td><?php echo $tipRet[$i]['is_mail']?"是":"否"; ?></td>
                <!--邮件发送状态-->
                <td><?php echo $tipRet[$i]['status']?"是":"否"; ?></td>
                <td>
                    <a id="<?php echo 'updateMsg'.$i; ?>" onclick="$msgBox.$updateMsg(this.id);" data-num="<?php echo $tipRet[$i]['id']; ?>">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    <a id="<?php echo 'delMsg'.$i; ?>" onclick="$msgBox.$delMsg(this.id);" data-num="<?php echo $tipRet[$i]['id']; ?>">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                    <a id="<?php echo 'queryMsg'.$i; ?>" onclick="$msgBox.$showMsg(this.id);" data-num="<?php echo $tipRet[$i]['id']; ?>">
                        <span class="glyphicon glyphicon-search"></span>
                    </a>
                </td>
            </tr>
        <?php } ?>
    <?php } ?>
</table>
</div>
<!--记录模态框-->
<div class="modal fade" id="updateTipModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
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
                            <input type="checkbox" id="is_email" onclick="$msgBox.$isMail=this.checked"> 是否邮件推送
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" onclick="$msgBox.$saveMsg();">记录</button>
            </div>
        </div>
    </div>
</div>
<?php require "../layout/admin.footer.php";   //引入后台底部文件 ?>
