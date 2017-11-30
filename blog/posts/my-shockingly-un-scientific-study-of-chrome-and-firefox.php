<?php 
include_once("../../project_root.php");
require PROJECT_ROOT . '/vendor/autoload.php';
include PROJECT_ROOT . '/assets/functions/get-browser-name.php';

// Load environment variables.
$dotenv = new Dotenv\Dotenv(PROJECT_ROOT);
$dotenv->load();
$servername = getenv('MYSQL_LOCATION');
$username = getenv('MYSQL_USERNAME');
$password = getenv('MYSQL_PASSWORD');

// Grab user's browser type.
$browser = get_browser_name($_SERVER['HTTP_USER_AGENT']);

// Get current file name, ignoring the extention.
$file_name = basename(__FILE__, '.php');

try {
    $connection = new PDO("mysql:host=$servername;dbname=blog", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $statement = $connection->prepare("SELECT * FROM posts WHERE slug = '$file_name'"); 
    $statement->execute();
    $result = $statement->fetchAll();
} catch(PDOException $error) {
    echo "Connection failed: " . $error->getMessage();
}
require PROJECT_ROOT . '/assets/templates/head.php';
require PROJECT_ROOT . '/assets/templates/navbar.php';
?>
<section>
	<p><span class="console-user">user</span>@<span class="console-os"><?= $browser ?>:</span><span class="console-pwd">~/$</span> mohnjatthews --blog <?= $result[0]['title']; ?> <?= $result[0]['created']; ?></p>
	<article class="single-tab">
		<?php
			$Parsedown = new Parsedown();
			echo $Parsedown->text($result[0]['content']);
		?>
	</article>
</section>
<script src="/assets/scripts/colour-change.js"></script>
<?php require PROJECT_ROOT . '/assets/templates/footer.php'; ?>
