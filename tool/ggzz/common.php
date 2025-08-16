<?php
include('./head.php');
echo '
<div class="layui-container">
	<div class="layui-row layui-col-space15">
		<div class="layui-col-md12">
			<div class="fly-panel">
				<div class="layui-card">
					<div class="layui-card-header"><span class="layui-badge-dot"></span> 请根据提示文字长度按照输入</div>
					<div class="layui-card-body">';
			
$jason = (isset($_GET['jason']) ? $_GET['jason'] : NULL);


/*********************************************************************************
/
/
/				以下为横幅制作
/
/
/*********************************************************************************/


if ($jason == 'jp2') {
	echo '
	<div class="panel panel-primary">

		<div class="panel-body">
			<div class="list-group-item">
				<img id="banner" class="img-responsive" src="img/2/chengfeng.png">
			</div>
			<input type="text" class="layui-input" name="a" id="a">
			<pre>永久超级会员8元 永久会员4元 下单秒刷</pre>
			<input type="text" class="layui-input" name="b" id="b">
			<pre>每天免费领取1000名片赞   24小时自助下单</pre>
			<input type="button" id="start" class="layui-btn layui-btn-fluid" value="生成制作"><div class="jiange10"></div>
			<a class="layui-btn layui-btn-primary layui-btn-fluid" href="https://connect.qq.com/widget/shareqq/index.html?url=http://wpa.qq.com/msgrd?v=3&uin=2921617366&site=qq&menu=yes">
			<i class="layui-icon layui-icon-face-smile" style="font-size: 15px; color: #1E9FFF;"></i>  长按图片可进行保存哦</a>
			<script type="text/javascript">
			$(document).ready(function() {
				$("#start").click(function() {
					var aa = $("#a").val();
					var bb = $("#b").val();
					layer.msg("生成过程中可能需要一段时间,请耐心等待");
					$("#banner").attr("src","./api.php?a="+aa+"&b="+bb+"&t=t2");
				})
			});
			</script>
		</div>
		<div class="panel-footer">
			<a class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" οnclick="javascript:history.back(-1);">返回上级</a>
			<a class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" style="float: right;" href="/">回到首页</a>
		</div>
	</div>
	';
} elseif ($jason == 'jp1') {
	echo '
	<div class="panel panel-primary">

		<div class="panel-body">
			<div class="list-group-item">
				<img id="banner" class="img-responsive" src="img/1/chengfeng.png">
			</div>
			<input type="text" class="layui-input" name="a" id="a">
			<pre>网红代刷网</pre>
			<input type="text" class="layui-input" name="b" id="b">
			<pre>最专注的网红平台</pre>
			<input type="text" class="layui-input" name="c" id="c">
			<pre>抖音网红精选业务</pre>
			<input type="text" class="layui-input" name="d" id="d">
			<pre>抖音热门汇总业务</pre>
			<input type="text" class="layui-input" name="e" id="e">
			<pre>超级会员4元</pre>
			<input type="text" class="layui-input" name="f" id="f">
			<pre>永久会员2元</pre>
			<input type="text" class="layui-input" name="h" id="h">
			<pre>网红自助下单平台，千万名片赞免费领取，24小时自助下单！</pre>
			<input type="button" id="start" class="layui-btn layui-btn-fluid" value="生成制作"><div class="jiange10"></div>
			<a class="layui-btn layui-btn-primary layui-btn-fluid" href="https://connect.qq.com/widget/shareqq/index.html?url=http://wpa.qq.com/msgrd?v=3&uin=2921617366&site=qq&menu=yes">
			<i class="layui-icon layui-icon-face-smile" style="font-size: 15px; color: #1E9FFF;"></i>  长按图片可进行保存哦</a>
			<script type="text/javascript">
			$(document).ready(function() {
				$("#start").click(function() {
								var aa = $("#a").val();
								var bb = $("#b").val();
								var cc = $("#c").val();
								var dd = $("#d").val();
								var ee = $("#e").val();
								var ff = $("#f").val();
								var hh = $("#h").val();
								
					layer.msg("生成过程中可能需要一段时间,请耐心等待");
					$("#banner").attr("src","./api.php?a="+aa+"&b="+bb+"&c="+cc+"&d="+dd+"&e="+ee+"&f="+ff+"&h="+hh+"&t=t1");
				})
			});
			</script>
		</div>
		<div class="panel-footer">
			<a class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" οnclick="javascript:history.back(-1);">返回上级</a>
			<a class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" style="float: right;" href="/">回到首页</a>
		</div>
	</div>
';
} elseif ($jason == 'jp3') {
	echo '
	<div class="panel panel-primary">

		<div class="panel-body">
			<div class="list-group-item">
				<img id="banner" class="img-responsive" src="img/3/chengfeng.png">
			</div>
			<input type="text" class="layui-input" name="a" id="a">
			<pre>永久超会5元，快手，抖音业务低价代刷</pre>
			<input type="button" id="start" class="layui-btn layui-btn-fluid" value="生成制作"><div class="jiange10"></div>
			<a class="layui-btn layui-btn-primary layui-btn-fluid" href="https://connect.qq.com/widget/shareqq/index.html?url=http://wpa.qq.com/msgrd?v=3&uin=2921617366&site=qq&menu=yes">
			<i class="layui-icon layui-icon-face-smile" style="font-size: 15px; color: #1E9FFF;"></i>  长按图片可进行保存哦</a>
				<script type="text/javascript">
				$(document).ready(function() {
					$("#start").click(function() {
						var aa = $("#a").val();
						layer.msg("生成过程中可能需要一段时间,请耐心等待");
						$("#banner").attr("src","./api.php?a="+aa+"&t=t3");
					})
				});
			</script>
		</div>
		<div class="panel-footer">
			<a class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" οnclick="javascript:history.back(-1);">返回上级</a>
			<a class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" style="float: right;" href="/">回到首页</a>
		</div>
	</div>	
';
} elseif ($jason == 'jp4') {
	echo '
	<div class="panel panel-primary">

		<div class="panel-body">
			<div class="list-group-item">
				<img id="banner" class="img-responsive" src="img/4/chengfeng.png">
            </div>
			<input type="text" class="layui-input" name="a" id="a">
			<pre>乘风卡盟</pre>
			<input type="text" class="layui-input" name="b" id="b">
			<pre>baidu.com</pre>
			<input type="text" class="layui-input" name="c" id="c">
			<pre>全网辅助低至1毛</pre>
			<input type="text" class="layui-input" name="d" id="d">
			<pre>作者卖卡 不稳不要钱</pre>
			<input type="button" id="start" class="layui-btn layui-btn-fluid" value="生成制作"><div class="jiange10"></div>
			<a class="layui-btn layui-btn-primary layui-btn-fluid" href="https://connect.qq.com/widget/shareqq/index.html?url=http://wpa.qq.com/msgrd?v=3&uin=2921617366&site=qq&menu=yes">
			<i class="layui-icon layui-icon-face-smile" style="font-size: 15px; color: #1E9FFF;"></i>  长按图片可进行保存哦</a>
			<script type="text/javascript">
			$(document).ready(function() {
				$("#start").click(function() {
					var aa = $("#a").val();
					var bb = $("#b").val();
					var cc = $("#c").val();
					var dd = $("#d").val();
					layer.msg("生成过程中可能需要一段时间,请耐心等待");
					$("#banner").attr("src","./api.php?a="+aa+"&b="+bb+"&c="+cc+"&d="+dd+"&t=t4");
				})
			});
			</script>
			
		</div>
		<div class="panel-footer">
			<a class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" οnclick="javascript:history.back(-1);">返回上级</a>
			<a class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" style="float: right;" href="/">回到首页</a>
		</div>
	</div>	
';
} elseif ($jason == 'jp5') {
	echo '
	<div class="panel panel-primary">

		<div class="panel-body">
			<div class="list-group-item">
				<img id="banner" class="img-responsive" src="img/5/chengfeng.png">
			</div>
			<input type="text" class="layui-input" name="a" id="a">
			<pre>广告位火爆招租中</pre>
			<input type="text" class="layui-input" name="b" id="b">
			<pre>曝光超高黄金广告位 低价出售了</pre>
			<input type="button" id="start" class="layui-btn layui-btn-fluid" value="生成制作"><div class="jiange10"></div>
			<a class="layui-btn layui-btn-primary layui-btn-fluid" href="https://connect.qq.com/widget/shareqq/index.html?url=http://wpa.qq.com/msgrd?v=3&uin=2921617366&site=qq&menu=yes">
			<i class="layui-icon layui-icon-face-smile" style="font-size: 15px; color: #1E9FFF;"></i>  长按图片可进行保存哦</a>
			<script type="text/javascript">
			$(document).ready(function() {
				$("#start").click(function() {
					var aa = $("#a").val();
					var bb = $("#b").val();
					layer.msg("生成过程中可能需要一段时间,请耐心等待");
					$("#banner").attr("src","./api.php?a="+aa+"&b="+bb+"&t=t5");
				})
			});
			</script>
		</div>
		<div class="panel-footer">
			<a class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" οnclick="javascript:history.back(-1);">返回上级</a>
			<a class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" style="float: right;" href="/">回到首页</a>
		</div>
	</div>	
';
}elseif ($jason == 'jp6') {
	echo '
	<div class="panel panel-primary">

		<div class="panel-body">
			<div class="list-group-item">
				<img id="banner" class="img-responsive" src="img/6/chengfeng.png">
			</div>
			<input type="text" class="layui-input" name="a" id="a">
			<pre>卡盟分站加盟满堆</pre>
			<input type="text" class="layui-input" name="b" id="b">
			<pre>金币条幅</pre>
			<input type="text" class="layui-input" name="c" id="c">
			<pre>卡盟平台分站免费送某某源码网做图</pre>
			<input type="button" id="start" class="layui-btn layui-btn-fluid" value="生成制作"><div class="jiange10"></div>
			<a class="layui-btn layui-btn-primary layui-btn-fluid" href="https://connect.qq.com/widget/shareqq/index.html?url=http://wpa.qq.com/msgrd?v=3&uin=2921617366&site=qq&menu=yes">
			<i class="layui-icon layui-icon-face-smile" style="font-size: 15px; color: #1E9FFF;"></i>  长按图片可进行保存哦</a>
			<script type="text/javascript">
			$(document).ready(function() {
				$("#start").click(function() {
					var aa = $("#a").val();
					var bb = $("#b").val();
					var cc = $("#c").val();
					layer.msg("生成过程中可能需要一段时间,请耐心等待");
					$("#banner").attr("src","./api.php?a="+aa+"&b="+bb+"&c="+cc+"&t=t6");
				})
			});
			</script>
		</div>
		<div class="panel-footer">
			<a class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" οnclick="javascript:history.back(-1);">返回上级</a>
			<a class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" style="float: right;" href="/">回到首页</a>
		</div>
	</div>	
';
}elseif ($jason == 'jp7') {
	echo '
	<div class="panel panel-primary">

		<div class="panel-body">
			<div class="list-group-item">
				<img id="banner" class="img-responsive" src="img/7/chengfeng.png">
			</div>
			<input type="text" class="layui-input" name="a" id="a">
			<pre>奇乐网</pre>
			<input type="text" class="layui-input" name="b" id="b">
			<pre>76wp.cn</pre>
			<input type="text" class="layui-input" name="c" id="c">
			<pre>0元距离上云体验</pre>
			<input type="text" class="layui-input" name="d" id="d">
			<pre>ESC85折六月限时抢更快更稳定</pre>
			<input type="button" id="start" class="layui-btn layui-btn-fluid" value="生成制作"><div class="jiange10"></div>
			<a class="layui-btn layui-btn-primary layui-btn-fluid" href="https://connect.qq.com/widget/shareqq/index.html?url=http://wpa.qq.com/msgrd?v=3&uin=2921617366&site=qq&menu=yes">
			<i class="layui-icon layui-icon-face-smile" style="font-size: 15px; color: #1E9FFF;"></i>  长按图片可进行保存哦</a>
			<script type="text/javascript">
			$(document).ready(function() {
				$("#start").click(function() {
					var aa = $("#a").val();
					var bb = $("#b").val();
					var cc = $("#c").val();
					var dd = $("#d").val();
					layer.msg("生成过程中可能需要一段时间,请耐心等待");
					$("#banner").attr("src","./api.php?a="+aa+"&b="+bb+"&c="+cc+"&d="+dd+"&t=t7");
				})
			});
			</script>
		</div>
		<div class="panel-footer">
			<a class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" οnclick="javascript:history.back(-1);">返回上级</a>
			<a class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" style="float: right;" href="/">回到首页</a>
		</div>
	</div>	
';
}elseif ($jason == 'jp8') {
	echo '
	<div class="panel panel-primary">

		<div class="panel-body">
			<div class="list-group-item">
				<img id="banner" class="img-responsive" src="img/8/chengfeng.png">
			</div>
			<input type="text" class="layui-input" name="a" id="a">
			<pre>奇乐中文网</pre>
			<input type="text" class="layui-input" name="b" id="b">
			<pre>男频女频收稿啦！加高福利多！</pre>
			<input type="text" class="layui-input" name="c" id="c">
			<pre>立即投稿</pre>
			<input type="button" id="start" class="layui-btn layui-btn-fluid" value="生成制作"><div class="jiange10"></div>
			<a class="layui-btn layui-btn-primary layui-btn-fluid" href="https://connect.qq.com/widget/shareqq/index.html?url=http://wpa.qq.com/msgrd?v=3&uin=2921617366&site=qq&menu=yes">
			<i class="layui-icon layui-icon-face-smile" style="font-size: 15px; color: #1E9FFF;"></i>  长按图片可进行保存哦</a>
			<script type="text/javascript">
			$(document).ready(function() {
				$("#start").click(function() {
					var aa = $("#a").val();
					var bb = $("#b").val();
					var cc = $("#c").val();
					layer.msg("生成过程中可能需要一段时间,请耐心等待");
					$("#banner").attr("src","./api.php?a="+aa+"&b="+bb+"&c="+cc+"&t=t8");
				})
			});
			</script>
		</div>
		<div class="panel-footer">
			<a class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" οnclick="javascript:history.back(-1);">返回上级</a>
			<a class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" style="float: right;" href="/">回到首页</a>
		</div>
	</div>	
';
}elseif ($jason == 'jp9') {
	echo '
	<div class="panel panel-primary">

		<div class="panel-body">
			<div class="list-group-item">
				<img id="banner" class="img-responsive" src="img/9/chengfeng.png">
			</div>
			<input type="text" class="layui-input" name="a" id="a">
			<pre>穷逼赚钱啦</pre>
			<input type="text" class="layui-input" name="b" id="b">
			<pre>提现秒到</pre>
			<input type="text" class="layui-input" name="c" id="c">
			<pre>每日福利送999+</pre>
			<input type="button" id="start" class="layui-btn layui-btn-fluid" value="生成制作"><div class="jiange10"></div>
			<a class="layui-btn layui-btn-primary layui-btn-fluid" href="https://connect.qq.com/widget/shareqq/index.html?url=http://wpa.qq.com/msgrd?v=3&uin=2921617366&site=qq&menu=yes">
			<i class="layui-icon layui-icon-face-smile" style="font-size: 15px; color: #1E9FFF;"></i>  长按图片可进行保存哦</a>
			<script type="text/javascript">
			$(document).ready(function() {
				$("#start").click(function() {
					var aa = $("#a").val();
					var bb = $("#b").val();
					var cc = $("#c").val();
					layer.msg("生成过程中可能需要一段时间,请耐心等待");
					$("#banner").attr("src","./api.php?a="+aa+"&b="+bb+"&c="+cc+"&t=t9");
				})
			});
			</script>
		</div>
		<div class="panel-footer">
			<a class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" οnclick="javascript:history.back(-1);">返回上级</a>
			<a class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" style="float: right;" href="/">回到首页</a>
		</div>
	</div>	
';
}elseif ($jason == 'jp10') {
	echo '
	<div class="panel panel-primary">

		<div class="panel-body">
			<div class="list-group-item">
				<img id="banner" class="img-responsive" src="img/10/chengfeng.png">
			</div>
			<input type="text" class="layui-input" name="a" id="a">
			<pre>海量素材</pre>
			<input type="text" class="layui-input" name="b" id="b">
			<pre>古风水墨实物漂浮等</pre>
			<input type="text" class="layui-input" name="c" id="c">
			<pre>免扣透明设计元素</pre>
			<input type="button" id="start" class="layui-btn layui-btn-fluid" value="生成制作"><div class="jiange10"></div>
			<a class="layui-btn layui-btn-primary layui-btn-fluid" href="https://connect.qq.com/widget/shareqq/index.html?url=http://wpa.qq.com/msgrd?v=3&uin=2921617366&site=qq&menu=yes">
			<i class="layui-icon layui-icon-face-smile" style="font-size: 15px; color: #1E9FFF;"></i>  长按图片可进行保存哦</a>
			<script type="text/javascript">
			$(document).ready(function() {
				$("#start").click(function() {
					var aa = $("#a").val();
					var bb = $("#b").val();
					var cc = $("#c").val();
					layer.msg("生成过程中可能需要一段时间,请耐心等待");
					$("#banner").attr("src","./api.php?a="+aa+"&b="+bb+"&c="+cc+"&t=t10");
				})
			});
			</script>
		</div>
		<div class="panel-footer">
			<a class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" οnclick="javascript:history.back(-1);">返回上级</a>
			<a class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" style="float: right;" href="/">回到首页</a>
		</div>
	</div>	
';
}









