<?php

// DEPENDÊNCIAS
use \Countpay\Page;
use \Countpay\DB\Sql;

/////////////////////////////////////////////////////////////
/* ************ GET - ROTA PARA LISTAR CARTÃO ************ */
/////////////////////////////////////////////////////////////
$app->get('/meta/criar', function() {

    // Dependências
    $page = new Page();
    $sql = new Sql();

    // Verificar login, caso não foi efetuado é redirecionado para login
    if (!isset($_SESSION['usuario']))
    {
        header('Location: /login');
        exit;
    }

    // Armazena o ID do usuário de acordo com o login e guarda na variável (resultado_id)
    $resultado_id = $_SESSION['usuario'];

    // Select com os campos coletados do frente e verificando se existe no banco de dados
    $categoria = $sql->select("SELECT descricao FROM categoria WHERE id_categoria > 4");

    // Template dentro de views arquivo: listar_contas.html
    $page->setTpl("criar_meta",

    // Dentro da pasta [views] o arquivo [listar_contas.html] está recebendo este array [$contas] e exibido de acordo com o banco
    array(
        "categoria"=>$categoria
    ));

});

?>