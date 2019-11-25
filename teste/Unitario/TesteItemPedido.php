<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Pedido;
use \Modelo\Produto;
use \Modelo\ItemPedido;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteItemPedido extends Teste
{
    private $produtoId;
    private $pedidoId;
    private $valor;

    public function antes()
    {
        $contato = new Usuario('usuario', 'teste', 'usuario', 'email@teste.com', '123456');
        $contato->salvar();
        $data = date('Y-m-d');
        $pedido = new Pedido($contato->getId(), '1', $data, '100');
        $pedido->salvar();
        $this->pedidoId = $pedido->getId();
        $produto = new Produto('produto', '1', 'descricao', '10');
        $produto->salvar();
        $this->produtoId = $produto->getId();
        $this->valor = $produto->getValor();
    }


    public function testeInserir()
    {
        $itemPedido = new ItemPedido($this->pedidoId, $this->produtoId, $this->valor);
        $itemPedido->salvar();
        $query = DW3BancoDeDados::query('SELECT * FROM itens_pedidos ');
        $bditensPedido = $query->fetchAll();
        $this->verificar(count($bditensPedido) == 1);
    }

    public function testeBuscarId()
    {
        $itemPedido1 = new ItemPedido($this->pedidoId, $this->produtoId, $this->valor);
        $itemPedido1->salvar();
        $itemPedido2 = ItemPedido::buscarId($itemPedido1->getId());
        $this->verificar($itemPedido1->getValor() == $itemPedido2->getValor());
    }

    public function testeBuscarPedidoId()
    {
        $itemPedido1 = new ItemPedido($this->pedidoId, $this->produtoId, $this->valor);
        $itemPedido1->salvar();
        $bditensPedido = ItemPedido::buscarPedidoId($this->pedidoId);
        $this->verificar($bditensPedido[0]->getValor() == $itemPedido1->getValor());
    }

}
