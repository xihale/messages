<?php
require_once "config.php";

if (!empty($mysql)) {
    try {
        $db=new PDO("mysql:host=".$mysql['server'].";dbname=".$mysql['dbname'],$mysql['username'],$mysql['password']);//连接数据库
        $db->exec("
            INSERT INTO messages (surl,message,due,type)
            VALUES ('".$_POST['surl']."','".$_POST['message']."','".$_POST['due']."','".($_POST['type']=="text"?'1':'0')."')
        ");
    }catch (PDOException $e){
        exit($e->getMessage());
    }

}