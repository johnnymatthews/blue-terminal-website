<?php
	require('../../vendor/autoload.php');
	// Get browser name.
	function get_browser_name($user_agent) {
		if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'opera';
		elseif (strpos($user_agent, 'Edge')) return 'edge';
		elseif (strpos($user_agent, 'Chrome')) return 'chrome';
		elseif (strpos($user_agent, 'Safari')) return 'safari';
		elseif (strpos($user_agent, 'Firefox')) return 'firefox';
		elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'ie';
		return 'browser';
	}
	$browser = get_browser_name($_SERVER['HTTP_USER_AGENT']);
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Mohnjatthews by John Matthews</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto+Mono" rel="stylesheet">
	<link href="/style.css" rel="stylesheet">
	<link rel="icon" href="/favicon.png">
	<style id="color-scheme-css"></style>
</head>
<body>
	<nav>
		<p>=================</p>
		<p>|| <a href="/">home</a> | <a href="/blog">blog</a> ||</p>
		<p>=================</p>
		<br>
	</nav>
	<section>
		<p><span class="console-user">user</span>@<span class="console-os"><?= $browser ?>:</span><span class="console-pwd">~/$</span> Example Post</p>
		<article class="single-tab">
			<?php
				$Parsedown = new Parsedown();
				$markdown_file = file_get_contents("example-post.md");
				echo $Parsedown->text($markdown_file);
			?>
		</article>
	</section>
	<section>
		<p><span class="console-user">user</span>@<span class="console-os"><?= $browser ?>:</span><span class="console-pwd">~/$</span> style <span class="title title-basic" onclick="changeColorScheme('basic')">basic</span> <span class="title title-man" onclick="changeColorScheme('man')">man</span> <span class="title title-mohn" onclick="changeColorScheme('mohn')">mohn</span></p>
	</section>
</body>
</html>
<?= round(filesize("index.php") / 1024, 2) . 'KB loaded in ' . 1 . ' second. <span class="blinker"> &#9608;</span>'; ?>