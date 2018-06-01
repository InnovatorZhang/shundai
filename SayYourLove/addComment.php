<?php
include(dirname(__FILE__)."/../mysqlConnect.php");
include(dirname(__FILE__)."/../jsonWrapper.php");
//解析android端传来的json数据
$postData = file_get_contents('php://input');

//将json数据解析成数组
$arrayData = json_decode($postData,true);

//获取类型和数据
$type = (int)$arrayData["Type"];
$data = $arrayData["Content"];

if($data){
    //评论者的id
	$uid = (int)$data["uid"];
	//评论的问题的id
	$qid = (int)$data["qid"];
	//评论的具体内容
	$content = $data["content"];
	
    //插入数据库当中
	$sql = $pdo->prepare("INSERT INTO comments(uid,qid,content) VALUES(?,?,?)");
    
    if($sql->execute(array($uid,$qid,$content))){
	    success_encode("添加成功");
	}else{
	    other_encode(400,"请检查信息是否完善!!!");
	}


}


?>