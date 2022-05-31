<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Inicio do Conteúdo da Pagina -->
<main id="main" class="main">

    <!-- Inicio Título da Pagina -->
    <div class="pagetitle">
        <h1>Histórico de Lançamentos</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Lançamento</li>
                <li class="breadcrumb-item active">Histórico de Lançamento</li>
            </ol>
        </nav>
    </div>
    <!-- Fim Título da Pagina -->

    <section class="section dashboard">
        <div class="row justify-content-center">

            <div class="col-md-12">

                <div class="card">
                    <div class="card-body" style="min-height: 70vh;">

                      
<!--                       <form class="row g-4 py-4 px-4 d-flex justify-content-center">

                        <div class="col-md-4">
                          <label for="descricao_busca" class="form-label">Descrição</label>
                          <input type="text" class="form-control" id="descricao_busca">
                        </div>

                        <div class="col-md-2">
                          <label for="data_busca" class="form-label">Data do Lançamento</label>
                          <input type="date" class="form-control" id="data_busca">
                        </div>

                        <div class="col-md-2">
                          <label for="tipo_lancamento_busca" class="form-label">Tipo de Lançamento</label>
                          <select class="form-select" id="tipo_lancamento_busca" required>
                              <option></option>
                              <option>Despesa Única</option>
                              <option>Despesa Fixa</option>
                              <option>Despesa Parcelada</option>
                              <option>Receita Única</option>
                              <option>Receita Fixa</option>
                              <option>Receita Parcelada</option>
                          </select>
                        </div>

                        <div class="col-md-2">
                          <label for="valor_busca" class="form-label">Valor</label>
                          <input type="number" class="form-control" id="valor_busca">
                        </div>

                        <div class="col-md-2 mt-auto">
                          <button type="button" class="btn btn-primary me-1" title="Buscar" style="background-color: blue; border-color: blue;">
                            <i class="bi bi-search"></i>
                          </button>
                          <button type="button" class="btn btn-primary" title="Imprimir" style="background-color: blue; border-color: blue;">
                            <i class="bi bi-printer-fill"></i>
                          </button>
                        </div>

                      </form> -->



                        <!-- Table with hoverable rows -->
                        <div class="card-body pt-3">
                            <table class="table table-hover datatable">
                              <thead>
                                <tr>
                                  <th scope="col">Descrição</th>
                                  <th scope="col">Tipo</th>
                                  <th scope="col">Valor</th>
                                  <th scope="col">Categoria</th>
                                  <th scope="col">Data de Lançamento</th>
                                  <th scope="col">Conta</th>
                                  <th scope="col">Cartão</th>
                                  <th scope="col">Parcelas</th>
                                  <th scope="col">Frequência</th>

                                </tr>
                              </thead>
                              <tbody>
                                <?php $counter1=-1;  if( isset($resultado) && ( is_array($resultado) || $resultado instanceof Traversable ) && sizeof($resultado) ) foreach( $resultado as $key1 => $value1 ){ $counter1++; ?>
                                <tr>
                                  <td><?php echo htmlspecialchars( $value1["descricao_lancamento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                  <td><span class="badge bg-secondary" style="font-size: small;"><?php echo htmlspecialchars( $value1["tipo_lancamento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></td>
                                  <td><?php echo htmlspecialchars( $value1["valor"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                  <td><?php echo htmlspecialchars( $value1["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                  <td><?php echo htmlspecialchars( $value1["data_lancamento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                  <td><?php echo htmlspecialchars( $value1["conta"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                  <td><?php echo htmlspecialchars( $value1["cartao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                  <td><?php echo htmlspecialchars( $value1["quantidade_parcelas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                  <td><?php echo htmlspecialchars( $value1["frequencia"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                </tr>
                                <?php } ?>
                              </tbody>
                            </table>
          
                          </div>
          
                        </div>
                      </div>

                    </div>
                </div>

            </div>

        </div>


        </div>
    </section>

</main><!-- End #main -->