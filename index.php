<?php
require_once "config.php";

if (!empty($mysql)) {
    echo $mysql['server'];
}