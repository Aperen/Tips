<?php
/**
 * Created by PhpStorm.
 * User: 季俊潇
 * Date: 2016/8/2
 * Time: 19:50
 * Description:文章详情页
 */

require "./layout/header.php"; //引入头部文件

require "./common/Parsedown.php";       //引入 Markdown 语法转换类
$id=$_GET['id'];        //获取文章ID
$sqlArticle="SELECT * FROM article WHERE id={$id}";
$retArticle = Db::dbQueryOne($con,$sqlArticle);     //公开的文章的结果集
$md= new Parsedown();               //实例化 Parsedown 类
$articleContent=$md->text($retArticle['content']);      //将文章内容转化为HTML
?>
    <link rel="stylesheet" href="./css/markdownpad-github.css">
<div class="container">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">
                <?php echo $retArticle['title']; ?>
            </h3>
        </div>
        <div class="panel-body">
            <?php echo $articleContent; ?>
        </div>
    </div>
</div>

    <br><br><br>
<?php require "./layout/footer.php"; //引入底部文件 ?>