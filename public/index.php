<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

define ("ROOT", dirname(__DIR__));

require dirname(__DIR__) . '/core/config/config.php';
require_once MODELS . '/Database.php';
require_once MODELS . '/News.php';
require_once CORE . '/classes/Router.php';
require_once CORE . '/func.php';

$router = new Router();

require_once CORE . '/config/routes.php';

$router->match();
