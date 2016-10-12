<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>KikADMIN | Painel de controle</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href=<?php $_SERVER['DOCUMENT_ROOT']?>"/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href=<?php $_SERVER['DOCUMENT_ROOT']?>"/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <link rel="stylesheet" href=<?php $_SERVER['DOCUMENT_ROOT']?>"/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href=<?php $_SERVER['DOCUMENT_ROOT']?>"/dist/css/skins/_all-skins.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <a href=<?php $_SERVER['DOCUMENT_ROOT']?>"/index.php" class="logo">
      <span class="logo-mini"><b>Kik</b></span>
      <span class="logo-lg"><b>Kik</b>ADMIN</span>
    </a>

    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Você possui 4 novas mensagens</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src=<?php $_SERVER['DOCUMENT_ROOT']?>"/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Diego Lima - Gerente
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Como está o andamento do projeto ADM?</p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src=<?php $_SERVER['DOCUMENT_ROOT']?>"/dist/img/user1-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Ruan - Teste
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Precisamos rever aquela regra de negócio.</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src=<?php $_SERVER['DOCUMENT_ROOT']?>"/dist/img/user1-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Márcio - Diretor
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Já utilizou WebBrocker do Delphi?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src=<?php $_SERVER['DOCUMENT_ROOT']?>"/dist/img/user1-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Sistema
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Resultado do mês de marco.</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">Todas as mensagens</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Você possui 10 notificações</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 novos usuários cadastrados hoje
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Existem pedidos aguardando verificação
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 2 usuários banidos hoje
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 vendas realizadas esta semana
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> Complete seu cadastro!
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">Todas as notificações</a></li>
            </ul>
          </li>
          
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src=<?php $_SERVER['DOCUMENT_ROOT']?>"/dist/img/user6-128x128.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Ermesom Lourenço</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src=<?php $_SERVER['DOCUMENT_ROOT']?>"/dist/img/user6-128x128.jpg" class="img-circle" alt="User Image">

                <p>
                  Ermesom Lourenço - Web Developer
                  <small>Membro desde Março. 2016</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-6 text-center">
                    <a href="#">Vendas</a>
                  </div>
                  <div class="col-xs-6 text-center">
                    <a href="#">Clientes</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src=<?php $_SERVER['DOCUMENT_ROOT']?>"/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Ermesom Lourenço</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENU PRINCIPAL</li>
        <li class="treeview">
          <a href=<?php $_SERVER['DOCUMENT_ROOT']?>"/index.php">
            <i class="fa fa-dashboard"></i> <span>Painel de controle</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href=<?php $_SERVER['DOCUMENT_ROOT']?>"/index.php"><i class="fa fa-circle-o"></i> Painel de controle</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-database"></i>
            <span>Cadastros</span>
            <span class="pull-right-container">
              <i class="fa fa-user-plus pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href=<?php $_SERVER['DOCUMENT_ROOT']?>"/pages/cadastros/clientes.php"><i class="fa fa-circle-o"></i> Clientes</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Produtos\Serviços</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Usuários</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Categorias\Redes sociais</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Relatórios</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Clientes</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Vendas\Usuário</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Vendas\Cliente</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Comissões</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Receita\Custos\Lucro</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cart-plus"></i> <span>Orçamentos\Vendas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Orçamento\venda</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Orçamentos realizados</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Comissões</a></li>
          </ul>
        </li>
        
        <li>
          <a href="#">
            <i class="fa fa-calendar"></i> <span>Calendário</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">3</small>
              <small class="label pull-right bg-blue">17</small>
            </span>
          </a>
        </li>
        <li><a href=<?php $_SERVER['DOCUMENT_ROOT']?>"/documentation/index.html"><i class="fa fa-book"></i> <span>Ajuda</span></a></li>
        <li class="header">Legendas</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Div que alinha as informações da página no espaço feita para tal, respeitando a parte de menu e top -->
  <div class="content-wrapper">