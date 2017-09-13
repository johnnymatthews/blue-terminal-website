<?php 
	// Grab the browser that the user is viewing the site on.
	function get_browser_name($user_agent)
	{
	    if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
	    elseif (strpos($user_agent, 'Edge')) return 'Edge';
	    elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
	    elseif (strpos($user_agent, 'Safari')) return 'Safari';
	    elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
	    elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';
	    return 'browser';
	}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
  	<meta charset="UTF-8">
  	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Mohnjatthews by John Matthews</title>
  	<link href="https://fonts.googleapis.com/css?family=Roboto+Mono" rel="stylesheet">
  	<link rel="icon" href="favicon.png">
  	<style> /* Downloading one file is better than two. */
  		body{font-family:"Roboto Mono",monospace;color:#36ed39;background-color:#1c1c1c;padding:30px}a{color:#b4ba1b}p{margin:0}a,h2,h3,h4,h5,p{font-size:16px}header,section{padding-bottom:15px}.single-project{padding-bottom:10px}.single-tab{padding-left:40px}.double-tab{padding-left:80px}.console-user{color:#2c82b7}.console-os{color:#209b23}.console-pwd{color:#d1bc1d}.action-output{color:#ed5c77}
  	</style>
</head>
<body>
 	<header>
 		<p>Last login: <?= date('D d M Y h:i:s'); ?></p>
 		<br>
 		<p><span class="console-user">user</span>@<span class="console-os"><?= strtolower(get_browser_name($_SERVER['HTTP_USER_AGENT'])); ?>:</span><span class="console-pwd">~/$</span> mohnjatthews <span class="section-colour">--about</span></p>
 		<br>
 		<p class="single-tab">Hi, I'm John Matthews, and I write code. Contact information is at the bottom, recent projects are in the middle, and the introductory paragraph is right here. Feel free to get in touch if you have a project idea, need a hand with your code, or just fancy a pint.</p>
  	</header>
	<section name="projects" class="projects">
		<p><span class="console-user">user</span>@<span class="console-os"><?= strtolower(get_browser_name($_SERVER['HTTP_USER_AGENT'])); ?>:</span><span class="console-pwd">~/$</span> mohnjatthews <span class="section-colour">--projects</span></p>
		<div class="single-tab single-project">
			<p>- <a href="#">Strip Health Cafe</a></p>
			<p>- Website, hosting, and graphic design for a healthy food-cafe based in Manchester UK.</p>
		</div>
		<div class="single-tab single-project">
			<p>- <a href="#">The Ninja Report</a></p>
			<p>- Website and hosting for a metal band in the UK.</p>
		</div>
		<div class="single-tab single-project">
			<p>- <a href="#">Friendsum</a></p>
			<p>- Custom lorem ipsum generator created during a hackday.</p>
		</div>
		<div class="single-tab single-project">
			<p>- <a href="#">DM Bespoke Health</a></p>
			<p>- Website for a personal fitness instructor contact website.</p>
		</div>
		<div class="single-tab single-project">
			<p>- <a href="#">LOTR Timer</a></p>
			<p>- The Lord of the Rings related hackday project.</p>
		</div>
		<div class="single-tab single-project">
			<p>- <a href="#">Tithe Barn</a></p>
			<p>- Website, hosting, and company branding for a bed and breakfast in Cumbria, UK.</p>
		</div>
 	</section>
 	<section>
 		<p><span class="console-user">user</span>@<span class="console-os"><?= strtolower(get_browser_name($_SERVER['HTTP_USER_AGENT'])); ?>:</span><span class="console-pwd">~/$</span> mohnjatthews <span class="section-colour">--contact</span></p>
 		<p id="email-address-reveal" class="single-tab"><a onclick="toggleEmail()">I don't like spam, so click/press this line to show my email address:</p>
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
    </script>
</body>
</html>
