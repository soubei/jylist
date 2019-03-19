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
	
    <script src="js/time/mobiscroll_002.js" type="text/javascript"></script>
	<script src="js/time/mobiscroll_004.js" type="text/javascript"></script>
	<link href="css/time/mobiscroll_002.css" rel="stylesheet" type="text/css">
	<link href="css/time/mobiscroll.css" rel="stylesheet" type="text/css">
	<script src="js/time/mobiscroll.js" type="text/javascript"></script>
	<script src="js/time/mobiscroll_003.js" type="text/javascript"></script>
	<script src="js/time/mobiscroll_005.js" type="text/javascript"></script>
	<link href="css/time/mobiscroll_003.css" rel="stylesheet" type="text/css">

<style type="text/css">
       .fx_header {
              position: fixed;
              top: 0px;
                }
  </style>



	</head>

	<body>
	
		<div class="hd_main">
		<div style="height:40px;display:none ;" class="appdiv fx_header_new"></div>
  <!--#include file="app_share.html"-->
			<div class="siliao_header">
				基本资料
				<a href="javascript:history.go(-1);" class="fl" id="ddd"><img src="images/zuojian.png" style="width:11px;">返回</a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
			
			
				<div class="jibenziliao">
					<ul>
						<li>
							<div>昵称</div>
							<input type="text" name="user_nicename" value="<?php echo ($base["user_nicename"]); ?>" placeholder="禁止使用非法昵称（5字以内）" class="jibenziliao_input" style="width:65%">
							<?php if($base['open']): ?><em style="color: red;" >(<?php echo ($base["open"]); ?>)</em><?php endif; ?>
						</li>
						<li><div>性别</div><span class="dede"><i data="2" <?php if($base['sex'] == 2): ?>class="sheng"<?php endif; ?> ></i>女生&nbsp;&nbsp;<i data="1" <?php if($base['sex'] == 1): ?>class="sheng"<?php endif; ?> ></i> 男生 </span>（如需修改，请联系客服）</li>
						<input name="sex" type="hidden" id="sex" value="<?php echo ($base["sex"]); ?>" />
						<!--<li><div>年龄</div><input type="text" name="age" value="<?php echo ($base["age"]); ?>" placeholder="请填写您的年龄" class="jibenziliao_input"></li>-->
						<li><div>星座</div>
							<select name="astro" class="astro" >
								<option value="0" >请选择</option>
								<?php if(is_array($astro)): foreach($astro as $k=>$vo): ?><option value="<?php echo ($k); ?>" <?php if($base['astro']==$k): ?>selected<?php endif; ?> ><?php echo ($vo); ?></option><?php endforeach; endif; ?> 
			 		   		</select>
						</li>
						
						
						<li>
							<div>生日</div>
						    <input value="<?php echo ($base["birthday"]); ?>" class="jibenziliao_input" readonly="readonly" name="appDate" id="appDate" type="text" placeholder="请选择出生年月">	
						</li>
						
						
						
						<li><div>地区</div>
							<select name="provinceid" id="provinceid" >
								<option value="0" >请选择</option>
								<?php if(is_array($province)): foreach($province as $key=>$vo): ?><option value="<?php echo ($vo["areaid"]); ?>" <?php if($base['provinceid']==$vo['areaid']): ?>selected<?php endif; ?> ><?php echo ($vo["areaname"]); ?></option><?php endforeach; endif; ?> 
	     		    		</select>
	     		    		
							<select name="cityid" id="cityid" >
					     		<option value="0" >请选择</option>
					     		<?php if(is_array($city)): foreach($city as $key=>$vo): ?><option value="<?php echo ($vo["areaid"]); ?>" <?php if($base['cityid']==$vo['areaid']): ?>selected<?php endif; ?> ><?php echo ($vo["areaname"]); ?></option><?php endforeach; endif; ?> 
				         	</select>
						</li>	
						
						<?php if(is_array($profile)): foreach($profile as $key=>$val): ?><li>
						   <div><?php echo ($val["name"]); ?></div>
							<select name="<?php echo ($key); ?>" class="<?php echo ($key); ?>" >
								<option value="0" >请选择</option>
								<?php if(is_array($val["info"])): foreach($val["info"] as $k=>$vo): ?><option value="<?php echo ($k); ?>" <?php if($base[$key]==$k): ?>selected<?php endif; ?> ><?php echo ($vo); ?></option><?php endforeach; endif; ?> 
			 		   		</select>
						</li><?php endforeach; endif; ?> 
						
				         	
								       
					</ul>
				</div>
				<input type="button" value="保存" class="jichubaoc"  >

				<!--#include file="footer.html"-->

		</div>
		<script type="text/javascript">
			//性别选择效果
			/*
			$(".jibenziliao ul li .dede i").click(function() {
				var index = $(this).index();
				$(".jibenziliao ul li .dede i").removeClass("sheng").eq(index).addClass("sheng");
				$('#sex').val($(this).attr('data'));
			})
			*/
			
			
			//省份选择事件
			$(function(){
				$('#provinceid').change(function(){
					var url = "<?php echo U('Home/Ajax/ajax_get_city');?>";
		    		var provinceid =  $(this).val();
		    		if(!provinceid) return false;
					$.post(url,{provinceid:provinceid},function(json){
						html = '<option value="0">请选择</option>';
						if(json){					
							$.each(json, function(idx, item) {
								html += '<option value="'+item.areaid+'">'+ item.areaname + '</option>';
							});	               
							$("#cityid").html(html);
						}			
					},'json');			
				})	
			})			
		</script>
		
		
		<script>			
			//提交
			$(function(){
				$('.jichubaoc').click(function(){
					//昵称必填
					var user_nicename = $("input[name = 'user_nicename']").val();//昵称
					if(user_nicename == ''){
						alertmsg("昵称必填");
						return false;
					}
					
					setDisabled($(this),'保存中');
					
					var o = $('.jibenziliao ul li');
				
//					var age = $("input[name = 'age']").val();//年龄
					var sex = $('input[name="sex"]').val();//性别
					var astro = $(".astro").val();
					var birthday = $("#appDate").val();
					var provinceid = $("#provinceid").val();
					var cityid = $("#cityid").val();
					var uid = $("input[name='id']").val();
					var code1 =  $(".code1").val();
					var code2 =  $(".code2").val();;
					var code3 =  $(".code3").val();;
					var code4 =  $(".code4").val();;
					
					$.ajax({
						type:"post",
						url:"<?php echo U();?>",
						data:{uid:uid,user_nicename:user_nicename,sex:sex,astro:astro,birthday:birthday,provinceid:provinceid,cityid:cityid,code1:code1,code2:code2,code3:code3,code4:code4},
						dataType: "json",
						success:function(msg){
							if( msg.type == 3 ){
								alertmsg('保存失败');
								unDisabled($('.jichubaoc'),'保存');
							}else{
								if( msg.type == 2 ){  //没开启审核   不用提示再审
									var obj = o.eq(0).find('em');
									if(obj.length != 0){
										obj.text('(审核中)');
									}else{
										o.eq(0).append('<em style="color: red;" >(审核中)</em>');
									}								
								}
								alertmsg('保存成功');
								unDisabled($('.jichubaoc'),'已保存');								
							}					
						}
					});						
				});
			})
	
			
		</script>
			<script type="text/javascript">
        $(function () {
			var currYear = (new Date()).getFullYear();	
			
			var opt={};
			opt.date = {preset : 'date'};
			opt.datetime = {preset : 'datetime'};
			opt.time = {preset : 'time'};
			opt.default = {
				theme: 'android-ics light', //皮肤样式
		        display: 'modal', //显示方式 
		        mode: 'scroller', //日期选择模式
				dateFormat: 'yyyy-mm-dd',
				lang: 'zh',
				showNow: true,
				nowText: "今天",
		        startYear: 1950, //开始年份
		        endYear: currYear + 0 //结束年份
			};

		  	$("#appDate").mobiscroll($.extend(opt['date'], opt['default']));
		  	var optDateTime = $.extend(opt['datetime'], opt['default']);
		  	var optTime = $.extend(opt['time'], opt['default']);
		    $("#appDateTime").mobiscroll(optDateTime).datetime(optDateTime);
		    $("#appTime").mobiscroll(optTime).time(optTime);
        });
    </script>
	</body>
</html>