<?php

// DEPENDÊNCIAS
use \Countpay\Page;
use \Countpay\DB\Sql;

/////////////////////////////////////////////////////////////
/* ************ GET - ROTA PARA LISTAR CARTÃO ************ */
/////////////////////////////////////////////////////////////
$app->get('/cartao', function() {

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
    $cartao = $sql->select(
    "SELECT cartao.id_cartao, cartao.apelido, cartao.tipo_cartao, cartao.vence_dia, cartao.limite, instituicao.nome
    FROM cartao
    INNER JOIN instituicao ON instituicao.id_instituicao = cartao.id_instituicao AND cartao.id_usuario = :ID_USUARIO", array(
        ":ID_USUARIO"=>$resultado_id
    ));

    // Template dentro de views arquivo: listar_contas.html
    $page->setTpl("listar_cartoes",

    // Dentro da pasta [views] o arquivo [listar_contas.html] está recebendo este array [$contas] e exibido de acordo com o banco
    array(
        "cartao"=>$cartao
    ));

});

$app->get('/alexandre', function(){

    $page = new Page(["header"=>false,
                      "footer"=>false]);

    $page->setTpl("login");
});

/////////////////////////////////////////////////////////////
/* ************* GET - ROTA PARA CRIAR CARTAO ************ */
/////////////////////////////////////////////////////////////
$app->get('/cartao/criar', function() {

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

    // Select das instituição para o usuário analisar a sua
    $instituicao = $sql->select("SELECT nome FROM instituicao ORDER BY id_instituicao ASC, nome ASC");

    // Template dentro de views arquivo: criar_cartao.html
    $page->setTpl("criar_cartao",

    // Dentro da pasta [views] o arquivo [criar_cartao.html] está recebendo este array [$instituicao] e exibido de acordo com o banco
    array(
        "instituicao"=>$instituicao
    ));

});

/////////////////////////////////////////////////////////////
/* **************** POST DE CRIAR CARTÃO ***************** */
/////////////////////////////////////////////////////////////
$app->post('/cartao/criar', function() {

    // Dependências
    $page = new Page();
    $sql = new Sql();

    // Armazena o ID do usuário de acordo com o login e guarda na variável (resultado_id)
    $id_usuario = $_SESSION['usuario'];

    // Coletando dados do front-end que está dentro do diretório [views][arquivo][criar_cartao.html]
    $apelido = $_POST['apelido'];
    $tipo_cartao = $_POST['tipo_cartao'];
    $vence_dia = $_POST['vence_dia'];
    $limite = $_POST['limite'];
    $instituicao_string = $_POST['instituicao'];

    // Select das instituição para o usuário analisar a sua
    $instituicao = $sql->select("SELECT id_instituicao FROM instituicao WHERE nome = :NOME", array(
        ":NOME"=>$instituicao_string
    ));

    // Verificação se os dados foi recebido, se sim realizar o armazenamento do id selecionado pelo usuário, caso não foi selecionado o campo fica vazio
    if (!empty($instituicao)){
        $instituicao = $instituicao[0]['id_instituicao'];
        } else {
            $instituicao = NULL;
        }

    // Realiza a inserção dos dados na tabela através do front-end, recebendo os dados digitados (inclusive os convertidos para id nos ifs de cima)
    $resultado = $sql->select("CALL sp_cartao_inserir(:APELIDO, :TIPO_CARTAO, :VENCE_DIA, :LIMITE, :ID_USUARIO, :ID_INSTITUICAO)", array(
        ':APELIDO'=>$apelido,
        ':TIPO_CARTAO'=>$tipo_cartao,
        ':VENCE_DIA'=>$vence_dia,
        ':LIMITE'=>$limite,
        ':ID_USUARIO'=>$id_usuario,
        ':ID_INSTITUICAO'=>$instituicao
    ));

    header('Location: /cartao');
    exit; 

});

