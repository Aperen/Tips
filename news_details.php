<?php
/**
 * Created by PhpStorm.
 * User: 季俊潇
 * Date: 2016/8/3
 * Time: 10:58
 * Description:新闻详情页
 */
require "./layout/header.php"; //引入底部文件
$id=$_GET['id'];        //获取文章ID
$sqlNew="SELECT * FROM news WHERE id={$id}";
$retNew = Db::dbQueryOne($con,$sqlNew);     //公开的文章的结果集
$sqlNewContent=Db::dbQueryAll($con,"SELECT * FROM news");
?>

    <div class="container">
        <input type="hidden" id="idNew" onclick="" value="<?php echo $id ?>">
        <input type="hidden" id="newCount" onclick="" value="<?php echo count($sqlNewContent); ?>">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <?php echo $retNew['title']; ?>
                </h3>
            </div>
            <div class="panel-body">
                <?php echo $retNew['intro']; ?>
            </div>
        </div>
        <!--按钮组-->
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default" onclick="$article.$upNew();">上一篇</button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default" onclick="window.location.href='./news_list.php'">返回</button>
            </div>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default" onclick="$article.$downNew();">下一篇</button>
            </div>
        </div>
    </div>
    <br><br><br>
<?php require "./layout/footer.php"; //引入底部文件 ?>