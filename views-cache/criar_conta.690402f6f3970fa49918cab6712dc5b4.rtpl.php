<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Inicio do Conteúdo da Pagina -->
<main id="main" class="main pb-0">

    <!-- Inicio Título da Pagina -->
    <div class="pagetitle">
      <h1>Cadastro de nova Conta</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="index.html">Carteira</a></li>
          <li class="breadcrumb-item active"><a href="lancamento_receita.html">Contas</a></li>
          <li class="breadcrumb-item active">Cadastrar Conta</li>
        </ol>
      </nav>
    </div>
    <!-- Fim Título da Pagina -->

    <section class="section" >
        <div class="row justify-content-center">

            <div class="col-lg-12">

                <div class="card" style="min-height: 66vh;">
                    <div class="card-body d-flex align-items-center">
                      <div class="col-md-7">
                        <form action="/conta/criar" method="post" class="row g-4 pt-2 pb-4 d-flex justify-content-center">

                            <div class="col-md-10">
                                <label for="apelido_conta" class="form-label">Nome ou Apelido</label>
                                <input type="text" class="form-control" name="apelido" id="apelido_conta" required>
                            </div>

                            <div class="col-md-5">
                                <label for="tipo_conta" class="form-label">Tipo Conta</label>

                                <select class="form-select" name="tipo_conta" id="tipo_conta" required>
                                    <option>Conta Digital</option>
                                    <option>Conta Poupança</option>
                                    <option>Conta Corrente</option>
                                    <option>Carteira Física</option>
                                </select>

                            </div>

                            <div class="col-md-5">
                                <label for="valor" class="form-label">Saldo Atual</label>
                                <input type="number" class="form-control" name="valor" id="valor" required>
                            </div>

                            <div class="col-md-10">
                                <label for="instituicao" class="form-label">Instituição Financeira</label>

                                <select class="form-select" name="instituicao" id="instituicao" required>
                                    <?php $counter1=-1;  if( isset($instituicao) && ( is_array($instituicao) || $instituicao instanceof Traversable ) && sizeof($instituicao) ) foreach( $instituicao as $key1 => $value1 ){ $counter1++; ?>
                                    <option><?php echo htmlspecialchars( $value1["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                    <?php } ?>
                                </select>

                            </div>

                            <div class="col-md-9 d-flex justify-content-center pt-3">
                              <a href="/conta" type="button" class="btn btn-secondary me-1">Voltar</a>
                              <button type="submit" class="btn btn-primary">Cadastrar Conta</button>
                            </div>
                        </form>
                      </div>   

                    <div class="col-md-5">
                        <img src="../res/site/assets/img/conta.png" alt="Conta" style="max-height: 60vh;">
                    </div> 

                    </div>
                </div>
            </div>
        </div>
    </section>

  </main><!-- End #main -->