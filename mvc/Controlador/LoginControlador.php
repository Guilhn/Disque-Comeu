<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Usuario;
use \Modelo\Produto;

class LoginControlador extends Controlador
{


    public function criar()
    {
        if (DW3Sessao::get('usuario') == null) {
            $this->visao('login/criar.php', [
                'mensagem' => DW3Sessao::getFlash('mensagem', null)
            ]);
        }
        else {
            $usuario = DW3Sessao::get('usuario_full');
            if ($usuario->isAdmin()) {
                $this->visao('pedidos/index.php', [
                    'usuario' => $usuario,
                    null
                ], 'administrador.php');
            }
            else{
                $this->redirecionar(URL_RAIZ . 'produtos');
            }
        }
    }

    public function armazenar()
    {
        $usuario = Usuario::buscarNomeUsuario($_POST['nome_usuario']);
        if ($usuario && $usuario->verificarSenha($_POST['senha'])) {
            DW3Sessao::set('usuario', $usuario->getId());
            DW3Sessao::set('usuario_full', $usuario);
            if ($usuario->isAdmin()) {
                $this->visao('pedidos/index.php', [], 'administrador.php');
              } else {
                $this->redirecionar(URL_RAIZ . 'produtos');
              }
        } else {
            $this->setErros(['login' => 'Usuário ou senha inválido.']);
            $this->visao('login/criar.php');
        }
    }

    public function destruir()
    {
        DW3Sessao::deletar('usuario');
        DW3Sessao::deletar('usuario_full');
        $this->redirecionar(URL_RAIZ . 'login');
    }
}
