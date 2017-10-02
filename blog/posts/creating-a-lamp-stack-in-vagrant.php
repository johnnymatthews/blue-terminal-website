<?php
	// Getting function files and autoloading composer modules.
	require('/var/www/public/assets/functions/get-env-vars.php');
	include('/var/www/public/assets/functions/get-browser-name.php');
	require('/var/www/public/vendor/autoload.php');	
	$Parsedown = new Parsedown();

	// Grab user's browser type.
	$browser = get_browser_name($_SERVER['HTTP_USER_AGENT']);

	$post_slug = basename(__FILE__, '.php');

	try {
	    $conn = new PDO("mysql:host=$servername;dbname=blog", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    $stmt = $conn->prepare("SELECT * FROM posts WHERE slug LIKE '$post_slug'"); 
	    $stmt->execute();
	    $result = $stmt->fetchAll();
	} catch(PDOException $e) {
	    echo "Connection failed: " . $e->getMessage();
	}
?>
<?php require('/var/www/public/assets/templates/head.php'); ?>
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
	<?= round(filesize(__FILE__) / 1024, 2) . 'KB loaded in < 1 second. <span class="blinker"> &#9608;</span>'; ?>
</body>
</html>