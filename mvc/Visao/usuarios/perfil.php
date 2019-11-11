<div class="section no-pad-bot" id="index-banner">
      <div class="container">
        <div class="row">
          <div id="profile-page" class="section">

            <div id="profile-page-header" class="card marginPerfil">
              <div class="card-image waves-effect waves-block waves-light">
                <!-- <img class="activator" src="../../../assets/img/banner.jpg" alt="user background"> -->
                <div class="banner-perfil fundo-efeito-secundario"></div>
              </div>
              <figure class="card-profile-image ">
                <img src="<?php $usuario = \Framework\DW3Sessao::get("usuario_full"); echo URL_IMG . $usuario->getImagem(); ?>" alt="profile image" width="20%" class=" z-depth-3 responsive-img circle">
              </figure>
              <div class="card-content">
                <div class="row">
                  <div class="col s3 offset-s2">
                    <h3 class="card-title grey-text text-darken-4"><b><?php $usuario = \Framework\DW3Sessao::get("usuario_full"); echo $usuario->getNome(), " ", $usuario->getSobrenome(); ?></b></h3>
                  </div>
                  <div class="col s3 center-align">
                    <h4 class="card-title grey-text text-darken-4">Email</h4>
                    <p class="medium-small grey-text"><?php $usuario = \Framework\DW3Sessao::get("usuario_full"); echo $usuario->getEmail() ?></p>
                  </div>
                  <div class="col s3 center-align">
                    <h4 class="card-title grey-text text-darken-4">Login</h4>
                    <p class="medium-small grey-text"><?php $usuario = \Framework\DW3Sessao::get("usuario_full"); echo $usuario->getNomeUsuario() ?></p>
                  </div>
                  <div class="col s1 right-align ">
                    <a class="btn activator waves-effect cor-fundo-primaria waves-light darken-2 right corHover" href="<?= URL_RAIZ . 'usuarios/pedidos' ?>">
                      Pedidos
                    </a>
                  </div>
                </div>
              </div>


            </div>
          </div>
        </div>

      </div>
    </div>