/*********************************************************************************
/
/
/				以下为店标制作
/
/
/*********************************************************************************/


if ($jason == 'db1') {
	echo '
	<div class="panel panel-primary">

		<div class="panel-body">
			<div class="list-group-item">
				<img id="banner" class="img-responsive" src="img/db/1/chengfeng.png">
			</div>
			<input type="text" class="layui-input" name="a" id="a">
			<pre>公牛插座</pre>
			<input type="text" class="layui-input" name="b" id="b">
			<pre>某某源码网制图</pre>
			<input type="button" id="start" class="layui-btn layui-btn-fluid" value="生成制作"><div class="jiange10"></div>
			<a class="layui-btn layui-btn-primary layui-btn-fluid" href="https://connect.qq.com/widget/shareqq/index.html?url=http://wpa.qq.com/msgrd?v=3&uin=2921617366&site=qq&menu=yes">
			<i class="layui-icon layui-icon-face-smile" style="font-size: 15px; color: #1E9FFF;"></i>  长按图片可进行保存哦</a>
			<script type="text/javascript">
			$(document).ready(function() {
				$("#start").click(function() {
					var aa = $("#a").val();
					var bb = $("#b").val();
					layer.msg("生成过程中可能需要一段时间,请耐心等待");
					$("#banner").attr("src","./api.php?a="+aa+"&b="+bb+"&t=d1");
				})
			});
			</script>
		</div>
		<div class="panel-footer">
			<a class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" οnclick="javascript:history.back(-1);">返回上级</a>
			<a class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" style="float: right;" href="/">回到首页</a>
		</div>
	</div>	
';
}elseif ($jason == 'db2') {
	echo '
	<div class="panel panel-primary">

		<div class="panel-body">
			<div class="list-group-item">
				<img id="banner" class="img-responsive" src="img/db/2/chengfeng.png">
			</div>
			<input type="text" class="layui-input" name="a" id="a">
			<pre>鲸鱼店铺图标</pre>
			<input type="text" class="layui-input" name="b" id="b">
			<pre>show logo design</pre>
			<input type="button" id="start" class="layui-btn layui-btn-fluid" value="生成制作"><div class="jiange10"></div>
			<a class="layui-btn layui-btn-primary layui-btn-fluid" href="https://connect.qq.com/widget/shareqq/index.html?url=http://wpa.qq.com/msgrd?v=3&uin=2921617366&site=qq&menu=yes">
			<i class="layui-icon layui-icon-face-smile" style="font-size: 15px; color: #1E9FFF;"></i>  长按图片可进行保存哦</a>
			<script type="text/javascript">
			$(document).ready(function() {
				$("#start").click(function() {
					var aa = $("#a").val();
					var bb = $("#b").val();
					layer.msg("生成过程中可能需要一段时间,请耐心等待");
					$("#banner").attr("src","./api.php?a="+aa+"&b="+bb+"&t=d2");
				})
			});
			</script>
		</div>
		<div class="panel-footer">
			<a class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" οnclick="javascript:history.back(-1);">返回上级</a>
			<a class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" style="float: right;" href="/">回到首页</a>
		</div>
	</div>	
';
}






