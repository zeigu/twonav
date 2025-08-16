<?php
session_start();
include('../jason.php');
?>
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
			  <div class="layui-card-header">广告横幅</div>
			  <div class="layui-card-body">
<?php
include('file.php');
if($_SESSION['SID'] == 'OK'){
if($_GET['pz'] == 'xg'){

			if ($_POST['gg'] !='' && $_POST['logo'] !='' && $_POST['bt'] !='' && $_POST['gjc'] !=''&& $_POST['ms'] !=''&& $_POST['mc'] !=''&& $_POST['js'] !=''&& $_POST['qq'] !=''&& $_POST['bq'] !=''&& $_POST['email'] !=''&& $_POST['password'] !=''){

					$file = new file();

						$newConfig = "<?php
						\$网站名称 = '".$_POST['bt']."';
						\$关键词汇 = '".$_POST['gjc']."';
						\$名称后辍 = '".$_POST['ms']."';
						\$name = '".$_POST['mc']."';
						\$jieshao = '".$_POST['js']."';
						\$qq = '".$_POST['qq']."';
						\$gg = '".$_POST['gg']."';
						\$logo = '".$_POST['logo']."';
						\$banquan = '".$_POST['bq']."';
						\$youxiang = '".$_POST['email']."';//后台登录邮箱
						\$mima = '".$_POST['password']."';//后台登录密码

						?>";
							
							$set = $file->put('../jason.php',$newConfig);
							
							if ($set){
								
								echo '<p>修改信息成功</p>';
								
							}else{
								
								echo '<p>修改信息错误</p>';
							}


			}else{
				
				echo '<p>各项内容请不要为空</p>';
			}

}
}else{
	echo '登录信息识别错误';
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
