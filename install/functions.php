<?php

function setup_database($db)
{
	$query = $db->query("SHOW TABLES LIKE 'recipes'");
	if(!$query->row) {
		$db->query(
			'CREATE TABLE `recipes` (
		  	`id` INT NOT NULL AUTO_INCREMENT,
		  	`name` VARCHAR(100) NOT NULL,
		  	`description` TEXT NULL,
		  	`image` VARCHAR(100) NULL,
		  	`ingredientes` TEXT NULL,
		  	PRIMARY KEY (`id`));'
	  	);
	}
}

function setup_config_file()
{
	$output  = '<?php' . "\n\n";
	$output .= 'define(\'APP_URL\', \'http://' . $_SERVER['HTTP_HOST'] . '\');' . "\n";
	$output .= 'define(\'DIR_APPLICATION\', \'true\');' . "\n";

	$file = fopen('../app/config/app.php', 'w');

	fwrite($file, $output);
	fclose($file);
}

function seed_database($db)
{
	$string = file_get_contents('db_seed.json');

	$json = json_decode($string, true);

	foreach ($json as $value) {
		foreach ($value['recipes'] as $key => $recipe) {

			$query = "INSERT INTO recipes (name, description, image, ingredientes) VALUES ('" . $recipe['name'] . "', '" . $recipe['description'] . "', '" . $recipe['image'] . "', '" . $recipe['ingredientes'] . "')";

			$db->query($query);
		}
	}
}