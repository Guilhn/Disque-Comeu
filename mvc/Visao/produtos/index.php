<div class="section no-pad-bot" id="index-banner">
  <div class="container">

    <?php if ($mensagem) : ?>
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
                    <p>R$ <?= $produtos->getValor() ?></p>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach ?>

      </div>
    </div>

  </div>
</div>