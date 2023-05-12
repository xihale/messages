<?php
require_once "function.php";

if(!empty($_GET)) {
	$res = get(substr($_SERVER['REQUEST_URI'], 1));
<<<<<<< HEAD
	if ($res == false) exit("短链无效".substr($_SERVER['REQUEST_URI'], 1));
=======
	if ($res == false) exit("短链无效");
>>>>>>> 21dc57ffbfe781d6d6bf3ca57cc9d35550448bbc
	if ($res['type'] == 0&&!strpos($res['message'],"\n")&&!strpos($res['message'],"\r\n")) header("Location: " . (preg_match("/\bhttps*://",$res['message'])===0?("http://".$res['message']):$res['message']));
	else if($res['type']==1){
		header("Content-Type: text/plain");
		echo $res['message'];
	}else if($res['type']==3){
	    header("Location:https://aword.code.xihale.top/#".str_replace("\n","\\n",$res['message']));
	}else{ // type==2 code
		?>
		<link rel="stylesheet" href="https://cdn.bootcdn.net/ajax/libs/highlight.js/11.6.0/styles/atom-one-dark.min.css"/>
		<script src="https://cdn.bootcdn.net/ajax/libs/highlight.js/11.6.0/highlight.min.js"></script>
		<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
		<style>
		    @font-face{
		        font-family: "FiraCode";
		        src: url('/src/FiraCode-Medium.ttf');
	        }
	        pre {tab-size:4;}
	        body{margin: 0;height: 100%;}
	        :where(code,html)::-webkit-scrollbar-thumb {
                box-shadow: inset 0 0 5px rgb(0 0 0 / 20%);
                background: #444;
                border-radius: 0;
            }
            :where(code,html)::-webkit-scrollbar{
                width: 13px;
                height: 13.4px;
            }
            :where(code,html)::-webkit-scrollbar-track {
                box-shadow: inset 0 0 5px rgb(0 0 0 / 20%);
                background: #333;
                border-radius: 0;
            }
		</style>
		<body>
		<pre><code style="font-size: 21px;font-family: 'FiraCode';"><?php echo preg_replace("/>/i","&gt;",preg_replace("/</i","&lt;",$res['message'])) ?></code></pre>
		<script defer>
            hljs.initHighlightingOnLoad();
		</script>
		</body>
		<?php
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
	<div><input name="surl" id="surl" type="text" class="form-control" placeholder="短链接" autocomplete="off" style="background: #323232;border: none;color: #4191f5;"><input name="due" id="due" class="form-control" placeholder="持续时间: 1~365" onkeyup="value=value.replace(/\b(0+)|[^0-9]/g,'');if(value>365)value=365;" autocomplete="off" style="background: #323232;border: none;color: #4191f5;"></div><br>
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
				<li><a>代码</a></li>
				<li><a>一言</a></li>
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
