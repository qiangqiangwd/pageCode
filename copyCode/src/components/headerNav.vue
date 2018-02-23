<template>
    <header>
      <div class="box">
        <h1 class="logo">
          <!--cqq-->
        </h1>
        <!--登录注册部分-->
        <div class="f-r userInfBox">
          <a class="loginIn" @click="showLoginBox" v-if="!$store.state.isLoginOrNot">登录/注册</a>
          <div class="showInf" v-else>
            {{this.$store.state.isLoginOrNot.userName}}，欢迎回来~
            <a class="logOut" @click="loginOut">退出</a>
          </div>
        </div>
        <!--导航部分-->
        <div class="nav">
          <el-menu :default-active="activeIndex" class="el-menu-demo" mode="horizontal" @select="handleSelect" :router="true">
            <el-menu-item index="/">
              首页
            </el-menu-item>
            <el-menu-item index="/blog">
              博客
            </el-menu-item>
            <el-submenu index="3">
              <template slot="title">其他</template>
              <el-menu-item index="/comments">评论</el-menu-item>
              <el-menu-item index="/chat">聊天室</el-menu-item>
              <!--<el-menu-item index="/login"></el-menu-item>-->
            </el-submenu>
            <!--<el-menu-item index="/login" v-if="!$store.state.isLoginOrNot">-->
              <!--登录/注册-->
            <!--</el-menu-item>-->
          </el-menu>
        </div>
      </div>
    </header>
</template>

<script>
  import store from '@/store/store'
  export default {
    data() {
      return {
        activeIndex: (location.hash.match(/(\/([a-zA-Z]{1,}))|(\/)/))[0], //匹配当前所在的页面
        toSrc:['/','/blog',['/comments','/','/']],
        othTit:['评论','吐槽','登录','其他']
        ,nowIndex:3 //选中其他时

        // //判断是否登录
        // ,isLoginOrNot:false
      };
    },
    mounted(){
      const _this = this;
      //改变状态
      this.activeIndex = (location.hash.match(/(\/([a-zA-Z]{1,}))|(\/)/))[0];
    },
    methods: {
      handleSelect(key, keyPath) {
        // console.log(key);
        // console.log(keyPath);
        // 点击其他时的变化
        // if(keyPath[0] == '3'){
        //   this.nowIndex = ~~(keyPath[1].split('-')[1]);
        //   if(keyPath[1].split('-')[1] <= 1){
        //     //当选中的不为登录时，跳转到对应的页面
        //     this.$router.push(this.toSrc[keyPath[0]-1][~~keyPath[1].split('-')[1]]);
        //   }else{
        //     //获取登录状态
        //     this.$store.state.isLoginOrNot = !this.$store.state.isLoginOrNot;
        //     alert('当前登录状态为:'+this.$store.state.isLoginOrNot);
        //   }
        // }else{
        //   //当不为其他时的页面跳转
        //   this.nowIndex = 3;
        //   this.$router.push(this.toSrc[key-1]);
        // }
      }


      //显示登录界面
      ,showLoginBox(){
        this.$store.state.isShowLoginBox = true;
      }
      //退出登录
      ,loginOut(){
        this.$store.state.isLoginOrNot = false; //登录状态变为未登录
        this.$cookie.delCookie('userId'); //删除cookie中记录的userId
        // window.location.reload(); //刷新页面
      }
    }
    ,store
  }
</script>

<style scoped lang="less">
  @navHeight:60px;
  header{
    border-bottom: 2px solid #eee;
  }
  .box{
    width: 1200px;
    height: @navHeight;
    margin: 0 auto;
  }
  .logo{
    float: left;
    color: #666;
    line-height: @navHeight;
  }
  .nav{
    float: right;
  }
  .userInfBox{
    font-size: 14px;
    padding: 0 15px;
    .loginIn{
      display: block;
      line-height: @navHeight;
      color: #909399;
      &:hover{
        color: #333;
      }
    }
    .showInf{
      color: #666;
      line-height: @navHeight;
    }
    .logOut{
      /*display: inline-block;*/
      color: #666;
      margin-left: 10px;
      text-decoration: underline;
      &:hover{
        color: #F56C6C;
      }
    }
  }
</style>
