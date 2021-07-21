<?php
require_once "config.php";
if (!empty($mysql)) {
    $db=new PDO("mysql:host=".$mysql['server'].";dbname=".$mysql['dbname'],$mysql['username'],$mysql['password']);//连接数据库
    $db->exec('
                CREATE TABLE messages(
                    surl VARCHAR(10) NOT NULL,
                    message VARCHAR(102400) NOT NULL,
                    due INT(3) UNSIGNED,
                    type boolean NOT NULL
                );
            ');
}