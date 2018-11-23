<?php
$INDEX = require_once __DIR__.'/config.php';
$INDEX = require_once __DIR__.'/templates/index.php';
?>
<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta name="renderer" content="webkit">
		<meta name="theme-color" content="#3F51B5" />
		<title>PHP-BIAOQINGBAO-GIF</title>
		<link href="https://cdn.bootcss.com/mdui/0.4.0/css/mdui.min.css" rel="stylesheet">
	</head>
	<body class="mdui-drawer-body-left mdui-appbar-with-toolbar mdui-theme-primary-indigo mdui-theme-accent-pink">
		<header class="mdui-appbar mdui-appbar-fixed">
			<div class="mdui-toolbar mdui-color-theme">
				<span class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" mdui-drawer="{target: '#main-drawer', swipe: true}"><i class="mdui-icon material-icons">menu</i></span>
				<a href="./" target="_blank" class="mdui-typo-headline mdui-hidden-xs">PHP-BIAOQINGBAO-GIF</a>
			</div>
		</header>

		<button class="mdui-fab mdui-fab-fixed" id="like"><i class="mdui-icon material-icons">thumb_up</i></button>	
		
		<div class="mdui-drawer" id="main-drawer">
			<div class="mdui-list" mdui-collapse="{accordion: true}" style="margin-bottom: 76px;">
				<li class="mdui-list-item mdui-ripple">
					<i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-light-blue">home</i>
					<div class="mdui-list-item-content">
						<a href="./" class="mdui-ripple">首页</a>
					</div>
			<div class="mdui-list" mdui-collapse="{accordion: true}" style="margin-bottom: 76px;">
				<li class="mdui-list-item mdui-ripple">
					<i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-light-blue">link</i>
					<div class="mdui-list-item-content">
						<a href="https://github.com/TheZihanGu/php-biaoqingbao-gif" class="mdui-ripple">项目GitHub</a>
					</div>
			<div class="mdui-list" mdui-collapse="{accordion: true}" style="margin-bottom: 76px;">
				<li class="mdui-list-item mdui-ripple">
					<i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-light-blue">attach_money</i>
					<div class="mdui-list-item-content">
						<a href="http://zihangu.com/donation/" class="mdui-ripple">赞赏作者</a>
					</div>
					</div>			
				</li>
			</div>

		<div class="mdui-tab mdui-color-indigo" mdui-tab>
			<a href="#home" class="mdui-ripple get_value_class" onclick="window.location.hash='home'">
				<label>首页</label>
			</a>
			<?php foreach ($INDEX as $value) : ?>
				<a href="#<?php echo $value['template_name']; ?>" class="mdui-ripple get_value_class" onclick="window.location.hash='<?php echo $value['template_name']; ?>'">
					<label><?php echo $value['name']; ?></label>
				</a>
			<?php endforeach; ?>

		</div>

		<div id="home" class="mdui-p-a-2">
			<div class="mdui-panel" mdui-panel>
				<div class="mdui-panel-item mdui-panel-item-open">
					<div class="mdui-panel-item-body">
						<p></p>
						<div class="mdui-typo">
							<h3>PHP-BIAOQINGBAO-GIF <small><a href="https://github.com/TheZihanGu/php-biaoqingbao-gif" target="_blank">  项目Github</a></small></h3>
							<h4>更多动图尽情期待！</h4>
							<h4>赞赏与广告：</h4>
							<div style="text-align: center;">
                              <img width="200" height="200" src="https://php-biaoqingbao-gif.oss-cn-hangzhou.aliyuncs.com/zanshang.jpg" />
							  <div style="text-align: center;">
                              <a href="https://promotion.aliyun.com/ntms/act/qwbk.html?userCode=4wz5xqgf"><img src="https://php-biaoqingbao-gif.oss-cn-hangzhou.aliyuncs.com/250x200.png" />
						    </div>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php foreach ($INDEX as $value) : ?>
			<div id="<?php echo $value['template_name']; ?>" class="mdui-p-a-2">
				<div class="mdui-panel" mdui-panel>

					<div class="mdui-row">
						<div class="mdui-col-md-4">
							<?php if ($value['preview_image'] == 'false') : ?>
								<div class="mdui-card">
								  <div class="mdui-card-content"><h3>???</h4>预览图走丢了，帮帮我们！</div>
								</div>
							<?php else : ?>
								<div class="mdui-card">
									<div class="mdui-card-media">
										<img src="<?php echo $value['preview_image']; ?>"/>
									</div>
								</div>
							<?php endif; ?>
						</div>

						<div class="mdui-col-md-8">
							<?php for($i=0; $i<$value['input_num']; $i++) : ?>
								<div class="mdui-textfield">
									<label class="mdui-textfield-label">第 <?php echo $i+1; ?> 句</label>
									<input class="mdui-textfield-input" type="text" name="<?php echo $value['template_name']; ?>_value" placeholder="<?php echo $value['input_placeholder'][$i]; ?>"/>
								</div>
							<?php endfor; ?>

							<?php if(DEFAULT_CREATE_SMALL_GIF === false) : ?>
								<?php if($value['small']  == true): ?>
									<label class="mdui-checkbox">
										<input id="<?php echo $value['template_name']; ?>-small-size" type="checkbox" value="true" checked/>
										<i class="mdui-checkbox-icon"></i>
										是否生成 [微信兼容小尺寸] GIF 图片
									</label>
								<?php else : ?>
									<label class="mdui-checkbox mdui-hidden">
										<input id="<?php echo $value['template_name']; ?>-small-size" type="checkbox" value="false"/>
										<i class="mdui-checkbox-icon"></i>
										是否生成 [微信兼容小尺寸] GIF 图片
									</label>
								<?php endif; ?>
							<?php endif; ?>
						</div>
					</div>

					<div class="mdui-col">
						<hr class="mdui-invisible"/><button class="mdui-btn mdui-btn-block mdui-color-theme-accent mdui-ripple" onclick="creat_gif()">生成</button>
					</div>
				</div>
			</div>
		<?php endforeach; ?>

	</body>
	<script src="https://cdn.bootcss.com/mdui/0.4.0/js/mdui.min.js"></script>
  <script src="./script.js?version=10050"></script>
  <script src="./like.js"></script>
</html>