/////////////////////////////////////////////////////////////
/* ************ GET - ROTA DE ALTERAR CONTA ************** */
/////////////////////////////////////////////////////////////
$app->get('/cartao/:id_usuario', function($id_cartao) {

    // Dependências
    $page = new Page();
    $sql = new Sql();

    // Verificar login, caso não foi efetuado é redirecionado para login
    if (!isset($_SESSION['usuario']))
    {
        header('Location: /admin/login');
        exit;
    }

    // Armazena o ID da conta dentro da variável (cartaoID)
    $cartaoID = $id_cartao;

    // Select dos dados da conta que é utilizado no form
    $cartao = $sql->select("SELECT id_cartao, apelido, tipo_cartao, vence_dia, limite, id_instituicao FROM cartao WHERE id_cartao = :ID_CARTAO",
    array(
        ":ID_CARTAO"=>$cartaoID,
    )); 

    $instituicao = $sql->select("SELECT nome FROM instituicao");

    // Template dentro de views arquivo: alterar_cartao.html
    $page->setTpl("alterar_cartao",
    
    // Dentro da pasta [views] o arquivo [alterar_cartao.html] está recebendo este array [$conta, $instituicao] e exibido de acordo com o banco
    array(
        "cartao"=>$cartao[0],
        'instituicao'=>$instituicao
    ));  

});

/////////////////////////////////////////////////////////////
/* *************** POST DE ALTERAR CONTA ***************** */
/////////////////////////////////////////////////////////////
$app->post('/cartao/alterar', function() {
    
    // Dependências
    $sql = new Sql();

    // Coletando dados do front-end que está dentro do diretório [views][arquivo][alterar_conta.html]
    $id_cartao = $_POST['id_cartao'];
    $apelido = $_POST['apelido'];
    $tipo_cartao = $_POST['tipo_cartao'];
    $vence_dia = $_POST['vence_dia'];
    $limite = $_POST['limite'];
    $instituicao = $_POST['instituicao'];

    $instituicaoArray = $sql->select("SELECT id_instituicao FROM instituicao WHERE nome = :NOME", array(
        ':NOME'=>$instituicao
    ));

    $instituicaoID = $instituicaoArray[0]['id_instituicao'];

    // REALIZA A ATUALIZAÇÃO DOS DADOS PROPORCIONAL AS INFORMAÇÕES PREENCHIDAS ACIMA
    // LEMBRAR DE FAZER A VERIFICAÇÃO SE NÃO ESTÁ SENDO FEITO A ATUALIZAÇÃO COM DADOS JÁ CADASTRADOS
    $sql->execQuery("UPDATE cartao SET apelido = :APELIDO, tipo_cartao = :TIPO_CARTAO, vence_dia = :VENCE_DIA, limite = :LIMITE, id_instituicao = :ID_INSTITUICAO WHERE id_cartao = :ID_CARTAO", array(

        ':ID_CARTAO'=>$id_cartao,
        ':APELIDO'=>$apelido,
        ':TIPO_CARTAO'=>$tipo_cartao,
        ':VENCE_DIA'=>$vence_dia,
        ':LIMITE'=>$limite,
        ':ID_INSTITUICAO'=>$instituicaoID,
        
    ));

    // RETORNO PARA O USUÁRIO CASO FOI REALIZADO A ALTERAÇÃO
     echo "<script language='javascript' type='text/javascript'>
     alert('Cartão alterada com sucesso!');window.location.href='/cartao';</script>";
    
});

