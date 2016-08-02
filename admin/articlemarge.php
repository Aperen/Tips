<?php
/**
 * Created by PhpStorm.
 * User: 季俊潇
 * Date: 2016/8/2
 * Time: 14:50
 * Description:文章列表
 */
require "../layout/admin.header.php";   //引入后台头部文件
$sqlUser="SELECT id FROM user WHERE username='".$userName."'";
$retUser=Db::dbQueryOne($con,$sqlUser);
$sqlArticle="SELECT id,title,auth,category_id,is_draft "
    . " FROM article WHERE author={$retUser['id']}";
$retArticle=Db::dbQueryAll($con,$sqlArticle);

?>

<div class="container">
    <table class="table">
        <tr>
            <th>编号</th>
            <th>标题</th>
            <th>分类</th>
            <th>权限</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        <?php for($i=0;$i<count($retArticle);$i++){ ?>
            <tr>
                <td><?php echo $i+1 ?></td>   <!--列表编号-->
                <td><?php echo $retArticle[$i]['title']; ?></td>    <!--文章标题-->
                <td>
                    <?php
                        $sqlCategory="SELECT name FROM category WHERE id=".$retArticle[$i]['category_id'];
                        $retCategory=Db::dbQueryOne($con,$sqlCategory);     //查询文章分类名称
                        echo $retCategory['name'];      //输出文章分类名称
                    ?>
                </td>
                <td><?php echo $retArticle[$i]['auth']?"公开":"不公开"; ?></td> <!--文章权限-->
                <td><?php echo $retArticle[$i]['is_draft']?"草稿":"已发布"; ?></td> <!--文章状态-->
                <td>
                    <a id="updateArticle<?php echo $i; ?>" onclick="$article.$updateArticle(this.id);" data-num="<?php echo $retArticle[$i]['id']; ?>">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    <a id="delArticle<?php echo $i; ?>" onclick="$article.$delArticle(this.id);" data-num="<?php echo $retArticle[$i]['id']; ?>">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                    <a id="" onclick="window.location.href='../article_details.php?id=<?php echo $retArticle[$i]['id']; ?>';">
                        <span class="glyphicon glyphicon-search"></span>
                    </a>
                </td>
            </tr>
        <?php }  ?>
    </table>
</div>
<?php require "../layout/admin.footer.php";   //引入后台底部文件 ?>