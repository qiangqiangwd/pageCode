
import Vue from 'vue'
//vuex页面传值
import Vuex from 'vuex'

Vue.use(Vuex);

//公共参数变量
const state = {
  isLoginOrNot : false  //是否登录的判断
  ,isShowLoginBox:false //是否显示登录框
  ,navNowStatus:'/' //导航栏当前所在位置
};

//公共函数
const mutations = {
  //判断登录状态
  judgeLoginFlag(){
    // console.log(this);
  }
};

export default new Vuex.Store({
  state,mutations
});
