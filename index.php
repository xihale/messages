<?php
require_once "function.php";

if(!empty($_GET)) {
	$res = get(substr($_SERVER['REQUEST_URI'], 2));
	if ($res == false) exit("短链无效");
	if ($res['type'] == 0&&strpos($res['type'],'\n')==-1) header("Location: " . $res['message']);
	else {
		header("Content-Type: text/plain");
		echo $res['message'];
	}
	exit(0);
}
?>
<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>TSMS-Take some messages</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="/src/i.css" rel="stylesheet">
</head>
<body>
<form role="form" action="/new.php" method="post">
	<div class="form-group">
		<input name="surl" id="surl" type="text" class="form-control" placeholder="短链接" autocomplete="off" style="background: #323232;border: none;color: #4191f5;"><br>
		<textarea name="message" id="val" class="form-control val" rows="3" placeholder="链接或文本内容" spellcheck="false" style="background: #323232;border: none;padding-top: 0.5%;color: #4191f5"></textarea><br>
		<input name="due" id="due" class="form-control" placeholder="持续时间: 1~365" onkeyup="value=value.replace(/[^1-6]/g,'');if(value>365)value=365;" autocomplete="off" style="background: #323232;border: none;color: #4191f5;"><br>
		<input name="type" id="type" type="text" value="链接" style="display: none">
		<div style="position: absolute;left: 30%;width: 40%;">
			<div class="btn-group" style="width: 45%;">
				<button type="button" class="btn btn-default dropdown-toggle"
				        data-toggle="dropdown" style="width: 100%;display: inline-block;background: #323232;color: #387bd0;border: none;">
					<span id="text" style="background: #323232;margin-right: 3px;">链接</span><span class="caret" style="background: #323232"></span>
				</button>
				<ul id="menu" class="dropdown-menu" role="menu" style="background: #323232;border: none;">
					<li><a>链接</a></li>
					<li><a>文本</a></li>
				</ul>
			</div>
			<input type="submit" class="form-control" style="width: 50%;display: inline-block;background: #323232;color: #387bd0;border: none;" value="创建">
		</div>
	</div>
</form>
</body>
<script src="/src/i.js"></script>
</html>