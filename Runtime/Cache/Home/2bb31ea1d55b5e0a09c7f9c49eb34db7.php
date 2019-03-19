<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta content="yes" name="apple-mobile-web-app-capable">
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<meta name="format-detection" content="telephone=no">
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
<title><?php echo ($media["title"]); ?></title>
<link rel="stylesheet" type="text/css" href="css/css.css">
<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>

</head>
<style type="text/css">
       .fx_header {
              position: fixed;
              top: 0px;
                }
  </style>

<body> 

  <div class="hd_main">
  <div style="height:40px;display:none ;" class="appdiv fx_header_new"></div>
  <!--#include file="app_share.html"-->
      <div class="siliao_header">
                      联系方式
        <a  href="javascript:history.go(-1);" class="fl" id="ddd"><img src="images/zuojian.png"  style="width:11px;">返回</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>

      <div class="lianxifangshi">
        <ul>
          <li><div>手机号</div><input type="text"  name="mob" value="<?php echo ((isset($info["mob"]) && ($info["mob"] !== ""))?($info["mob"]):$uinfo[user_login]); ?>" maxlength="11" placeholder="请填写您的手机号" class="lianxifangshi_input"><div data="mob"  class="fr <?php echo ($lxfs_config["mob"]); ?>"></div></li>
          <!-- <li><div>QQ</div><input type="text"  name="qq" value="<?php echo ($info["qq"]); ?>" maxlength="20"  placeholder="请填写您的QQ账号" class="lianxifangshi_input"><div data="qq" class="fr <?php echo ($lxfs_config["qq"]); ?>"></div></li>-->
          <li><div>微信</div><input type="text"  name="weixin" value="<?php echo ($info["weixin"]); ?>" maxlength="20"  placeholder="请填写您的微信账号" class="lianxifangshi_input"><div data="weixin" class="fr <?php echo ($lxfs_config["weixin"]); ?>"></div></li>
        </ul>     	
      </div>
	  
	      <p class="vipchaikan_new">只有VIP才能查看您的联系方式</p>
	  
    <input  name="button" value="保存"  class="jichubaoc" />  
    	<!--#include file="footer.html"-->   
  </div>
  
	  <script type="text/javascript">
	  
      $(".lianxifangshi ul li .fr").click(function(){
        var index=$(this).index();
        var  o =  $(this);
        //$(this).toggleClass("hot");
        var className = $(this).attr('class');
        var data = $(this).attr('data');
        var value =  className.indexOf('hot') > 0? 0 :1;
              
        $.post('<?php echo U("Setlxfs");?>',{data:data,value:value},function(data){
    			if(data.status!=1){
    				alert(data.info);
    			}else{
    				o.toggleClass("hot");
    			}    	
    		},'json')
      })
           
      $(function(){
     		$('.jichubaoc').live('click',function(){
     			var o = $(this);
    			setDisabled(o,'保存中');
   	      var mob = $('input[name="mob"]').val();
	        if(!isDigit(mob)) {
	    	  	alertmsg('请输入正确手机号');
	    	  	unDisabled(o,'保存');
	    	  	return false;
	       	} 
		  /* 
   	       	var qq = $('input[name="qq"]').val();
   	        if(!isQQ(qq)){
   	          alert('请输入正确QQ号');
  	    	    unDisabled(o,'保存');
  	    	  	return false;
   	        }
   	       */
   	      var weixin = $('input[name="weixin"]').val();
    			$.post('<?php echo U();?>',{mob:mob,weixin:weixin},function(data){
    				if(data.status!=1){
    					alert(data.info);
    				}
    				unDisabled(o,'已保存');
    			},'json')
    		});
 			});       
	  </script>
	</body>
</html>