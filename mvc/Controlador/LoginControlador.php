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
            $usuario = DW3Sessao::get('usuario');
            if ($usuario->isAdmin()) {
                $this->redirecionar(URL_RAIZ . 'pedidos');
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
            DW3Sessao::set('usuario', $usuario);
            if ($usuario->isAdmin()) {
                $this->redirecionar(URL_RAIZ . 'pedidos');
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
        DW3Sessao::deletar('carrinho');
        $this->redirecionar(URL_RAIZ);
    }
}
