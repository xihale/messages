<?php
require_once "config.php";

function get($surl)
{
	global $mysql;
	if (!($surl=="" || empty($mysql))) {
		try {
			$db = new PDO("mysql:host=" . $mysql['server'] . ";dbname=" . $mysql['dbname'], $mysql['username'], $mysql['password']); //连接数据库
			$result = $db->prepare("
			SELECT * FROM messages WHERE surl='$surl'
		"); //读取当surl==$surl的全部数据
			$result->execute();
			$result=$result->fetch();
			if (empty($result))return false;
			return $result;
		} catch (PDOException $e) {
			exit($e->getMessage());
		}
		$db = null;
	}
}