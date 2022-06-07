<?php

// DEPENDÊNCIAS
use \Countpay\Page;
use \Countpay\DB\Sql;

/////////////////////////////////////////////////////////////
/* ********** GET - ESCOLHER LANÇAMENTO RECEITA ********** */
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
/* *********** GET - LANÇAMENTO RECEITA ÚNICA ************ */
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
/* ********** POST - LANÇAMENTO RECEITA ÚNICA ************ */
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
/* ********* GET - ROTA DO LANCAMENTO PARCELADO ********** */
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


/////////////////////////////////////////////////////////////
/* ************* POST -  RECEITA PARCELADA *************** */
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


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////
/* ******** GET - ESCOLHER O LANÇAMENTO DESPESA ********** */
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
/* ************ GET - LANÇAMENTO DESPESA ÚNICA *********** */
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
/* *********** POST - LANÇAMENTO DESPESA ÚNICA ************** */
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
/* ************* GET - ROTA DESPESA PARCELADO ************ */
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
/* ************* POST - ROTA DESPESA PARCELADO *********** */
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


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////
/* ******** GET - ROTA DO HISTÓRICO DE LANÇAMENTO ******** */
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
    $resultado = $sql->select("SELECT lancamento.id_lancamento, lancamento.descricao_lancamento, lancamento.tipo_lancamento, lancamento.valor, categoria.descricao, lancamento.data_lancamento, IF(conta.apelido <> NULL, NULL, conta.apelido) 'conta', cartao.apelido 'cartao', lancamento.quantidade_parcelas, lancamento.frequencia
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


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////
/* ************ GET - ROTA DE EXCLUIR CARTÃO ************* */
/////////////////////////////////////////////////////////////
$app->get('/lancamento/:id_lancamento/delete', function($id_lancamento) {

    $sql = new Sql();
    
    // Armazena o ID da conta dentro da variável (idColetado)
    $idColetado = $id_lancamento;

    var_dump($idColetado);

     // Executa e exclusão da linha de acordo com o ID da conta coletado
    $sql->execQuery("DELETE FROM lancamento WHERE id_lancamento = :ID_LANCAMENTO", array(

        ':ID_LANCAMENTO'=>$idColetado

    ));

    // RETORNO QUE O USUÁRIO FOI EXCLUIDO COM SUCESSO
    echo "<script language='javascript' type='text/javascript'>
    alert('Lançamento excluído com sucesso!');window.location.href='/lancamento/historico';</script>";

});

?>