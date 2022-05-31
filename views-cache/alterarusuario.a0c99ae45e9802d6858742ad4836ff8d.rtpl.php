<?php if(!class_exists('Rain\Tpl')){exit;}?>  <!-- Inicio do Conteúdo da Pagina -->
  <main id="main" class="main pb-0">

    <!-- Inicio Título da Pagina -->
    <div class="pagetitle">
      <h1>Atualizar Usuário</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="/admin/usuario">Usuários</a></li>
          <li class="breadcrumb-item active"><a href="/admin/usuario/criar">Buscar Usuário</a></li>
        </ol>
      </nav>
    </div>
    <!-- Fim Título da Pagina -->

    <section class="section" >
        <div class="row justify-content-center">

            <div class="col-lg-12">

                <div class="card" style="min-height: 70vh;">
                    <div class="card-body d-flex align-items-center">
                      <div class="col-md-12 pt-4 pb-4">

                        <form action="/admin/usuario/alterar" method="post" class="row g-4 d-flex justify-content-center">

                          <div class="col-md-10">
                            <label for="iduser" class="form-label visually-hidden">ID</label>
                            <input type="text" class="form-control visually-hidden" id="iduser" name="id_usuario" value="<?php echo htmlspecialchars( $usuario["id_usuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                          </div>

                          <div class="col-md-10">
                            <label for="nomeuser" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nomeuser" name="nome" value="<?php echo htmlspecialchars( $usuario["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                          </div>

                          <div class="col-md-10">
                            <label for="sobrenomeuser" class="form-label">Sobrenome</label>
                            <input type="text" class="form-control" id="sobrenomeuser" name="sobrenome" value="<?php echo htmlspecialchars( $usuario["sobrenome"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                          </div>

                          <div class="col-md-10">
                            <label for="emailuser" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="emailuser" name="email" value="<?php echo htmlspecialchars( $usuario["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                          </div>

                          <div class="col-md-10">
                            <label for="datauser" class="form-label">Data de Nascimento</label>
                            <input type="date" class="form-control" id="datauser" name="data_nascimento" value="<?php echo htmlspecialchars( $usuario["data_nascimento"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                          </div>

                          <div class="col-md-10">
                            <label for="loginuser" class="form-label">Login</label>
                            <input type="text" class="form-control" id="loginuser" name="login" value="<?php echo htmlspecialchars( $usuario["login"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                          </div>

                          <div class="col-md-10 d-flex justify-content-center pt-1">
                            <a href="/admin"><button type="button" class="btn btn-secondary me-1">Cancelar</button></a>
                            <a href="/admin"><button type="button" class="btn btn-danger me-1">Excluir</button></a>
                            <button type="submit" class="btn btn-success me-1">Atualizar</button>
                          </div>

                        </form>
                        
                      </div>
                        <!--                         
                        <div class="col-md-5">
                          <img src="/assets/img/img_receita_unica.png" alt="Receita Única" style="max-height: 66vh;">
                        </div> 
                        -->
                    </div>
                </div>
            </div>
        </div>
    </section>

  </main>
  <!-- End #main -->

