<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Framework\DW3BancoDeDados;

class TesteAdmin extends Teste
{
    public function testeCriar()
    {
        $this->logarAdmin();
        $resposta = $this->get(URL_RAIZ . 'admin');
        $this->verificarContem($resposta, 'Criar conta administrador');
    }

    public function testeArmazenar()
    {
        $this->logarAdmin();
        $resposta = $this->post(URL_RAIZ . 'admin', [
            'nome' => 'Nome Teste',
            'sobrenome' => 'Teste',
            'nome_usuario' => 'usuario',
            'email' => 'email@teste.com',
            'senha' => '123456',
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'admin');
        $resposta = $this->get(URL_RAIZ . 'admin');
        $this->verificarContem($resposta, 'Criar conta administrador');
        $query = DW3BancoDeDados::query('SELECT * FROM usuarios WHERE nome = "Nome Teste"');
        $bdUsuarios = $query->fetchAll();
        $this->verificar(count($bdUsuarios) == 1);
    }


}
