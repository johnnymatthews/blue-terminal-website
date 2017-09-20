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
  	<link rel="icon" href="favicon.png">
</head>
<style>
	body{color:#36ed39;background-color:#1c1c1c;padding:30px;font-family:"Roboto Mono",monospace}a{color:#b4ba1b}p{margin:0}a,h2,h3,h4,h5,p{font-size:16px}header,section{padding-bottom:15px}.single-project{padding-bottom:10px}.single-tab{padding-left:40px}.double-tab{padding-left:80px}@media screen and (max-width:700px){.single-tab{padding-left:20px}.double-tab{padding-left:40px}}.blinker{animation:blinker 1s linear infinite}@keyframes blinker{50%{opacity:0}}.title{cursor:pointer}.title-basic{color:#000;background-color:#fff}.title-man{background-color:#ff0;color:#6195e8}.title-mohn{color:#36ed39;background-color:#1c1c1c;}
</style>
<style id="color-scheme-css">
	.console-user{color:#2c82b7}.console-os{color:#209b23}.console-pwd{color:#d1bc1d}
</style>
<body>
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
			<p><a href="#">Strip Health Cafe</a></p>
			<p>Website, hosting, and graphic design for a healthy food-cafe based in Manchester UK.</p>
		</div>
		<div class="single-tab single-project">
			<p><a href="#">The Ninja Report</a></p>
			<p>Website and hosting for a metal band in the UK.</p>
		</div>
		<div class="single-tab single-project">
			<p><a href="#">Friendsum</a></p>
			<p>Custom lorem ipsum generator created during a hackday.</p>
		</div>
		<div class="single-tab single-project">
			<p><a href="#">DM Bespoke Health</a></p>
			<p>Website for a personal fitness instructor contact website.</p>
		</div>
		<div class="single-tab single-project">
			<p><a href="#">LOTR Timer</a></p>
			<p>The Lord of the Rings related hackday project.</p>
		</div>
		<div class="single-tab single-project">
			<p><a href="#">Tithe Barn</a></p>
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
 	<section>
		<p><span class="console-user">user</span>@<span class="console-os"><?= $browser ?>:</span><span class="console-pwd">~/$</span> style <span class="title title-basic" onclick="changeColorScheme('basic')">basic</span> <span class="title title-man" onclick="changeColorScheme('man')">man</span> <span class="title title-mohn" onclick="changeColorScheme('mohn')">mohn</span></p>
 	</section>
	<script>
        function toggleEmail() {
            var email_address = "john" + "@" + "mohnj" + "atthe" + "ws.c" + "om";
            if(document.getElementById("email-address-reveal").innerHTML != '<a href="mailto:' + email_address + '">' + email_address + '</a>') {
            	document.getElementById("email-address-reveal").innerHTML = '<a href="mailto:' + email_address + '">' + email_address + '</a>';
            } else {
                document.getElementById("email-address-reveal").innerHTML = '&nbsp;'
            }
        }
        function changeColorScheme(color_scheme) {
        	var code_snippet
        	switch(color_scheme) {
        	    case 'basic':
        	    	console.log('here!');
        	        code_snippet = '.console-user,body{color:#000}body{background-color:#fff}.console-os{color:grey}.console-pwd{color:#000}';
        	        break;
        	    case 'man':
        	        code_snippet = 'body{color:#6195e8;background-color:#ff0}.console-user{color:red}.console-os{color:#00f}.console-pwd{color:#fff}';
        	        break;
        	    default:
        	        code_snippet = 'body{color:#36ed39;background-color:#1c1c1c}.console-user{color:#2c82b7}.console-os{color:#209b23}.console-pwd{color:#d1bc1d}';
        	}
        	console.log('there!');
        	document.getElementById('color-scheme-css').innerHTML = code_snippet;
        }
    </script>
</body>
</html>
<?= round(filesize("index.php") / 1024, 2) . 'KB loaded in ' . 1 . ' second. <span class="blinker"> &#9608;</span>'; ?>
