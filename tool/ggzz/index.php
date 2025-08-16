<?php include('./head.php'); ?>
<div class="jiange10"></div>
<div class="layui-container">
	<div class="layui-row layui-col-space15">
		<div class="layui-col-md8">
			<div class="fly-panel">
			
			<div class="layui-card">
			  <div class="layui-card-header"><?php echo $网站名称; ?></div>
			  <div class="layui-card-body">

				<div class="layui-tab">
				  <ul class="layui-tab-title">
					<li class="layui-this">横幅</li>
					<li>店标</li>
					<li>LOGO</li>
				  </ul>
				  <div class="layui-tab-content">

					<div class="layui-tab-item layui-show">

						<div class="panel-body">
							<?php 
							
								for ($x=1; $x<=10; $x++) {
							?>
								<div class="bj">
									<img src="./img/<?php echo $x; ?>/wc.png" width="100%" /></p>
									&nbsp;<span class="layui-badge layui-bg-gray">广告横幅</span>&nbsp;<a style="float: right;text-decoration:none;" href="common.php?jason=jp<?php echo $x; ?>"><span class="layui-badge layui-bg-blue">在线制作</span></a></p>
								</div><hr class="layui-bg-gray">
							<?php 
							
								}
								
							?>
						</div>


					</div>
					<div class="layui-tab-item">
					
					  <div class="layui-row">

							<?php 
								
								for ($x=1; $x<=2; $x++) {
							?>
													  
							<div class="layui-col-xs6 layui-col-sm6 layui-col-md4">
							
								<div class="panel-body">
								
										<div class="bj">
											<img src="./img/db/<?php echo $x; ?>/wc.png" width="100%" /></p>
											&nbsp;<span class="layui-badge layui-bg-gray">店标</span>&nbsp;<a style="float: right;text-decoration:none;" href="common.php?jason=db<?php echo $x; ?>"><span class="layui-badge layui-bg-blue">在线制作</span></a></p>
										</div><hr class="layui-bg-gray">
									</div>
							  
							</div>
								
							<?php 
								
								}
									
							?>
						
					  </div>
					
					
					</div>
					<div class="layui-tab-item">
					
					
						
						<div class="layui-row">
							<?php 
									
								for ($x=1; $x<=4; $x++) {
							?>
														  
							<div class="layui-col-xs6 layui-col-sm6 layui-col-md4">
							
								<div class="panel-body">
								
										<div class="bj">
											<img src="./img/logo/<?php echo $x; ?>/wc.png" width="100%" /></p>
											&nbsp;<span class="layui-badge layui-bg-gray">LOGO</span>&nbsp;<a style="float: right;text-decoration:none;" href="common.php?jason=logo<?php echo $x; ?>"><span class="layui-badge layui-bg-blue">在线制作</span></a></p>
										</div><hr class="layui-bg-gray">
									</div>
							  
							</div>
									
							<?php 
									
								}
										
							?>
						
				
						</div>
					
					
					
					</div>
					<div class="layui-tab-item">目前还没有制作项目</div>
				  </div>
				</div>
				
				
				</div>
			</div>
				
			</div>
		</div>
		
		
		<div class="layui-col-md4">
		
			<div class="fly-panel">
				<div class="layui-card">
				  <div class="layui-card-header">相关说明</div>
				  <div class="layui-card-body">
											<div class="layui-collapse">
						  <div class="layui-colla-item">
							<h2 class="layui-colla-title">使用说明</h2>
							<div class="layui-colla-content layui-show">
							1.选择自己喜欢的样式<hr>
							2.点击右边的在线制作按钮<hr>
							3.请根据提示文字长度按照输入<hr>
							4.点击底部的生成制作按钮<hr>
							5.回到顶部长按图片进行保存
							</div>
						  </div>
						  <div class="layui-colla-item">
							<h2 class="layui-colla-title">版权声明</h2>
							<div class="layui-colla-content layui-show">
							1.本站所有制作素材来自网络收集，如有侵权请联系站长立即删除。<hr>
							2.本站所生成的图片仅供个人参考与使用，请勿用于其他非法用途或者商业用途否则后果自负与本站相关人员无关。
							</div>
						  </div>
						  <div class="layui-colla-item">
							<h2 class="layui-colla-title">素材投稿</h2>
							<div class="layui-colla-content layui-show">
							1.如果你有好的素材想要和大家分享欢迎投稿<hr>
							2.如果是本人原创素材投稿，本站有权授予在本站所生成制图的图片可以商业用途。（如果你觉得不行的话可以放弃投稿，本人在这里还是说声“谢谢你的支持”。）<hr>						
							3.投稿格式为一张背景图片不要有文字等素材（格式最好png，gif暂不支持），还要一张成品图片以作参考。<hr>
							4.本站素材投稿为公益性没有利益可言，毕竟本站也是一个公益性的网站。<hr>
							5.投稿邮箱：3092059473@qq.com（附加素材）
							</div>
						  </div>
						</div>
				  </div>
				</div>
						
			</div>

			<div class="fly-panel">
				<div class="layui-card">
				  <div class="layui-card-header">服务中心</div>
				  <div class="layui-card-body">
					<p><span class="layui-badge">站长</span> <?php echo $name;?></p>
					<hr class="layui-bg-gray">
					<p><span class="layui-badge">介绍</span> <?php echo $jieshao;?></p>
					<hr class="layui-bg-gray">
					<p><span class="layui-badge">QQ号</span> <?php echo $qq;?></p>
				  </div>
				</div>
						
			</div>
		</div>
	</div>
</div>
<?php
	include 'foot.php'; 
?>
