<?php

// Bootstrapping application
require_once 'config/app.php';
require_once 'config/assets.php';
require_once 'config/database.php';

require_once 'system/core/Registry.php';
require_once 'system/core/Controller.php';
require_once 'system/core/App.php';

require_once 'system/helper/Url.php';
require_once 'system/helper/Asset.php';
require_once 'system/helper/Database.php';



$registry = new Registry();


$registry->set('url', new Url());
$registry->set('assets', new Asset(getAssets()));
$registry->set('db', new DB(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE));

$app = new App($registry);

$app->execute();