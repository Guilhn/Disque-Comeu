<?php
namespace Controlador;

use \Modelo\Usuario;

class UsuarioControlador extends Controlador
{
    public function criar()
    {
        $this->visao('usuarios/criar.php');
    }

    public function criar_admin()
    {
        $this->visao('usuarios/criar_admin.php', [], 'administrador.php');
    }

    public function armazenar()
    {
        $foto = array_key_exists('foto', $_FILES) ? $_FILES['foto'] : null;
        $usuario = new Usuario($_POST['nome'], $_POST['sobrenome'], $_POST['nome_usuario'], $_POST['email'], $_POST['senha'], $foto);

        if ($usuario->isValido()) {
            $usuario->salvar();
            $this->redirecionar(URL_RAIZ . 'usuarios/sucesso');

        } else {
            $this->setErros($usuario->getValidacaoErros());
            $this->visao('usuarios/criar.php');
        }
    }

    public function sucesso()
    {
        $this->visao('usuarios/sucesso.php');
    }
}
