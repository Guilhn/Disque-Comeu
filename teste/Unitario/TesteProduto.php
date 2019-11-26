<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Produto;
use \Framework\DW3BancoDeDados;

class TesteProduto extends Teste
{

    public function testeInserir()
    {
        $produto = new Produto('nome teste', '1', 'Descricao Teste', '1');
        $produto->salvar();
        $query = DW3BancoDeDados::query('SELECT * FROM produtos ');
        $bdproduto = $query->fetchAll();
        $this->verificar(count($bdproduto) == 1);
    }

    public function testeAtualizar()
    {
        $produto = new Produto('nome teste', '1', 'Descricao Teste', '1');
        $produto->salvar();
        $produto->setNome('nome atualizado');
        $produto->setCategoriaId(2);
        $produto->salvar();
        $query = DW3BancoDeDados::query('SELECT * FROM produtos ');
        $bdproduto = $query->fetchAll();
        $this->verificar(count($bdproduto) == 1);
    }

    public function testeBuscarId()
    {
        $produto1 = new Produto('nome teste', '1', 'Descricao Teste', '1');
        $produto1->salvar();
        $produto2 = Produto::buscarId($produto1->getId());
        $this->verificar($produto1->getNome() == $produto2->getNome());
    }

    public function testeBuscarNomeCategpria()
    {
        $produto1 = new Produto('produto 01', '1', 'Descricao Teste', '1');
        $produto1->salvar();
        $categoria = Produto::buscarNomeCategoria($produto1->getCategoriaId());
        $this->verificar($categoria == 'Pizza');
    }

    public function testeBuscarProdutos()
    {
        $produto1 = new Produto('produto 01', '1', 'Descricao Teste', '1');
        $produto1->salvar();
        $produto2 = new Produto('produto 02', '1', 'Descricao Teste', '1');
        $produto2->salvar();
        $produtos = Produto::buscarProdutos();
        $this->verificar(count($produtos) == 2);
    }

    public function testeContarTodos()
    {
        $produto1 = new Produto('produto 01', '1', 'Descricao Teste', '1');
        $produto1->salvar();
        $produto2 = new Produto('produto 02', '1', 'Descricao Teste', '1');
        $produto2->salvar();
        $total = Produto::contarTodos();
        $this->verificar($total == 2);
    }

    public function testecontarPedidosStatus()
    {
        $produto1 = new Produto('produto 01', '1', 'Descricao Teste', '1');
        $produto1->salvar();
        $produto2 = new Produto('produto 02', '1', 'Descricao Teste', '1');
        $produto2->salvar();
        $produto3 = new Produto('produto 03', '2', 'Descricao Teste', '1');
        $produto3->salvar();
        $total = Produto::contarProdutosCategoria($produto1->getCategoriaId());
        $this->verificar($total == 2);
    }




}
