<div class="section no-pad-bot" id="index-banner">
  <div class="container">

    <?php if (!empty($mensagem)) : ?>
        <div class="row">
          <div class="col s12 m6 offset-m3 l4 offset-l4 msg-green center toast" >
            <p class="center"><?= $mensagem ?></p>
          </div>
        </div>
        <br>
        <br>
    <?php endif ?>

    <div class="row">
      <div>
        <p>
          <h3 class="center cor-texto-terciaria font-title ">Pratos</h3>
          <br>
        </p>


        <div>
          <?php if (!empty($produtos)) : ?>
            <div class="row">
              <div class="col s12 m8 offset-m2 l6 offset-l3">

                <div class="card-panel">
                  <div>
                    <div class="input-field row">

                      <div class=" col s12">
                        <span class="grey-text">Categoria</span>
                        <select>
                          <option value="" disabled selected>Todas</option>
                          <option value="1">Pizza</option>
                          <option value="2">Lanche</option>
                          <option value="3">Porção</option>
                        </select>

                      </div>
                    </div>
                    <div class="card-action">
                      <div class="row">
                        <div class="col s12 m5 offset-m5">
                          <a class="waves-effect waves-light btn btn-direita margin-btn" href="pedidos.html">Filtrar</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endif ?>

          <?php if (empty($produtos)) : ?>
            <div class="row">
              <div id="profile-page-header" class="col s8 offset-s2 card cor-fundo-aviso marginPerfil">
                <div class="card-image waves-effect waves-block waves-light">
                  <div class="banner-aviso fundo-efeito-secundario"></div>
                </div>

                <div class="card-content">
                  <div class="row">
                  <div class="col s10 offset-s1 m3 center pageFormulario">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="hamburger" class="texto-branco" role="img" width="70%" viewBox="0 0 600 512">
                    <path fill="currentColor" d="M473.7 73.8l-2.4-2.5c-46-47-118-51.7-169.6-14.8L336 159.9l-96 64 48 128-144-144 96-64-28.6-86.5C159.7 19.6 87 24 40.7 71.4l-2.4 2.4C-10.4 123.6-12.5 202.9 31 256l212.1 218.6c7.1 7.3 18.6 7.3 25.7 0L481 255.9c43.5-53 41.4-132.3-7.3-182.1z"></path>
                    </svg>
                  </div>
                    <div class="col s12 m9 center pageFormulario">
                        <h4 class="texto-branco">Infelizmente não temos produtos cadastrado ainda! 😥</h4>
                    </div>
                  </div>
                </div>
                <div class="card-image waves-effect waves-block waves-light">
                  <div class="banner-aviso fundo-efeito-secundario"></div>
                </div>
              </div>
            </div>
          <?php endif ?>
          
          <?php if (!empty($produtos)) : ?>
            <?php foreach ($produtos as $produtos) : ?>
              <div class="col s12 m4 l3">
              <div class="card">
                <div class="card-image">
                  <img width="100%" height="165px"src="<?= URL_IMG . $produtos->getImagem() ?>">
                  <a class="btn-floating halfway-fab waves-effect waves-light blue" href="<?= URL_RAIZ . 'produtos/editar/' . $produtos->getId() ?>" title="Editar Prato" h><i class="material-icons">edit</i></a>
                </div>
                <div class="card-content">
                  <div class="row">
                    <span class="card-title black-text">
                      <p><?= $produtos->getNome() ?></p>
                    </span>
                    <span class="card-title black-text hide-on-med-only">
                      <p>R$ <?= number_format($produtos->getValor(), 2, ',', '.') ?></p>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <?php endforeach ?>
          <?php endif ?>

      </div>
    </div>

  </div>
</div>