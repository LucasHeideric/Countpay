<?php

// DEPENDÊNCIAS
use \Countpay\PageAdmin;
use \Countpay\DB\Sql;

// GET - ROTA PARA LISTAR OS USUÁRIOS
$app->get('/admin/usuario', function() {

    $page = new PageAdmin();
    $sql = new Sql();
    
    $usuarios = $sql->select("SELECT id_usuario, nome, sobrenome, email, data_nascimento, login FROM usuario ORDER BY id_usuario");

    // VERIFICA SE O LOGIN JÁ FOI EFETIVADO, CASO NÃO É REDIRECIONADO PARA LOGIN
    if (!isset($_SESSION['admin']))
    {
        header('Location: /admin/login');
        exit;
    }
        
    $page->setTpl("lista_usuarios", array("usuarios"=>$usuarios));
    
});


// GET - ROTA PARA CRIAR NOVOS USUÁRIOS
$app->get('/admin/usuario/criar', function() {

    $page = new PageAdmin();
    $sql = new Sql();
    
    // VERIFICA SE O LOGIN JÁ FOI EFETIVADO, CASO NÃO É REDIRECIONADO PARA LOGIN
    if (!isset($_SESSION['admin']))
    {
        header('Location: /admin/login');
        exit;
    } 
        
    $page->setTpl("criarusuario");
        
});


// POST - ROTA PARA CRIAR NOVOS USUÁRIOS
$app->post('/admin/usuario/criar', function() {
    
    $sql = new Sql();
    $page = new PageAdmin();

    // VERIFICA SE O LOGIN JÁ FOI EFETIVADO, CASO NÃO É REDIRECIONADO PARA LOGIN
    if (!isset($_SESSION['admin']))
    {
        header('Location: /admin/login');
        exit;
    }

    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $data_nascimento = $_POST['data_nascimento'];
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $id_tipo_usuario = 2;

    // CONSULTA NO BANCO PARA VER SE EXISTE E-MAIL OU LOGIN DUPLICADO
    $resultado_cadastrocheck = $sql->select("SELECT email, login FROM usuario WHERE email = :EMAIL OR login = :LOGIN", array(
        ':EMAIL'=>$email,
        ':LOGIN'=>$login
    ));

    // CASO TENHA ALGUM REGISTRO NO BANCO COM OS DADOS MENCIONADOS É ARMAZENADO DE FORMA INDIVIDUAL
    if (!empty($resultado_cadastrocheck)){
    $resultado_email = $resultado_cadastrocheck[0]['email'];
    $resultado_login = $resultado_cadastrocheck[0]['login'];
    }

    // VERIFICA SE EXISTE ALGUM REGISTRO NAS VARIAVEIS "RESULTADOS"
    if (isset($resultado_email) && isset($resultado_login)) {

        // SE EXISTIR ELE VERIFICA QUE DADOS COLETADOS DO FRONT É O MESMO QUE ESTÁ NO BANCO, CASO SEJA É BARRADO COM MENSAGEM DE AVISO
        if ($resultado_email == $email || $resultado_login == $login)
        {
            echo "<script language='javascript' type='text/javascript'>
            alert('E-mail ou login já cadastrado, tente novamente!');window.location.href='/admin/usuario/criar';</script>";
        }
        // CASO NÃO TENHA UM REGISTRO COM OS MESMO VALORES PASSA A CONDIÇÃO DE CRIAÇÃO DE NOVO USUÁRIO
        } else {
        
            // PASSANDO OS DADOS COLETADO PARA A STORED PROCEDURE E REALIZANDO A INSERÇÃO NO BANCO DE DADOS
            $resultado = $sql->select("CALL sp_usuario_inserir(:NOME, :SOBRENOME, :EMAIL, :DATA_NASCIMENTO, :LOGIN, :SENHA, :ID_TIPO_USUARIO)", array(
                ':NOME'=>$nome,
                ':SOBRENOME'=>$sobrenome,
                ':EMAIL'=>$email,
                ':DATA_NASCIMENTO'=>$data_nascimento,
                ':LOGIN'=>$login,
                ':SENHA'=>$senha,
                ':ID_TIPO_USUARIO'=>$id_tipo_usuario
            ));

            // CASO A INSERÇÃO FOI REALIZADA, EXIBI A MENSAGEM DE CADASTRO COM SUCESSO.
            if ($resultado > 0) {
                echo "<script language='javascript' type='text/javascript'>
                alert('Usuário cadastrado com sucesso!');window.location.href='/admin/usuario';</script>";
            }
    }

});


