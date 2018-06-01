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


//获取要取用的页数和数量
	$page = (int)$data["page"];
	$count = (int)$data["count"];
	
	//因为是从1页开始的
	$page = $page-1;
	
	//查询开始的位置
	$begin = $page*$count;
	
	//数据库中查询
	$sql = $pdo->prepare("SELECT id AS loveid,
	title,content FROM lovewall
	LIMIT ?,?");
	
	$sql->execute(array($begin,$count));
	
	if($data = $sql->fetchAll(PDO::FETCH_NAMED)){
		success_encode($data);
	}else{
		other_encode(400, "没有数据哦!");
	}

?>