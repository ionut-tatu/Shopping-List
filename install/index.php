<?php

require_once('../app/init.php');
require_once('functions.php');

$db = new DB(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

setup_database($db);
seed_database($db);
setup_config_file();

header('Location: ../public/');
exit();