<?php
/**
 * Created by PhpStorm.
 * User: 季俊潇
 * Date: 2016/8/2
 * Time: 19:19
 * Description:文章社区页面
 */
require "./layout/header.php"; //引入头部文件
$sqlArticle="SELECT * FROM article WHERE delete_flag =0 and is_draft =0 and auth !=0 ORDER BY id DESC ";

$retArticle = Db::dbQueryAll($con,$sqlArticle);     //公开的文章的结果集
//var_dump($retArticle);
?>
<div class="container">
    <!--最新文章-->
    <?php if($retArticle[0]) {  //如果存在文章结果集 ?>
        <?php for($i=0;$i<count($retArticle);$i++){    ?>
            <div class="media">
                <div class="media-left">
                    <a href="./article_details.php?id=<?php echo $retArticle[$i]['id']; ?>">
                        <img class="media-object" src="images/article.png" alt="...">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $retArticle[$i]['title']; ?></h4>
                    <?php echo mb_substr(strip_tags($retArticle[$i]['content']),0,55,'utf-8'); ?>...
                </div>

            </div>
        <?php  } ?>
    <?php } ?>
</div>


<?php require "./layout/footer.php"; //引入底部文件 ?>