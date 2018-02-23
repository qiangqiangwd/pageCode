<template>
  <div class="loginContainer">
    <div class="center1">
      <div class="center2">
        <div class="loginBox">
          <a class="closeBtn" @click="closeLoginBox">
            <i class="el-icon-close"></i>
          </a>
          <el-tabs v-model="activeName" @tab-click="handleClick">
            <el-tab-pane label="登录" name="0">
              <el-form :model="ruleLogin" status-icon :rules="rules1" ref="ruleLogin" label-width="100px" class="demo-ruleForm">
                <el-form-item label="用户名" prop="userName">
                  <el-input v-model="ruleLogin.userName"></el-input>
                </el-form-item>
                <el-form-item label="密码" prop="password">
                  <el-input type="password" v-model="ruleLogin.password" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item>
                  <el-button type="primary" @click="submitForm('ruleLogin')" :loading="loginFlag">登录</el-button>
                  <el-button @click="resetForm('ruleLogin')">重置</el-button>
                </el-form-item>
              </el-form>
            </el-tab-pane>
            <el-tab-pane label="注册" name="1">
              <el-form :model="ruleRegister" status-icon :rules="rules2" ref="ruleRegister" label-width="100px" class="demo-ruleForm">
                <el-form-item label="用户名" prop="userName">
                  <el-input v-model.number="ruleRegister.userName"></el-input>
                </el-form-item>
                <el-form-item label="密码" prop="password">
                  <el-input type="password" v-model="ruleRegister.password" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="确认密码" prop="checkPsd">
                  <el-input type="password" v-model="ruleRegister.checkPsd" auto-complete="off"></el-input>
                </el-form-item>

                <el-form-item>
                  <el-button type="primary" :loading="registerFlag" @click="submitForm('ruleRegister')">提交</el-button>
                  <el-button @click="resetForm('ruleRegister')">重置</el-button>
                </el-form-item>
              </el-form>
            </el-tab-pane>
          </el-tabs>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import store from '@/store/store' //导入vuex
  export default {
    data() {
      //登录检测用户名不为空且是否存在
      var checkUserNameLog = (rule, value, callback) => {
        if (!value) {
          return callback(new Error('用户名不能为空'));
        }
        this.$main.selectSomeInf({
          ele:this,
          data:{
            selectInf:'hasUserName',
            userName:value
          },
          fun(res){
            if(res.code == '1'){
              callback(new Error('用户名不存在'));
            }else{
              callback();
            }
          }
        });
      };
      //注册检测用户名不为空且是否存在
      var checkUserName = (rule, value, callback) => {
        if (!value) {
          return callback(new Error('用户名不能为空'));
        }
        this.$main.selectSomeInf({
          ele:this,
          data:{
            selectInf:'hasUserName',
            userName:value
          },
          fun(res){
            if(res.code == '1'){
              callback();
            }else{
              callback(new Error('用户名已存在'));
            }
          }
        });
      };
      //登录检测密码不能为空且不能小于6位
      var validatePass = (rule, value, callback) => {
        if (value === '') {
          callback(new Error('请输入密码'));
        } else if(value.length < 6){
          callback(new Error('密码过短'));
        }else{
          callback();
        }
      };
      var validatePass2 = (rule, value, callback) => {
        if (value === '') {
          callback(new Error('请再次输入密码'));
        } else if (value !== this.ruleRegister.password) {
          callback(new Error('两次输入密码不一致!'));
        } else {
          callback();
        }
      };
      return {
        //默认选中登录
        activeName:'0',
        //登录部分
        ruleLogin: {
          userName: '', //用户名
          password: '' //密码
        },
        rules1: {
          password: [
            { validator: validatePass, trigger: 'blur' }
          ],
          userName: [
            { validator: checkUserNameLog, trigger: 'blur' }
          ]
        }
        //注册部分
        ,ruleRegister: {
          userName: '', //用户名
          password: '' //密码
          ,checkPsd: '' //确认密码
        }
        ,rules2: {
          password: [
            { validator: validatePass, trigger: 'blur' }
          ],
          checkPsd: [
            { validator: validatePass2, trigger: 'blur' }
          ],
          userName: [
            { validator: checkUserName, trigger: 'blur' }
          ]
        }

        //登录状态
        ,loginFlag:false
        //注册状态
        ,registerFlag:false
      };
    },
    mounted(){
    },
    methods: {
      //登录或注册
      submitForm(formName) {
        let _this = this;
        this.$refs[formName].validate((valid) => {
          if (valid) {
            if(formName == 'ruleLogin'){
              _this.loginFlag = true;
              _this.$ajax({
                url: '/server/login.php'
                ,data: _this.ruleLogin
                ,success(res){
                  res = JSON.parse(res);
                  _this.loginFlag = false;

                  if(res.code == 1){
                    _this.$message({
                      message: res.msg,
                      type: 'success',
                      duration:1500,
                      onClose(){
                        _this.$router.push('/'); //跳转回首页
                        _this.$store.state.isLoginOrNot = res.data;  //判断已经登录（将用户信息放入这条信息中）
                        _this.$cookie.setCookie('userId',res.data.userId,2);
                        _this.$store.state.isShowLoginBox = false;  //关闭登录框
                      }
                    });
                  }else{
                    _this.$message.error(res.msg);
                  }
                }
              });
            }else{
              // /^[\S]{6,12}$/
              //   ,'密码必须6到12位，且不能出现空格'
              _this.registerFlag = true;
              _this.$ajax({
                url: '/server/register.php'
                ,data: _this.ruleRegister
                ,success(res){
                  _this.registerFlag = false;
                  res = JSON.parse(res);
                  console.log(res);


                  if(res.code == 1){
                    _this.$message({
                      message: res.msg,
                      type: 'success',
                      duration:2000,
                      onClose(){
                        _this.resetForm('ruleRegister');
                      }
                    });
                  }else{
                    _this.$message.error(res.msg);
                  }
                }
              });
              _this.resetForm('ruleLogin');
            }
          } else {
            return false;
          }
        });
      },
      resetForm(formName) {
        this.$refs[formName].resetFields();
      },
      handleClick(tab, event) {
        //点击切换登录注册时的操作
        // console.log(tab, event);
      }
      //关闭登录框
      ,closeLoginBox(){
        this.$store.state.isShowLoginBox = false;
      }
    }
    ,store
  }
</script>

<style lang="less">
  .loginContainer{
    /*margin: 50px auto!important;*/
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 666;
    .center1{
      display: table;
      width: 100%;
      height: 100%;
      text-align: center;
      .center2{
        display: table-cell;
        vertical-align: middle;
      }
    }
  }
  .loginBox{
    display: inline-block;
    width: 360px;
    padding: 45px 45px 35px 20px;
    margin: 0 auto;
    border: 1px solid #eee;
    border-radius: 5px;
    box-shadow: 0 0 10px #ccc;
    background: #fff;
    position: relative;
    .el-tabs__nav{
      left: 50%!important;
      transform: translateX(-50%)!important;
    }
    .el-tabs__item{
      font-size: 16px;
    }
    .closeBtn{
      position: absolute;
      right: 20px;
      top: 20px;
      font-size: 22px;
      color: #666;
      padding: 5px;
      &:hover{
        color: #F56C6C;
      }
    }
  }
</style>
