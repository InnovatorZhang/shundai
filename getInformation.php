<?php
include("mysqlConnect.php");
include("Controll.php");

//解析android端传来的json数据
$postData = file_get_contents('php://input');

//将json数据解析成数组
$arrayData = json_decode($postData,true);

//获取类型和数据
$type = (int)$arrayData["Type"];
$data = $arrayData["Content"];

if($type == 0){
   	login($pdo,$data);
}else if($type == 1){
	getExpressList($pdo,$data);
}else if($type == 2){
	getExpressInfo($pdo,$data);
}else if($type == 3){
	getSecondHandList($pdo,$data);
}else if($type == 4){
	getSecondHandInfo($pdo,$data);
}else{
	other_encode(400, "wrong type!!!");
}

?>