<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

require_once "./src/vendor/autoload.php";
require_once "./src/helpers.php";

use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

use Framework\Router;
use Framework\Session;
Session::start();

$router=new Router();
require_once basePath("routes.php");
$uri=parse_url($_SERVER["REQUEST_URI"],PHP_URL_PATH);
$router->route($uri);

//Contact me to write something here