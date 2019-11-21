<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <div class="row">
            <main class="pageFormulario">

                <div class="row">
                    <div class="col s12 m10 offset-m1 l8 offset-l2 card-panel">
                        <div class="card-content">
                            <div class="input-field col s12 center">
                                <h4 class="center login-form-text">Editar Prato</h4>
                                <br>
                            </div>
                        </div>

                        <div class="card-content">
                            <form action="<?= URL_RAIZ . 'produtos/' . $produto->getId() . '/editar' ?>" method="post" enctype="multipart/form-data" class="col s12">
                                <input type="hidden" name="_metodo" value="PATCH">

                                <div class="row">
                                    <div>
                                        <div class="input-field col s12 m6">
                                            <i class="material-icons prefix cor-texto-primaria">local_dining</i>
                                            <input class="" value="<?php echo $produto->getNome(); ?>" type="text" placeholder="Prato" name="nome">
                                            <label class="black-text active">Prato <span class="red-text">*</span></label>
                                            <?php $this->incluirVisao('util/formErro.php', ['campo' => 'nome']) ?>
                                        </div>
                                        <div class="input-field col s12 m6">
                                            <select name="categoria_id">
                                                <?php foreach ($categorias as $categorias) : ?>
                                                    <?php $selected = $categorias->getId() == $produto->getCategoriaId() ? 'selected' : '' ?>
                                                    <option value="<?= $categorias->getId() ?>"<?= $selected ?>><?= $categorias->getNome() ?></option>
                                                <?php endforeach ?>
                                            </select>
                                            <label>Categoria</label>
                                            <?php $this->incluirVisao('util/formErro.php', ['campo' => 'categoria_id']) ?>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix cor-texto-primaria">description</i>
                                        <input class="" value="<?php echo $produto->getDescricao(); ?>" placeholder="Descrição" id="user" type="text" name="descricao">
                                        <label class="black-text active">Descrição <span class="red-text">*</span></label>
                                        <?php $this->incluirVisao('util/formErro.php', ['campo' => 'descricao']) ?>
                                    </div>

                                    <div class="input-field col s12">
                                        <i class="material-icons prefix cor-texto-primaria">attach_money</i>
                                        <input class="" value="<?php echo $produto->getValor(); ?>" id="Valor" type="text" placeholder="Valor" name="valor">
                                        <label class="black-text active">Valor <span class="grey-text">(00.00)</span><span class="red-text">*</span></label>
                                        <?php $this->incluirVisao('util/formErro.php', ['campo' => 'valor']) ?>
                                    </div>
                                </div>


                                <div class="row">

                                    <div class="row">
                                        <div class="input-field offset-s4 col s4">
                                            <button type="submit" class="btn cor-fundo-primaria CorLink waves-effect waves-light col s12">EDITAR</button>
                                        </div>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </main>
        </div>

    </div>
</div>