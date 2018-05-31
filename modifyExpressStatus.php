<?php

include("mysqlConnect.php");
include("jsonWrapper.php");
//解析android传来的数据
$postData = file_get_contents('php://input');

//将json解析成数组
$arrayData = json_decode($postData,true);

//获取类型和数据
$type = (int)$arrayData["Type"];
$data = $arrayData["Content"];

if($data){
    //被修改人的账户
	$id = (int)$data["id"];
	//被修改人的密码
    $status = (int)$data["status"];

    
	//准备数据库
	$sql = $pdo->prepare("UPDATE express SET deliverstatus=? WHERE id=?");

	if($sql->execute(array($status,$id))){
		success_encode("修改快递状态成功");
	}else{
	    other_encode(400,"请检查上传的字段是否有误!!!");
	}


}else{
	other_encode(400,"请检查上传的字段是否有误!!!");
}


?>