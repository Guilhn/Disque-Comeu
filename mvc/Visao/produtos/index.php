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

    <?php if (!empty($mensagem)) : ?>
        <div class="row">
          <div class="col s10 offset-s1 m4 offset-m4 l2 offset-l5 msg-green center toast" >
            <p class="center"><?= $mensagem ?></p>
          </div>
        </div>
        <br>
        <br>
    <?php endif ?>


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

      <div><h4 class="center cor-texto-terciaria font-title ">Produtos</h4></div>


      <?php if (empty($produtos)) : ?>
        <div class="row">
          <div class="col s10 offset-s1 m8 offset-m2 msg-red center white-text" >
            <h5>Nao possui nenhum produto cadastrado ainda!</h5>
          </div>
        </div>
        <br>
        <br>
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
                  <div class="col s12 m6"><a class="tam-btn btn waves-effect waves-light  btn-direita " href="<?= URL_RAIZ . 'carrinho/' . $produtos->getId()?>"><i class="material-icons">add</i> Carrinho</a></div>
                </div>
                
              </div>
            </div>

            <!-- Modal Structure -->
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
                    <a class="center waves-effect waves-light btn btn-esquerda margin-btn" href="<?= URL_RAIZ . 'carrinho/' . $produtos->getId()?>">+ CARRINHO</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach ?>
      <?php endif ?>
      
      <!-- CARD -->

    </div>


  </div>
  <br><br>
</div>