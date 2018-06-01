<?php
include(dirname(__FILE__)."/../jsonWrapper.php");
include(dirname(__FILE__)."/../mysqlConnect.php");

//解析android端传来的json数据
$postData = file_get_contents('php://input');

//将json数据解析成数组
$arrayData = json_decode($postData,true);

//获取类型和数据
$type = (int)$arrayData["Type"];
$data = $arrayData["Content"];

//如果data不为空，插入数据
if($data){
    //商品主人的id
	$uid = (int)$data["uid"];
	//书名
    $title = $data["title"];
	//价格
	$price = $data["price"];
	//出版号
	$publishid = (int)$data["publishid"];
	//出版时间
	$publishtime = $data["publishtime"];
	//书的页数
	$page = (int)$data["page"];
	//书主人的电话
	$phonenumber = $data["phonenumber"];
	//书的字数
	$words = $data["words"];
	//纸的材质
	$paper = $data["paper"];
	//版式
	$format = (int)$data["format"];
	//印刷时间
	$printtime = $data["printtime"];
	//包装样式
	$package = $data["package"];
	//印刷次数
	$printtimes = (int)$data["printtimes"];
	//isbn号
	$isbn = $data["isbn"];
	//推荐语
	$recommended = $data["recommended"];
    
	//echo $uid.$title.$price.$publishid.$publishtime.$page.$phonenumber.$words.$paper.$format.$printtime.$package.$printtimes.$isbn.$recommended;
	//插入数据库
    $sql = $pdo->prepare("INSERT INTO secondhand(uid,title,price,publishid,publishtime,page,
		phonenumber,words,paper,format,printtime,package,printtimes,isbn,recommended) VALUES(
			?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

	if($sql->execute(array($uid,$title,$price,$publishid,$publishtime,$page,$phonenumber,$words,$paper,$format,$printtime,$package,$printtimes,$isbn,$recommended))){
		//查询id
		$sql = $pdo->prepare("SELECT id FROM secondhand WHERE title = ?");
		$sql->execute(array($title));
		//返回商品的id
		$id = 0;
		$data = $sql->fetchAll(PDO::FETCH_NAMED);
		
		//找到最近插入的商品的id
		foreach($data as $e){
			if($e['id'] > $id){
				$id = $e['id'];
			}
			
		}
		
		if($id > 0){
			$data2['id'] = $id;
			success_encode($data2);
		}else{
			other_encode(400,"未知错误");
		}
	    
	}else{
	    other_encode(400,"请检查信息是否完善!!!");
	}

}

?>
