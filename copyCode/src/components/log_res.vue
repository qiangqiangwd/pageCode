<template>
  <div class="log_res">
    <div class="centerBox1">
      <div class="centerBox2">
        <div class="box">
          <h3 class="title">登陆</h3>
          <el-form ref="form" :model="form" label-width="80px">
            <el-form-item label="用户名">
              <el-input v-model="form.userName" placeholder="请输入用户名"></el-input>
            </el-form-item>
            <el-form-item label="密码">
              <el-input v-model="form.password" type="password" placeholder="请输入密码"></el-input>
            </el-form-item>
            <el-form-item>
              <el-button type="primary" @click="logOrResSubmitResult">立即登陆</el-button>
              <!--<el-button>取消</el-button>-->
            </el-form-item>
          </el-form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import store from '@/store/store'
  export default {
    data () {
      return {
        form:{
          userName:''
          ,password:''
        }
      }
    }
  ,methods:{
    logOrResSubmitResult(){
      var _this = this;
      this.$ajax({
        url:'login.php',
        type:'POST',
        data:{
          userName:_this.form.userName
          ,password:_this.form.password
        },
        success(data){
//        data = data.trim();
        data = JSON.parse(data);
        console.log(data);
          if(data.code == '200'){
            _this.$message({
              message: '登陆成功!',
              type: 'success'
            });
            _this.$emit('listenToChildEvent',false); //向调用登陆框的父组件发送可以关闭登陆框的消息
           _this.$store.isLoginOrNot = true;//改变登陆状态（变为已登陆）
            localStorage.token = data.data.token;
          }else{
            _this.$message({
              message: data.data == 'psdFalse'?'密码错误!':'用户名错误!',
              type: 'error'
            });
          }
        }
      });
    }
  }
  ,store
  }
</script>

<style scoped>
  /*<!-- 总的盒子-->*/
  .log_res{
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0, 0, 0, 0.3);
  }
  .centerBox1{
    display: table;
    width:100%;
    height:100%;
  }
  .centerBox2{
    display: table-cell;
    text-align: center;
    vertical-align: middle;
  }
  .centerBox2 .box{
    display: inline-block;
    padding: 20px 40px 20px 20px;
    background: #fff;
    text-align: left;
  }
  h3.title{
    text-align: center;
    padding-bottom: 20px;
    font-size: 20px;
    color: #333;
  }
</style>
