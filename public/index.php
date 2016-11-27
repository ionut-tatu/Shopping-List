<?php

if (is_file('../app/config/app.php')) {
	require_once('../app/config/app.php');
}

if(!defined('DIR_APPLICATION')) {
	header('Location: ../install/index.php');
	exit;
}

require_once('../app/init.php');