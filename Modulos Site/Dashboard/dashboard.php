<?php

// DEPENDÊNCIAS
use \Countpay\Page;
use \Countpay\DB\Sql;

/////////////////////////////////////////////////////////////
/* ******************* ROTA DO INDEX ********************* */
/////////////////////////////////////////////////////////////
$app->get('/', function() {

    // Dependências
    $page = new Page();

    // Verificar login, caso não foi efetuado é redirecionado para login
    if (!isset($_SESSION['usuario']))
    {
        header('Location: /login');
        exit;
    }

    // Template dentro de views arquivo: index.html
    $page->setTpl("index");

});

?>