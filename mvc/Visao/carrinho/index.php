<div class="section no-pad-bot" id="index-banner">
  <div class="container">
    <div class="row">
      <div>
        <p>
          <h4 class="center cor-texto-terciaria font-title ">Carrinho</h4>
          <br>
        </p>

        <?php if (empty($carrinho)) : ?>
          <div class="row">
            <div id="profile-page-header" class="col s8 offset-s2 card cor-fundo-aviso marginPerfil">
              <div class="card-image waves-effect waves-block waves-light">
                <div class="banner-aviso fundo-efeito-secundario"></div>
              </div>

              <div class="card-content">
                <div class="row">
                  <div class="col s10 offset-s1 m3 center pageFormulario">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="hamburger" class="texto-branco" role="img" width="70%" viewBox="0 0 600 512">
                      <path fill="currentColor" d="M576 216v16c0 13.255-10.745 24-24 24h-8l-26.113 182.788C514.509 462.435 494.257 480 470.37 480H105.63c-23.887 0-44.139-17.565-47.518-41.212L32 256h-8c-13.255 0-24-10.745-24-24v-16c0-13.255 10.745-24 24-24h67.341l106.78-146.821c10.395-14.292 30.407-17.453 44.701-7.058 14.293 10.395 17.453 30.408 7.058 44.701L170.477 192h235.046L326.12 82.821c-10.395-14.292-7.234-34.306 7.059-44.701 14.291-10.395 34.306-7.235 44.701 7.058L484.659 192H552c13.255 0 24 10.745 24 24zM312 392V280c0-13.255-10.745-24-24-24s-24 10.745-24 24v112c0 13.255 10.745 24 24 24s24-10.745 24-24zm112 0V280c0-13.255-10.745-24-24-24s-24 10.745-24 24v112c0 13.255 10.745 24 24 24s24-10.745 24-24zm-224 0V280c0-13.255-10.745-24-24-24s-24 10.745-24 24v112c0 13.255 10.745 24 24 24s24-10.745 24-24z"></path>
                    </svg>
                  </div>
                  <div class="col s12 m9 center pageFormulario">
                    <h4 class="texto-branco">Infelizmente seu carrinho está vazio!</h4>
                  </div>
                </div>
              </div>
              <div class="card-image waves-effect waves-block waves-light">
                <div class="banner-aviso fundo-efeito-secundario"></div>
              </div>
            </div>
          </div>
        <?php endif ?>

        <?php if (!empty($carrinho)) : ?>
          <table class="responsive-table table highlight fundo-branco">
            <tbody>
              <tr class="padbottom texto-branco cor-fundo-primaria">
                <th class="center">item pedido</th>
                <th class="center">Categoria</th>
                <th class="center">Valor</th>

              </tr>
              <?php foreach ($carrinho as $carrinho) : ?>
                <tr>
                  <td class="center"><?= $carrinho->getNome() ?></td>
                  <td class="center"><?= $carrinho->buscarNomeCategoria($carrinho->getCategoriaId()) ?></td>
                  <td class="center">R$ <?= number_format($carrinho->getValor(), 2, ',', '.') ?></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>

          <table class="responsive-table table highlight fundo-branco">
            <tbody>
              <tr class="padbottom ">
                <th class="cor-fundo-primaria center texto-branco ">Total</th>
                <td class="center">R$ <?= number_format($total, 2, ',', '.') ?></td>
              </tr>

            </tbody>
          </table>

          <div class="center btn-carrinho">
            <form id="logout" action="<?= URL_RAIZ . 'pedidos' ?>" method="post" class="hidden">
              <input type="hidden" name="total" value="<?php echo $total; ?>">
              <button type="submit" class="waves-effect waves-light btn btn-esquerda margin-btn">Finalizar Compra</button>
            </form>
            <form id="form-deletar" action="<?= URL_RAIZ . 'carrinho' ?>" method="post">
              <input id="input-sair" type="text" value="DELETE" name="_metodo">
            </form>
            <a class="waves-effect waves-light btn btn-direita margin-btn" onclick="event.preventDefault(); $('#form-deletar').submit()" href="">Deletar Carrinho</a>

          </div>

          <br>
          <br>
        <?php endif ?>


      </div>
    </div>

  </div>
</div>