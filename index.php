<?php
error_reporting(-1);
ini_set('display_errors', 'On');
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/bootstrap/load_env.php';
require_once __DIR__ . '/bootstrap/process_url.php';
load(__DIR__);
define("APP_PATH", getenv("APP_PATH"));
define("DEFAULT_COTROLLER", 'Home');

$processUrl = new \App\Bootstrap\ProcessUrl();
$processUrl->exeUrl();