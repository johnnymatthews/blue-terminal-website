<?php
// Returns the tags for an individual post based on the id of that post.
function getTags($tag_string) {
	global $servername, $username, $password; // Grab global env vars for PDO statement.
	$return_array = []; // Create blank array, because array_push needs one to exist.
	$post_tags = array_map('intval', explode(',', $tag_string)); // Turn the string of numbers into an array.
	
	foreach ($post_tags as $post_tag) {
		try {
		    $conn = new PDO("mysql:host=$servername;dbname=blog", $username, $password);
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$statement = $conn->prepare("SELECT `name` FROM `tags` WHERE `id` LIKE $post_tag  "); 
		    $statement->execute();
		    $tag = $statement->fetchAll();
		    $conn = NULL; // Close the connection.
		} catch(PDOException $e) {
		    echo "Tag connection failed: " . $e->getMessage();
		}
		array_push($return_array, $tag);
	}
	return $return_array;
}