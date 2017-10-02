<?php 
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/assets/templates/head.php';
require __DIR__ . '/assets/templates/navbar.php';
include __DIR__ . '/assets/functions/get-browser-name.php';

// Grab user's browser type.
$browser = get_browser_name($_SERVER['HTTP_USER_AGENT']);
?>
 	<section>
 		<p><span class="console-user">user</span>@<span class="console-os"><?= $browser ?>:</span><span class="console-pwd">~/$</span> mohnjatthews --about</p>
 		<br>
 		<header>
 			<p class="single-tab">Hi there, I'm John Matthews. I write code and technical docs. Contact information is at the bottom, recent projects are in the middle, and the introductory paragraph is right here. Feel free to get in touch if you have a project idea, need a hand with your code, or just fancy a pint.</p> 
 		</header>
  	</section>
	<section name="projects" class="projects">
		<p><span class="console-user">user</span>@<span class="console-os"><?= $browser ?>:</span><span class="console-pwd">~/$</span> mohnjatthews --projects</p>
		<br>
		<div class="single-tab single-project">
			<p><a href="//www.striphealthcafe.com/">Strip Health Cafe</a></p>
			<p>Website, hosting, and graphic design for a healthy-food cafe based in Manchester UK.</p>
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
 	<script src="/assets/scripts/email-address-reveal.js"></script>
 	<?php require('/var/www/public/assets/templates/footer.php'); ?>