<?php
include(dirname(__FILE__)."/../mysqlConnect.php");
include(dirname(__FILE__)."/../jsonWrapper.php");
//解析android传来的数据
$postData = file_get_contents('php://input');

//将json解析成数组
$arrayData = json_decode($postData,true);

//获取类型和数据
$type = (int)$arrayData["Type"];
$data = $arrayData["Content"];

if($data){
    //被修改人的账户
	$username = $data["username"];
	//被修改人的密码
    $password = $data["password"];
	//性别
	$sex = (int)$data["sex"];
	//昵称
	$nickname = $data["nickname"];
	//被修改人的电话号码
	$phonenumber = $data["phonenumber"];
	//生日
	$birthday = $data["birthday"];
	//学校
	$school = $data["school"];
	//qq号
	$qqnumber = $data["qqnumber"];
	//支付宝
	$alipay = $data["alipay"];
    
	//准备数据库
	$sql = $pdo->prepare("UPDATE person SET nickname=?,sex=?,phonenumber=?,birthday=?,school=?,qqnumber=?,alipay=? WHERE username=? AND password=?");

	if($sql->execute(array($nickname,$sex,$phonenumber,$birthday,$school,$qqnumber,$alipay,$username,$password))){
		success_encode("修改个人信息成功");
	}else{
	    other_encode(400,"请检查上传的字段是否有误!!!");
	}


}else{
	other_encode(400,"请检查上传的字段是否有误!!!");
}

?>
