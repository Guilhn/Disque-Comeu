<div class="pageFormulario">

    <div id="login-page" class="row">
      <div class="col s10 offset-s1 m8 offset-m2 l4 offset-l4 card-panel">
        <form action="<?= URL_RAIZ . 'login' ?>" method="post" id="formulario" class="login-form">
          <div class="row">
            <div class="input-field col s12 center">
              <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="hamburger" class="cor-texto-primaria" role="img" width="20%" viewBox="0 0 512 512">
                <path fill="currentColor"
                  d="M464 256H48a48 48 0 0 0 0 96h416a48 48 0 0 0 0-96zm16 128H32a16 16 0 0 0-16 16v16a64 64 0 0 0 64 64h352a64 64 0 0 0 64-64v-16a16 16 0 0 0-16-16zM58.64 224h394.72c34.57 0 54.62-43.9 34.82-75.88C448 83.2 359.55 32.1 256 32c-103.54.1-192 51.2-232.18 116.11C4 180.09 24.07 224 58.64 224zM384 112a16 16 0 1 1-16 16 16 16 0 0 1 16-16zM256 80a16 16 0 1 1-16 16 16 16 0 0 1 16-16zm-128 32a16 16 0 1 1-16 16 16 16 0 0 1 16-16z">
                </path>
              </svg>
              <h4 class="center login-form-text">Login</h4>
            </div>
          </div>
          <div class="row margin">

            <div class="center">

            <?php $this->incluirVisao('util/loginErro.php', ['campo' => 'login']) ?>

            </div>

            <div class="input-field col s12 <?= $this->getErroCss('login') ?>">
              <div class="col s12">
                <i class="material-icons prefix cor-texto-primaria ">account_circle</i>
                <input placeholder="Usuário" id="nome_usuario" name="nome_usuario" value="<?= $this->getPost('nome_usuario') ?>" class="tooltipped" type="text">
              </div>

            </div>
          </div>
          <div class="row margin">
            <div class="input-field col s12 <?= $this->getErroCss('login') ?>">
              <div class="col s12">
                <i class="material-icons prefix cor-texto-primaria">vpn_key</i>
                <input placeholder="Senha" id="password" name="senha" type="password">

              </div>
            </div>

          </div>

          <div class="row">
            <div class="input-field col offset-s3 s6">
              <button type="submit" class="btn cor-fundo-primaria corHover waves-effect waves-light col s12 tooltipped">Entrar</button>
            </div>
          </div>
          <div class="row">
            <div class="input-field col offset-s3 s6">
              <p class="center medium-small"><a href="cadastro.html">Registrar agora!</a></p>
            </div>

          </div>

        </form>
      </div>
    </div>
  </div>