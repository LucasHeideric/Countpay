<?php
session_start();
require_once("vendor/autoload.php");

use \Slim\Slim;
use \Countpay\Page;
use \Countpay\PageAdmin;
use \Countpay\DB\Sql;

$app = new \Slim\Slim();
$app->config('debug', true);

require_once("Modulos Admin\Login\login.php");
require_once("Modulos Admin\Dashboard\dashboard.php");
require_once("Modulos Admin\Usuario\usuario.php");


require_once("Modulos Site\Login\login.php");
require_once("Modulos Site\Dashboard\dashboard.php");
require_once("Modulos Site\Carteira\carteira.php");
require_once("Modulos Site\Lancamentos\lancamentos.php");


$app->run();

?>
