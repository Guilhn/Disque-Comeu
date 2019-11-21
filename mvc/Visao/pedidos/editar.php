<div class="section no-pad-bot" id="index-banner">
  <div class="container">
    <div class="row">
      <div>

        <div class="row">
          <div class="col s12 m6 offset-m3">
            <form action="<?= URL_RAIZ . 'pedidos/' . $pedido->getId() . '/editar' ?>" method="post" class="col s12">
              <input type="hidden" name="_metodo" value="PATCH">
              <div class="card white darken-1">
                <div class="card-content white-text row">
                  <span class="card-title cor-texto-secundaria center">Status do pedido</span>
                  <br>
                  <div class="col s10 offset-s1">
                    <select name="status_pedido" class="fundo-branco">
                      <?php foreach ($status as $status) : ?>
                        <?php $selected = $status->getId() == $pedido->getStausPedidoId() ? 'selected' : '' ?>
                        <option value="<?= $status->getId() ?>" <?= $selected ?>><?= $status->getNome() ?></option>
                      <?php endforeach ?>
                    </select>
                    </select>
                  </div>
                </div>
                <div class="card-action">
                  <div class="row">
                    <div class="col s12 m4 offset-m4">
                      <button type="submit" class="btn btn-esquerda CorLink waves-effect waves-light col s12">Salvar status</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>

        <h5 class="center cor-texto-terciaria font-title ">Pedido: <?= $pedido->getId() ?></h5>
        <br>

        <div class="row">
          <div class="col s12 card">
            <div class="row">
              <div class="col s3">
                <p class="blue-text "><b>Data: <span class="blue-text"><?= $pedido->getDataPedidoFormatada() ?></span></b></p>
              </div>
              <div class="col s12 ">
                <h5 class="center cor-texto-primaria font-title">Status</h5>
              </div>
            </div>
            <div class="col s12">
              <?php if ($pedido->getStausPedidoId() == 1) : ?>
                <ul class="stepper horizontal" id="horizontal">
                  <li class="step active">
                    <div class="step-title ">Pedido Novo</div>
                  </li>
                  <li class="step ">
                    <div class="step-title waves-effect waves-dark">Leu o pedido</div>
                  </li>
                  <li class="step">
                    <div class="step-title waves-effect waves-dark">Saiu para Entrega</div>
                  </li>
                  <li class="step ">
                    <div class="step-title waves-effect waves-dark">Entregue</div>
                  </li>
                </ul>
              <?php endif ?>
              <?php if ($pedido->getStausPedidoId() == 2) : ?>
                <ul class="stepper horizontal" id="horizontal">
                  <li class="step">
                    <div class="step-title ">Pedido Novo</div>
                  </li>
                  <li class="step active">
                    <div class="step-title waves-effect waves-dark">Leu o pedido</div>
                  </li>
                  <li class="step">
                    <div class="step-title waves-effect waves-dark">Saiu para Entrega</div>
                  </li>
                  <li class="step ">
                    <div class="step-title waves-effect waves-dark">Entregue</div>
                  </li>
                </ul>
              <?php endif ?>
              <?php if ($pedido->getStausPedidoId() == 3) : ?>
                <ul class="stepper horizontal" id="horizontal">
                  <li class="step">
                    <div class="step-title ">Pedido Novo</div>
                  </li>
                  <li class="step ">
                    <div class="step-title waves-effect waves-dark">Leu o pedido</div>
                  </li>
                  <li class="step active">
                    <div class="step-title waves-effect waves-dark">Saiu para Entrega</div>
                  </li>
                  <li class="step ">
                    <div class="step-title waves-effect waves-dark">Entregue</div>
                  </li>
                </ul>
              <?php endif ?>
              <?php if ($pedido->getStausPedidoId() == 4) : ?>
                <ul class="stepper horizontal" id="horizontal">
                  <li class="step">
                    <div class="step-title ">Pedido Novo</div>
                  </li>
                  <li class="step ">
                    <div class="step-title waves-effect waves-dark">Leu o pedido</div>
                  </li>
                  <li class="step">
                    <div class="step-title waves-effect waves-dark">Saiu para Entrega</div>
                  </li>
                  <li class="step active">
                    <div class="step-title waves-effect waves-dark">Entregue</div>
                  </li>
                </ul>
              <?php endif ?>

            </div>


            <div class="col s12">
              <hr>
              <div class="row">
                <div class="col s6 offset-s3 m2">
                  <img src="../../../assets/img/pizza.jpg" class="responsive-img materialboxed" alt="">
                </div>
                <div class="col s12 m10">
                  <div class="row">
                    <div class="col s12 m4">
                      <p class="center"><b>Pizza de Calabresa</b></p>
                    </div>
                    <div class="col s12 m4">
                      <p class="center">Categoria: Pizza</p>
                    </div>
                    <div class="col s12 m4">
                      <p class="center"><b>R$ 35,00</b></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col s6 offset-s3 m2">
                  <img src="../../../assets/img/batata-frita.jpg" class="responsive-img materialboxed" alt="">
                </div>
                <div class="col s12 m10">
                  <div class="row">
                    <div class="col s12 m4">
                      <p class="center"><b>Batata Frita</b></p>
                    </div>
                    <div class="col s12 m4">
                      <p class="center">Data: 19/09/19</p>
                    </div>
                    <div class="col s12 m4">
                      <p class="center"><b>R$ 10,00</b></p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col s12">
                  <h5 class="center"><b>Total:</b> R$ <?= number_format($pedido->getTotal(), 2, ',', '.') ?></h5>
                </div>
              </div>
            </div>
          </div>

        </div>





        <br>
        <br>

      </div>
    </div>

  </div>
</div>