/////////////////////////////////////////////////////////////
/* ************ GET - ROTA DE EXCLUIR CARTÃO ************* */
/////////////////////////////////////////////////////////////
$app->get('/cartao/:id_cartao/delete', function($id_cartao) {

    $sql = new Sql();
    
    // Armazena o ID da conta dentro da variável (idColetado)
    $idColetado = $id_cartao;

    // Executa e exclusão da linha de acordo com o ID da conta coletado
    $sql->execQuery("DELETE FROM cartao WHERE id_cartao = :ID_CARTAO", array(

        ':ID_CARTAO'=>$idColetado

    ));

    // RETORNO QUE O USUÁRIO FOI EXCLUIDO COM SUCESSO
    echo "<script language='javascript' type='text/javascript'>
    alert('Cartão excluído com sucesso!');window.location.href='/conta';</script>";

});

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////
/* ************ GET - ROTA PARA LISTAR CONTA ************* */
/////////////////////////////////////////////////////////////
$app->get('/conta', function() {

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
    $contas = $sql->select(
    "SELECT conta.id_conta, conta.apelido, instituicao.nome, conta.tipo_conta, conta.saldo
    FROM conta
    INNER JOIN instituicao ON instituicao.id_instituicao = conta.id_instituicao AND conta.id_usuario = :ID_USUARIO", array(
        ":ID_USUARIO"=>$resultado_id
    ));

    // Template dentro de views arquivo: listar_contas.html
    $page->setTpl("listar_contas",

    // Dentro da pasta [views] o arquivo [listar_contas.html] está recebendo este array [$contas] e exibido de acordo com o banco
    array(
        "contas"=>$contas
    ));

});

/////////////////////////////////////////////////////////////
/* ************* GET - ROTA PARA CRIAR CONTA ************* */
/////////////////////////////////////////////////////////////
$app->get('/conta/criar', function() {

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

    // Select das instituição para o usuário analisar a sua
    $instituicao = $sql->select("SELECT nome FROM instituicao ORDER BY id_instituicao ASC, nome ASC");

    // Template dentro de views arquivo: criar_conta.html
    $page->setTpl("criar_conta",

    // Dentro da pasta [views] o arquivo [criar_conta.html] está recebendo este array [$instituicao] e exibido de acordo com o banco
    array(
        "instituicao"=>$instituicao
    ));

});

/////////////////////////////////////////////////////////////
/* **************** POST DE CRIAR CONTA ****************** */
/////////////////////////////////////////////////////////////
$app->post('/conta/criar', function() {

    // Dependências
    $page = new Page();
    $sql = new Sql();

    // Armazena o ID do usuário de acordo com o login e guarda na variável (resultado_id)
    $id_usuario = $_SESSION['usuario'];

    // Coletando dados do front-end que está dentro do diretório [views][arquivo][criar_conta.html]
    $apelido = $_POST['apelido'];
    $tipo_conta = $_POST['tipo_conta'];
    $saldo = $_POST['valor'];
    $instituicao_string = $_POST['instituicao'];

    // Select das instituição para o usuário analisar a sua
    $instituicao = $sql->select("SELECT id_instituicao FROM instituicao WHERE nome = :NOME", array(
        ":NOME"=>$instituicao_string
    ));

    // Verificação se os dados foi recebido, se sim realizar o armazenamento do id selecionado pelo usuário, caso não foi selecionado o campo fica vazio
    if (!empty($instituicao)){
        $instituicao = $instituicao[0]['id_instituicao'];
        } else {
            $instituicao = NULL;
        }
    
    // Realiza a inserção dos dados na tabela através do front-end, recebendo os dados digitados (inclusive os convertidos para id nos ifs de cima)
    $resultado = $sql->select("CALL sp_conta_inserir(:APELIDO, :TIPO_CONTA, :SALDO, :ID_USUARIO, :ID_INSTITUICAO)", array(
        ':APELIDO'=>$apelido,
        ':TIPO_CONTA'=>$tipo_conta,
        ':SALDO'=>$saldo,
        ':ID_USUARIO'=>$id_usuario,
        ':ID_INSTITUICAO'=>$instituicao
    ));

    header('Location: /conta');
    exit;
    
});

