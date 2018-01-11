import Vue from 'vue'
//路由
import Router from 'vue-router'
//页面
import index from '@/page/index'
import blog from '@/page/blog'
import comments from '@/page/comments'

Vue.use(Router);



export default new Router({
  routes: [
    //首页
    {
      path: '/',
      name: 'index',
      component: index
    },
    //博客页面
    {
      path: '/blog',
      name: 'blog',
      component: blog
    },
    //评论页面
    {
      path: '/comments',
      name: 'comments',
      component: comments
    }
  ]
})