/*********************************************************************************
/
/
/				以下为LOGO制作
/
/
/*********************************************************************************/


if ($jason == 'logo1') {
	echo '
	<div class="panel panel-primary">

		<div class="panel-body">
			<div class="list-group-item">
				<img id="banner" class="img-responsive" src="img/logo/1/chengfeng.png">
			</div>
			<input type="text" class="layui-input" name="a" id="a">
			<pre>271</pre>
			<input type="text" class="layui-input" name="b" id="b">
			<pre>工程</pre>
			<input type="text" class="layui-input" name="c" id="c">
			<pre>date</pre>
			<input type="button" id="start" class="layui-btn layui-btn-fluid" value="生成制作"><div class="jiange10"></div>
			<a class="layui-btn layui-btn-primary layui-btn-fluid" href="https://connect.qq.com/widget/shareqq/index.html?url=http://wpa.qq.com/msgrd?v=3&uin=2921617366&site=qq&menu=yes">
			<i class="layui-icon layui-icon-face-smile" style="font-size: 15px; color: #1E9FFF;"></i>  长按图片可进行保存哦</a>
			<script type="text/javascript">
			$(document).ready(function() {
				$("#start").click(function() {
					var aa = $("#a").val();
					var bb = $("#b").val();
					var cc = $("#c").val();
					layer.msg("生成过程中可能需要一段时间,请耐心等待");
					$("#banner").attr("src","./api.php?a="+aa+"&b="+bb+"&c="+cc+"&t=logo1");
				})
			});
			</script>
		</div>
		<div class="panel-footer">
			<a class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" οnclick="javascript:history.back(-1);">返回上级</a>
			<a class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" style="float: right;" href="/">回到首页</a>
		</div>
	</div>	
';
}elseif ($jason == 'logo2') {
	echo '
	<div class="panel panel-primary">

		<div class="panel-body">
			<div class="list-group-item">
				<img id="banner" class="img-responsive" src="img/logo/2/chengfeng.png">
			</div>
			<input type="text" class="layui-input" name="a" id="a">
			<pre>风速网</pre>
			<input type="text" class="layui-input" name="b" id="b">
			<pre>50MB.CN</pre>
			<input type="button" id="start" class="layui-btn layui-btn-fluid" value="生成制作"><div class="jiange10"></div>
			<a class="layui-btn layui-btn-primary layui-btn-fluid" href="https://connect.qq.com/widget/shareqq/index.html?url=http://wpa.qq.com/msgrd?v=3&uin=2921617366&site=qq&menu=yes">
			<i class="layui-icon layui-icon-face-smile" style="font-size: 15px; color: #1E9FFF;"></i>  长按图片可进行保存哦</a>
			<script type="text/javascript">
			$(document).ready(function() {
				$("#start").click(function() {
					var aa = $("#a").val();
					var bb = $("#b").val();
					layer.msg("生成过程中可能需要一段时间,请耐心等待");
					$("#banner").attr("src","./api.php?a="+aa+"&b="+bb+"&t=logo2");
				})
			});
			</script>
		</div>
		<div class="panel-footer">
			<a class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" οnclick="javascript:history.back(-1);">返回上级</a>
			<a class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" style="float: right;" href="/">回到首页</a>
		</div>
	</div>	
';
}elseif ($jason == 'logo3') {
	echo '
	<div class="panel panel-primary">

		<div class="panel-body">
			<div class="list-group-item">
				<img id="banner" class="img-responsive" src="img/logo/3/chengfeng.png">
			</div>
			<input type="text" class="layui-input" name="a" id="a">
			<pre>颜泡网</pre>
			<input type="text" class="layui-input" name="b" id="b">
			<pre>YANPAO.CN</pre>
			<input type="button" id="start" class="layui-btn layui-btn-fluid" value="生成制作"><div class="jiange10"></div>
			<a class="layui-btn layui-btn-primary layui-btn-fluid" href="https://connect.qq.com/widget/shareqq/index.html?url=http://wpa.qq.com/msgrd?v=3&uin=2921617366&site=qq&menu=yes">
			<i class="layui-icon layui-icon-face-smile" style="font-size: 15px; color: #1E9FFF;"></i>  长按图片可进行保存哦</a>
			<script type="text/javascript">
			$(document).ready(function() {
				$("#start").click(function() {
					var aa = $("#a").val();
					var bb = $("#b").val();
					layer.msg("生成过程中可能需要一段时间,请耐心等待");
					$("#banner").attr("src","./api.php?a="+aa+"&b="+bb+"&t=logo3");
				})
			});
			</script>
		</div>
		<div class="panel-footer">
			<a class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" οnclick="javascript:history.back(-1);">返回上级</a>
			<a class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" style="float: right;" href="/">回到首页</a>
		</div>
	</div>	
';
}elseif ($jason == 'logo4') {
	echo '
	<div class="panel panel-primary">

		<div class="panel-body">
			<div class="list-group-item">
				<img id="banner" class="img-responsive" src="img/logo/4/chengfeng.png">
			</div>
			<input type="text" class="layui-input" name="a" id="a">
			<pre>米壳社区</pre>
			<input type="text" class="layui-input" name="b" id="b">
			<pre>MIXUNS.COM</pre>
			<input type="button" id="start" class="layui-btn layui-btn-fluid" value="生成制作"><div class="jiange10"></div>
			<a class="layui-btn layui-btn-primary layui-btn-fluid" href="https://connect.qq.com/widget/shareqq/index.html?url=http://wpa.qq.com/msgrd?v=3&uin=2921617366&site=qq&menu=yes">
			<i class="layui-icon layui-icon-face-smile" style="font-size: 15px; color: #1E9FFF;"></i>  长按图片可进行保存哦</a>
			<script type="text/javascript">
			$(document).ready(function() {
				$("#start").click(function() {
					var aa = $("#a").val();
					var bb = $("#b").val();
					layer.msg("生成过程中可能需要一段时间,请耐心等待");
					$("#banner").attr("src","./api.php?a="+aa+"&b="+bb+"&t=logo4");
				})
			});
			</script>
		</div>
		<div class="panel-footer">
			<a class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" οnclick="javascript:history.back(-1);">返回上级</a>
			<a class="layui-btn layui-btn-xs layui-btn-radius layui-btn-normal" style="float: right;" href="/">回到首页</a>
		</div>
	</div>	
';
}





echo'</div></div></div></div></div></div></div>';
include('./foot.php');