/////////////////////////////////////////////////////////////
/* ************ GET - ROTA DE ALTERAR CONTA ************** */
/////////////////////////////////////////////////////////////
$app->get('/conta/:id_usuario', function($id_conta) {

    // Dependências
    $page = new Page();
    $sql = new Sql();

    // Verificar login, caso não foi efetuado é redirecionado para login
    if (!isset($_SESSION['usuario']))
    {
        header('Location: /admin/login');
        exit;
    }

    // Armazena o ID da conta dentro da variável (contaID)
    $contaID = $id_conta;

    // Select dos dados da conta que é utilizado no form
    $conta = $sql->select("SELECT id_conta, apelido, tipo_conta, saldo, id_instituicao  FROM conta WHERE id_conta = :ID_CONTA",
    array(
        ":ID_CONTA"=>$contaID,
    )); 

    $instituicao = $sql->select("SELECT nome FROM instituicao");

    // Template dentro de views arquivo: alterar_conta.html
    $page->setTpl("alterar_conta",
    
    // Dentro da pasta [views] o arquivo [alterar_conta.html] está recebendo este array [$conta, $instituicao] e exibido de acordo com o banco
    array(
        "conta"=>$conta[0],
        'instituicao'=>$instituicao
    )); 
    
});

/////////////////////////////////////////////////////////////
/* ************ POST - ROTA DE ALTERAR CONTA ************* */
/////////////////////////////////////////////////////////////
$app->post('/conta/alterar', function() {

    $sql = new Sql();

    // Coletando dados do front-end que está dentro do diretório [views][arquivo][alterar_conta.html]
    $id_conta = $_POST['id_conta'];
    $apelido = $_POST['apelido'];
    $tipo_conta = $_POST['tipo_conta'];
    $valor = $_POST['valor'];
    $instituicao = $_POST['instituicao'];

    $instituicaoArray = $sql->select("SELECT id_instituicao FROM instituicao WHERE nome = :NOME", array(
        ':NOME'=>$instituicao
    ));

    $instituicaoID = $instituicaoArray[0]['id_instituicao'];

    // REALIZA A ATUALIZAÇÃO DOS DADOS PROPORCIONAL AS INFORMAÇÕES PREENCHIDAS ACIMA
    // LEMBRAR DE FAZER A VERIFICAÇÃO SE NÃO ESTÁ SENDO FEITO A ATUALIZAÇÃO COM DADOS JÁ CADASTRADOS
    $sql->execQuery("UPDATE conta SET apelido = :APELIDO, tipo_conta = :TIPO_CONTA, saldo = :SALDO, id_instituicao = :ID_INSTITUICAO WHERE id_conta = :ID_CONTA", array(

        ':ID_CONTA'=>$id_conta,
        ':APELIDO'=>$apelido,
        ':TIPO_CONTA'=>$tipo_conta,
        ':SALDO'=>$valor,
        ':ID_INSTITUICAO'=>$instituicaoID,
        
    ));

    // RETORNO PARA O USUÁRIO CASO FOI REALIZADO A ALTERAÇÃO
     echo "<script language='javascript' type='text/javascript'>
     alert('Conta alterada com sucesso!');window.location.href='/conta';</script>";
    
});

/////////////////////////////////////////////////////////////
/* ************ GET - ROTA DE EXCLUIR CONTA ************** */
/////////////////////////////////////////////////////////////
$app->get('/conta/:id_conta/delete', function($id_conta) {

    // Dependências
    $sql = new Sql();
    
    // Armazena o ID da conta dentro da variável (idColetado)
    $idColetado = $id_conta;

    // Executa e exclusão da linha de acordo com o ID da conta coletado
    $sql->execQuery("DELETE FROM conta WHERE id_conta = :ID_CONTA", array(

        ':ID_CONTA'=>$idColetado

    ));

    // RETORNO QUE O USUÁRIO FOI EXCLUIDO COM SUCESSO
    echo "<script language='javascript' type='text/javascript'>
    alert('Conta excluído com sucesso!');window.location.href='/conta';</script>";

});


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////
/* ********************** GET - COPIA ******************** */
/////////////////////////////////////////////////////////////
$app->get('/lancamento/transferencia', function() {

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

    // Select das instituição para o usuário analisar a sua
    $conta = $sql->select("SELECT apelido FROM conta WHERE id_usuario = :ID_USUARIO", array(
        ":ID_USUARIO"=>$resultado_id
    ));

    // Select das instituição para o usuário analisar a sua
    $cartao = $sql->select("SELECT apelido FROM cartao WHERE id_usuario = :ID_USUARIO", array(
        ":ID_USUARIO"=>$resultado_id
    ));
    
    $usuario = $sql->select("SELECT id_usuario FROM usuario WHERE id_usuario = :ID_USUARIO", array(
        ":ID_USUARIO"=>$resultado_id
    ));

    $page->setTpl("lancamento_transferencia",
    array(
        "conta"=>$conta,
        "cartao"=>$cartao,
        "usuario"=>$usuario[0]
    ));

});

