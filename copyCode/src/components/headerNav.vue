<template>
    <header>
      <div class="box">
        <h1 class="logo">
          cqq
        </h1>
        <div class="nav">
          <el-menu :default-active="activeIndex" class="el-menu-demo" mode="horizontal" @select="handleSelect">
            <el-menu-item index="1">
              首页
            </el-menu-item>
            <el-menu-item index="2">
              博客
            </el-menu-item>
            <el-submenu index="3">
              <template slot="title">{{othTit[nowIndex]}}</template>
              <el-menu-item index="3-0">评论</el-menu-item>
              <el-menu-item index="3-1">吐槽</el-menu-item>
              <el-menu-item index="3-2">登录</el-menu-item>
            </el-submenu>
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
        activeIndex: '1',
        toSrc:['/','/blog',['/comments','/','/']],
        othTit:['评论','吐槽','登录','其他']
        ,nowIndex:3 //选中其他时
      };
    },
    methods: {
      handleSelect(key, keyPath) {
        // console.log(key);
        // console.log(keyPath);
        //点击其他时的变化
        if(keyPath[0] == '3'){
          this.nowIndex = ~~(keyPath[1].split('-')[1]);
          if(keyPath[1].split('-')[1] <= 1){
            //当选中的不为登录时，跳转到对应的页面
            this.$router.push(this.toSrc[keyPath[0]-1][~~keyPath[1].split('-')[1]]);
          }else{
            //获取登录状态
            this.$store.state.isLoginOrNot = !this.$store.state.isLoginOrNot;
            alert('当前登录状态为:'+this.$store.state.isLoginOrNot);
          }
        }else{
          //当不为其他时的页面跳转
          this.nowIndex = 3;
          this.$router.push(this.toSrc[key-1]);
        }
      }
    }
    ,store
  }
</script>

<style scoped>
  header{
    border-bottom: 2px solid #eee;
  }
  .box{
    width: 1200px;
    height: 60px;
    margin: 0 auto;
  }
  .logo{
    float: left;
    color: #666;
    line-height: 60px;
  }
  .nav{
    float: right;
  }
</style>
