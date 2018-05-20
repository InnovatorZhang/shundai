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

//如果data不为空的话，进行下一步操作
if($data){
    //你要删除的快递的id
	$id = (int)$data["id"];
	
	//如果id不为空删除此id的数据
    if($id){
	    //准备删除数据
        $sql = $pdo->prepare("DELETE FROM express WHERE id=?");
        //如果执行成功返回信息
		if($sql->execute(array($id))){
		    success_encode("删除成功");
		}else{
			other_encode(400,"请检查id是否正确");
		}
    }else{
	    other_encode("请检查数据格式是否正确!!!");
	}
}else{
    other_encode("请检查数据格式是否正确!!!");
}


?>
