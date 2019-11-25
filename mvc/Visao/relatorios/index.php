<div class="section no-pad-bot" id="index-banner">
  <div class="container">
    <div class="row">
      <div>
        <p>
          <h4 class="center cor-texto-terciaria font-title ">Relatório</h4>
          <br>
        </p>

        <div class="row">
          <div class="col s12 m6 offset-m3">
            <form method="get">
              <div class="card white darken-1">
                <div class="card-content row">
                  <span class="card-title cor-texto-secundaria center">Filtro de Lucro</span>
                  <br>
                  <div class="row">
                    <div class="col s10 offset-s1 m8 offset-m2">
                      <label for="">Data Inicio</label>
                      <input type="date" name="dataInicio" value="<?= $this->getGet('dataInicio') ?>" autoClose class="datepicker">

                    </div>
                    <div class="col s10 offset-s1 m8 offset-m2">
                      <label for="">Data Fim</label>
                      <input type="date" name="dataFim" value="<?= $this->getGet('dataFim') ?>" autoClose class="text-black datepicker">

                    </div>

                  </div>
                </div>
                <div class="card-action">
                  <div class="row">
                    <div class="col s12 m5 offset-m4">
                      <button type="submit" class="waves-effect waves-light btn btn-direita margin-btn">Filtrar</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <?php if (empty($registros[0]['id'])) : ?>
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
                    <h4 class="texto-branco">Infelizmente não tem pedidos!</h4>
                  </div>
                </div>
              </div>
              <div class="card-image waves-effect waves-block waves-light">
                <div class="banner-aviso fundo-efeito-secundario"></div>
              </div>
            </div>
          </div>
        <?php endif ?>

        <?php if (!empty($registros[0]['id'])) : ?>
          <table class="responsive-table table highlight fundo-branco">
            <tbody>
              <tr class="padbottom texto-branco cor-fundo-primaria">
                <th class="center">Numero</th>
                <th class="center">Valor</th>
                <th class="center">Data</th>
                <th class="center">Status</th>
              </tr>
              <?php for ($i = 0; $i < count($registros) - 1; $i++) : ?>
                <tr>
                  <td class="center">000<?= $registros[$i]['id'] ?></td>
                  <td class="center">R$ <?= number_format($registros[$i]['total'], 2, ',', '.') ?></td>
                  <td class="center"><?= date_format(date_create($registros[$i]['data_pedido']), 'd-m-Y') ?></td>
                  <?php if ($registros[$i]['status_pedido_id'] == 1) : ?>
                    <td class="center green-text"><b>Pedido Novo</b></td>
                  <?php endif ?>
                  <?php if ($registros[$i]['status_pedido_id'] == 2) : ?>
                    <td class="center amber-text"><b>Leu o pedido</b></td>
                  <?php endif ?>
                  <?php if ($registros[$i]['status_pedido_id'] == 3) : ?>
                    <td class="center orange-text"><b>Saiu para Entrega</b></td>
                  <?php endif ?>
                  <?php if ($registros[$i]['status_pedido_id'] == 4) : ?>
                    <td class="center blue-text"><b>Entregue</b></td>
                  <?php endif ?>
                </tr>
              <?php endfor ?>

            </tbody>
          </table>
          <table class="responsive-table table highlight fundo-branco">
            <tbody>
              <tr class="padbottom ">
                <th class="cor-fundo-primaria center texto-branco ">Total</th>
                <td class="center">R$ <?= number_format($registros[$i]['total_pedido'], 2, ',', '.') ?></td>
              </tr>

            </tbody>
          </table>
        <?php endif ?>

        <br>
        <br>

      </div>
    </div>

  </div>
</div>