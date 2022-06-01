<?php

// DEPENDÊNCIAS
use \Countpay\Page;
use \Countpay\DB\Sql;



/////////////////////////////////////////////////////////////
/* ******************* ROTA DO LOGIN ********************* */
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
/* ************** ROTA DO SESSION DESTROY **************** */
/////////////////////////////////////////////////////////////
$app->get('/sair', function() {

    // Dependências

    // Remover a sessão do usuário logado
    session_destroy();

    header('Location: /login');
    exit;

});



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



/////////////////////////////////////////////////////////////
/* ******************* ROTA DE CARTÃO ********************* */
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



/////////////////////////////////////////////////////////////
/* **************** ROTA DE CRIAR CARTAO ****************** */
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
/* *************** ROTA DE ALTERAR CONTA ***************** */
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
/* *************** ROTA DE EXCLUIR CARTÃO ***************** */
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



/////////////////////////////////////////////////////////////
/* ******************* ROTA DE CONTA ********************* */
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
/* **************** ROTA DE CRIAR CONTA ****************** */
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

    }

);



/////////////////////////////////////////////////////////////
/* *************** ROTA DE ALTERAR CONTA ***************** */
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
/* *************** POST DE ALTERAR CONTA ***************** */
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
/* *************** ROTA DE EXCLUIR CONTA ***************** */
/////////////////////////////////////////////////////////////
$app->get('/conta/:id_conta/delete', function($id_conta) {

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




/////////////////////////////////////////////////////////////
/* ********** ROTA DO HISTÓRICO DE LANÇAMENTO ************ */
/////////////////////////////////////////////////////////////
$app->get('/lancamento/historico', function() {

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

    // Select dos dados usado para gerar o histórico de lançamento
    $resultado = $sql->select("SELECT lancamento.descricao_lancamento, lancamento.tipo_lancamento, lancamento.valor, categoria.descricao, lancamento.data_lancamento, IF(conta.apelido <> NULL, NULL, conta.apelido) 'conta', cartao.apelido 'cartao', lancamento.quantidade_parcelas, lancamento.frequencia
    FROM lancamento															
    INNER JOIN categoria ON lancamento.id_categoria = categoria.id_categoria AND lancamento.id_usuario = :ID_USUARIO
    LEFT OUTER JOIN cartao ON lancamento.id_cartao = cartao.id_cartao
    LEFT OUTER JOIN conta ON lancamento.id_conta = conta.id_conta ORDER BY id_lancamento ASC" ,
    array(
        ":ID_USUARIO"=>$resultado_id
    ));

    // Template dentro de views arquivo: index.html
    $page->setTpl("historico_lancamento",
    // Dentro da pasta [views] o arquivo [historico_lancamento.html] está recebendo este array [$resultado] e exibido de acordo com o banco
    array(
        "resultado"=>$resultado
    ));

});



/////////////////////////////////////////////////////////////
/* ****** ROTA PARA ESCOLHER O LANÇAMENTO DESPESA ******** */
/////////////////////////////////////////////////////////////
$app->get('/lancamento/despesa', function() {

    // Dependências
    $page = new Page();

    // Verificar login, caso não foi efetuado é redirecionado para login
    if (!isset($_SESSION['usuario']))
    {
        header('Location: /login');
        exit;
    }   

    // Template dentro de views arquivo: lancamento_receita.html
    $page->setTpl("lancamento_despesa");  
    
});



/////////////////////////////////////////////////////////////
/* ******* ROTA DE LANÇAMENTO DESPESA ÚNICO OU FIXO ****** */
/////////////////////////////////////////////////////////////
$app->get('/lancamento/despesa/unica', function() {

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

    // Selects dos dados usado para o usuário selecionar dentro do cadastro de receita única ou fixa
    $usuario = $sql->select("SELECT id_usuario FROM usuario WHERE id_usuario = :ID_USUARIO", array(":ID_USUARIO"=>$resultado_id)); 
    $categoria = $sql->select("SELECT descricao FROM categoria WHERE id_categoria > 4 ORDER BY descricao ASC");
    $conta = $sql->select("SELECT apelido FROM conta WHERE id_usuario = :ID_USUARIO", array(":ID_USUARIO"=>$resultado_id));
    $cartao = $sql->select("SELECT apelido FROM cartao WHERE id_usuario = :ID_USUARIO", array(":ID_USUARIO"=>$resultado_id));

    // Template dentro de views arquivo: lancamento_receita_unica.html 
    $page->setTpl("lancamento_despesa_unica",

    // Dentro da pasta [views] o arquivo [lancamento_receita_unica.html] está recebendo estes arrays:
    // [$usuario, $categoria, $conta, $cartao e $tipo_receita] e exibido de acordo com o banco
    array(
        "usuario"=>$usuario[0],
        "categoria"=>$categoria,
        "conta"=>$conta,
        "cartao"=>$cartao
    )); 

});



/////////////////////////////////////////////////////////////
/* ********* ROTA DO LANCAMENTO DESPESA PARCELADO ******** */
/////////////////////////////////////////////////////////////
$app->get('/lancamento/despesa/parcelado', function() {

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

    // Selects dos dados usado para o usuário selecionar dentro do cadastro de receita parcelado
    $usuario = $sql->select("SELECT id_usuario FROM usuario WHERE id_usuario = :ID_USUARIO", array(":ID_USUARIO"=>$resultado_id)); 
    $categoria = $sql->select("SELECT descricao FROM categoria WHERE id_categoria > 4 ORDER BY id_categoria ASC");
    $conta = $sql->select("SELECT apelido FROM conta WHERE id_usuario = :ID_USUARIO", array(":ID_USUARIO"=>$resultado_id));
    $cartao = $sql->select("SELECT apelido FROM cartao WHERE id_usuario = :ID_USUARIO", array(":ID_USUARIO"=>$resultado_id));
    $frequencia = $sql->select("SELECT descricao FROM frequencia");
    
    // Template dentro de views arquivo: lancamento_despesa_parcelado.html 
    $page->setTpl("lancamento_despesa_parcelado",
    
    // Dentro da pasta [views] o arquivo [lancamento_despesa_parcelado.html] está recebendo estes arrays:
    // [$usuario, $categoria, $conta, $cartao, $frequenciae $tipo] e exibido de acordo com o banco
    // Tratar $usuario quando não obter nenhum registro
    array(
        "usuario"=>$usuario[0],
        "categoria"=>$categoria,
        "conta"=>$conta,
        "cartao"=>$cartao,
        "frequencia"=>$frequencia
    ));

});



/////////////////////////////////////////////////////////////
/* ************** POST RECEITA PARCELADA ***************** */
/////////////////////////////////////////////////////////////
$app->post('/lancamento/despesa/parcelado', function() {

    // Dependências
    $sql = new Sql();

    // Coletando dados do front-end que está dentro do diretório [views][arquivo][lancamento_despesa_parcelado.html]
    $id_usuario = $_POST['id_usuario'];
    $tipo_lancamento = $_POST['tipo_despesa'];
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $parcela = $_POST['parcela'];
    $data_despesa = $_POST['data_despesa'];
    $frequencia = $_POST['frequencia'];
    $desc_conta = $_POST['id_conta'];
    $desc_cartao = $_POST['id_cartao'];
    $desc_categoria = $_POST['id_categoria'];

    // Consulta no banco de dados para a conversão de string recebido do front-end para o ID dos campos selecionados
    $resultado_conta = $sql->select("SELECT id_conta FROM conta WHERE apelido = :APELIDO AND id_usuario = :ID_USUARIO",
    array (
    ":APELIDO"=>$desc_conta,
    ':ID_USUARIO'=>$id_usuario
    ));

    $resultado_cartao = $sql->select("SELECT id_cartao FROM cartao WHERE apelido = :APELIDO AND id_usuario = :ID_USUARIO",
    array (
    ":APELIDO"=>$desc_cartao,
    ':ID_USUARIO'=>$id_usuario
    ));

    $resultado_categoria = $sql->select("SELECT id_categoria FROM categoria WHERE descricao = :DESCRICAO",
    array (
    ":DESCRICAO"=>$desc_categoria
    ));


    // Verificação se os dados foi recebido, se sim realizar o armazenamento do id selecionado pelo usuário, caso não foi selecionado o campo fica vazio
    if (!empty($resultado_conta)){
        $conta = $resultado_conta[0]['id_conta'];
    } else {
        $conta = NULL;
    }

    if (!empty($resultado_cartao)){
        $cartao = $resultado_cartao[0]['id_cartao'];
    } else {
        $cartao = NULL;
    }

    if (!empty($resultado_categoria)){
        $categoria = $resultado_categoria[0]['id_categoria'];
    } else {
        $categoria = NULL;
    }

    // Caso o valor de parcelas seja maior que 1 vai entrar na função
    if ($parcela > 1 ) {

        // Valor é dividido pelo numero de parcelas
        $valor = ($valor / $parcela);

        // Analisa se a frequência é dias ou mês
        if ($frequencia == 'Semanalmente' || $frequencia == 'Quinzenalmente')
        {

            // Select para coleta a quantidade de [dias] selecionado pelo usuário
            $quantidade = $sql->select("SELECT dias FROM frequencia WHERE descricao = :FREQUENCIA", array(
                ':FREQUENCIA'=>$frequencia
            ));

            // A variável quantAux serve para receber o dado do array de cima e converter a mesma para string
            $quantAux = $quantidade[0]['dias'];

        } else {
        // So executa caso o usuário selecione as opções de mês em diante 

            // Select para coleta a quantidade de [meses] selecionado pelo usuário
            $quantidade = $sql->select("SELECT mes FROM frequencia WHERE descricao = :FREQUENCIA", array(
                ':FREQUENCIA'=>$frequencia
            ));

            // A variável quantAux serve para receber o dado do array de cima e converter a mesma para string
            $quantAux = $quantidade[0]['mes'];

        }

        // Esquema de looping para a quantidade de parcelas
        // Contador que soma de 1 em 1 até ser menor que $parcela
        for ($i=1; $i < $parcela+1; $i++) {

            // Realizar o lançamento dos dados, retornando para o array [resultado] o id do lançamento [id_lancamento]
            $resultado = $sql->select("CALL sp_lancamento_parcelado(:ID_USUARIO, :TIPO_LANCAMENTO, :DESCRICAO, :VALOR, :PARCELA, :DATA_LANCAMENTO, :FREQUENCIA, :ID_CONTA, :ID_CARTAO, :ID_CATEGORIA)", array(
                ':ID_USUARIO'=>$id_usuario,
                ':TIPO_LANCAMENTO'=>$tipo_lancamento,
                ':DESCRICAO'=>$descricao,
                ':VALOR'=>$valor,
                ':PARCELA'=>$i.' / '.$parcela,
                ':DATA_LANCAMENTO'=>$data_despesa,
                ':FREQUENCIA'=>$frequencia,
                ':ID_CONTA'=>$conta,
                ':ID_CARTAO'=>$cartao,
                ':ID_CATEGORIA'=>$categoria
            ));

            // quant recebe a quantidade de dias ou mês (depende da seleção do usuário) multiplicada pelo contador
            $quant = $quantAux * ($i-1);

            // Verificação para saber como é necessário inserir as tabelas (dia ou mês)
            // (Motivo: "INTERVAL X MONTH/DAY")
            if ($frequencia == 'Semanalmente' || $frequencia == 'Quinzenalmente')
            {

                // Inserção da parcela com a soma de semana ou quinzena no campo (data_lancamento)
                $sql->execQuery("UPDATE lancamento SET data_lancamento = date_add(data_lancamento, INTERVAL :DIAS DAY)
                WHERE id_lancamento = :ID_LANCAMENTO;", 
                array(
                    ':ID_LANCAMENTO'=> $resultado[0]['id_lancamento'],
                    ':DIAS'=> $quant
                ));

            } else {

                // Inserção da parcela com a soma de meses no campo (data_lancamento)
                $sql->execQuery("UPDATE lancamento SET data_lancamento = date_add(data_lancamento, INTERVAL :DIAS MONTH)
                WHERE id_lancamento = :ID_LANCAMENTO;", 
                array(
                    ':ID_LANCAMENTO'=> $resultado[0]['id_lancamento'],
                    ':DIAS'=> $quant
                ));
            }
        }

    } else { 
        // Caso o usuário preencha uma unica parcela
        $resultado = $sql->select("CALL sp_lancamento_parcelado(:ID_USUARIO, :TIPO_LANCAMENTO, :DESCRICAO, :VALOR, :PARCELA, :DATA_LANCAMENTO, :FREQUENCIA, :ID_CONTA, :ID_CARTAO, :ID_CATEGORIA)", array(
            ':ID_USUARIO'=>$id_usuario,
            ':TIPO_LANCAMENTO'=>$tipo_lancamento,
            ':DESCRICAO'=>$descricao,
            ':VALOR'=>$valor,
            ':PARCELA'=>$parcela,
            ':DATA_LANCAMENTO'=>$data_despesa,
            ':FREQUENCIA'=>$frequencia,
            ':ID_CONTA'=>$conta,
            ':ID_CARTAO'=>$cartao,
            ':ID_CATEGORIA'=>$categoria
        ));

    }

    

    // Caso a inserção foi realizada o sistema retorna uma mensagem informativa
    if ($resultado > 0) {
        echo "<script language='javascript' type='text/javascript'>
        alert('Despesa realizada com sucesso!');window.location.href='/lancamento/historico';</script>";
    }

});



/////////////////////////////////////////////////////////////
/* ************ POST RECEITA UNICA OU FIXA *************** */
/////////////////////////////////////////////////////////////
$app->post('/lancamento/despesa/unica', function() {

    // Dependências
    $sql = new Sql();

    // Coletando dados do front-end que está dentro do diretório [views][arquivo][lancamento_receita_unica.html]
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $tipo_lancamento = $_POST['tipo_despesa'];
    $data_lancamento = $_POST['data_despesa'];
    $id_usuario = $_POST['id_usuario'];
    $desc_conta = $_POST['id_conta'];
    $desc_cartao = $_POST['id_cartao'];
    $desc_categoria = $_POST['id_categoria'];

    // Armazena o ID do usuário de acordo com o login e guarda na variável (usuario)
    $usuario = $_SESSION['usuario'];

    // Consulta no banco de dados para a conversão de string recebido do front-end para o ID dos campos selecionados
    $resultado_conta = $sql->select("SELECT id_conta FROM conta WHERE apelido = :APELIDO AND id_usuario = :ID_USUARIO",
    array (
    ":APELIDO"=>$desc_conta,
    ':ID_USUARIO'=>$usuario
    ));

    $resultado_cartao = $sql->select("SELECT id_cartao FROM cartao WHERE apelido = :APELIDO AND id_usuario = :ID_USUARIO",
    array (
    ":APELIDO"=>$desc_cartao,
    ':ID_USUARIO'=>$usuario
    ));

    $resultado_categoria = $sql->select("SELECT id_categoria FROM categoria WHERE descricao = :DESCRICAO",
    array (
    ":DESCRICAO"=>$desc_categoria
    ));

    // Verificação se os dados foi recebido, se sim realizar o armazenamento do id selecionado pelo usuário, caso não foi selecionado o campo fica vazio
    if (!empty($resultado_conta)){
        $conta = $resultado_conta[0]['id_conta'];
    } else {
        $conta = NULL;
    }

    if (!empty($resultado_cartao)){
        $cartao = $resultado_cartao[0]['id_cartao'];
    } else {
        $cartao = NULL;
    }

    if (!empty($resultado_categoria)){
        $categoria = $resultado_categoria[0]['id_categoria'];
    } else {
        $categoria = NULL;
    }

    // Realiza a inserção dos dados na tabela através do front-end, recebendo os dados digitados (inclusive os convertidos para id nos ifs de cima)
    $resultado = $sql->select("CALL sp_lancamento_normal(:ID_USUARIO, :DESCRICAO, :VALOR, :TIPO_LANCAMENTO, :DATA_LANCAMENTO, :ID_CONTA, :ID_CARTAO, :ID_CATEGORIA)", array(
        ':ID_USUARIO'=>$id_usuario,
        ':DESCRICAO'=>$descricao,
        ':VALOR'=>$valor,
        ':TIPO_LANCAMENTO'=>$tipo_lancamento,
        ':DATA_LANCAMENTO'=>$data_lancamento,
        ':ID_CONTA'=>$conta,
        ':ID_CARTAO'=>$cartao,
        ':ID_CATEGORIA'=>$categoria
    ));

    // Caso a variável resultado recebeu algum valor, retorna uma mensagem de inserção realizada
    if ($resultado > 0) {

        echo "<script language='javascript' type='text/javascript'>
        alert('Lançamento realizado com sucesso!');window.location.href='/lancamento/historico';</script>";

    } else {
    // Caso alguma informação ficou pendente, retorna a mensagem 
        echo "<script language='javascript' type='text/javascript'>
        alert('Algo deu errado! Tente novamente...');window.location.href='/';</script>";

    }

});



/////////////////////////////////////////////////////////////
/* ****** ROTA PARA ESCOLHER O LANÇAMENTO RECEITA ******** */
/////////////////////////////////////////////////////////////
$app->get('/lancamento/receita', function() {

    // Dependências
    $page = new Page();

    // Verificar login, caso não foi efetuado é redirecionado para login
    if (!isset($_SESSION['usuario']))
    {
        header('Location: /login');
        exit;
    }   

    // Template dentro de views arquivo: lancamento_receita.html
    $page->setTpl("lancamento_receita");  
    
});




/////////////////////////////////////////////////////////////
/* ********** ROTA DE LANÇAMENTO ÚNICO OU FIXO *********** */
/////////////////////////////////////////////////////////////
$app->get('/lancamento/receita/unica', function() {

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

    // Selects dos dados usado para o usuário selecionar dentro do cadastro de receita única ou fixa
    $usuario = $sql->select("SELECT id_usuario FROM usuario WHERE id_usuario = :ID_USUARIO", array(":ID_USUARIO"=>$resultado_id)); 
    $categoria = $sql->select("SELECT descricao FROM categoria WHERE id_categoria < 5 ORDER BY id_categoria ASC");
    $conta = $sql->select("SELECT apelido FROM conta WHERE id_usuario = :ID_USUARIO", array(":ID_USUARIO"=>$resultado_id));
    $cartao = $sql->select("SELECT apelido FROM cartao WHERE id_usuario = :ID_USUARIO", array(":ID_USUARIO"=>$resultado_id));

    // Template dentro de views arquivo: lancamento_receita_unica.html 
    $page->setTpl("lancamento_receita_unica",

    // Dentro da pasta [views] o arquivo [lancamento_receita_unica.html] está recebendo estes arrays:
    // [$usuario, $categoria, $conta, $cartao e $tipo_receita] e exibido de acordo com o banco
    array(
        "usuario"=>$usuario[0],
        "categoria"=>$categoria,
        "conta"=>$conta,
        "cartao"=>$cartao
    )); 

});




/////////////////////////////////////////////////////////////
/* ************ ROTA DO LANCAMENTO PARCELADO ************* */
/////////////////////////////////////////////////////////////
$app->get('/lancamento/receita/parcelado', function() {

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

    // Selects dos dados usado para o usuário selecionar dentro do cadastro de receita parcelado
    $usuario = $sql->select("SELECT id_usuario FROM usuario WHERE id_usuario = :ID_USUARIO", array(":ID_USUARIO"=>$resultado_id)); 
    $categoria = $sql->select("SELECT descricao FROM categoria WHERE id_categoria < 5 ORDER BY id_categoria ASC");
    $conta = $sql->select("SELECT apelido FROM conta WHERE id_usuario = :ID_USUARIO", array(":ID_USUARIO"=>$resultado_id));
    $cartao = $sql->select("SELECT apelido FROM cartao WHERE id_usuario = :ID_USUARIO", array(":ID_USUARIO"=>$resultado_id));
    $frequencia = $sql->select("SELECT descricao FROM frequencia");
    
    // Template dentro de views arquivo: lancamento_receita_parcelado.html 
    $page->setTpl("lancamento_receita_parcelado",
    
    // Dentro da pasta [views] o arquivo [lancamento_receita_parcelado.html] está recebendo estes arrays:
    // [$usuario, $categoria, $conta, $cartao, $frequenciae $tipo] e exibido de acordo com o banco
    // Tratar $usuario quando não obter nenhum registro
    array(
        "usuario"=>$usuario[0],
        "categoria"=>$categoria,
        "conta"=>$conta,
        "cartao"=>$cartao,
        "frequencia"=>$frequencia
    ));

});


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// METODOS POST     METODOS POST        METODOS POST        METODOS POST        METODOS POST        METODOS POST        METODOS POST        METODOS POST        METODOS POST        METODOS POST
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////
/* ************ POST DO LOGIN ADMINISTRADOR ************** */
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
/* ************ POST RECEITA UNICA OU FIXA *************** */
/////////////////////////////////////////////////////////////
$app->post('/lancamento/receita/unica', function() {

    // Dependências
    $sql = new Sql();

    // Coletando dados do front-end que está dentro do diretório [views][arquivo][lancamento_receita_unica.html]
    $descricao = $_POST['descricao'];
    $tipo_lancamento = $_POST['tipo_receita'];
    $valor = $_POST['valor'];
    $data_lancamento = $_POST['data_receita'];
    $id_usuario = $_POST['id_usuario'];
    $desc_conta = $_POST['id_conta'];
    $desc_cartao = $_POST['id_cartao'];
    $desc_categoria = $_POST['id_categoria'];

    // Armazena o ID do usuário de acordo com o login e guarda na variável (usuario)
    $usuario = $_SESSION['usuario'];

    // Consulta no banco de dados para a conversão de string recebido do front-end para o ID dos campos selecionados
    $resultado_conta = $sql->select("SELECT id_conta FROM conta WHERE apelido = :APELIDO AND id_usuario = :ID_USUARIO",
    array (
    ":APELIDO"=>$desc_conta,
    ':ID_USUARIO'=>$usuario
    ));

    $resultado_cartao = $sql->select("SELECT id_cartao FROM cartao WHERE apelido = :APELIDO AND id_usuario = :ID_USUARIO",
    array (
    ":APELIDO"=>$desc_cartao,
    ':ID_USUARIO'=>$usuario
    ));

    $resultado_categoria = $sql->select("SELECT id_categoria FROM categoria WHERE descricao = :DESCRICAO",
    array (
    ":DESCRICAO"=>$desc_categoria
    ));

    // Verificação se os dados foi recebido, se sim realizar o armazenamento do id selecionado pelo usuário, caso não foi selecionado o campo fica vazio
    if (!empty($resultado_conta)){
        $conta = $resultado_conta[0]['id_conta'];
    } else {
        $conta = NULL;
    }

    if (!empty($resultado_cartao)){
        $cartao = $resultado_cartao[0]['id_cartao'];
    } else {
        $cartao = NULL;
    }

    if (!empty($resultado_categoria)){
        $categoria = $resultado_categoria[0]['id_categoria'];
    } else {
        $categoria = NULL;
    }

    // Realiza a inserção dos dados na tabela através do front-end, recebendo os dados digitados (inclusive os convertidos para id nos ifs de cima)
    $resultado = $sql->select("CALL sp_lancamento_normal(:ID_USUARIO, :DESCRICAO, :VALOR, :TIPO_LANCAMENTO, :DATA_LANCAMENTO, :ID_CONTA, :ID_CARTAO, :ID_CATEGORIA)", array(
        ':ID_USUARIO'=>$id_usuario,
        ':DESCRICAO'=>$descricao,
        ':VALOR'=>$valor,
        ':TIPO_LANCAMENTO'=>$tipo_lancamento,
        ':DATA_LANCAMENTO'=>$data_lancamento,
        ':ID_CONTA'=>$conta,
        ':ID_CARTAO'=>$cartao,
        ':ID_CATEGORIA'=>$categoria
    ));

    // Caso a variável resultado recebeu algum valor, retorna uma mensagem de inserção realizada
    if ($resultado > 0) {

        echo "<script language='javascript' type='text/javascript'>
        alert('Receita realizada com sucesso!');window.location.href='/lancamento/historico';</script>";

    } else {
    // Caso alguma informação ficou pendente, retorna a mensagem 
        echo "<script language='javascript' type='text/javascript'>
        alert('Algo deu errado! Tente novamente...');window.location.href='/';</script>";

    }

});


/////////////////////////////////////////////////////////////
/* ************** POST RECEITA PARCELADA ***************** */
/////////////////////////////////////////////////////////////
$app->post('/lancamento/receita/parcelado', function() {

    // Dependências
    $sql = new Sql();

    // Coletando dados do front-end que está dentro do diretório [views][arquivo][lancamento_receita_parcelado.html]
    $id_usuario = $_POST['id_usuario'];
    $tipo_lancamento = $_POST['tipo_receita'];
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $parcela = $_POST['parcela'];
    $data_receita = $_POST['data_receita'];
    $frequencia = $_POST['frequencia'];
    $desc_conta = $_POST['id_conta'];
    $desc_cartao = $_POST['id_cartao'];
    $desc_categoria = $_POST['id_categoria'];

    // Consulta no banco de dados para a conversão de string recebido do front-end para o ID dos campos selecionados
    $resultado_conta = $sql->select("SELECT id_conta FROM conta WHERE apelido = :APELIDO AND id_usuario = :ID_USUARIO",
    array (
    ":APELIDO"=>$desc_conta,
    ':ID_USUARIO'=>$id_usuario
    ));

    $resultado_cartao = $sql->select("SELECT id_cartao FROM cartao WHERE apelido = :APELIDO AND id_usuario = :ID_USUARIO",
    array (
    ":APELIDO"=>$desc_cartao,
    ':ID_USUARIO'=>$id_usuario
    ));

    $resultado_categoria = $sql->select("SELECT id_categoria FROM categoria WHERE descricao = :DESCRICAO",
    array (
    ":DESCRICAO"=>$desc_categoria
    ));


    // Verificação se os dados foi recebido, se sim realizar o armazenamento do id selecionado pelo usuário, caso não foi selecionado o campo fica vazio
    if (!empty($resultado_conta)){
        $conta = $resultado_conta[0]['id_conta'];
    } else {
        $conta = NULL;
    }

    if (!empty($resultado_cartao)){
        $cartao = $resultado_cartao[0]['id_cartao'];
    } else {
        $cartao = NULL;
    }

    if (!empty($resultado_categoria)){
        $categoria = $resultado_categoria[0]['id_categoria'];
    } else {
        $categoria = NULL;
    }

    // Caso o valor de parcelas seja maior que 1 vai entrar na função
    if ($parcela > 1 ) {

        // Valor é dividido pelo numero de parcelas
        $valor = ($valor / $parcela);

        // Analisa se a frequência é dias ou mês
        if ($frequencia == 'Semanalmente' || $frequencia == 'Quinzenalmente')
        {

            // Select para coleta a quantidade de [dias] selecionado pelo usuário
            $quantidade = $sql->select("SELECT dias FROM frequencia WHERE descricao = :FREQUENCIA", array(
                ':FREQUENCIA'=>$frequencia
            ));

            // A variável quantAux serve para receber o dado do array de cima e converter a mesma para string
            $quantAux = $quantidade[0]['dias'];

        } else {
        // So executa caso o usuário selecione as opções de mês em diante 

            // Select para coleta a quantidade de [meses] selecionado pelo usuário
            $quantidade = $sql->select("SELECT mes FROM frequencia WHERE descricao = :FREQUENCIA", array(
                ':FREQUENCIA'=>$frequencia
            ));

            // A variável quantAux serve para receber o dado do array de cima e converter a mesma para string
            $quantAux = $quantidade[0]['mes'];

        }

        // Esquema de looping para a quantidade de parcelas
        // Contador que soma de 1 em 1 até ser menor que $parcela
        for ($i=1; $i < $parcela+1; $i++) {

            // Realizar o lançamento dos dados, retornando para o array [resultado] o id do lançamento [id_lancamento]
            $resultado = $sql->select("CALL sp_lancamento_parcelado(:ID_USUARIO, :TIPO_LANCAMENTO, :DESCRICAO, :VALOR, :PARCELA, :DATA_LANCAMENTO, :FREQUENCIA, :ID_CONTA, :ID_CARTAO, :ID_CATEGORIA)", array(
                ':ID_USUARIO'=>$id_usuario,
                ':TIPO_LANCAMENTO'=>$tipo_lancamento,
                ':DESCRICAO'=>$descricao,
                ':VALOR'=>$valor,
                ':PARCELA'=>$i.' / '.$parcela,
                ':DATA_LANCAMENTO'=>$data_receita,
                ':FREQUENCIA'=>$frequencia,
                ':ID_CONTA'=>$conta,
                ':ID_CARTAO'=>$cartao,
                ':ID_CATEGORIA'=>$categoria
            ));

            // quant recebe a quantidade de dias ou mês (depende da seleção do usuário) multiplicada pelo contador
            $quant = $quantAux * ($i-1);

            // Verificação para saber como é necessário inserir as tabelas (dia ou mês)
            // (Motivo: "INTERVAL X MONTH/DAY")
            if ($frequencia == 'Semanalmente' || $frequencia == 'Quinzenalmente')
            {

                // Inserção da parcela com a soma de semana ou quinzena no campo (data_lancamento)
                $sql->execQuery("UPDATE lancamento SET data_lancamento = date_add(data_lancamento, INTERVAL :DIAS DAY)
                WHERE id_lancamento = :ID_LANCAMENTO;", 
                array(
                    ':ID_LANCAMENTO'=> $resultado[0]['id_lancamento'],
                    ':DIAS'=> $quant
                ));

            } else {

                // Inserção da parcela com a soma de meses no campo (data_lancamento)
                $sql->execQuery("UPDATE lancamento SET data_lancamento = date_add(data_lancamento, INTERVAL :DIAS MONTH)
                WHERE id_lancamento = :ID_LANCAMENTO;", 
                array(
                    ':ID_LANCAMENTO'=> $resultado[0]['id_lancamento'],
                    ':DIAS'=> $quant
                ));
            }
        }

    } else { 
        // Caso o usuário preencha uma unica parcela
        $resultado = $sql->select("CALL sp_lancamento_parcelado(:ID_USUARIO, :TIPO_LANCAMENTO, :DESCRICAO, :VALOR, :PARCELA, :DATA_LANCAMENTO, :FREQUENCIA, :ID_CONTA, :ID_CARTAO, :ID_CATEGORIA)", array(
            ':ID_USUARIO'=>$id_usuario,
            ':TIPO_LANCAMENTO'=>$tipo_lancamento,
            ':DESCRICAO'=>$descricao,
            ':VALOR'=>$valor,
            ':PARCELA'=>$parcela,
            ':DATA_LANCAMENTO'=>$data_receita,
            ':FREQUENCIA'=>$frequencia,
            ':ID_CONTA'=>$conta,
            ':ID_CARTAO'=>$cartao,
            ':ID_CATEGORIA'=>$categoria
        ));

    }

    

    // Caso a inserção foi realizada o sistema retorna uma mensagem informativa
    if ($resultado > 0) {
        echo "<script language='javascript' type='text/javascript'>
        alert('Receita realizada com sucesso!');window.location.href='/lancamento/historico';</script>";
    }

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

    }

);



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
?>