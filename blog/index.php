<?php
// Getting function files and autoloading composer modules.
require('/var/www/public/assets/functions/get-env-vars.php');
include('/var/www/public/assets/functions/get-browser-name.php');
require('/var/www/public/vendor/autoload.php');

// Grab user's browser type.
$browser = get_browser_name($_SERVER['HTTP_USER_AGENT']);

try {
    $conn = new PDO("mysql:host=$servername;dbname=blog", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM posts ORDER BY created DESC"); 
    $stmt->execute();
    $result_index = $stmt->fetchAll();
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

function randomWrittenWord($word) {
	switch ($word) {
	    case 1:
	        $word = "Hastily written";
	        break;
	    case 2:
	        $word = "Scribbled";
	        break;
	    case 3:
	        $word = "Worded";
	        break;
	    case 4:
			$word = "Penned";
	        break;
	    case 5:
			$word = "Scratched";
	        break;
	    case 5:
			$word = "Scribed";
	        break;
	    default:
	        $word = "Written";
    }
    return $word;
}
require('/var/www/public/assets/templates/head.php');
require('/var/www/public/assets/templates/navbar.php');
?>
	<section>
		<p><span class="console-user">user</span>@<span class="console-os"><?= $browser ?>:</span><span class="console-pwd">~/$</span> mohnjatthews --blog</p>
		<br>
		<?php foreach($result_index as $post) : ?>
		<article class="single-tab single-project">
			<p>
				<a href="posts/<?= $post['slug'] ?>.php"><?= $post['title']; ?></a><br>
				<?= randomWrittenWord(rand(1, 6)); ?> on <?= date('jS F Y', strtotime($post['created'])); ?>
			</p>
		</article>
		<?php endforeach; ?>
	</section>
	<script src="/assets/scripts/colour-change.js"></script>
	<?php require('/var/www/public/assets/templates/footer.php'); ?>