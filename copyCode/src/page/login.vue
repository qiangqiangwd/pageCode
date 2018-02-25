<template>
  <div class="allContainer loginContainer">
    <div class="loginBox">
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
              <el-button type="primary" @click="submitForm('ruleLogin')">提交</el-button>
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
              <el-button type="primary" @click="submitForm('ruleRegister')">提交</el-button>
              <el-button @click="resetForm('ruleRegister')">重置</el-button>
            </el-form-item>
          </el-form>
        </el-tab-pane>
      </el-tabs>

    </div>
  </div>
</template>

<script>
  export default {
    data() {
      //登录检测用户名不为空且是否存在
      var checkUserName = (rule, value, callback) => {
        if (!value) {
          return callback(new Error('用户名不能为空'));
        }else{
          callback();
        }
        // setTimeout(() => {
        //   if (value != 'cqq') {
        //     callback(new Error('用户名不存在'));
        //   } else {
        //     callback();
        //   }
        // }, 1000);
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
            { validator: checkUserName, trigger: 'blur' }
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
      };
    },
    methods: {
      //登录或注册
      submitForm(formName) {
        let _this = this;
        this.$refs[formName].validate((valid) => {
          if (valid) {
            if(formName == 'ruleLogin'){
              _this.$ajax({
                url: 'index.php'
                // ,type:'GET'
                ,data: _this.ruleLogin
                ,success(res){
                  res = JSON.parse(res);
                  if(res.code == 1){
                    _this.$message({
                      message: res.msg,
                      type: 'success',
                      duration:2000,
                      onClose(){
                        _this.$router.push('/');
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
              alert('zhuce');
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
    }
  }
</script>

<style lang="less">
  .loginContainer{
    margin: 50px auto!important;
  }
  .loginBox{
    width: 30%;
    padding: 45px 45px 35px 20px;
    margin: 0 auto;
    border: 1px solid #eee;
    border-radius: 5px;
    box-shadow: 0 0 10px #ccc;
    .el-tabs__nav{
      left: 50%!important;
      transform: translateX(-50%)!important;
    }
    .el-tabs__item{
      font-size: 16px;
    }
  }
</style>
