<?php
require_once "function.php";

$list=[
	$surl = $_POST['surl'],
	$message = $_POST['message'],
	$due = $_POST['due'],
	$type = $_POST['type']
];
foreach ($list as $i){
	if(empty($i))exit(1);
}
if(get($surl)!=false){
	exit("此链已被占用!");
}

if (!empty($mysql)) {
    try {
        $db=new PDO("mysql:host=".$mysql['server'].";dbname=".$mysql['dbname'],$mysql['username'],$mysql['password']);//连接数据库
        $db->exec("
            INSERT INTO messages (surl,message,due,type)
            VALUES ('$surl','$message',$due,".($_POST['type']=="文本"?'1':'0').")
        ");
        echo '<a href="/?'.$_POST['surl'].'">/?'.$_POST['surl'].'</a>';
    }catch (PDOException $e){
        exit($e->getMessage());
    }
}