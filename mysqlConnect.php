<?php
 
$pdo = new PDO("mysql:host=localhost;dbname=zhang;","root","zhangzhonghao");
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
$pdo->exec("set names 'utf8'");



?>