<?php
session_start();
require_once("vendor/autoload.php");

use \Slim\Slim;
use \Countpay\Page;
use \Countpay\PageAdmin;
use \Countpay\DB\Sql;
use \Countpay\Model\Usuario;

$app = new \Slim\Slim();
$app->config('debug', true);

require_once("PHP Admin\admin.php");
require_once("PHP Site\site.php");

$app->run();

?>




