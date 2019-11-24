<div class="section no-pad-bot" id="index-banner">
  <div class="container">
    <div class="row">
      <div class="col s10 offset-s1 ">
        <div>
          <p>
            <h4 class="center cor-texto-terciaria font-title ">Meus pedidos</h4>
            <br>
          </p>

            <div class="row">
              <div class="col s12 m8 offset-m2 l6 offset-l3">

                <div class="card-panel">
                  <form method="get">
                    <div>
                      <div class="input-field row">
                        <div class=" col s12">
                          <span class="grey-text">Status Pedido</span>
                          <select name="status_id">
                            <option value="">---</option>
                            <?php foreach ($status as $status) : ?>
                              <option value="<?= $status->getId() ?>"><?= $status->getNome() ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                      <div class="card-action">
                        <div class="row">
                          <div class="col s12 m5 offset-m5">
                            <button type="submit" class="waves-effect waves-light btn btn-direita margin-btn">Filtrar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

          <?php if (empty($pedidos)) : ?>
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
                      <h4 class="texto-branco">Infelizmente você não possui pedidos!</h4>
                    </div>
                  </div>
                </div>
                <div class="card-image waves-effect waves-block waves-light">
                  <div class="banner-aviso fundo-efeito-secundario"></div>
                </div>
              </div>
            </div>
          <?php endif ?>

          <?php if (!empty($pedidos)) : ?>
            <?php foreach ($pedidos as $pedidos) : ?>
              <div class="row">
                <div class="col s12 card">
                  <div class="row">
                    <div class="col s3">
                      <p class="grey-text  left"><b>Pedido: <?= $pedidos->getId() ?></b></p>
                      <p class="grey-text  right"><b>Data: <?= $pedidos->getDataPedidoFormatada() ?></b></p>
                    </div>
                    <div class="col s12 ">
                      <h5 class="center cor-texto-primaria font-title">Status</h5>
                    </div>
                  </div>
                  <div class="col s12">
                    <?php if ($pedidos->getStausPedidoId() == 1) : ?>
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
                    <?php if ($pedidos->getStausPedidoId() == 2) : ?>
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
                    <?php if ($pedidos->getStausPedidoId() == 3) : ?>
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
                    <?php if ($pedidos->getStausPedidoId() == 4) : ?>
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



            <div class="center">
              <?php if ($totalPedidos > $limit) : ?>
                <?php if ($pagina > 1) : ?>
                  <a href="<?= URL_RAIZ . 'meus-pedidos?p=' . ($pagina - 1) ?>" class="center btn waves-effect waves-light btn btn-esquerda">Página anterior</a>
                <?php endif ?>
                <?php if ($pagina < $ultimaPagina) : ?>
                  <a href="<?= URL_RAIZ . 'meus-pedidos?p=' . ($pagina + 1) ?>" class="btn waves-effect waves-light btn btn-direita">Próxima página</a>
                <?php endif ?>
              <?php endif ?>
            </div>


          <?php endif ?>


        </div>


      </div>


    </div>
  </div>
</div>

</div>
</div>