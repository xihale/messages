<?php
require_once "config.php";
fclose(fopen("date","w"));
if (!empty($mysql)) {
try{
    $db=new PDO("mysql:host=".$mysql['server'].";dbname=".$mysql['dbname'],$mysql['username'],$mysql['password']);//连接数据库
    echo "Connect succeed.<br/>";
    $r=$db->exec('
                CREATE TABLE messages(
                    surl VARCHAR(10) NOT NULL,
                    message VARCHAR(65000) NOT NULL,
                    due INT(3) UNSIGNED,
                    type INT(1) NOT NULL
                );
            ');
    echo "done.(Please check if the message table really created and maybe you should adjust the message item's size low.)<br/>";
}catch (PDOException $e) {exit("Database operation failed: " . $e->getMessage());}
}
