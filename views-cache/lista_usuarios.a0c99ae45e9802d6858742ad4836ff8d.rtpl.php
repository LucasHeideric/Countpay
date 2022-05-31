<?php if(!class_exists('Rain\Tpl')){exit;}?> <!-- Inicio do Conteúdo da Pagina -->
 <main id="main" class="main">

    <!-- Inicio Título da Pagina -->
    <div class="pagetitle">
        <h1>Painel de Administração do Usuário</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
                <li class="breadcrumb-item active">Painel de Usuário</li>
            </ol>
        </nav>
    </div>
    <!-- Fim Título da Pagina -->

    <section class="section dashboard">
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
                                  <th scope="col">Nome</th>
                                  <th scope="col">Sobrenome</th>
                                  <th scope="col">E-mail</th>
                                  <th scope="col">Data de Nascimento</th>
                                  <th scope="col">Login</th>
                                  <th scope="col">Ações</th>

                                </tr>
                              </thead>
                              <tbody>
                                <?php $counter1=-1;  if( isset($usuarios) && ( is_array($usuarios) || $usuarios instanceof Traversable ) && sizeof($usuarios) ) foreach( $usuarios as $key1 => $value1 ){ $counter1++; ?>
                                <tr>
                                  <td><?php echo htmlspecialchars( $value1["id_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                  <td><?php echo htmlspecialchars( $value1["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                  <td><?php echo htmlspecialchars( $value1["sobrenome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                  <td><?php echo htmlspecialchars( $value1["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                  <td><?php echo htmlspecialchars( $value1["data_nascimento"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                  <td><?php echo htmlspecialchars( $value1["login"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                  <td>
                                      <a href="/admin/usuario/<?php echo htmlspecialchars( $value1["id_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary btn-sm" style="line-height: 0.5;"><i class="bx bxs-edit"></i></a>
                                      <a href="/admin/usuario/<?php echo htmlspecialchars( $value1["id_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete" class="btn btn-danger btn-sm" style="line-height: 0.5;"><i class="bx bxs-trash"></i></a>
                                  </td>
                                </tr>
                                <?php } ?>
                              </tbody>
                            </table>
          
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