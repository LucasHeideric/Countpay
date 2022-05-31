<?php if(!class_exists('Rain\Tpl')){exit;}?> <!-- Inicio do Conteúdo da Pagina -->
 <main id="main" class="main pb-0">

    <!-- Inicio Título da Pagina -->
    <div class="pagetitle">
      <h1>Receita Parcelada</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
          <li class="breadcrumb-item active"><a href="index.html">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="lancamento_despesa.html">Nova Receita</a></li>
          <li class="breadcrumb-item active">Receita Parcelada</li>
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
                        <form action="/lancamento/receita/parcelado" method="post" class="row g-4 pt-4 pb-4 d-flex justify-content-center">

                            <div class="col-md-10">
                              <label for="iduser" class="form-label visually-hidden">ID</label>
                              <input type="text" class="form-control visually-hidden" id="iduser" name="id_usuario" value="<?php echo htmlspecialchars( $usuario["id_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                            </div>

                            <div class="col-md-10">
                              <label for="receita" class="form-label visually-hidden">Tipo Receita</label>
                              <input type="text" class="form-control visually-hidden" id="receita" name="tipo_receita" value="Receita Parcelada">
                            </div>

                            <div class="col-md-10">
                                <label for="descricao_receita" class="form-label">Descrição</label>
                                <input type="text" class="form-control" name="descricao" id="descricao_receita">
                            </div>

                            <div class="col-md-5">
                                <label for="valor_receita" class="form-label">Valor Total</label>
                                <input type="number" placeholder="R$ 00,00" name="valor"  class="form-control" id="valor_receita">
                            </div>

                            <div class="col-md-5" style="margin-top: auto;">
                                <label for="parcelas_receita" class="form-label">Parcelas</label>
                                <input type="number" placeholder="Lançar com divisão em pelo menos 2x" class="form-control" name="parcela" id="parcelas_receita">
                            </div>

                            <div class="col-md-5">
                                <label for="data_despesa_receita" class="form-label">Data da Receita</label>
                                <input type="date" class="form-control" name="data_receita" id="data_despesa_receita">
                            </div>

                            <div class="col-md-5">
                                <label for="frequencia_receita" class="form-label">Frequência</label>
                                <select class="form-select" name="frequencia" id="frequencia_receita" required>
                                  <?php $counter1=-1;  if( isset($frequencia) && ( is_array($frequencia) || $frequencia instanceof Traversable ) && sizeof($frequencia) ) foreach( $frequencia as $key1 => $value1 ){ $counter1++; ?>

                                  <option><?php echo htmlspecialchars( $value1["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                  <?php } ?>

                                </select>
                            </div>


                            <div class="col-md-5">
                                <label for="contacartao_receita" class="form-label">Conta</label>
                                <select class="form-select" name="id_conta" id="contacartao_receita">
                                  <option value="">Opção conta não utilizada</option>
                                  <?php $counter1=-1;  if( isset($conta) && ( is_array($conta) || $conta instanceof Traversable ) && sizeof($conta) ) foreach( $conta as $key1 => $value1 ){ $counter1++; ?>

                                  <option><?php echo htmlspecialchars( $value1["apelido"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                  <?php } ?>

                                </select>
                            </div>

                            <div class="col-md-5">
                              <label for="contacartao_receita" class="form-label">Cartão</label>
                              <select class="form-select" name="id_cartao" id="contacartao_receita">
                                <option value="">Opção cartão não utilizada</option>
                                <?php $counter1=-1;  if( isset($cartao) && ( is_array($cartao) || $cartao instanceof Traversable ) && sizeof($cartao) ) foreach( $cartao as $key1 => $value1 ){ $counter1++; ?>

                                <option><?php echo htmlspecialchars( $value1["apelido"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                <?php } ?>

                              </select>
                          </div>

                            <div class="col-md-10 mb-3">
                                <label for="categoria_despesa" class="form-label">Categoria</label>
                                <select class="form-select" name="id_categoria" id="categoria_despesa" required>
                                  <?php $counter1=-1;  if( isset($categoria) && ( is_array($categoria) || $categoria instanceof Traversable ) && sizeof($categoria) ) foreach( $categoria as $key1 => $value1 ){ $counter1++; ?>

                                  <option><?php echo htmlspecialchars( $value1["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                  <?php } ?>

                                </select>
                            </div>


                            <div class="col-md-9 d-flex justify-content-center">
                              <button type="button" class="btn btn-secondary me-1">Cancelar</button>
                              <button type="submit" class="btn btn-success" style="background-color: #26A234; border-color: #26A234;">Salvar Receita</button>
                            </div>
                        </form>
                      </div>
                        <div class="col-md-5">
                          <img src="../../res/site/assets/img/img_receita_parcelada.png" alt="Receita Parcelada" style="max-height: 66vh;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

  </main>