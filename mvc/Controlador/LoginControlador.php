<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Usuario;

class LoginControlador extends Controlador
{
    public function criar()
    {
        $this->visao('login/criar.php');
    }

    public function armazenar()
    {
        $usuario = Usuario::buscarNomeUsuario($_POST['nome_usuario']);
        if ($usuario && $usuario->verificarSenha($_POST['senha'])) {
            DW3Sessao::set('usuario', $usuario->getId());
            if ($usuario->isAdmin()) {
                $this->visao('pedidos/index.php', [
                    'usuario' => $usuario,
                    null
                ], 'administrador.php');
                echo $usuarioId = DW3Sessao::get('usuario');
              } else {
                $this->visao('inicio/index.php', [
                    'usuario' => $usuario,
                    null
                ], 'consumidor.php');
              }
        } else {
            $this->setErros(['login' => 'Usuário ou senha inválido.']);
            $this->visao('login/criar.php');
        }
    }

    public function destruir()
    {
        DW3Sessao::deletar('usuario');
        $this->redirecionar(URL_RAIZ . 'login');
    }
}
