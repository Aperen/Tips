<?php
/**
 * Created by PhpStorm.
 * User: 季俊潇
 * Date: 2016/8/3
 * Time: 10:51
 * Description:新闻摘要页面
 */
require "./layout/header.php"; //引入头部文件
$sqlNews="SELECT * FROM news";
$retNews=Db::dbQueryAll($con,$sqlNews);          //最新头条的结果集
?>
<div class="container">
    <!--最新头条-->
    <?php if($retNews[0]) {  //如果存在文章结果集 ?>
        <?php for($i=0;$i<count($retNews);$i++){    ?>
            <a href="./news_details.php?id=<?php echo $retNews[$i]['id']; ?>" style="text-decoration: none">
                <div class="media">
                    <div class="media-left">
                        <img class="media-object img-circle" src="<?php echo $retNews[$i]['kpic']; ?>" alt="..." width="64px" height="64px">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $retNews[$i]['title']." 来源于:".$retNews[$i]['sour']; ?></h4>
                        <?php echo mb_substr(strip_tags($retNews[$i]['intro']),0,55,'utf-8'); ?>...
                    </div>
                </div>
            </a>
            <hr>
        <?php  } ?>
    <?php  } ?>
    <br>
    <button class="form-control">没有更多了哦</button>
    <br><br><br>
</div>
<?php require "./layout/footer.php"; //引入底部文件 ?>