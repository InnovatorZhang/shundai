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


if($data){
	//拿到想要查询评论列表的id
	$qid = (int)$data["qid"];
	
	$sql = $pdo->prepare("SELECT person.username,person.nickname,comments.content,
	comments.time
	FROM person RIGHT JOIN comments ON person.id=comments.uid 
	WHERE comments.qid=?");
	$sql->execute(array($qid));
	
	if($data = $sql->fetchAll(PDO::FETCH_NAMED)){
		success_encode($data);
	}else{
		other_encode(400, "没有数据哦!");
	}
	
}
    


?>