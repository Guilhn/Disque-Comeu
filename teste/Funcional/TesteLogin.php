<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3Sessao;

class TesteLogin extends Teste
{
    public function testeAcessar()
    {
        $resposta = $this->get(URL_RAIZ . 'login');
        $this->verificarContem($resposta, 'Login');
    }

    public function testeLogarNaoAdmin()
    {
        (new Usuario('usuario', 'teste', 'usuario', 'email@teste.com', '123456'))->salvar();
        $resposta = $this->post(URL_RAIZ . 'login', [
            'nome_usuario' => 'usuario',
            'senha' => '123456'
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'produtos');
        $this->verificar(DW3Sessao::get('usuario') != null);
    }

    public function testeLogarAdmin()
    {
        $resposta = $this->post(URL_RAIZ . 'login', [
            'nome_usuario' => 'admin',
            'senha' => 'admin'
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'pedidos');
        $this->verificar(DW3Sessao::get('usuario') != null);
    }

    public function testeLoginInvalido()
    {
        $resposta = $this->post(URL_RAIZ . 'login', [
            'nome_usuario' => 'usuario',
            'senha' => '123456'
        ]);
        $this->verificarContem($resposta, 'usuario');
        $this->verificar(DW3Sessao::get('usuario') == null);
    }

    public function testeDeslogar()
    {
        (new Usuario('usuario', 'teste', 'usuario', 'email@teste.com', '123456'))->salvar();
        $resposta = $this->post(URL_RAIZ . 'login', [
            'nome_usuario' => 'usuario',
            'senha' => '123456'
        ]);
        $resposta = $this->delete(URL_RAIZ . 'login');
        $this->verificarRedirecionar($resposta, URL_RAIZ);
        $this->verificar(DW3Sessao::get('usuario') == null);
    }

}
