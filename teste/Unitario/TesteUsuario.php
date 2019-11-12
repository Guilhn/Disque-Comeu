<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteUsuario extends Teste
{
    private $usuarioId;

    public function testeArmazenar()
    {
        $usuario = new Usuario('Nome-Teste', 'Sobrenome-Teste', 'Nome-Usuario-Teste', 'email@teste.com', 'Senha-Teste');
        $usuario->salvar();
        $query = DW3BancoDeDados::query('SELECT * FROM usuarios WHERE nome = "Nome-Teste"');
        $bdUsuarios = $query->fetchAll();
        $this->verificar(count($bdUsuarios) == 1);
    }

    public function testeBuscarId()
    {
        $contato1 = new Usuario('Nome-Teste', 'Sobrenome-Teste', 'Nome-Usuario-Teste', 'email@teste.com', 'Senha-Teste');
        $contato1->salvar();
        $contato2 = Usuario::buscarId($contato1->getId());
        $this->verificar($contato1->getNome() == $contato2->getNome());
    }

    public function testeBuscarNome()
    {
        (new Usuario('Nome-Teste', 'Sobrenome-Teste', 'Nome-Usuario-Teste', 'email@teste.com', 'Senha-Teste'))->salvar();
        $contato = Usuario::buscarNomeUsuario('Nome-Usuario-Teste');
        $this->verificar($contato != null);
    }
}
