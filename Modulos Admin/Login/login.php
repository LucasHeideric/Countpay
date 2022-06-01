<?php

// DEPENDÊNCIAS
use \Countpay\PageAdmin;
use \Countpay\DB\Sql;

// GET - ROTA DO LOGIN ADMINISTRADOR
$app->get('/admin/login', function() {

    $page = new PageAdmin([
        "header"=>false,
        "footer"=>false
    ]);

    $page->setTpl("login");

});

// POST - ROTA DO LOGIN ADMINISTRADOR
$app->post('/admin/login', function() {

    $sql = new Sql();

    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $array_resultado = $sql->select("SELECT login, senha, id_tipo_usuario, id_usuario FROM usuario WHERE login = :LOGIN AND senha = :SENHA",
    array(
        ":LOGIN"=>$login,
        ":SENHA"=>$senha
    ));

    // CASO EXISTA ALGO NO ARRAY, ATRIBUA O VALOR NAS VARIÁVEIS
    if (!empty($array_resultado)) {

    $resultado_login = $array_resultado[0]['login'];
    $resultado_senha = $array_resultado[0]['senha']; 
    $resultado_tipo_usuario = $array_resultado[0]['id_tipo_usuario'];
    $resultado_id_usuario = $array_resultado[0]['id_usuario'];

    } else {
        echo "<script language='javascript' type='text/javascript'>
        alert('Login ou Senha invalido!');window.location.href='/admin/login';</script>";
    }

    if ($resultado_login == $login && $resultado_senha == $senha && $resultado_tipo_usuario == 1) {
    
    // ARMAZENA A SESSÃO SE O LOGIN SER EFETIVADO
    $_SESSION['admin'] = $resultado_id_usuario;
    header("Location: /admin");
    exit;

    } else {
    echo "<script language='javascript' type='text/javascript'>
    alert('Usuário ou Senha incorreto!');window.location.href='/admin/login';</script>";
    }
    
});

/////////////////////////////////////////////////////////////
/* ************** ROTA DO SESSION DESTROY **************** */
/////////////////////////////////////////////////////////////
$app->get('/admin/sair', function() {

    // Dependências

    // Remover a sessão do usuário logado
    session_destroy();

    header('Location: /admin/login');
    exit;

});
?>