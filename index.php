<?php 
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
 		<p><span class="console-user">user</span>@<span class="console-os"><?= $browser ?>:</span><span class="console-pwd">~/$</span> mohnjatthews --about</p>
 		<br>
 		<header>
 			<p class="single-tab">Hi, I'm John Matthews, and I write code. Contact information is at the bottom, recent projects are in the middle, and the introductory paragraph is right here. Feel free to get in touch if you have a project idea, need a hand with your code, or just fancy a pint.</p> 
 		</header>
  	</section>
	<section name="projects" class="projects">
		<p><span class="console-user">user</span>@<span class="console-os"><?= $browser ?>:</span><span class="console-pwd">~/$</span> mohnjatthews --projects</p>
		<br>
		<div class="single-tab single-project">
			<p><a href="//www.striphealthcafe.com/">Strip Health Cafe</a></p>
			<p>Website, hosting, and graphic design for a healthy food-cafe based in Manchester UK.</p>
		</div>
		<div class="single-tab single-project">
			<p><a href="//www.theninjareport.co.uk">The Ninja Report</a></p>
			<p>Website and hosting for a metal band in the UK.</p>
		</div>
		<div class="single-tab single-project">
			<p><a href="//github.com/mohnjatthews/friendsum">Friendsum</a></p>
			<p>Custom lorem ipsum generator created during a hackday.</p>
		</div>
		<div class="single-tab single-project">
			<p><a href="//www.dmbespokehealth.co.uk/index.php">DM Bespoke Health</a></p>
			<p>Website for a personal fitness instructor contact website.</p>
		</div>
		<div class="single-tab single-project">
			<p><a href="//github.com/mohnjatthews/lotr-timer-depricated">LOTR Timer</a></p>
			<p>The Lord of the Rings related hackday project.</p>
		</div>
		<div class="single-tab single-project">
			<p><a href="//www.tithebarn.net">Tithe Barn</a></p>
			<p>Website, hosting, and company branding for a bed and breakfast in Cumbria, UK.</p>
		</div>
 	</section>
 	<section>
 		<p><span class="console-user">user</span>@<span class="console-os"><?= $browser ?>:</span><span class="console-pwd">~/$</span> mohnjatthews --contact</p>
 		<br>
 		<p id="email-address-reveal" class="single-tab"><a onclick="toggleEmail()"><u>Click for Email</u></a></p>
 		<p class="single-tab"><a href="//www.github.com/mohnjatthews">GitHub</a></p>
 		<p class="single-tab"><a href="//www.linkedin.com/in/mohnjatthews">LinkedIn</a></p>
 	</section>
 	<footer>
		<p><span class="console-user">user</span>@<span class="console-os"><?= $browser ?>:</span><span class="console-pwd">~/$</span> style <span class="title title-basic" onclick="changeColorScheme('basic')">basic</span> <span class="title title-man" onclick="changeColorScheme('man')">man</span> <span class="title title-mohn" onclick="changeColorScheme('mohn')">mohn</span></p>
 	</footer>
	<script src="/assets/scripts/email-address-reveal.js"></script>
	<?= round(filesize(__FILE__) / 1024, 2) . 'KB loaded in ' . 1 . ' second. <span class="blinker"> &#9608;</span>'; ?>
</body>
</html>