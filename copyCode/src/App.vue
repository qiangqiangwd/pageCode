<template>
  <div id="app">
    <headerNav></headerNav>
    <router-view/>
    <login v-if="$store.state.isShowLoginBox"></login>
  </div>
</template>

<script>
  import headerNav from '@/components/headerNav'  //引入公共的头部
  import login from '@/components/login'  //导入登录模块
  import store from '@/store/store'
export default {
  name: 'app',
  components:{ headerNav,login }
  ,mounted(){
    //全局引用判断是否登录过的函数
    //判断是否登录
    this.$main.selectSomeInf({
      ele:this
    });
  }
  ,store
}
</script>

<style>
  *{
    margin: 0;
    padding: 0;
  }
  a{
    text-decoration: none;
    cursor: pointer;
  }
  textarea{
    font-size: 16px!important;
    resize: none!important;
  }
  li{
    list-style-type: none;
  }
  .allContainer{
    width: 1200px;
    margin: 0 auto;
  }
  .f-r{
    float: right;
  }
  .f-l{
    float: left;
  }
</style>
