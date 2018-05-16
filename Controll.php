<?php
include("token.php");

/*
*用户登陆
*/
function login($pdo,$data){
	//获取账号和密码
  $username = $data["Account"];
  $password = $data["Password"];

  $sql = $pdo->prepare("SELECT id,username,password,avatar,phonenumber,sex,token FROM person WHERE username = ? AND password = ?");
  $sql->execute(array($username, $password));
  if ($row = $sql->fetch(PDO::FETCH_NAMED)) {
      success_encode($row);
  } else {
    other_encode(400, "账号密码错误");
  }
}

/**
*获取快递列表
*/
function getExpressList($pdo,$data){
	$username = $data["Account"];
	
	//通过账户获取id
	$sql = $pdo->prepare("SELECT id FROM person WHERE username = ?");
    $sql->execute(array($username));
	if ($row = $sql->fetch(PDO::FETCH_NAMED)) {
      //拿到账户id
	  $id = $row["id"];
	  
	  //通过id找到对应的快递
	  $sql = $pdo->prepare("SELECT express.id AS deliverid,
	  person.username AS nickname,
	  person.avatar,
	  express.delivertype,
	  express.receivetime,
	  express.sendlocation
	  FROM person RIGHT JOIN express ON person.id=express.uid 
	  WHERE express.uid = ?");
	  
      $sql->execute(array($id));
	  
	  if($data = $sql->fetchAll(PDO::FETCH_NAMED)){
		 success_encode($data);
	  }else{
		 other_encode(400, "没有数据哦!");
	  }
	  
	  
	  
    } else {
      other_encode(400, "用户名错误!!!");
    }
	
	
}

/**
*获取快递详细信息
*/
function getExpressInfo($pdo,$data){
	//拿到快递id
	$id = $data["deliverid"];
	
	$sql = $pdo->prepare("SELECT express.id AS deliverid,
	express.deliverstatus,
	person.avatar,
    express.delivertype,
	express.receivetime,
	express.sendlocation,
	express.note,
	express.repay,
	person.username AS nickname,
	express.phonenumber,
	person.sex,
	person.token
	FROM person RIGHT JOIN express ON  person.id=express.uid 
	WHERE express.id = ?");
	
    $sql->execute(array($id));
	
	 if($data = $sql->fetchAll(PDO::FETCH_NAMED)){
		 success_encode($data);
	  }else{
		 other_encode(400, "没有数据哦!");
	  }
	
}

/**
*获取二手商品列表
*/
function getSecondHandList($pdo,$data){
	//获取要取用的页数和数量
	$page = $data["page"];
	$count = $data["count"];
	
	//因为是从1页开始的
	$page = $page-1;
	
	//查询开始的位置
	$begin = $page*$count;
	
	//数据库中查询
	$sql = $pdo->prepare("SELECT id AS goodsid,
	title,image,price FROM secondhand
	LIMIT ?,?");
	
	$sql->execute(array($begin,$count));
	
	if($data = $sql->fetchAll(PDO::FETCH_NAMED)){
		success_encode($data);
	}else{
		other_encode(400, "没有数据哦!");
	}

}

/**
*获取二手商品的详细信息
*/
function getSecondHandInfo($pdo,$data){
	//获取要查询商品的id
	$id = $data["goodsid"];
	
	//从数据库中查询信息
	$sql = $pdo->prepare("SELECT secondhand.id AS goodsid,
	secondhand.title,
	person.avatar,
	person.username AS nickname,
	secondhand.image,
	person.token,
	secondhand.publishtime,
	secondhand.publishid,
	secondhand.page,
	secondhand.words,
	secondhand.printtime,
	secondhand.format,
	secondhand.paper,
	secondhand.printtimes,
	secondhand.package,
	secondhand.isbn,
	secondhand.price,
	secondhand.recommended
	FROM person RIGHT JOIN secondhand ON person.id=secondhand.uid
	WHERE secondhand.id = ?");
	
	$sql->execute(array($id));
	
	if($data = $sql->fetchAll(PDO::FETCH_NAMED)){
		success_encode($data);
	}else{
		other_encode(400, "没有这本书的数据哦!");
	}
}







?>