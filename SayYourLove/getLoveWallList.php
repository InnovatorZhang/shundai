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


//获取要取用的页数和数量
	$page = (int)$data["page"];
	$count = (int)$data["count"];
	
	//因为是从1页开始的
	$page = $page-1;
	
	//查询开始的位置
	$begin = $page*$count;
	
	//数据库中查询
	$sql = $pdo->prepare("SELECT lovewall.id AS loveid,
	person.avatar,
	person.username,
	person.nickname,
	lovewall.title,
	lovewall.content,
    lovewall.time	
	FROM person RIGHT JOIN lovewall ON person.id=lovewall.uid
	LIMIT ?,?");
	
	$sql->execute(array($begin,$count));
	
	if($data = $sql->fetchAll(PDO::FETCH_NAMED)){
		//通过id添加评论条数
		foreach($data as &$e){
			$sql = $pdo->prepare("select count(*) AS count FROM comments WHERE qid=?");
			$sql->execute(array($e["loveid"]));
			
			if($temp = $sql->fetchAll(PDO::FETCH_NAMED)){
				 
				foreach($temp as $c){
					$e["count"] = $c["count"];
				}
			}else{
				other_encode(400, "奇怪的错误");
			}
		}
		
		success_encode($data);
	}else{
		other_encode(400, "没有数据哦!");
	}

?>