<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Inicio do Conteúdo da Pagina -->
<main id="main" class="main pb-0">

  <!-- Inicio Título da Pagina -->
  <div class="pagetitle">
    <h1>Despesa Única ou Fixa</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="#">Lançamento</a></li>
        <li class="breadcrumb-item active"><a href="#">Nova Despesa</a></li>
        <li class="breadcrumb-item active">Despesa Única ou Fixa</li>
      </ol>
    </nav>
  </div>
  <!-- Fim Título da Pagina -->

  <section class="section">
    <div class="row justify-content-center">

      <div class="col-lg-12">

        <div class="card" style="min-height: 66vh;">
          <div class="card-body d-flex align-items-center">
            <div class="col-md-7">

              <form action="/lancamento/despesa/unica" method="post" class="row g-4 pt-4 pb-4 d-flex justify-content-center">

                <div class="col-md-10">
                  <label for="iduser" class="form-label visually-hidden">ID</label>
                  <input type="text" class="form-control visually-hidden" id="iduser" name="id_usuario"
                    value="<?php echo htmlspecialchars( $usuario["id_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                </div>

                <div class="col-md-10">
                  <label for="descricao_despesa" class="form-label">Descrição</label>
                  <input type="text" name="descricao" class="form-control" id="descricao_despesa" required>
                </div>

                <div class="col-md-3">
                  <label for="valor_despesa" class="form-label">Valor</label>
                  <input type="number" name="valor" placeholder="R$ 00,00" class="form-control" id="valor_despesa" required>
                </div>

                <div class="col-md-4">
                  <label for="contacartao_despesa" class="form-label">Tipo Despesa</label>
                  <select class="form-select" name="tipo_despesa" id="contacartao_despesa" required>
                    <option>Despesa</option>
                    <option>Despesa Fixa</option>
                  </select>
                </div>

                <div class="col-md-3">
                  <label for="data_despesa" class="form-label">Data da Despesa</label>
                  <input type="date" name="data_despesa" class="form-control" id="data_despesa" required>
                </div>


                <div class="col-md-5">
                  <label for="conta_usuario" class="form-label">Conta</label>
                  <select class="form-select" name="id_conta" id="conta_usuario">
                    <option value="">Opção conta não utilizada</option>
                    <?php $counter1=-1;  if( isset($conta) && ( is_array($conta) || $conta instanceof Traversable ) && sizeof($conta) ) foreach( $conta as $key1 => $value1 ){ $counter1++; ?>
                    <option><?php echo htmlspecialchars( $value1["apelido"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                    <?php } ?>
                  </select>
                </div>


                <div class="col-md-5">
                  <label for="cartao_usuario" class="form-label">Cartão</label>
                  <select class="form-select" name="id_cartao" id="cartao_usuario">
                    <option value="">Opção cartão não utilizada</option>
                    <?php $counter1=-1;  if( isset($cartao) && ( is_array($cartao) || $cartao instanceof Traversable ) && sizeof($cartao) ) foreach( $cartao as $key1 => $value1 ){ $counter1++; ?>
                    <option><?php echo htmlspecialchars( $value1["apelido"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                    <?php } ?>
                  </select>
                </div>


                <div class="col-md-10 mb-3">
                  <label for="categoria_despesa" class="form-label">Categoria</label>
                  <select class="form-select" name="id_categoria" id="contacartao_despesa" required>
                    <?php $counter1=-1;  if( isset($categoria) && ( is_array($categoria) || $categoria instanceof Traversable ) && sizeof($categoria) ) foreach( $categoria as $key1 => $value1 ){ $counter1++; ?>
                    <option><?php echo htmlspecialchars( $value1["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                    <?php } ?>
                  </select>
                </div>


                <div class="col-md-9 d-flex justify-content-center">
                  <button type="button" class="btn btn-secondary me-1">Cancelar</button>
                  <button type="submit" class="btn btn-success"
                    style="background-color: #E54640; border-color: #E54640;">Salvar Despesa</button>
                </div>

              </form>

            </div>
            <div class="col-md-5">
              <img src="../../res/site/assets/img/img_despesa_unica.png" alt="Despesa Única" style="max-height: 66vh;">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>
<!-- End #main -->