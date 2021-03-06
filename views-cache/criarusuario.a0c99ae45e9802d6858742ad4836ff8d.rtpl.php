<?php if(!class_exists('Rain\Tpl')){exit;}?>  <!-- Inicio do Conteúdo da Pagina -->
  <main id="main" class="main pb-0">

    <!-- Inicio Título da Pagina -->
    <div class="pagetitle">
      <h1>Cadastro de Novo Usuário</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="/admin/usuario">Usuários</a></li>
          <li class="breadcrumb-item active"><a href="/admin/usuario/criar">Criar Usuários</a></li>
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

                    <form action="/admin/usuario/criar" method="post" class="row g-2 d-flex justify-content-center">
                  
                      <div class="col-md-10">
                        <label for="nomeusuario" class="form-label">Nome</label>
                        <div class="input-group has-validation">
        
                          <input type="text" name="nome" class="form-control" id="nomeusuario" required>
                          <div class="invalid-feedback">Por gentileza, digite o seu nome.</div>
        
                        </div>
                      </div>
        
                      <div class="col-md-10">
                        <label for="sobrenomeusuario" class="form-label">Sobrenome</label>
                        <div class="input-group has-validation">
        
                          <input type="text" name="sobrenome" class="form-control" id="sobrenomeusuario" required>
                          <div class="invalid-feedback">Por gentileza, digite o seu sobrenome.</div>
                          
                        </div>
                      </div>
        
                      <div class="col-md-5">
                        <label for="emailusuario" class="form-label">E-mail</label>
                        <div class="input-group has-validation">
        
                          <input type="email" name="email" class="form-control" id="emailusuario" required>
                          <div class="invalid-feedback">Por gentileza, digite o seu e-mail.</div>
                          
                        </div>
                      </div>
        
                      <div class="col-md-5">
                        <label for="datanascimentousuario" class="form-label">Data de Nascimento</label>
                        <div class="input-group has-validation">
        
                          <input type="date" name="data_nascimento" class="form-control" id="datanascimentousuario" required>
                          <div class="invalid-feedback">Por gentileza, digite a sua data de nascimento.</div>
                          
                        </div>
                      </div>
                        
        
                        <div class="col-md-10">
                          <label for="loginusuario" class="form-label">Login</label>
                          <div class="input-group has-validation">
        
                            <input type="text" name="login" class="form-control" id="loginusuario" required>
                            <div class="invalid-feedback">Por gentileza, digite a seu login.</div>
                            
                          </div>
                        </div>
        
                        <div class="col-md-10">
                          <label for="senhausuario" class="form-label">Senha</label>
                          <div class="input-group has-validation">
        
                            <input type="password" name="senha" class="form-control" id="senhausuario" required>
                            <div class="invalid-feedback">Por gentileza, digite a sua senha</div>
                            
                          </div>
                        </div>
        
                          
                      <div class="col-3 pt-3">
                        <a href="/admin/usuario"><button class="btn btn-secondary w-100" type="button">Voltar</button></a>
                      </div>
                      <div class="col-3 pt-3">
                        <button class="btn btn-primary w-100" type="submit">Criar</button>
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

  </main><!-- End #main -->
