<template>
  <div>
    <h1 class="t-c">首页</h1>

    <div class="underTimeBox">
      距离<b>国庆长假</b>还有：
      <p>
        <b class="r-c">{{nationalTime.day}}</b>天
        <b class="o-c">{{nationalTime.hour}}</b>小时
        <b class="b-c">{{nationalTime.minute}}</b>分钟
        <b class="g-c">{{nationalTime.second}}</b>秒
      </p>
    </div>
  <div>
    <h3>api的链接</h3>
    <a target="_blank" href="http://blog.csdn.net/h5_queenstyle12/article/details/75386359">vuex的使用</a>
  </div>
  </div>
</template>

<script>
    export default {
      name: "index",
      data() {
        return {
          nationalTime:{},
          underTime:''
        }
      },
      //立即执行
      mounted (){
        getServerDate(this);
      },
      destroyed(){
        //当退出本页面时清除所有倒计时
        clearInterval(this.underTime);
      }
    }

    // 获取当前服务器时间
    function getServerDate(e){
      let xhr = null;
      if(window.XMLHttpRequest){
        xhr = new window.XMLHttpRequest();
      }else{ // ie
        xhr = new ActiveObject("Microsoft")
      }

      xhr.open("GET","/",true);
      xhr.send(null);
      xhr.onreadystatechange=function(){
        //获取到时间后的操作
        let time,date;
        if(xhr.readyState == 2){
          time = xhr.getResponseHeader("Date");
          date = new Date(time);
          let delTime = 0;
          e.nationalTime = calcTime('2018-10-1',date.getTime());

          //开始循环加载时间
          e.underTime = setInterval(()=>{
            delTime+=1000;
            e.nationalTime = calcTime('2018-10-1',date.getTime() + delTime);
          },1000);
        }
      }
    }

    /**
     * 时间的计算:
     * time：要和当前时间进行比较的时间（格式可以为2018-10-1 10:1:20 或 2018/10/1 10:1:20）
     */

    function calcTime(fTime,now){
      //转换为时间戳
      let futureTime = (new Date(fTime)).getTime(),
        nowTime = now,
        calcTime = Math.floor((futureTime - nowTime)/1000) //两则所相差的秒数
        ,year,week,day,hour,minute,second  //年周日时分秒
      ;

      // year = Math.floor(calcTime/31536000);
      // week = Math.floor((calcTime%31536000)/604800);
      day = Math.floor(calcTime/86400);
      hour = Math.floor(calcTime%86400/3600);
      minute = Math.floor(calcTime%86400%3600/60);
      second = calcTime%86400%3600%60;
      return {
        day:day,
        hour:hour,
        minute:minute,
        second:second
      }
    }
</script>

<style scoped lang="less">
  .underTimeBox{
    color: #333333;
    text-align: center;
    margin: 25px 0;
    b{
      font-size: 22px;
      color: #666;
      margin: 0 10px;
    }
    p{
      b{
        font-size: 24px;
        margin: 0 5px;
      }
    }
  }
</style>
