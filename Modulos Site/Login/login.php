<?php

// DEPENDÊNCIAS
use \Countpay\Page;
use \Countpay\DB\Sql;

/////////////////////////////////////////////////////////////
/* **************** GET - ROTA DO LOGIN ****************** */
/////////////////////////////////////////////////////////////
$app->get('/login', function() {

    // Dependências
    $page = new Page([
        "header"=>false,
        "footer"=>false
    ]);

    // Template dentro de views arquivo: login.html
    $page->setTpl("login");

});

/////////////////////////////////////////////////////////////
/* ********* POST - ROTA DO LOGIN ADMINISTRADOR ********** */
/////////////////////////////////////////////////////////////
$app->post('/login', function() {

    // Dependências
    $sql = new Sql();

    // Coletando dados do front-end que está dentro do diretório [views][arquivo][index.html]
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    // Select com os campos coletados do frente e verificando se existe no banco de dados
    $array_resultado = $sql->select("SELECT id_usuario, login, senha, id_tipo_usuario FROM usuario WHERE login = :LOGIN AND senha = :SENHA",
    array(
        ":LOGIN"=>$login,
        ":SENHA"=>$senha
    ));

    // Caso exista algo dentro do array, as variáveis recebe os valores da busca de forma separada e convertida para string
    if (!empty($array_resultado)) {

    $resultado_id = $array_resultado[0]['id_usuario'];
    $resultado_login = $array_resultado[0]['login'];
    $resultado_senha = $array_resultado[0]['senha']; 
    $resultado_tipo_usuario = $array_resultado[0]['id_tipo_usuario'];

    // Exibe uma mensagem de erro para que o usuário preencha os campos necessário
    } else {

        echo "<script language='javascript' type='text/javascript'>
        alert('Usuário ou Senha incorreto!');window.location.href='/login';</script>";

    }

    // Compara se os dados recebidos do front-end é os mesmos dados que está armazenado no banco
    // Exemplo: ResultadoFront = ResultadoBanco -> Se sim, efetue o procedimento
    if ($resultado_login == $login && $resultado_senha == $senha && $resultado_tipo_usuario == 2) {
    
    // Armazena a sessão do usuário, caso o login seja efetivado
    $_SESSION['usuario'] = $resultado_id;

    // Com o login efetivado o usuário é encaminhado para a pagina: index.html que fica no diretório: [views][arquivo][index.html]
    header("Location: /");
    exit;

    } else {

    // Caso os dados não seja validado de acordo com o banco, exibe mensagem de erro por conta dos dados
    echo "<script language='javascript' type='text/javascript'>
    alert('Usuário ou Senha incorreto!');window.location.href='/login';</script>";

    }
    
    });

/////////////////////////////////////////////////////////////

/* ************** GET - ROTA DO SAIR **************** */
/////////////////////////////////////////////////////////////
$app->get('/sair', function() {

    // Remover a sessão do usuário logado
    session_destroy();

    header('Location: /login');
    exit;

});

?>