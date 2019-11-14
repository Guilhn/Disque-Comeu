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

      <!--  CARD   -->

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

      <?php foreach ($produtos as $produtos) : ?>
        
        <div class="col s12 m4 l4">
          <div class="card  ">
            <div class="card-content">
              <span class="card-title text-ellipsis"> <?= $produtos->getNome() ?></span>
              <img width="100%" height="200px" src="<?= URL_IMG . $produtos->getImagem() ?>"  class=" materialboxed" alt="">
              <div class="row">
                <h5 class="col s12 m12 l8">R$ <?= $produtos->getValor() ?></h5>
                <a class="col s12 m12 l4 margin-btn waves-effect waves-light btn-esquerda btn modal-trigger" href="#modal<?= $produtos->getId()?>">VER</a>
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
                  <h5>R$ <?= $produtos->getValor() ?></h5>
                  <a class="waves-effect waves-light btn btn-esquerda margin-btn" href="<?= URL_RAIZ . 'carrinho/' . $produtos->getId()?>">+ CARRINHO</a>
                  <a class="waves-effect waves-light btn btn-direita margin-btn" href="<?= URL_RAIZ . 'login' ?>">COMPRAR</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach ?>

      



      <!-- CARD -->

    </div>


    <ul class="pagination center">
      <li class="disabled"><a href="javascript:;"><i class="material-icons">chevron_left</i></a></li>
      <li class="active"><a href="javascript:;">1</a></li>
      <li class="waves-effect "><a href="pages/produtos/02.html">2</a></li>
      <li class="waves-effect"><a href="pages/produtos/03.html">3</a></li>
      <li class="waves-effect"><a href="pages/produtos/04.html">4</a></li>
      <li class="waves-effect"><a href="pages/produtos/05.html">5</a></li>
      <li class="waves-effect"><a href="pages/produtos/02.html"><i class="material-icons">chevron_right</i></a></li>
    </ul>



  </div>
  <br><br>
</div>