/////////////////////////////////////////////////////////////
/* ******************** POST - COPIA ********************* */
/////////////////////////////////////////////////////////////
$app->post('/lancamento/transferencia', function() {

    // Dependências
    $page = new Page();
    $sql = new Sql();

    // Armazena o ID do usuário de acordo com o login e guarda na variável (resultado_id)
    $id_usuario = $_SESSION['usuario'];

    // Coletando dados do front-end que está dentro do diretório [views][arquivo][criar_cartao.html]
    $conta_despesa_string = $_POST['id_conta_despesa'];
    $conta_receita_string = $_POST['id_conta_receita'];
    $valor = $_POST['valor'];
    $data_lancamento = $_POST['data_lancamento'];
    $tipo_lancamento_receita = 'Transferência Receita';
    $tipo_lancamento_despesa = 'Transferência Despesa';
    $categoria = 29;
    $apelido_receita = 'Transferência recebida de ' . $conta_despesa_string;
    $apelido_despesa = 'Transferência para ' . $conta_receita_string;

    // Select das instituição para o usuário analisar a sua
    $conta_despesa = $sql->select("SELECT id_conta FROM conta WHERE apelido LIKE :CONTA", array(
        ":CONTA"=>$conta_despesa_string
    ));

    // Select das instituição para o usuário analisar a sua
    $conta_receita = $sql->select("SELECT id_conta FROM conta WHERE apelido LIKE :CONTA", array(
        ":CONTA"=>$conta_receita_string
    ));    

    // Verificação se os dados foi recebido, se sim realizar o armazenamento do id selecionado pelo usuário, caso não foi selecionado o campo fica vazio
    if (!empty($conta_despesa)){
        $conta_despesa = $conta_despesa[0]['id_conta'];
        } else {
            $conta_despesa = NULL;
        }

    // Verificação se os dados foi recebido, se sim realizar o armazenamento do id selecionado pelo usuário, caso não foi selecionado o campo fica vazio
    if (!empty($conta_receita)){
        $conta_receita = $conta_receita[0]['id_conta'];
        } else {
            $conta_receita = NULL;
        }           
    
    $resultado1 = $sql->select("CALL sp_lancamento_transferencia(:DESCRICAO_DESPESA, :TIPO_LANCAMENTO, :VALOR, :DATA_LANCAMENTO, :USUARIO, :CONTA, :CATEGORIA )", array(
        ':DESCRICAO_DESPESA'=>$apelido_despesa,
        ':TIPO_LANCAMENTO'=>$tipo_lancamento_despesa,
        ':VALOR'=>$valor,
        ':DATA_LANCAMENTO'=>$data_lancamento,
        ':USUARIO'=>$id_usuario,
        ':CONTA'=>$conta_despesa,
        ':CATEGORIA'=>$categoria, 
    ));

    $resultado2 = $sql->select("CALL sp_lancamento_transferencia(:DESCRICAO_RECEITA, :TIPO_LANCAMENTO, :VALOR, :DATA_LANCAMENTO, :USUARIO, :CONTA, :CATEGORIA )", array(
        ':DESCRICAO_RECEITA'=>$apelido_receita,
        ':TIPO_LANCAMENTO'=>$tipo_lancamento_receita,
        ':VALOR'=>$valor,
        ':DATA_LANCAMENTO'=>$data_lancamento,
        ':USUARIO'=>$id_usuario,
        ':CONTA'=>$conta_receita,
        ':CATEGORIA'=>$categoria, 
    ));


    header('Location: /lancamento/historico');
    exit;


});
?>