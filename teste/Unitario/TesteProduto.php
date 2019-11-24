<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Modelo\Produto;
use \Framework\DW3BancoDeDados;

class TesteProduto extends Teste
{
    private $usuarioId;

    public function testeArmazenar()
    {
        $produto = new Produto('nome-teste', '1', 'Descricao Teste', '00.00');
        $produto->salvar();
        $query = DW3BancoDeDados::query('SELECT * FROM produtos ');
        $bdproduto = $query->fetchAll();
        $this->verificar(count($bdproduto) == 1);
    }

    public function testeBuscarId()
    {
        $produto1 = new Produto('nome-teste', '1', 'Descricao Teste', '00.00');
        $produto1->salvar();
        $produto2 = Produto::buscarId($produto1->getId());
        $this->verificar($produto1->getNome() == $produto2->getNome());
    }

    public function testeBuscarCategoria()
    {
        $categoria1 = 1;
        $categoria2 = 2;
        $produto1 = new Produto('produto - 01 ', $categoria1, 'produto - 01', '00.00');
        $produto1->salvar();
        $produto2 = new Produto('produto - 01 ', $categoria1, 'produto - 01', '00.00');
        $produto2->salvar();
        $produto3 = new Produto('produto - 02', $categoria2, 'produto - 02', '00.00');
        $produto3->salvar();
        $produtos = Produto::buscarCategoria($categoria1);
        $this->verificar(count($produtos) == 2);
    }

    public function testeBuscarProdutos()
    {
        $produto1 = new Produto('produto - 01', '1', 'produto - 01', '00.00');
        $produto1->salvar();
        $produto2 = new Produto('produto - 02', '1', 'produto - 02', '00.00');
        $produto2->salvar();
        $produtos = Produto::buscarProdutos();
        $this->verificar(count($produtos) == 2);
    }


}
