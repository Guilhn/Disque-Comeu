<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteUsuarios extends Teste
{
    public function testeCriar()
    {
        $resposta = $this->get(URL_RAIZ . 'usuarios/criar');
        $this->verificarContem($resposta, 'Criar conta');
    }

    public function testeArmazenar()
    {
        $resposta = $this->post(URL_RAIZ . 'usuarios', [
            'nome' => 'Nome-Teste',
            'sobrenome' => 'Sobrenome-Teste',
            'nome_usuario' => 'Nome-Usuario-Teste',
            'email' => 'email@teste.com',
            'senha' => 'Senha-Teste',
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
        $resposta = $this->get(URL_RAIZ . 'login');
        $this->verificarContem($resposta, 'Login');
        $query = DW3BancoDeDados::query('SELECT * FROM usuarios WHERE nome = "Nome-Teste"');
        $bdUsuarios = $query->fetchAll();
        $this->verificar(count($bdUsuarios) == 1);
    }
}
