<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Framework\DW3BancoDeDados;

class TesteUsuarios extends Teste
{
    public function testeCriar()
    {
        $resposta = $this->get(URL_RAIZ . 'usuarios/criar');
        $this->verificarContem($resposta, 'Criar conta');
    }

    public function testeMeusPedidos()
    {
        $this->logar();
        $resposta = $this->get(URL_RAIZ . 'meus-pedidos');
        $this->verificarContem($resposta, 'Meus pedidos');
    }

    public function testePerfil()
    {
        $this->logar();
        $resposta = $this->get(URL_RAIZ . 'perfil');
        $this->verificarContem($resposta, 'email@teste.com');
    }

    public function testeArmazenar()
    {
        $resposta = $this->post(URL_RAIZ . 'usuarios', [
            'nome' => 'Nome Teste',
            'sobrenome' => 'Teste',
            'nome_usuario' => 'usuario',
            'email' => 'email@teste.com',
            'senha' => '123456',
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
        $resposta = $this->get(URL_RAIZ . 'login');
        $this->verificarContem($resposta, 'Login');
        $query = DW3BancoDeDados::query('SELECT * FROM usuarios WHERE nome = "Nome Teste"');
        $bdUsuarios = $query->fetchAll();
        $this->verificar(count($bdUsuarios) == 1);
    }
}
