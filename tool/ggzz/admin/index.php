<?php
session_start();
include('../jason.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title><?php echo $网站名称; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="keywords" content="<?php echo $关键词汇; ?>">
  <meta name="description" content="<?php echo $名称后辍; ?>">
  <link rel="stylesheet" href="../layui/css/layui.css">
  <link rel="stylesheet" href="../layui/css/global.css">
  <script src="../layui/jquery.min.js"></script>
  <script src="../layui/layui.js"></script>
  <script src="../layui/lay/modules/layer.js"></script>
</head>
<body>

<div class="fly-header layui-bg-black">
  <div class="layui-container">
    <a class="fly-logo" href="/">
      <img src="<?php echo $logo; ?>" alt="logo" style="width: 120px;height: 40px;">
    </a>
  </div>
</div>

<div class="jiange10"></div>
<div class="layui-container">
	<div class="layui-row layui-col-space15">
		<div class="layui-col-md12">
			<div class="fly-panel">
			
			<div class="layui-card">
			  <div class="layui-card-header">后台重地</div>
			  <div class="layui-card-body">
<?php

if ($_GET['d'] == 'dl'){
	
	if ($_POST['email'] == '' && $_POST['password'] == ''){
		
		echo '<p>用户登录信息请不要为空</p>';
		
	}else{
		
		if ($_POST['email'] == $youxiang && $_POST['password'] == $mima){
			
			
			echo '
			<form class="layui-form" action="xg.php?pz=xg" method="post">
			<div class="layui-form-item">
				<label for="inputPassword3" class="layui-form-label">标题</label>
				<div class="layui-input-block">
				  <input type="text" name="bt" value="'.$网站名称.'" class="layui-input" id="inputPassword3" placeholder="标题">
				</div>
			  </div>
			
			<div class="layui-form-item">
				<label for="inputPassword3" class="layui-form-label">关键词</label>
				<div class="layui-input-block">
				  <input type="text" name="gjc" value="'.$关键词汇.'" class="layui-input" id="inputPassword3" placeholder="关键词">
				</div>
			  </div>
			
			
			<div class="layui-form-item">
				<label for="inputPassword3" class="layui-form-label">描述</label>
				<div class="layui-input-block">
				  <input type="text" name="ms" value="'.$名称后辍.'" class="layui-input" id="inputPassword3" placeholder="描述">
				</div>
			  </div>

			  <div class="layui-form-item">
				<label for="inputPassword3" class="layui-form-label">名称</label>
				<div class="layui-input-block">
				  <input type="text" name="mc" value="'.$name.'" class="layui-input" id="inputPassword3" placeholder="名称">
				</div>
			  </div>

			  <div class="layui-form-item">
				<label for="inputPassword3" class="layui-form-label">介绍</label>
				<div class="layui-input-block">
				  <input type="text" name="js" value="'.$jieshao.'" class="layui-input" id="inputPassword3" placeholder="介绍">
				</div>
			  </div>

			  <div class="layui-form-item">
				<label for="inputPassword3" class="layui-form-label">logo</label>
				<div class="layui-input-block">
				  <input type="text" name="logo" value="'.$logo.'" class="layui-input" id="inputPassword3" placeholder="logo">
				</div>
			  </div>

			  <div class="layui-form-item">
				<label for="inputPassword3" class="layui-form-label">公告</label>
				<div class="layui-input-block">
				  <input type="text" name="gg" value="'.$gg.'" class="layui-input" id="inputPassword3" placeholder="公告">
				</div>
			  </div>
			  
			<div class="layui-form-item">
				<label for="inputPassword3" class="layui-form-label">QQ号</label>
				<div class="layui-input-block">
				  <input type="text" name="qq" value="'.$qq.'" class="layui-input" id="inputPassword3" placeholder="QQ号">
				</div>
			  </div>

			  <div class="layui-form-item">
				<label for="inputPassword3" class="layui-form-label">版权</label>
				<div class="layui-input-block">
				  <input type="text" name="bq" value="'.$banquan.'" class="layui-input" id="inputPassword3" placeholder="版权">
				</div>
			  </div>
			
			
			  <div class="layui-form-item">
				<label class="layui-form-label">邮箱</label>
				<div class="layui-input-block">
				  <input type="email" name="email" value="'.$youxiang.'" class="layui-input" id="inputEmail3" placeholder="邮箱">
				</div>
			  </div>
			  
			  <div class="layui-form-item">
				<label for="inputPassword3" class="layui-form-label">密码</label>
				<div class="layui-input-block">
				  <input type="text" name="password" value="'.$mima.'" class="layui-input" id="inputPassword3" placeholder="密码">
				</div>
			  </div>

			  <div class="layui-form-item">
				<div class="col-sm-offset-2 layui-input-block">
				  <button type="submit" class="btn btn-default">提交</button>
				</div>
			  </div>
			</form>';
			
			$_SESSION['SID'] = "OK";
			
		}else{
			
			echo '<p>登录用户信息错误</p>';
			
		}
		
	}
	
}else{ ?>
<form class="layui-form" action="?d=dl" method="post">

   <div class="layui-form-item">
    <label class="layui-form-label">邮箱</label>
    <div class="layui-input-block">
      <input type="email" name="email" required  lay-verify="required" placeholder="邮箱" autocomplete="off" class="layui-input">
    </div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">密码</label>
    <div class="layui-input-block">
      <input type="password" name="password" required  lay-verify="required" placeholder="密码" autocomplete="off" class="layui-input">
    </div>
  </div>
  
   <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
    </div>
  </div>

</form>
<?php 

} 
?>
</div>
</div>

</div>
</div>
</div>
</div>

<div class="fly-footer">
  <p>版权所有© <?php echo $banquan; ?></p>
</div>

<script>
	//注意：选项卡 依赖 element 模块，否则无法进行功能性操作
	layui.use('element', function(){
		 var element = layui.element;
	});
</script>


</body>
</html>
