<?php

namespace Controlador;

use \Modelo\Usuario;
use \Framework\DW3Sessao;

class UsuarioControlador extends Controlador
{
    public function criar()
    {
        $this->visao('usuarios/criar.php');
    }

    public function perfil()
    {
        $this->visao('usuarios/perfil.php', [], 'consumidor.php');
    }

    public function pedidos()
    {
        $this->visao('usuarios/pedidos.php', [], 'consumidor.php');
    }

    public function carrinho()
    {
        $this->visao('usuarios/carrinho.php', [], 'consumidor.php');
    }
    
    public function armazenar()
    {
        $foto = array_key_exists('foto', $_FILES) ? $_FILES['foto'] : null;
        $administrador = 0;
        $usuario = new Usuario($_POST['nome'], $_POST['sobrenome'], $_POST['nome_usuario'], $_POST['email'], $_POST['senha'], $administrador, $foto);

        if ($usuario->isValido()) {
            $usuario->salvar();
            DW3Sessao::setFlash('mensagem', 'Cadastro realizado com sucesso!');
            $this->redirecionar(URL_RAIZ . 'login');
            
        } else {
            $this->setErros($usuario->getValidacaoErros());
            $this->visao('usuarios/criar.php');
        }
    }
}
