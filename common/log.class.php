<?php
/**
 * Created by PhpStorm.
 * User: 季俊潇
 * Date: 2016/7/27
 * Time: 13:55
 * Description:日志基类
 */
class Log{
    private $date;           //记录时间
    private $obj;            //记录对象
    private $content;        //记录内容

    //构造函数
    public function __construct(){

    }
    //记录日志
    public function insertLog($d,$o,$c){
        //创建日志文件
        $file=self::createLogFile();
        //写入日志文件
        $str=$d." ".$o." ".$c."\n";
        fwrite($file,$str);
        fclose($file);
    }
    //读取日志
    public function showLog(){

    }
    //清空全部日志
    public function clearLog(){

    }
    //创建日志文件
    private function createLogFile(){
        //判断日志目录是否存在
        if(!file_exists("../log")){
            //如果目录不存在
            //创建目录
            try{
                mkdir("../log",775);
                echo "创建成功";
            }catch (Exception $e){
                return false;
            }
        }
        //定义日志文件名
        $logFileName="log_".date("Y-m-d")."_.log";
        $file = fopen("../log/".$logFileName, "a");
        return $file;
    }

}