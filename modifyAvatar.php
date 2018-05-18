<?php
include("mysqlConnect.php");
include("jsonWrapper.php");
//echo exec('whoami');
if($_FILES['file']['error'] > 0){
	other_encode(400,"文件错误！！！");
}else{
	$filepath = "picture/avatar/";//接收文件的目录

	//将文件存到目录下
	if(move_uploaded_file($_FILES['file']['tmp_name'],$filepath.$_FILES['file']['name'])){
   
		//分割文件名，取出要用的id
        $tempArray = explode('.',$_FILES['file']['name']);
		$id = $tempArray[0];
		$url = "http://127.0.0.1/shundai/picture/avatar/".$_FILES['file']['name'];
		$sql = $pdo->prepare("UPDATE person SET avatar=? WHERE id=?");
	    if($sql->execute(array($url,$id))){ 
           $avatarUrl["avatarUrl"] = $url;		
		   success_encode($avatarUrl);
		}else{
		    other_encode(400,"插入数据库错误,请检查图片格式或名称是否符合要求!");
		}
	}else{
	       other_encode(400,"文件存储出错啦！");
	}
}
  
  
  
?>
