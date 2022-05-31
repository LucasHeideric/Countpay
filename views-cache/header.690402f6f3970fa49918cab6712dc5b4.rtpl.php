<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-BR">

<head>

  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - Admin Countpay</title>

  <!-- Icones utilizado no Projeto -->
  <link href="../../res/admin/assets/img/favicon.png" rel="icon">
  <link href="res/admin/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../../res/admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../res/admin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../res/admin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../../res/admin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../../res/admin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../../res/admin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../../res/admin/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Icones de Bancos Brasileiros -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/matheusmcuba/icones-bancos-brasileiros@1.1/dist/all.css">

  <!-- Arquivo CSS do Countpay -->
  <link href="../../res/admin/assets/css/style.css" rel="stylesheet">

</head>

<body>
  <!-- ======= Cabeçalho ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <!-- ======= Sidebar - Menu Vertical ======= -->
    <div class="d-flex align-items-center justify-content-between">
      <!-- Inicio Logo -->
      <a href="/" class="logo d-flex align-items-center">
        <img src="../../res/admin/assets/img/logo.png" alt="">
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- Fim Logo -->
    
    <!-- Inicio Busca -->
    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Pesquisar" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div>
    <!-- Fim Busca -->

    <!-- Inicio Icone de Busca com tela reduzida -->
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li>
        <!-- Fim Icone de Busca com tela reduzida -->

        <li class="nav-item dropdown">

        <!-- Inicio Perfil -->
        <li class="nav-item dropdown pe-3">

          <!-- Inicio Perfil Imagem Icone -->
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="../../res/admin/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">Lucas Heideric</span>
          </a>
          <!-- Fim Perfil Imagem Icone -->

          <!-- Inicio Informações do Perfil -->
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Lucas Heideric</h6>
              <span>CEO Countpay</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="perfil.html">
                <i class="bi bi-person"></i>
                <span>Meu Perfil</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="perfil.html">
                <i class="bi bi-gear"></i>
                <span>Configurações da Conta</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="/sair">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sair</span>
              </a>
            </li>

          </ul>
          <!-- Fim Informações do Perfil -->
        </li>
        <!-- Fim Perfil -->

      </ul>
    </nav>
    <!-- Fim do Sidebar - Menu Vertical -->

  </header>
  <!-- Fim do Cabeçalho -->
  
  <!-- ======= Inicio do Menu Lateral ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <!-- Inicio Dashboard -->
      <li class="nav-item">
        <a class="nav-link " href="/">
          <i class="bx bxs-dashboard"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <!-- Fim Dashboard -->

      <!-- Inicio da Lista do Menu -->

      <!-- Inicio Projeção Futuras -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#projecao" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart-fill"></i><span>Projeções Futuras</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>

        <ul id="projecao" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="contas.html">
              <i class="bx bxs-chevron-right"></i><span>Projeção</span>
            </a>
          </li>
        </ul>

      </li>
      <!-- Fim Projeção Futuras -->

      <!-- Inicio Carteira -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#carteira" data-bs-toggle="collapse" href="#">
          <i class="bx bxs-wallet"></i><span>Carteira</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>

        <ul id="carteira" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/conta">
              <i class="bx bxs-chevron-right"></i><span>Contas</span>
            </a>
          </li>

          <li>
            <a href="/cartao">
              <i class="bx bxs-chevron-right"></i><span>Cartões</span>
            </a>
          </li>
        </ul>

      </li>
      <!-- Fim Carteira -->

      <!-- Inicio Lançamentos -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bx bxs-dollar-circle"></i><span>Laçamentos</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>

        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/lancamento/receita">
              <i class="bx bxs-chevron-right"></i><span>Receita</span>
            </a>
          </li>

          <li>
            <a href="/lancamento/despesa">
              <i class="bx bxs-chevron-right"></i><span>Despesa</span>
            </a>
          </li>

          <li>
            <a href="lancamento_transferencia.html">
              <i class="bx bxs-chevron-right"></i><span>Transferência</span>
            </a>
          </li>

          <li>
            <a href="/lancamento/historico">
              <i class="bx bxs-chevron-right"></i><span>Historico de Lançamento</span>
            </a>
          </li>
        </ul>

      </li>
      <!-- Fim Lançamentos -->

      <!-- Inicio Metas -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bx bxs-bar-chart-square"></i><span>Metas</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          
          <li>
            <a href="nova_meta.html">
              <i class="bx bxs-chevron-right"></i><span>Criar Nova Meta</span>
            </a>
          </li>

          <li>
            <a href="minhas_metas.html">
              <i class="bx bxs-chevron-right"></i><span>Minhas Metas</span>
            </a>
          </li>

        </ul>
      </li>
      <!-- Fim Metas -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bx bxs-file-doc"></i><span>Relatórios</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="geral_relatorio.html">
              <i class="bx bxs-chevron-right"></i><span>Relatório Geral</span>
            </a>
          </li>
          <li>
            <a href="calendario_relatorio.html">
              <i class="bx bxs-chevron-right"></i><span>Calendário</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->


      <li>
        <hr class="dropdown-divider text-secondary">
      </li>
      <!-- Titulo do Menu Lateral -->
      <li class="nav-heading">Utilitários</li>

      <!-- Inicio Perfil -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="perfil.html">
          <i class="bx bxs-id-card"></i>
          <span>Perfil</span>
        </a>
      </li>
      <!-- Fim Perfil -->

      <!-- Inicio Suporte -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-faq.html">
          <i class="bx bxs-help-circle"></i>
          <span>Suporte Online</span>
        </a>
      </li>
      <!-- Fim Suporte -->

      <!-- Inicio Contato -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact.html">
          <i class="bx bxs-envelope"></i>
          <span>Contato</span>
        </a>
      </li>
      <!-- Fim Contato -->

    </ul>

  </aside>
  <!-- Fim do Menu Lateral -->