// GET - ROTA PARA ALTERAR O USUÁRIO JÁ CADASTRADO
$app->get('/admin/usuario/:id_usuario', function($id_usuario) {

    $page = new PageAdmin();
    $sql = new Sql();

    // VERIFICA SE O LOGIN JÁ FOI EFETIVADO, CASO NÃO É REDIRECIONADO PARA LOGIN
    if (!isset($_SESSION['admin']))
    {
        header('Location: /admin/login');
        exit;
    }

    // COLETA O ID DO USUÁRIO QUE FOI SELECIONADO VIA BROWSER NO BOTÃO DE ALTERAR
    $usuarioID = $id_usuario;

    // CARREGA TODAS AS INFORMAÇÕES DO USUÁRIO
    $usuario = $sql->select("SELECT id_usuario, nome, sobrenome, email, data_nascimento, login FROM usuario WHERE id_usuario = :ID_USUARIO",
    array(
        ":ID_USUARIO"=>$usuarioID,
    )); 

    // CARREGA OS DADOS NO FORMULÁRIO ATRAVÉS DO SLIM E REGISTROS NA COLUNA DA TABELA USUÁRIO DE ACORDO COM O ID COLETADO
    $page->setTpl("alterarusuario", array(
        "usuario"=>$usuario[0]
    )); 
    
});


// POST - ROTA PARA ALTERAR USUÁRIO JÁ CADASTRADO
$app->post('/admin/usuario/alterar', function() {
    $sql = new Sql();

    // COLETANDO INFORMAÇÕES DO FORM NO FRONT-END NA PAGINA: admin/alterarusuario.html
    $id_usuario = $_POST['id_usuario'];
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $data_nascimento = $_POST['data_nascimento'];
    $login = $_POST['login'];

    // REALIZA A ATUALIZAÇÃO DOS DADOS PROPORCIONAL AS INFORMAÇÕES PREENCHIDAS ACIMA
    // LEMBRAR DE FAZER A VERIFICAÇÃO SE NÃO ESTÁ SENDO FEITO A ATUALIZAÇÃO COM DADOS JÁ CADASTRADOS
    $sql->execQuery("UPDATE usuario SET nome = :NOME, sobrenome = :SOBRENOME, email = :EMAIL, data_nascimento = :DATA_NASCIMENTO, login = :LOGIN WHERE id_usuario = :ID_USUARIO", array(

        ':NOME'=>$nome,
        ':SOBRENOME'=>$sobrenome,
        ':EMAIL'=>$email,
        ':DATA_NASCIMENTO'=>$data_nascimento,
        ':LOGIN'=>$login,
        ':ID_USUARIO'=>$id_usuario

    ));

    // RETORNO PARA O USUÁRIO CASO FOI REALIZADO A ALTERAÇÃO
    echo "<script language='javascript' type='text/javascript'>
    alert('Usuário alterado com sucesso!');window.location.href='/admin/usuario';</script>";

});


// GET - ROTA PARA EXCLUIR USUÁRIO JÁ CADASTRADO
$app->get('/admin/usuario/:id_usuario/delete', function($id_usuario) {

    $sql = new Sql();
    
    // COLETA O ID DO USUÁRIO QUE FOI SELECIONADO VIA BROWSER NO BOTÃO DE EXCLUIR
    $idColetado = $id_usuario;

    // EXECUTA A EXCLUSÃO DA LINHA DE ACORDO COM O ID DO USUÁRIO COLETADO
    $sql->execQuery("DELETE FROM usuario WHERE id_usuario = :ID_USUARIO", array(

        ':ID_USUARIO'=>$idColetado

    ));

    // RETORNO QUE O USUÁRIO FOI EXCLUIDO COM SUCESSO
    echo "<script language='javascript' type='text/javascript'>
    alert('Usuário excluído com sucesso!');window.location.href='/admin/usuario';</script>";

});


?>