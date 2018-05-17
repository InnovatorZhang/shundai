<?php
include("mysqlConnect.php");
include("jsonWrapper.php");
//解析android端传来的json数据
$postData = file_get_contents('php://input');

//将json数据解析成数组
$arrayData = json_decode($postData,true);

//获取类型和数据
$type = (int)$arrayData["Type"];
$data = $arrayData["Content"];

$username = $data["username"];
$password = $data["password"];


if($username && $password){
    $sql = $pdo->prepare("SELECT * FROM person WHERE username = ?");
    $sql->execute(array($username));

    if($sql->fetchAll(PDO::FETCH_NAMED)){
         other_encode(400,"用户名已经被注册了哦！");
      }else{
         //增加用户
         $sql = $pdo->prepare("INSERT INTO person(username,password) VALUES(?,?)");
         $sql->execute(array($username,$password));
         //验证是否成功插入
         $sql = $pdo->prepare("SELECT * FROM person WHERE username = ?");
         $sql->execute(array($username));
         if($sql->fetchAll(PDO::FETCH_NAMED)){
            success_encode("注册成功啦!!");
         }
      }
}else{
other_encode(400,"用户名和密码不能为空哦！");
}

?>
