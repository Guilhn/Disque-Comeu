<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteUsuario extends Teste
{
    private $usuarioId;

    public function testeInserir()
    {
        $usuario = new Usuario('usuario', 'teste', 'usuario', 'email@teste.com', '123456');
        $usuario->salvar();
        $query = DW3BancoDeDados::query('SELECT * FROM usuarios WHERE nome = "usuario"');
        $bdUsuarios = $query->fetchAll();
        $this->verificar(count($bdUsuarios) == 1);
    }

    public function testeBuscarId()
    {
        $contato1 = new Usuario('usuario', 'teste', 'usuario', 'email@teste.com', '123456');
        $contato1->salvar();
        $contato2 = Usuario::buscarId($contato1->getId());
        $this->verificar($contato1->getNome() == $contato2->getNome());
    }

    public function testeBuscarNome()
    {
        $contato = new Usuario('usuario', 'teste', 'usuario', 'email@teste.com', '123456');
        $contato->salvar();
        $contato = Usuario::buscarNomeUsuario('usuario');
        $this->verificar($contato != null);
        $this->verificar($contato->getNome() == 'usuario');
    }
}
