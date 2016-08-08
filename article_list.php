<?php
/**
 * Created by PhpStorm.
 * User: 季俊潇
 * Date: 2016/8/2
 * Time: 2016年8月8日 14:00
 * Description:我的文章
 */
require "./layout/header.php"; //引入头部文件
if(!isset($_SESSION["userName"])){
    $sqlArticle="SELECT * FROM article WHERE delete_flag!=1 AND category_id=1 AND is_draft =0 ORDER BY post_date DESC";
}else{
    if(!isset($_GET['cid']) || $_GET['cid']==0 ){        //如果文章分类为推荐文章
        $sqlArticle="SELECT * FROM article WHERE delete_flag!=1 AND category_id=1 AND is_draft =0 ORDER BY post_date DESC";
    }elseif($_GET['cid']==1){   //如果文章分类为我的文章
        $sqlArticle="SELECT * FROM article WHERE delete_flag!=1 AND author={$retUser[0]['id']} AND is_draft =0 ORDER BY post_date DESC";
    }elseif($_GET['cid']==2){   //如果文章分类为好友的文章
        $sqlArticle="SELECT * FROM article WHERE delete_flag!=1 AND author!={$retUser[0]['id']} AND is_draft =0 ORDER BY post_date DESC";
    }elseif($_GET['cid']==3){   //如果文章分类为推广文章
        $sqlArticle="SELECT * FROM article WHERE delete_flag!=1 AND category_id=2 AND is_draft =0 ORDER BY post_date DESC";
    }else{
        echo "参数错误！";
    }

}
$retArticle=Db::dbQueryAll($con,$sqlArticle);
?>
<div class="container">
    <div class="row">
        <!--文章分类-->
        <div class="col-lg-3 col-lg-offset-1">
            <div class="list-group">
                <a href="#" class="list-group-item active">
                    文章栏目
                </a>
                <a href="./article_list.php?cid=0" class="list-group-item">推荐文章</a>
                <?php if(isset($_SESSION['userName'])){ ?>
                    <a href="./article_list.php?cid=1" class="list-group-item">我的文章</a>
                    <a href="./article_list.php?cid=2" class="list-group-item">好友文章</a>
                <?php } ?>
                <a href="./article_list.php?cid=3" class="list-group-item">推广文章</a>
            </div>
        </div>

        <!--文章列表-->
        <div class="col-lg-7">
            <!--最新文章-->
            <?php if($retArticle[0]) {  //如果存在文章结果集 ?>
                <?php for($i=0;$i<count($retArticle);$i++){
                        //查询作者昵称
                        $authorName=Db::dbQueryOne($con,"SELECT username FROM user WHERE id={$retArticle[$i]['author']}")['username'];
                        //查询分类名称
                        $categoryName=Db::dbQueryOne($con,"SELECT name FROM category WHERE id={$retArticle[$i]['category_id']}")['name'];
                    ?>

                    <div class="media">
                        <div class="media-left">
                            <a href="./article_details.php?id=<?php echo $retArticle[$i]['id']; ?>">
                                <img class="media-object img-circle" src="images/article.png" alt="...">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $retArticle[$i]['title']; ?></h4>
                            作者：<?php echo $authorName;?>&nbsp;&nbsp;&nbsp;分类:<?php echo $categoryName;?>&nbsp;&nbsp;&nbsp;
                            发表日期:<?php echo $retArticle[$i]['post_date']; ?>
                            <br>
                            <?php echo mb_substr(strip_tags($retArticle[$i]['content']),0,55,'utf-8'); ?>...
                        </div>

                    </div>
                    <hr>
                <?php  } ?>

            <?php }else{
                echo "本栏目暂时没有新的文章发布哦";
            } ?>
        </div>
    </div>

</div>


<?php require "./layout/footer.php"; //引入底部文件 ?>