<div class="section no-pad-bot" id="index-banner">
      <div class="container">
        <div class="row">
          <div class="col s10 offset-s1 ">
            <div>
              <p>
                <h4 class="center cor-texto-terciaria font-title ">Meus pedidos</h4>
                <br>
              </p>


                <?php foreach ($pedidos as $pedidos) : ?>
                  <div class="row">
                    <div class="col s12 card">
                      <div class="row">
                        <div class="col s3">
                          <p class="grey-text  left"><b>Pedido: <?= $pedidos->getId() ?></b></p>
                          <p  class="grey-text  right"><b>Data: <?= $pedidos->getDataPedidoFormatada() ?></b></p>
                        </div>
                        <div class="col s12 ">
                          <h5 class="center cor-texto-primaria font-title">Status</h5>
                        </div>
                      </div>
                      <div class="col s12">
                      <?php if ($pedidos->getIdStausPedido() == 1) : ?>
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
                      <?php if ($pedidos->getIdStausPedido() == 2) : ?>
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
                      <?php if ($pedidos->getIdStausPedido() == 3) : ?>
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
                      <?php if ($pedidos->getIdStausPedido() == 4) : ?>
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
                                <p class="center">Categoria: </p>
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
                                <p class="center">Categoria: </p>
                              </div>
                              <div class="col s12 m4">
                                <p class="center"><b>R$ 10,00</b></p>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col s12">
                            <h5 class="center"><b>Total:</b> R$ <?= number_format($pedidos->getTotal(), 2, ',', '.') ?></h5>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                  <br>
                <?php endforeach ?>


            </div>


          </div>


        </div>
      </div>
    </div>

    </div>
    </div>