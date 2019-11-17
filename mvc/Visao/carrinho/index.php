
    
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
                <div class="col s10 offset-s1 m8 offset-m2 msg-red center white-text" >
                  <h5>Não Possui nada em seu Carrinho :(</h5>
                </div>
              </div>
              <br>
              <br>
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
                  <td class="center"><?= $carrinho->buscarNomeCategoria($carrinho->getId()) ?></td>
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
              <a class="waves-effect waves-light btn btn-esquerda margin-btn" href="pedidos.html">Finalizar Compra</a>
              <a class="waves-effect waves-light btn btn-direita margin-btn" href="<?= URL_RAIZ . 'carrinho/deletar' ?>">Deletar Carrinho</a>
            </div>

            <br>
            <br>
            <?php endif ?>
            

          </div>
        </div>

      </div>
</div>