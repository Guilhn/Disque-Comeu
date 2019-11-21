<div class="section no-pad-bot" id="index-banner">
  <div class="container">
    <div class="row">
      <div class="col s12 ">
      </div>
    </div>

  </div>
</div>


<div class="container">
  <div class="section">


    <div class="row">


      <?php if (!empty($produtos)) : ?>
        <div class="row">
          <div class="col s12 m8 offset-m2 l6 offset-l3">

            <div class="card-panel">
              <form method="get">
                <div>
                  <div class="input-field row">
                    <div class=" col s12">
                      <span class="grey-text">Categoria</span>
                      <select name="categoria_id">
                        <?php foreach ($categorias as $categorias) : ?>
                            <option value="<?= $categorias->getId() ?>"><?= $categorias->getNome() ?></option>
                        <?php endforeach ?>
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
              </form>
            </div>
          </div>
        </div>
      <?php endif ?>

      <div><h4 class="center cor-texto-terciaria font-title ">Produtos</h4></div>

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
                        <h4 class="texto-branco">Infelizmente não temos produtos cadastrado ainda!</h4>
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

          <div class="col s12 m4 l4">
            <div class="card  ">
              <div class="card-content">
                <span class="card-title text-ellipsis"> <?= $produtos->getNome() ?></span>
                <img width="100%" height="200px" src="<?= URL_IMG . $produtos->getImagem() ?>"  class=" materialboxed" alt="">
                <div class="row">
                  <h5 class="col s12 center">R$ <?= number_format($produtos->getValor(), 2, ',', '.') ?></h5>
                </div>
                <div class="row padd-buttom">
                  <div class="col s12 m6"><a class="tam-btn waves-effect waves-light btn-esquerda btn modal-trigger" href="#modal<?= $produtos->getId()?>">VER</a></div>
                  <div class="col s12 m6"><a class="tam-btn btn waves-effect waves-light  btn-direita " href="<?= URL_RAIZ . 'login' ?>"><i class="material-icons">add</i> Carrinho</a></div>
                </div>
              </div>
            </div>
          </div>

          <div id="modal<?= $produtos->getId()?>" class="modal" tabindex="0">
            <div class="modal-content">
              <a class="modal-close right "><i class="material-icons black-text">close</i></a>
              <div class="row" id="product-two">
                <div class="col m6">
                  <img width="100%" src="<?= URL_IMG . $produtos->getImagem() ?>" class="responsive-img materialboxed" alt="">
                </div>
                <div class="col m6">
                  <h5><?= $produtos->getNome() ?></h5>
                  <hr class="mb-5">
                  <p class="mt-3"><?= $produtos->getDescricao() ?></p>
                  <h5>R$ <?= number_format($produtos->getValor(), 2, ',', '.') ?></h5>
                  <a class="center waves-effect waves-light btn btn-esquerda margin-btn" href="<?= URL_RAIZ . 'login' ?>">+ CARRINHO</a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach ?>
      <?php endif ?>

      <div class="center col s12">
        <?php if ($pagina > 1) : ?>
          <a href="<?= URL_RAIZ . 'inicio?p=' . ($pagina - 1) ?>" class="center btn waves-effect waves-light btn btn-esquerda">Página anterior</a>
        <?php endif ?>
        <?php if ($pagina < $ultimaPagina) : ?>
          <a href="<?= URL_RAIZ . 'inicio?p=' . ($pagina + 1) ?>" class="btn waves-effect waves-light btn btn-direita">Próxima página</a>
        <?php endif ?>
      </div>

    </div>

  </div>
  <br><br>
</div>