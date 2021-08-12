<?php
require_once "function.php";

if(!empty($_GET)) {
	$res = get(substr($_SERVER['REQUEST_URI'], 2));
	if ($res == false) exit("短链无效");
	if ($res['type'] == 0&&strpos($res['type'],'\n')==false) header("Location: " . (preg_match("/\bhttp[s*]:/",$res['message'])==false?"http://".$res['message']:$res['message']));
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
	<link rel="icon" href="/messages.png" type="image/x-icon" />
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="/src/i.css" rel="stylesheet">
</head>
<body>
<div class="form-group">
	<div><input name="surl" id="surl" type="text" class="form-control" placeholder="短链接" autocomplete="off" style="background: #323232;border: none;color: #4191f5;"><input name="due" id="due" class="form-control" placeholder="持续时间: 1~365" onkeyup="value=value.replace(/\b(0+)|[^0-6]/g,'');if(value>365)value=365;" autocomplete="off" style="background: #323232;border: none;color: #4191f5;"></div><br>
	<textarea name="message" id="val" class="form-control val" rows="3" placeholder="链接或文本内容" spellcheck="false" style="background: #323232;border: none;padding-top: 0.5%;color: #4191f5"></textarea><br>
	<input name="type" id="type" type="text" value="链接" style="display: none">
	<div style="position: absolute;left: 31.7%;width: 40%;">
		<div class="btn-group" style="width: 45%;">
			<button type="button" class="btn btn-default dropdown-toggle"
			        data-toggle="dropdown" style="width: 100%;display: inline-block;background: #323232;color: #387bd0;border: none;">
				<span id="text" style="background: #323232;margin-right: 0.5%;">链接</span><span class="caret" style="background: #323232"></span>
			</button>
			<ul id="menu" class="dropdown-menu" role="menu" style="background: #323232;border: none;">
				<li><a>链接</a></li>
				<li><a>文本</a></li>
			</ul>
		</div>
		<button class="btn btn-default dropdown-toggle" style="vertical-align: top;width: 50%;display: inline-block;background: #323232;color: #387bd0;border: none;" onclick="push();">创建</button>
	</div>
</div>
</body>
<script src="/src/i.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://xihale.gitee.io/test/spop/spop.min.js"></script>
<link href="https://xihale.gitee.io/test/spop/spop.min.css" rel="stylesheet"/>
<script>
    function push(){
        $.ajaxSettings.async=false;
        $.post("/new.php",{"surl":$("#surl").val(),"message":$("#val").val(),"due":$("#due").val(),"type":$("#type").val()},function(data){
            var success=data.substr(0,2)=='<a'?"success":"warning";
            spop({
                template:data,
                style:success,
                autoclose:8000
            });
        });
        $.ajaxSettings.async=true;
    }
</script>
</html>