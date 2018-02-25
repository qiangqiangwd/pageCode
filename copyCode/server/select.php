
<?php
 require './db.class.php'; //引入数据库相关信息
 //该php用于查找相关数据
 
 //获取用户名
 $selectInf = $_POST["selectInf"];
 
 $db = mysql_db::getIntance();

 
 if($selectInf == "loginJudge"){
	 
		//判断是否登录的部分
		$list = $db->getRow("SELECT * FROM user WHERE userId='{$_POST["userId"]}'");
		//code：成功为1  msg:返回的信息  data:返回的数据（参数）
	   if($list){
		   $arr = array('code' => 1, 'msg' => '已登录！', 'data' => $list);
	   }else{
		   $arr = array('code' => 0, 'msg' => '未登录！', 'data' => null);
	   }
 }else if($selectInf == "hasUserName"){
	 
		//判断用户名是否存在的部分
	 	$list = $db->getRow("SELECT * FROM user WHERE userName='{$_POST["userName"]}'");
		//code：成功为1  msg:返回的信息  data:返回的数据（参数）
	   if($list){
		   $arr = array('code' => 0, 'msg' => '拥有该用户名！', 'data' => null);
	   }else{
		   $arr = array('code' => 1, 'msg' => '未拥有该用户名！', 'data' => $list);
	   }
 }else if($selectInf == "desireWallInf"){
	 
	 	//获取许愿墙信息部分
	 	$list = $db->getAll("SELECT * FROM desireWall");
		//code：成功为1  msg:返回的信息  data:返回的数据（参数）
	   if($list){
		   $arr = array('code' => 1, 'msg' => '返回成功！', 'data' => $list);
	   }else{
		   $arr = array('code' => 0, 'msg' => '返回失败！', 'data' => null);
	   }
 }
 
 echo json_encode($arr); //返回结果

?>
