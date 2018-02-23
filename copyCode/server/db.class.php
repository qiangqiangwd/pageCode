
<?php
class mysql_db{  
  //1.私有的静态属性
  private static $dbcon = false;  
  //2.私有的构造方法
  private function __construct(){
    $dbconn = @mysql_connect("bdm181660112.my3w.com","bdm181660112","cqqMysqlPw1993");
    mysql_select_db("bdm181660112_db",$dbconn) or die("mysql_connect error");
    mysql_query("SET NAMES utf8");
  }  
  //3.私有的克隆方法
  private function __clone() {
  
  }  
  //1.公有的静态方法
  public static function getIntance() { 
    if(self::$dbcon==false){    
      self::$dbcon=new self;
    } 
    return self::$dbcon;
  } 
  //执行语句
  public function query($sql) {
    $query=mysql_query($sql);    
    return $query;
  } 
  /**
  * 查询某个字段
  * @param
  * @return string or int
  */
  public function getOne($sql) {
    $query = $this->query($sql);   
    return mysql_result($query,0);
  }  
  //获取一行记录,return array 一维数组
  public function getRow($sql,$type="assoc") {
      $query=$this->query($sql);    
      if(!in_array($type,array("assoc",'array',"row"))) { 
         die("mysql_query error");
       }
      $funcname = "mysql_fetch_".$type;   
      return $funcname($query);
  }  
  //获取一条记录,前置条件通过资源获取一条记录
  public function getFormSource($query,$type="assoc"){    
     if(!in_array($type,array("assoc","array","row"))) {
        die("mysql_query error");
     }
     $funcname = "mysql_fetch_".$type;    
     return $funcname($query);
  }  //获取多条数据，二维数组
  public function getAll($sql){
      $query=$this->query($sql);
      $list=array();   
      while ($r=$this->getFormSource($query)) {
        $list[]=$r;
      }  
      return $list;
  }  
  //获得最后一条记录id
  public function getInsertid(){  
     return mysql_insert_id();
  }
   /**
   * 定义添加数据的方法
   * @param string $table 表名
   * @param string orarray $data [数据]
   * @return int 最新添加的id
   */
   public function insert($table,$data){  
    //遍历数组，得到每一个字段和字段的值
     $key_str='';
     $v_str='';   
     foreach($data as $key=>$v) {   
        if(empty($v)) {     
        die("error");
      }     
      //$key的值是每一个字段s一个字段所对应的值
      $key_str.=$key.',';
      $v_str.="'$v',";
   }
   $key_str=trim($key_str,',');
   $v_str=trim($v_str,',');   //判断数据是否为空
   $sql="insert into $table ($key_str) values ($v_str)";   
   $this->query($sql);   //返回上一次增加操做产生ID值
   return mysql_insert_id();
 }
 /*
  * 删除一条数据方法
  * @param1 $table, $where=array('id'=>'1') 表名 条件
  * @return 受影响的行数
  */
  public function deleteOne($table, $where){    
     if(is_array($where)){      
        foreach ($where as $key => $val) {
        $condition = $key.'='.$val;
      }
    } else {
      $condition = $where;
    }
    $sql = "delete from $table where $condition";    $this->query($sql);    //返回受影响的行数
    return mysql_affected_rows();
  }  /*
  * 删除多条数据方法
  * @param1 $table, $where 表名 条件
  * @return 受影响的行数
  */
  public function deleteAll($table, $where){    
      if(is_array($where)){  
          foreach ($where as $key => $val) {  
                if(is_array($val)){
          $condition = $key.' in ('.implode(',', $val) .')';
        } else {
          $condition = $key. '=' .$val;
        }
      }
    } else {
      $condition = $where;
    }
    $sql = "delete from $table where $condition";    $this->query($sql);    //返回受影响的行数
    return mysql_affected_rows();
  }
  /**
  * [修改操作description]
  * @param [type] $table [表名]
  * @param [type] $data [数据]
  * @param [type] $where [条件]
  * @return [type]
  */
 public function update($table,$data,$where) {   //遍历数组，得到每一个字段和字段的值
      $str='';  foreach($data as $key=>$v){
      $str.="$key='$v',";
  }
     $str=rtrim($str,',');  //修改SQL语句
     $sql="update $table set $str where $where";  $this->query($sql);  //返回受影响的行数
     return mysql_affected_rows();
 }
}

?>