<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Inicio do Conteúdo da Pagina -->
<main id="main" class="main">

    <!-- Inicio Título da Pagina -->
    <div class="pagetitle">
        <h1>Meus Cartões</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Carteira</li>
                <li class="breadcrumb-item active">Cartão</li>
            </ol>
        </nav>
    </div>
    <!-- Fim Título da Pagina -->

    <section class="section">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body" style="min-height: 72vh;">

                        <!-- Table with hoverable rows -->
                        <div class="card-body pt-3">
                            <table class="table table-hover datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Descrição da Cartão</th>
                                        <th scope="col">Tipo Cartão</th>
                                        <th scope="col">Vence dia</th>
                                        <th scope="col">Limite</th>
                                        <th scope="col">Instituição</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $counter1=-1;  if( isset($cartao) && ( is_array($cartao) || $cartao instanceof Traversable ) && sizeof($cartao) ) foreach( $cartao as $key1 => $value1 ){ $counter1++; ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars( $value1["id_cartao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                        <td><?php echo htmlspecialchars( $value1["apelido"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                        <td><?php echo htmlspecialchars( $value1["tipo_cartao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                        <td><?php echo htmlspecialchars( $value1["vence_dia"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                        <td><?php echo htmlspecialchars( $value1["limite"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                        <td><?php echo htmlspecialchars( $value1["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                        <td>
                                            <a href="/cartao/<?php echo htmlspecialchars( $value1["id_cartao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary btn-sm" style="line-height: 0.5;"><i class="bx bxs-edit"></i></a>
                                            <a href="/cartao/<?php echo htmlspecialchars( $value1["id_cartao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete" class="btn btn-danger btn-sm" style="line-height: 0.5;"><i class="bx bxs-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                            <div class="text-center pt-3">
                                <a href="/" type="button" class="btn btn-secondary me-1">Voltar</a>
                                <a href="/cartao/criar" type="button" class="btn btn-primary">Cadastrar Cartão</a>
                            </div>

                        </div>
                    </div>
                </div>


                <!-- End Table with hoverable rows -->

            </div>
        </div>

        </div>

        </div>


        </div>
    </section>

</main><!-- End #main -->