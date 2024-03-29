<?php

$is_Date=date("Ymd");
$fp=fopen("date","r");
if(fgets($fp)==$is_Date)exit("Tried again.");
fclose($fp);
$fp=fopen("date","w");
fputs($fp,$is_Date);
fclose($fp);

require_once "config.php";
if (!empty($mysql)) {
    try {
        $db = new PDO("mysql:host=" . $mysql['server'] . ";dbname=" . $mysql['dbname'], $mysql['username'], $mysql['password']);//连接数据库
        $db->query("SET NAMES utf8");
        $result = $db->prepare("
            SELECT surl,due FROM messages
        ");
        $result->execute();
        while ($res = $result->fetch()) {
            if ($res['due'] == 0) {
                $db->exec("
                    DELETE FROM messages WHERE surl='" . $res['surl'] . "'
                ");
                continue; //检测到期后删除并跳过循环
            }
            $db->exec("
                UPDATE messages SET due='" . (intval($res['due']) - 1) . "' WHERE surl='" . $res['surl'] . "'
            ");
        }
    }catch (PDOException $e){
        exit($e);
    }
}else{
    echo "empty!";
}