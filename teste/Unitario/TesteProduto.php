<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Modelo\Mensagem;
use \Framework\DW3BancoDeDados;

class TesteMensagem extends Teste
{
    private $usuarioId;

    public function testeCadastrarProduto()
    {
        $produto = new Produto('nome-teste', 1, 'Descricao Teste', 00.00);
        $produto->salvar();
        $query = DW3BancoDeDados::query("SELECT * FROM produtos WHERE id = " . $produto->getId());
        $bdproduto = $query->fetch();
        $this->verificar($bdproduto['nome-teste'] === $produto->getNome());
    }
}
