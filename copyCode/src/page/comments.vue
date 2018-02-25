<template>
    <div class="comments">
      <div class="title">
        许愿墙：
      </div>
      <!--输入框部分-->
      <div class="writeIn">
        <div class="w1">
          <el-input
            type="textarea"
            autosize
            placeholder="不留下点什么吗？"
            v-model="sendComment"
            :maxlength="400"
          >
          </el-input>
        </div>
        <div class="w2">
          <el-button>表情</el-button>
          <el-button type="primary" :loading="false" @click="sendComments">提交</el-button>
        </div>
      </div>
      <!--展示评论部分-->
      <div class="waterfallBox">
        <div class="waterfall">
          <div class="item" v-for="(item,index) in comments">
            <div class="box">
              <div class="inf">
                <span>{{item.userName}}</span>
                <span class="f-r">{{item.time}}</span>
              </div>
              <p>
                {{item.content}}
              </p>
              <div class="resInf">
                <a class="like">赞&nbsp;{{item.like}}</a>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
</template>

<script>
    export default {
        name: "comments"
        ,data(){
          return {
            sendComment:'',  //输入的内容
            sendIng:false, //是否正在提交中
            comments : []
          }
      },
      mounted(){
        const _this = this;
        //获取数据
        this.$ajax({
          url: '/server/select.php'
          ,data: {
            selectInf:'desireWallInf'
          }
          ,success(res){
            res = JSON.parse(res);
            if(res.code == 1){
              console.log(res);
              _this.comments = res.data; //数据给予s
            }else{
              _this.$message.error(res.msg);
            }
          }
        });
      },
      methods:{
        sendComments(){
          const _this = this;
          let value = this.sendComment.trim();
          if(value){
            this.sendIng = true;
            //获取数据
//            let data = {
//              content:value,
//              userId:
//            };

            this.comments.before();
          }else{
            _this.$message.error('内容不能为空！');
            this.sendComment = '';
          }
        }
      }
    }
</script>

<style scoped lang="less">
  /*瀑布流层*/
  .waterfallBox{
   padding-top: 30px;

  }
  .waterfall{
    -moz-column-count:4; /* Firefox */
    -webkit-column-count:4; /* Safari 和 Chrome */
    column-count:4;
    -moz-column-gap: .5em;
    -webkit-column-gap: .5em;
    column-gap: .5em;
  }
  /*一个内容层*/
  .item{
    padding: .5em 0;
    /*margin: 0 0 1em 0;*/
    -moz-page-break-inside: avoid;
    -webkit-column-break-inside: avoid;
    break-inside: avoid;
    .box{
      padding: 8px;
      border: 1px solid rgba(64, 158, 255, 0.3);
      font-size: 14px;
      color:#333;
      border-radius: 5px;
      box-shadow: 0 0 0 #ccc;
      transition: all linear .25s;
      &:hover{
         border: 1px solid #409EFF;
         box-shadow: 0 0 10px #409EFF;
         transition: all linear .25s;
       }
       p{
         word-wrap: break-word;
       }
       .inf{
         padding-bottom: 5px;
         margin-bottom: 5px;
         font-size: 14px;
         color: #666;
         border-bottom: 1px solid #ccc;
       }
       .resInf{
         margin-top: 5px;
         padding-top: 5px;
         text-align: right;
       }
       .like{
         color:#999;
         &:hover{
            color:#67C23A;
          }
       }
    }
  }
  .item img{
    width: 100%;
    margin-bottom:10px;
  }
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
