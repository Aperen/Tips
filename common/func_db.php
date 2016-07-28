<?php
/*
 * 创建人：季俊潇
 * 创建日期：2016年7月22
 * 修改日期：2016年7月22
 * 描述：数据库操作类
 */
class Db{
/*    private static $dbHost="localhost";           //数据库地址
    private static $dbName="tips";                 //数据库名
    private static $dbUser="root";                 //数据库用户
    private static $dbPw="";                       //数据库密码
    private static $dbPort="3306";                 //数据库端口*/
    private static $dbHost=SAE_MYSQL_HOST_M;           //SAE数据库地址
    private static $dbName=SAE_MYSQL_DB;                 //SAE数据库名
    private static $dbUser=SAE_MYSQL_USER;                 //SAE数据库用户
    private static $dbPw=SAE_MYSQL_PASS;                       //SAE数据库密码
    private static $dbPort=SAE_MYSQL_PORT;                 //SAE数据库端口
    //数据库连接
    public static function dbConnect(){
        $con = mysqli_connect(Db::$dbHost,Db::$dbUser,DB::$dbPw,Db::$dbName,Db::$dbPort);     //连接数据库
        if(!$con){          //如果连接失败
            echo "数据库连接失败:".mysqli_connect_error();     //输出数据库连接错误信息
        }
        mysqli_query($con,"SET NAMES UTF8");		//设置数据库编码
        return $con;
    }
    //关闭数据库连接
    public static function dbClose($con){
        mysqli_close($con);
        return true;
    }
    //查询一条记录
    public static function dbQueryOne($con,$sql){
        $ret=mysqli_query($con,$sql);
        if(mysqli_affected_rows($con)>0){
            return mysqli_fetch_assoc($ret);
        }
        return false;
    }
    //查询全部记录
    public static function dbQueryAll($con,$sql){
        $result = mysqli_query($con,$sql);
        if($result && mysqli_affected_rows($con)>0){        //如果查询条数大于0
            while($row=mysqli_fetch_assoc($result)){        //遍历查询结果
                $ret[]=$row;                            //将查询结果存入数组
            }
            return $ret;           //返回所有记录
        }
        return false;           //返回假
    }
    //插入一条数据
    public static function dbInsertOne($table,$k,$v){
        $keys="";
        $values="";
        $con =self::dbConnect();
        //检查键值对数量是否匹配
        if(count($k)!=count($v)){
            echo "字段与值不匹配！";
        }
        //遍历传参，组成字符串
        for($i=0;$i<count($k);$i++){
            $keys =$keys."`{$k[$i]}`,";
            $values = $values."'{$v[$i]}',";
        }
        //去掉末尾的逗号
        $keys=mb_substr($keys,0,strlen($keys)-1);
        $values=mb_substr($values,0,mb_strlen($values)-1);
        $sql="INSERT INTO {$table} ({$keys}) VALUES ($values);";    //拼接语句
        $ret=mysqli_query($con,$sql);               //执行插入语句
        return $ret;
    }
    //根据ID删除一条记录
    public static function dbDelete($table,$id){
        $con = self::dbConnect();               //数据库连接
        $sql= "DELETE FROM {$table} WHERE `id`={$id}";      //定义语句
        $ret = mysqli_query($con,$sql);         //执行语句
        return $ret;            //返回结果
    }
    //根据ID更新一条记录
    public static function dbUpdate($sql){
        $con = self::dbConnect();       //连接数据库
        $ret = mysqli_query($con,$sql);       //执行SQL语句
        return mysqli_affected_rows($con);      //返回受影响记录条数
    }
    //测试方法
    public static function dbTest(){
        //测试返回一条记录
        //return Db::dbQueryOne(Db::dbConnect(),"SELECT * FROM tips");

        //测试返回全部记录
        //return $row=Db::dbQueryAll(Db::dbConnect(),"SELECT * FROM tips");

        //测试插入一条记录
        /*$k=Array("content","date","author");
        $v=Array("一次次的重构，相信会做的更好！","2016-07-23 12:00:00:00","admin");
        return self::dbInsertOne("tips",$k,$v);*/

        //测试删除一条记录
/*        $table="templates";
        $id=2;
        $ret=self::dbDelete($table,$id);*/

        //测试更新一条记录
/*        $sql="UPDATE `tips`.`task` SET `content` = '你好吗，世界！' WHERE `task`.`id` = 1;";
        return self::dbUpdate($sql);*/
    }
}

?>