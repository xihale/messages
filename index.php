<?php
require_once "function.php";

if(!empty($_GET)) {
	$res = get(substr($_SERVER['REQUEST_URI'], 2));
	if ($res == false) exit("短链无效");
	if ($res['type'] == 0) header("Location: " . $res['message']);
	else {
		header("Content-Type: text/plain");
		echo $res['messages'];
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
		<input name="surl" id="surl" type="text" class="form-control" placeholder="短链接" autocomplete="off"><br>
		<textarea name="message" id="val" class="form-control val" rows="3" placeholder="链接或文本内容"></textarea><br>
		<input name="due" id="due" class="form-control" placeholder="持续时间: 1~365" onkeyup="value=value.replace(/[^1-6]/g,'');if(value>365)value=365;" autocomplete="off"><br>
		<div style="position: absolute;left: 30%;width: 40%">
			<select name="type" class="form-control" style="width: 45%;display: inline-block;">
				<option>链接</option>
				<option>文本</option>
			</select>
			<input type="submit" class="form-control" style="width: 50%;display: inline-block;" value="创建">
		</div>
	</div>
</form>
</body>
<script src="/src/i.js"></script>
</html>