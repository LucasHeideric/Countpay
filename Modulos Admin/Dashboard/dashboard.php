<?php

// DEPENDÊNCIAS
use \Countpay\PageAdmin;
use \Countpay\DB\Sql;

// GET - ROTA DO INDEX ADMINISTRADOR
$app->get('/admin', function() {

    $sql = new Sql();
    $page = new PageAdmin();
  
    // VERIFICA SE O LOGIN JÁ FOI EFETIVADO, CASO NÃO É REDIRECIONADO PARA LOGIN
    if (!isset($_SESSION['admin']))
    {
        header('Location: /admin/login');
        exit;
    }

    $usuarioDados = $sql->select("SELECT quantidade_usuario FROM usuario_dados"); 
    $contaDados = $sql->select("SELECT quantidade_conta FROM conta_dados");
    $cartaoDados = $sql->select("SELECT quantidade_cartao FROM cartao_dados");
    $lancamentoDados = $sql->select("SELECT lancamento_total FROM lancamento_dados");

    // POSSO MELHORAR ESSES (DADOS), SÓ FAZER O SELECT E ATRIBUIR TITULO NO NOME DA COLUNA
    // SELECT SUM(id_conta) 'totalcontas'
    // Sintaxe: {$variavel.nome} Ficaria assim: {$contaDados.totalcontas} 
    $page->setTpl("index", array(
        "usuarioDados"=>$usuarioDados[0],
        "contaDados"=>$contaDados[0],
        "cartaoDados"=>$cartaoDados[0],
        "lancamentoDados"=>$lancamentoDados[0]
    )); 
  
});

?>