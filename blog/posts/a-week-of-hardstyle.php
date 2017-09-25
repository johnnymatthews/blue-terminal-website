<?php
// Getting function files and autoloading composer modules.
require('/var/www/public/assets/functions/get-env-vars.php');
include('/var/www/public/assets/functions/get-browser-name.php');
require('/var/www/public/vendor/autoload.php');

// Grabbing Slugify and Parsedown to use later.
use Cocur\Slugify\Slugify;
$slugify = new Slugify();
$Parsedown = new Parsedown();

// Grab user's browser type.
$browser = get_browser_name($_SERVER['HTTP_USER_AGENT']);

// Grab and create post information.
echo __FILE__;
$post_name = "A Week of Hardstyle";
$slug = $slugify->slugify($post_name);
$markdown_post = file_get_contents('../markdown/' . $slug . ".md");
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Mohnjatthews - <?= $post_name; ?></title>
	<link href="https://fonts.googleapis.com/css?family=Roboto+Mono" rel="stylesheet">
	<link href="/assets/css/style.css" rel="stylesheet">
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
		<p><span class="console-user">user</span>@<span class="console-os"><?= $browser ?>:</span><span class="console-pwd">~/$</span> mohnjatthews --blog</p>
		<article class="single-tab">
			<?php
				echo $Parsedown->text($markdown_post);
			?>
		</article>
	</section>
	<section>
		<p><span class="console-user">user</span>@<span class="console-os"><?= $browser ?>:</span><span class="console-pwd">~/$</span> style <span class="title title-basic" onclick="changeColorScheme('basic')">basic</span> <span class="title title-man" onclick="changeColorScheme('man')">man</span> <span class="title title-mohn" onclick="changeColorScheme('mohn')">mohn</span></p>
	</section>
	<script src="/assets/scripts/email-address-reveal.js"></script>
	<?= round(filesize(__FILE__) / 1024, 2) . 'KB loaded in ' . 1 . ' second. <span class="blinker"> &#9608;</span>'; ?>
</body>
</html>