<?php if(!class_exists('Rain\Tpl')){exit;}?>  <!-- Inicio do Conteúdo da Pagina -->
  <main id="main" class="main">

    <!-- Inicio Título da Pagina -->
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div>
    <!-- Fim Título da Pagina -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Inicio Receita -->
            <div class="col-md-4 col-lg-3" action="/admin">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Usuários </br> <span>Cadastrado no sistema</span></h5>
                  <div class="d-flex align-items-center">
                    <a href="lista_usuarios.html">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="ri ri-user-follow-fill"></i>
                    </div>
                    </a>
                    <div class="ps-3">
                      <h6><?php echo htmlspecialchars( $usuarioDados["quantidade_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h6>
                      <span class="text-muted small pt-2 ps-1">Usuários cadastrados</span>
                    </div>
                  </div>

                </div>

              </div>
            </div>
            <!-- Fim Receita -->

            <!-- Inicio Transferência -->
            <div class="col-md-4 col-lg-3" action="/admin">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Contas</br><span>Cadastrados no sistema</span></h5>

                  <div class="d-flex align-items-center">
                    <a href="#">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="ri ri-bank-fill" style="color: #0AA8D0;"></i>
                    </div>
                    </a>
                    <div class="ps-3">
                      <h6><?php echo htmlspecialchars( $contaDados["quantidade_conta"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h6>
                      <span class="text-muted small pt-2 ps-1">Contas cadastradas</span>

                    </div>
                  </div>

                </div>
              </div>

            </div>
            <!-- Fim Transferência -->

            <!-- Inicio Transferência -->
            <div class="col-md-4 col-lg-3" action="/admin">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Cartões</br><span>Cadastrados no sistema</span></h5>

                  <div class="d-flex align-items-center">
                    <a href="#">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bx bxs-credit-card" style="color: orange"></i>
                    </div>
                    </a>
                    <div class="ps-3">
                      <h6><?php echo htmlspecialchars( $cartaoDados["quantidade_cartao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h6>
                      <span class="text-muted small pt-2 ps-1">Cartões cadastrados</span>

                    </div>
                  </div>

                </div>
              </div>

            </div>
            <!-- Fim Transferência -->

            <!-- Inicio Transferência -->
            <div class="col-md-4 col-lg-3" action="/admin">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Lançamentos</br><span>Este mês</span></h5>

                  <div class="d-flex align-items-center">
                    <a href="#">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bx bx-dollar" style="color: orangered;"></i>
                    </div>
                    </a>
                    <div class="ps-3">
                      <h6>R$ <?php echo htmlspecialchars( $lancamentoDados["lancamento_total"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h6>
                      <span class="text-muted small pt-2 ps-1">Lançamentos Realizados</span>

                    </div>
                  </div>

                </div>
              </div>

            </div>
            <!-- Fim Transferência -->
          </div>
    </section>

  </main>
  <!-- Fim Conteúdo -->