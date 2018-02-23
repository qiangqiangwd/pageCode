<template>
    <div class="comments">
      <div class="title">
        评论区：
      </div>
      <!--输入框部分-->
      <div class="writeIn">
        <div class="w1">
          <el-input
            type="textarea"
            autosize
            placeholder="请输入内容"
            v-model="comments"
            :maxlength="400"
          >
          </el-input>
        </div>
        <div class="w2">
          <el-button>表情</el-button>
          <el-button type="primary" :loading="false">提交</el-button>
        </div>
      </div>
      <!--展示评论部分-->
      <ul class="showComments">
        <li v-for="item in 5">
          <div class="top">
            <div class="nickname">
              昵称{{item}}
            </div>
            <div class="date">
              2018-1-26
            </div>
          </div>
          <div class="bottom">
            内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容
          </div>
        </li>
      </ul>
    </div>
</template>

<script>
    export default {
        name: "comments"
        ,data(){
          return {
            comments : ''
          }
      }
    }
</script>

<style scoped lang="less">
  .comments{
    width: 1100px;
    margin: 0 auto;
    padding: 50px;
    .showComments{
      margin-top: 25px;
      color: #333;
      font-size: 0;
      /*padding: 0 20px;*/
      li{
        /*padding: 20px 0;*/
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 15px;
      }
      .bottom{
        font-size: 14px;
        padding:10px 20px;
        color: #666;
      }
      .top{
        overflow: hidden;
        border-bottom: 1px solid #eee;
        padding:10px 20px;
        .nickname,.date{
          font-size: 14px;
        }
        .nickname{
          float: left;
        }
        .date{
          float: right;
        }
      }
    }
    .title{
      font-size: 18px;
      color: #333;
      margin-bottom: 20px;
      border-left: 3px solid #409EFF;
      padding-left: 15px;
    }
    .writeIn{
      overflow: hidden;
      .w1,.w2{
        float: left;
      }
      .w1{
        width: 80%;
      }
      .w2{
        width: 20%;
        text-align: center;
      }
    }
  }
</style>
