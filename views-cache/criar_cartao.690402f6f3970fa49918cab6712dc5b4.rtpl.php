<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Inicio do Conteúdo da Pagina -->
<main id="main" class="main pb-0">

    <!-- Inicio Título da Pagina -->
    <div class="pagetitle">
      <h1>Cadastro de novo Cartão</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="/">Carteira</a></li>
          <li class="breadcrumb-item active"><a href="/cartao">Cartão</a></li>
          <li class="breadcrumb-item active"><a href="/cartao/criar">Criar Cartão</a></li>
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
                        <form action="/cartao/criar" method="post" class="row g-4 pt-2 pb-4 d-flex justify-content-center">

                            <div class="col-md-10">
                                <label for="apelido_cartao" class="form-label">Nome ou Apelido</label>
                                <input type="text" class="form-control" name="apelido" id="apelido_cartao" required>
                            </div>

                            <div class="col-md-5">
                                <label for="tipo_cartao" class="form-label">Tipo Cartão</label>

                                <select class="form-select" name="tipo_cartao" id="tipo_cartao" required>
                                    <option>Cartão</option>
                                    <option>Cartão de Débito</option>
                                    <option>Cartão de Crédito</option>
                                </select>

                            </div>

                            <div class="col-md-5">
                                <label for="vence_dia" class="form-label">Vence dia</label>
                                <select class="form-select" name="vence_dia" id="vence_dia" required>
                                  <option>1</option>
                                  <option>2</option>
                                  <option>3</option>
                                  <option>4</option>
                                  <option>5</option>
                                  <option>6</option>
                                  <option>7</option>
                                  <option>8</option>
                                  <option>9</option>
                                  <option>10</option>
                                  <option>11</option>
                                  <option>12</option>
                                  <option>13</option>
                                  <option>14</option>
                                  <option>15</option>
                                  <option>16</option>
                                  <option>17</option>
                                  <option>18</option>
                                  <option>19</option>
                                  <option>20</option>
                                  <option>21</option>
                                  <option>22</option>
                                  <option>23</option>
                                  <option>24</option>
                                  <option>25</option>
                                  <option>26</option>
                                  <option>27</option>
                                  <option>28</option>
                                  <option>29</option>
                                  <option>30</option>
                                  <option>31</option>
                                </select>
                            </div>

                            <div class="col-md-5">
                              <label for="limite" class="form-label">Limite do Cartão</label>
                              <input type="number" placeholder="R$" class="form-control" name="limite" id="limite" required>
                            </div>

                            <div class="col-md-5">
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
                        <img src="../res/site/assets/img/cartao.png" alt="Conta" style="max-height: 60vh;">
                    </div> 

                    </div>
                </div>
            </div>
        </div>
    </section>

  </main><!-- End #main -->