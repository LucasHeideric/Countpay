<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Inicio do Conteúdo da Pagina -->
<main id="main" class="main pb-0">

    <!-- Inicio Título da Pagina -->
    <div class="pagetitle">
        <h1>Meta por Categoria</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
                <li class="breadcrumb-item active"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="nova_meta.html">Criar nova Meta</a></li>
                <li class="breadcrumb-item active">Meta por Categoria</li>
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

                            <form action="/lancamento/transferencia" method="post"
                                class="row g-4 pt-1 pb-4 d-flex justify-content-center">

                                <div class="col-md-10">
                                    <label for="nome" class="form-label">Nome</label>
                                    <input type="text" placeholder="Digite o nome da meta" class="form-control" id="nome">
                                </div>

                                <div class="col-md-10">
                                    <label for="nome" class="form-label">Categoria</label>
                                    <select class="form-select" name="categoria" id="descricao_despesa" required>
                                        <?php $counter1=-1;  if( isset($categoria) && ( is_array($categoria) || $categoria instanceof Traversable ) && sizeof($categoria) ) foreach( $categoria as $key1 => $value1 ){ $counter1++; ?>
                                        <option><?php echo htmlspecialchars( $value1["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for="nome" class="form-label">Data Inicial</label>
                                    <input type="date" class="form-control" id="nome">
                                </div>

                                <div class="col-md-3">
                                    <label for="nome" class="form-label">Data Final</label>
                                    <input type="date" class="form-control" id="nome">
                                </div>

<!--                                <div class="col-md-4">
                                    <label for="nome" class="form-label">Conta</label>
                                    <select class="form-select" name="id_conta_despesa" id="descricao_despesa" required>
                                        <option value="">Opção cartão não utilizada</option>
                                        <?php $counter1=-1;  if( isset($conta) && ( is_array($conta) || $conta instanceof Traversable ) && sizeof($conta) ) foreach( $conta as $key1 => $value1 ){ $counter1++; ?>
                                        <option><?php echo htmlspecialchars( $value1["apelido"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
                                        <?php } ?>
                                    </select>
                                    </div> 
-->

                                <div class="col-md-4">
                                    <label for="nome" class="form-label">Valor</label>
                                    <input type="number" placeholder="R$00,00" class="form-control" id="nome">
                                </div>

                                <div class="col-md-10">
                                    <label for="nome" class="form-label">Objetivo</label>
                                    <textarea class="form-control" placeholder="Campo não obrigatório..." id="detalhe_meta" style="min-height: 10vh;"></textarea>
                                </div>

                                <div class="col-md-10 pt-4 d-flex justify-content-center">
                                    <button type="button" class="btn btn-secondary me-1">Voltar</button>
                                    <button type="submit" class="btn btn-success"
                                    style="background-color: #26A234; border-color: #26A234;">Criar Meta</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-5">
                            <img src="../../res/site/assets/img/meta.png" alt="imagem transferência"
                                style="max-height: 60vh;">
                        </div>
                    </div>
                </div>
            </div>
    </section>

</main><!-- End #main -->