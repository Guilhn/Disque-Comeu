<?php
namespace Controlador;

use \Modelo\Usuario;

class AdminControlador extends Controlador
{
    public function criar()
    {
        $this->visao('admin/criar.php', [], 'administrador.php');
    }

    public function armazenar()
    {
        $foto = array_key_exists('foto', $_FILES) ? $_FILES['foto'] : null;
        $administrador = 1;
        $usuario = new Usuario($_POST['nome'], $_POST['sobrenome'], $_POST['nome_usuario'], $_POST['email'], $_POST['senha'], $administrador, $foto);

        if ($usuario->isValido()) {
            $usuario->salvar();
            $this->redirecionar(URL_RAIZ . 'admin/criar');

        } else {
            $this->setErros($usuario->getValidacaoErros());
            $this->visao('admin/criar.php', [], 'administrador.php');
        }
    }

}
