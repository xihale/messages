<?php
require_once "config.php";

if(!(empty($_GET)||empty($mysql))){
    $surl=substr($_SERVER['REQUEST_URI'],2); //取'?'后的参数
    try {
        $db=new PDO("mysql:host=".$mysql['server'].";dbname=".$mysql['dbname'],$mysql['username'],$mysql['password']); //连接数据库
        $result=$db->prepare("
            SELECT * FROM messages WHERE surl='$surl'
        "); //读取当surl==$surl的全部数据
        $result->execute();
        while($res=$result->fetch()){
            echo $res['message'];
        }
    }
    catch (PDOException $e){
        exit($e->getMessage());
    }
//    $select="SELECT ".$surl." FORM ".$mysql['header']."messages";
    $db=null;
}
else{
    echo "empty!";
}