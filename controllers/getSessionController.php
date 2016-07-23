<?php
session_start();
if(isset($_SESSION["regUserName"])){
    echo  "true";
}else{
    echo  "false";
}

?>