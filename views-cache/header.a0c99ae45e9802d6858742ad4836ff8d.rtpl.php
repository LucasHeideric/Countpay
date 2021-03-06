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

  <!-- Arquivo CSS do Countpay -->
  <link href="../../res/admin/assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Cabeçalho ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <!-- ======= Sidebar - Menu Vertical ======= -->
    <div class="d-flex align-items-center justify-content-between">
      <!-- Inicio Logo -->
      <a href="/admin" class="logo d-flex align-items-center">
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
              <a class="dropdown-item d-flex align-items-center" href="/admin/sair">
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
        <a class="nav-link " href="/admin">
          <i class="bx bxs-dashboard"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <!-- Fim Dashboard -->

      <!-- Inicio da Lista do Menu -->

      <!-- Inicio Usuários -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bx bxs-user"></i><span>Usuários</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>

        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/admin/usuario">
              <i class="bx bxs-chevron-right"></i><span>Buscar Usuários</span>
            </a>
            <a href="/admin/usuario/criar">
              <i class="bx bxs-chevron-right"></i><span>Criar Usuários</span>
            </a>
          </li>
        </ul>

      </li>
      <!-- Fim Usuários -->


      <!-- Inicio Perfil -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="perfil.html">
          <i class="bx bxs-id-card"></i>
          <span>Perfil</span>
        </a>
      </li>
      <!-- Fim Perfil -->

      <!-- Inicio Contato -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact.html">
          <i class="bx bxs-envelope"></i>
          <span>Alterar Contato</span>
        </a>
      </li>
      <!-- Fim Contato -->

    </ul>

  </aside>
  <!-- Fim do Menu Lateral -->
