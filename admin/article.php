<?php
/**
 * Created by PhpStorm.
 * User: 季俊潇
 * Date: 2016/7/30
 * Time: 10:46
 * Description:文章发表页
 */
require "../layout/admin.header.php";           //引入头部文件
$sql="SELECT name FROM category WHERE user_id=0 or user_id={$retCurrentUser['id']}";
$retCategory=Db::dbQueryAll($con,$sql);
?>

<div class="container">
    <!--用来记录用户ID的隐藏域-->
    <input type="hidden" value="<?php echo $retCurrentUser['id']; ?>" id="userId">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <!--文章分类下拉列表框-->
                    <div class="col-lg-2 col-md-3 col-xs-3">
                        <select class="form-control" id="selectCategory">
                            <?php for($i=0;$i<count($retCategory);$i++){
                                echo "<option>".$retCategory[$i]['name']."</option>";
                            } ?>
                        </select>
                    </div>
                    <!--文章权限下拉列表框-->
                    <div class="col-lg-2 col-md-3 col-xs-3">
                        <select class="form-control" id="selectAuth">
                            <option value="1">公开</option>
                            <option value="0">不公开</option>
                        </select>
                    </div>
                    <!--新增分类按钮-->
                    <div class="col-lg-2 col-md-3 col-xs-3">
                        <button class="btn btn-default" onclick="$article.$showAddCategory();">新增分类</button>
                    </div>
                    <!--发表文章按钮-->
                    <div class="col-lg-2 col-md-2 col-xs-3 col-lg-offset-4">
                        <button class="btn btn-primary" style="width:100%" onclick="$article.$addArticle();">发布</button>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <!--文章标题输入框-->
                <input type="text" class="form-control" style="width:100%;"  placeholder="请输入文章标题" id="articleTitle">
                <br><!--文章内容文本域-->
                <textarea name="" id="articleContent"  rows="20" class="form-control" placeholder="在此支持Markdown语法"></textarea>
            </div>
        </div>
    </div>

    <div class="row">

    </div>
</div>

<?php require "../layout/admin.footer.php";  //引入底部文件 ?>