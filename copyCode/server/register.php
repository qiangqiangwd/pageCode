
<?php
 require './db.class.php'; //引入数据库相关信息
 
 //获取用户名
 $userName = $_POST["userName"];
 //获取密码
 $password = $_POST["password"];
 
$db = mysql_db::getIntance();
//搜索所有的用户列表，返回数组
$list = $db->insert("user",array('userName' => $userName, 'password' => $password)); //表名  $data [数据]
	//code：成功为1  msg:返回的信息  data:返回的数据（参数）
   if($list){
	   $arr = array('code' => 1, 'msg' => '注册成功！', 'data' => array('userId' => $list));
   }else{
	   $arr = array('code' => 0, 'msg' => '注册失败', 'data' => null);
   }
   echo json_encode($arr); //返回结果
?>
