<?php
require_once "function.php";

$list=[
	$surl = $_POST['surl'],
	$message = $_POST['message'],
	$due = $_POST['due'],
	$type = $_POST['type']
];
foreach ($list as $i){
	if(empty($i))exit("参数不完整,请检查是否有漏填项!");
}
if(get($surl)!=false){
	exit("此链已被占用!");
}

if (!empty($mysql)) {
	try {
		$db=new PDO("mysql:host=".$mysql['server'].";dbname=".$mysql['dbname'],$mysql['username'],$mysql['password']);//连接数据库
		$db->exec("
            INSERT INTO messages (surl,message,due,type)
            VALUES ('$surl','$message',$due,".($type=="文本"?'1':($type=="链接"?'0':'2')).")
        ");
		$host=(empty($_SERVER['HTTPS'])||$_SERVER['HTTPS']=="off"?"http://":"https://").$_SERVER['HTTP_HOST'];
		echo '<a href="'.$host.'/?'.$_POST['surl'].'">'.$host.'/?'.$_POST['surl'].'</a>';
	}catch (PDOException $e){
		exit($e->getMessage());
	}
}