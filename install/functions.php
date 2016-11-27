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
		  	PRIMARY KEY (`id`));'
	  	);
	}

	$query = $db->query("SHOW TABLES LIKE 'ingredientes'");
	if(!$query->row) {
		$db->query(
			'CREATE TABLE `ingredientes` (
  			`id` INT NOT NULL,
  			`name` VARCHAR(100) NOT NULL,
  			PRIMARY KEY (`id`));'
	  	);
	}

	$query = $db->query("SHOW TABLES LIKE 'recipe_to_ingredientes'");
	if(!$query->row) {
		$db->query(
			'CREATE TABLE `recipe_to_ingredientes` (
  			`id` INT NOT NULL AUTO_INCREMENT,
  			`recipe_id` INT NOT NULL,
  			`ingredient_id` INT NOT NULL,
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
