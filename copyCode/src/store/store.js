
import Vue from 'vue'
//vuex页面传值
import Vuex from 'vuex'

Vue.use(Vuex);

const state = {
  isLoginOrNot : false  //是否登录的判断
};

export default new Vuex.Store({
  state
});
