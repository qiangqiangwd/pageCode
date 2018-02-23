
<?php
 require './db.class.php'; //引入数据库相关信息
 
 //获取用户名
 $userName = $_POST["userName"];
 //获取密码
 $password = $_POST["password"];
 
$db = mysql_db::getIntance();
//搜索所有的用户列表，返回数组
$list = $db->getRow("SELECT * FROM user WHERE userName='{$userName}' AND password='{$password}'");
	//code：成功为1  msg:返回的信息  data:返回的数据（参数）
   if($list){
	   $arr = array('code' => 1, 'msg' => '登录成功！', 'data' => $list);
   }else{
	   $arr = array('code' => 0, 'msg' => '密码不正确', 'data' => null);
   }
   echo json_encode($arr); //返回结果
?>
