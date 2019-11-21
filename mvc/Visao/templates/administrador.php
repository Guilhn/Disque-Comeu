<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
  <title><?= APLICACAO_NOME ?></title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="<?= URL_CSS . 'materialize.min.css' ?>" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="<?= URL_IMG . 'favicon.ico' ?>" rel="icon" type="image/png" sizes="16x16">
  <link href="<?= URL_CSS . 'style.css' ?>" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="<?= URL_CSS . 'dropify.css' ?>" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="<?= URL_CSS . 'mstepper.min.css' ?>" type="text/css" rel="stylesheet" media="screen,projection" />

</head>

<body class="fundo">
  <nav class="cor-fundo-primaria" role="navigation">
    <div class="nav-wrapper container ">
      <a id="logo" href="<?= URL_RAIZ . 'pedidos' ?>" class="brand-logo"><span class="front-logo hide-on-small-only">Disque</span> <span class="back-logo hide-on-small-only">Comeu</span> <i class="fas fa-hamburger"></i></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="<?= URL_RAIZ . 'relatorio' ?>">Relatório</a></li>
        <li><a class="dropdown-trigger" href="javascript:;" data-target="dropdown1">Funcionarios<i class="material-icons right">arrow_drop_down</i></a></li>
        <li><a class="dropdown-trigger" href="javascript:;" data-target="dropdown2">Pratos<i class="material-icons right">arrow_drop_down</i></a></li>
        <li><a href="<?= URL_RAIZ . 'pedidos' ?>">Pedidos</a></li>
        <li>
          <form id="form-sair" action="<?= URL_RAIZ . 'login' ?>" method="post">
            <input id="input-sair" type="text" value="DELETE" name="_metodo">
          </form>
          <a title="Sair" href="" onclick="event.preventDefault(); $('#form-sair').submit()"><i class="material-icons right">exit_to_app</i>Sair</a>
        </li>
      </ul>

      <ul id="dropdown1" class="dropdown-content">
        <li><a href="<?= URL_RAIZ . 'admin' ?>"><span>Cadastrar</span></a></li>
      </ul>

      <ul id="dropdown2" class="dropdown-content">
        <li><a href="<?= URL_RAIZ . 'produtos/criar' ?>"><span>Cadastrar</span></a></li>
        <li><a href="<?= URL_RAIZ . 'produtos/listar' ?>"><span>Listar</span></a></li>
      </ul>

      <ul id="nav-mobile" class="sidenav">
        <li><a href="<?= URL_RAIZ . 'pedidos' ?>">Pedidos</a></li>
        <li><a href="<?= URL_RAIZ . 'relatorio' ?>">Relatório</a></li>
        <li class="divider" tabindex="-1"></li>
        <li class="cor-texto-primaria titulo-itens"><b>Funcionario</b></li>
        <li><a href="<?= URL_RAIZ . 'admin' ?>">Cadastrar</a></li>
        <li class="divider" tabindex="-1"></li>
        <li class="cor-texto-primaria titulo-itens"><b>Pratos</b></li>
        <li><a href="<?= URL_RAIZ . 'produtos/criar' ?>">Cadastrar</a></li>
        <li><a href="<?= URL_RAIZ . 'produtos/listar' ?>">Listar</a></li>
        <li class="divider" tabindex="-1"></li>
        <li> <a title="Sair" href="" onclick="event.preventDefault(); $('#form-sair').submit()"><i class="material-icons right">exit_to_app</i>Sair</a></li>
      </ul>
      <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
  </nav>
  <main>

    <?php $this->imprimirConteudo() ?>

  </main>

  <footer class="page-footer fundo-efeito-secundario ">
    <div class="container">
      <div class="row">
        <div class="col l4 s12">
          <h4><a href="<?= URL_RAIZ . 'pedidos' ?>" class="brand-logo texto-branco"><span class="front-logo">Disque</span> <span class="back-logo">Comeu</span> <i class="fas fa-hamburger"></i></a></h4>


        </div>
        <div class="col l2 s6">
          <h5 class="texto-branco">Relatório</h5>
          <ul>
            <li><a class="white-text" href="<?= URL_RAIZ . 'relatorio' ?>"><b>relatório de lucro</b></a></li>
          </ul>

        </div>
        <div class="col l2 s6">
          <h5 class="texto-branco">Funcionario</h5>
          <ul>
            <li><a class="white-text" href="<?= URL_RAIZ . 'admin' ?>"><b>Cadastrar Funcionario</b></a></li>
          </ul>

        </div>
        <div class="col l2 s6">
          <h5 class="texto-branco">Pratos</h5>
          <ul>
            <li><a class="white-text" href="<?= URL_RAIZ . 'produtos/criar' ?>"><b>Cadastrar Prato</b></a></li>
            <li><a class="white-text" href="<?= URL_RAIZ . 'produtos/listar' ?>"><b>Listar Pratos</b></a></li>
          </ul>
        </div>
        <div class="col l2 s6">
          <h5 class="texto-branco">Pedidos</h5>
          <ul>
            <li><a class="white-text" href="<?= URL_RAIZ . 'pedidos' ?>"><b>Mostrar Pedidos</b></a></li>
          </ul>
        </div>

      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
        © Copyright 2019 - Disque Comeu 🍔 - Todos os direitos
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="<?= URL_JS . 'materialize.min.js' ?>"></script>
  <script src="<?= URL_JS . 'init.js' ?>"></script>
  <script src="<?= URL_JS . 'mensagemFlash.js' ?>"></script>
  <script src="<?= URL_JS . 'all.min.js' ?>"></script>
  <script src="<?= URL_JS . 'dropify.js' ?>"></script>

</body>

</html>