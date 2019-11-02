<div class="pageFormulario">

    '<div class="row">
      <div class="col s12 m8 offset-m2 l6 offset-l3 card-panel">
        <div class="card-content">
          <div class="input-field col s12 center">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user-plus" class="cor-texto-primaria" width="10%" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
              <path fill="currentColor"
                d="M624 208h-64v-64c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v64h-64c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h64v64c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-64h64c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm-400 48c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z">
              </path>
            </svg>
            <h4 class="center login-form-text">Criar conta</h4>
            <br>
          </div>
        </div>


        <div class="card-content">
          <form action="/projeto/question/usuarios" method="post" enctype="multipart/form-data" class="col s12">

            <div class="row">
              <div>
                <div class="input-field col s12 m6">
                  <i class="material-icons prefix cor-texto-primaria">person</i>
                  <input class="" value="" type="text" placeholder="Nome" name="nome">
                  <label class="black-text active">Nome <span class="red-text">*</span></label>
                </div>
                <div class="input-field col s12 m6">
                  <i class="material-icons prefix cor-texto-primaria">person</i>
                  <input class="" value="" type="text" placeholder="Sobrenome" name="sobrenome">
                  <label class="black-text active">Sobrenome <span class="red-text">*</span></label>
                </div>
              </div>

            </div>

            <div class="row">
              <div class="input-field col s12 m6">
                <i class="material-icons prefix cor-texto-primaria">account_circle</i>
                <input class="" value="" placeholder="Usuário" id="user" type="text" name="login">
                <label class="black-text active">Login <span class="red-text">*</span></label>
              </div>

              <div class="input-field col s12 m6">
                <i class="material-icons prefix cor-texto-primaria">vpn_key</i>
                <input class="" value="" id="password" type="password" placeholder="Senha" name="senha">
                <label class="black-text active">Senha <span class="red-text">*</span></label>

              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <i class="material-icons prefix cor-texto-primaria">email</i>
                <input class="" value="" placeholder="Email" id="email" type="email" name="email">
                <label class="black-text active" for="email">Email <span class="red-text">*</span></label>
              </div>
            </div>


            <div class="row">
              <div class="input-field col s12">
                <div class="row">
                  <div class="input-field col s12">
                    <div class="">

                      <h5 class="cor-texto-primaria center">Foto do Perfil</h5>
                      <div class="dropify-wrapper">
                        <div class="dropify-message"><span class="file-icon"></span>
                          <p>Arraste e solte um arquivo aqui ou clique</p>
                          <p class="dropify-error">Ooops, algo errado aconteceu.</p>
                        </div>
                        <div class="dropify-loader"></div>
                        <div class="dropify-errors-container">
                          <ul></ul>
                        </div><input id="foto" name="foto" type="file" class="dropify form-control" data-default-file=""><button type="button" class="dropify-clear">Remover</button>
                        <div class="dropify-preview"><span class="dropify-render"></span>
                          <div class="dropify-infos">
                            <div class="dropify-infos-inner">
                              <p class="dropify-filename"><span class="dropify-filename-inner"></span></p>
                              <p class="dropify-infos-message">Arraste e solte ou clique para substituir</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">

              <div class="row">
                <div class="input-field offset-s4 col s4">
                  <a class="btn cor-fundo-primaria CorLink waves-effect waves-light col s12" href="../index.html">Cadastrar</a>
                </div>
              </div>

            </div>

          </form>
        </div>
      </div>
    </div>'

  </div>