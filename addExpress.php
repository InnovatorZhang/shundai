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

//如果data不为空的话，插入数据
if($data){
    //快递主人的id
	$uid = (int)$data["uid"];
	//快递状态
	$deliverstatus = (int)$data["deliverstatus"];
    //需要支付的费用
	$repay = $data["repay"];
	//快递员的电话号码
	$phonenumber = $data["phonenumber"];
    //快递类型，如顺丰，圆通
	$delivertype = $data["delivertype"];
	//取快递的时间
	$receivetime = $data["receivetime"];
	//取快递的地点
	$sendlocation = $data["sendlocation"];
	//备注，如：“包裹很大”
	$note = $data["note"];

    //插入数据库当中
	$sql = $pdo->prepare("INSERT INTO express(uid,deliverstatus,repay,phonenumber,delivertype,
		receivetime,sendlocation,note) VALUES(?,?,?,?,?,?,?,?)");
    
    if($sql->execute(array($uid,$deliverstatus,$repay,$phonenumber,$delivertype,$receivetime,$sendlocation,$note))){
	    success_encode("添加成功");
	}else{
	    other_encode(400,"请检查信息是否完善!!!");
	}


}


?>
