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
                            <form action="<?= URL_RAIZ . 'produtos/editar/' . $produto->getId() ?>" method="post" enctype="multipart/form-data" class="col s12">
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
                                            <select name="id_categoria" >
                                                <option value="<?php echo $produto->getIdCategoria(); ?>" disabled selected>Atual</option>
                                                <option value="1">Pizza</option>
                                                <option value="2">Lanche</option>
                                                <option value="3">Massa</option>
                                                <option value="4">Porção</option>
                                            </select>
                                            <label>Categoria</label>
                                            <?php $this->incluirVisao('util/formErro.php', ['campo' => 'id_categoria']) ?>
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
                                    <div class="input-field col s12">
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <div class="center">

                                                    <h5 class="cor-texto-primaria center">Foto do Prato</h5>
                                                    <input type="file" value="" name="foto" disabled>
                                                    <?php $this->incluirVisao('util/formErro.php', ['campo' => 'foto']) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="row">
                                        <div class="input-field offset-s4 col s4">
                                            <button type="submit" class="btn cor-fundo-primaria CorLink waves-effect waves-light col s12">Cadastrar</button>
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