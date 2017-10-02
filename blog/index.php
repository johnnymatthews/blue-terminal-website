<?php
// Import the PROJECT_ROOT global variable.
include_once("../project_root.php");

// Getting function files and autoloading composer modules.
require PROJECT_ROOT . 'vendor/autoload.php';
include PROJECT_ROOT . 'assets/functions/get-browser-name.php';
include PROJECT_ROOT . 'assets/functions/get-tags.php';

// Load environment variables.
$dotenv = new Dotenv\Dotenv(PROJECT_ROOT);
$dotenv->load();
$servername = getenv('MYSQL_LOCATION');
$username = getenv('MYSQL_USERNAME');
$password = getenv('MYSQL_PASSWORD');

// Grab user's browser type.
$browser = get_browser_name($_SERVER['HTTP_USER_AGENT']);

try {
    $conn = new PDO("mysql:host=$servername;dbname=blog", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM posts WHERE deleted = 0 ORDER BY created DESC"); 
    $stmt->execute();
    $result_index = $stmt->fetchAll();
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

require(PROJECT_ROOT . 'assets/templates/head.php');
require(PROJECT_ROOT . '/assets/templates/navbar.php');
?>
	<section>
		<p><span class="console-user">user</span>@<span class="console-os"><?= $browser ?>:</span><span class="console-pwd">~/$</span> mohnjatthews --blog</p>
		<br>
		<?php foreach($result_index as $post) : ?>
		<article class="single-tab single-project">
			<p>
				<a href="posts/<?= $post['slug'] ?>.php"><?= $post['title']; ?></a><br>
				<?= date('jS F Y', strtotime($post['created'])); ?><br>
				<span class="tags">
					<?php
						if(!empty($post['tags'])) {
							$tags = getTags($post['tags']);
							foreach($tags as $tag) {
								echo "[" . $tag[0]['name'] . "] ";
							}
						}
					?>
				</span>
			</p>
		</article>
		<?php endforeach; ?>
	</section>
<script src="/assets/scripts/colour-change.js"></script>
<?php require PROJECT_ROOT . 'assets/templates/footer.php'; ?>