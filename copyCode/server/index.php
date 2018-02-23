
<?php
 require './db.class.php'; //引入数据库相关信息
 
 echo date('y-m-d h:i:s',time());
$db = mysql_db::getIntance();
//搜索所有的用户列表，返回数组
$list = $db->getAll("SELECT * FROM user");

  //$arr=array('11','ss','ddd');
  //print_r("{$arr[0][0]}");
  $htmlStr1 = "<table border='1' cellspacing='0' cellpadding='0'><tr><td>名字</td><td>id</td><td>密码</td><td>修改/删除</td></tr>" ;
  $htmlStr2 = "";
   for($i = 0 ; $i < count($list) ; $i++){
	  // if($list[$i]['userName'] == 'qiangwd'&&$list[$i]['password'] == '123456'){
		//echo json_encode($list[$i]);   //输出json对象的形式
		//break;
	   //}
	   $str = "<tr><td>{$list[$i]['userName']}</td><td>{$list[$i]['userId']}</td><td>{$list[$i]['password']}</td><td>修改/删除</td></tr>" ;
	   $htmlStr2 = $htmlStr2.$str;
	   
	   //echo implode(",",$list[$i]) . "<br>";   //输出数组中所有的参数
   }
   $htmlStr3 = "</form>";
   echo $htmlStr1 . $htmlStr2 . $htmlStr3;
//print_r("$list");
//$list = $db->getRow("SELECT field1,field2 FROM acticle WHERE acticle_id=1018");
?>
