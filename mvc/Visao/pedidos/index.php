<div class="section no-pad-bot" id="index-banner">
  <div class="container">
    <div class="row">
      <div>
        <p>
          <h4 class="center cor-texto-terciaria font-title ">Pedidos</h4>
          <br>
        </p>

        <?php if (!empty($mensagem)) : ?>
          <div class="row">
            <div class="col s12 m6 offset-m3 l2 offset-l5 msg-green center toast">
              <p class="center"><?= $mensagem ?></p>
            </div>
          </div>
          <br>
          <br>
        <?php endif ?>

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
                    <path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 448c-110.3 0-200-89.7-200-200S137.7 56 248 56s200 89.7 200 200-89.7 200-200 200zm-80-216c17.7 0 32-14.3 32-32s-14.3-32-32-32-32 14.3-32 32 14.3 32 32 32zm160-64c-17.7 0-32 14.3-32 32s14.3 32 32 32 32-14.3 32-32-14.3-32-32-32zm-80 128c-40.2 0-78 17.7-103.8 48.6-8.5 10.2-7.1 25.3 3.1 33.8 10.2 8.4 25.3 7.1 33.8-3.1 16.6-19.9 41-31.4 66.9-31.4s50.3 11.4 66.9 31.4c8.1 9.7 23.1 11.9 33.8 3.1 10.2-8.5 11.5-23.6 3.1-33.8C326 321.7 288.2 304 248 304z"></path>
                    </svg>
                  </div>
                  <div class="col s12 m9 center pageFormulario">
                    <h4 class="texto-branco">Infelizmente não temos pedidos!</h4>
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
          <table class="responsive-table table highlight fundo-branco">
            <tbody>
              <tr class="padbottom texto-branco cor-fundo-primaria">
                <th class="center">Editar</th>
                <th class="center">Pedido</th>
                <th class="center">Valor</th>
                <th class="center">Data</th>
                <th class="center">Status</th>
              </tr>

              <?php foreach ($pedidos as $pedidos) : ?>
                <tr>
                  <td>
                    <div class="row center">
                      <a href="<?= URL_RAIZ . 'pedidos/' . $pedidos->getId() . '/editar' ?>" class="btn-floating btn-small waves-effect waves-light blue" title="Editar Pedido">
                        <i class="material-icons white-text">edit</i>
                      </a>
                    </div>
                  </td>
                  <td class="center">Batata Frita; Cheesecake</td>
                  <td class="center">R$ <?= number_format($pedidos->getTotal(), 2, ',', '.') ?></td>
                  <td class="center"><?= $pedidos->getDataPedidoFormatada() ?></td>
                  <?php if ($pedidos->getIdStausPedido() == 1) : ?>
                    <td class="center green-text"><?= $pedidos->buscarNomeStatus($pedidos->getIdStausPedido()) ?></td>
                  <?php endif ?>
                  <?php if ($pedidos->getIdStausPedido() == 2) : ?>
                    <td class="center amber-text"><?= $pedidos->buscarNomeStatus($pedidos->getIdStausPedido()) ?></td>
                  <?php endif ?>
                  <?php if ($pedidos->getIdStausPedido() == 3) : ?>
                    <td class="center orange-text"><?= $pedidos->buscarNomeStatus($pedidos->getIdStausPedido()) ?></td>
                  <?php endif ?>
                  <?php if ($pedidos->getIdStausPedido() == 4) : ?>
                    <td class="center blue-text"><?= $pedidos->buscarNomeStatus($pedidos->getIdStausPedido()) ?></td>
                  <?php endif ?>
                </tr>
              <?php endforeach ?>


            </tbody>
          </table>
        <?php endif ?>
        <br>
        <br>

      </div>
    </div>

  </div>
</div>