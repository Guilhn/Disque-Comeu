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

        <br>
        <br>

      </div>
    </div>

  </div>
</div>