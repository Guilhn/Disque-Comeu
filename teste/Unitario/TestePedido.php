<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Pedido;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TestePedido extends Teste
{
    private $usuarioId;
    private $data;

    public function antes()
    {
        $contato = new Usuario('usuario', 'teste', 'usuario', 'email@teste.com', '123456');
        $contato->salvar();
        $this->usuarioId = $contato->getId();
        $this->data = date('Y-m-d');

    }

    public function testeInserir()
    {
        $pedido = new Pedido($this->usuarioId, 1, $this->data, 100);
        $pedido->salvar();
        $query = DW3BancoDeDados::query('SELECT * FROM pedidos ');
        $bdpedido = $query->fetchAll();
        $this->verificar(count($bdpedido) == 1);
    }

    public function testeAtualizar()
    {

        $pedido = new Pedido($this->usuarioId, 1, $this->data, 100);
        $pedido->salvar();

        $pedido->setStausPedidoId(2);
        $pedido->salvar();
        $query = DW3BancoDeDados::query('SELECT * FROM pedidos ');
        $bdpedido = $query->fetchAll();
        $this->verificar(count($bdpedido) == 1);
    }

    public function testeBuscarId()
    {
        $pedido1 = new Pedido($this->usuarioId, 1, $this->data, 100);
        $pedido1->salvar();
        $pedido2 = Pedido::buscarId($pedido1->getId());
        $this->verificar($pedido1->getTotal() == $pedido2->getTotal());
    }

    public function testeBuscarPedidoIdUsuario()
    {
        $pedido1 = new Pedido($this->usuarioId, 1, $this->data, 100);
        $pedido1->salvar();
        $pedidos = Pedido::buscarPedidoIdUsuario($filtro = [], $this->usuarioId);
        $this->verificar(count($pedidos) == 1);
    }

    public function testeContarTodos()
    {
        $pedido1 = new Pedido($this->usuarioId, 1, $this->data, 100);
        $pedido1->salvar();
        $total = Pedido::contarTodos($this->usuarioId);
        $this->verificar($total == 1);
    }

    public function testeContarPedidosStatus()
    {
        $pedido1 = new Pedido($this->usuarioId, 1, $this->data, 100);
        $pedido1->salvar();
        $pedido2 = new Pedido($this->usuarioId, 1, $this->data, 100);
        $pedido2->salvar();
        $bdpedido = Pedido::contarPedidosStatus($this->usuarioId, $pedido1->getStausPedidoId());
        $this->verificar($bdpedido == 2);
    }

    public function testeBuscarNomeStatus()
    {
        $pedido1 = new Pedido($this->usuarioId, 1, $this->data, 100);
        $pedido1->salvar();
        $status = Pedido::buscarNomeStatus($pedido1->getStausPedidoId());
        $this->verificar($status == 'Pedido Novo');
    }

    public function testeBuscarPedidos()
    {
        $pedido1 = new Pedido($this->usuarioId, 1, $this->data, 100);
        $pedido1->salvar();
        $pedido2 = new Pedido($this->usuarioId, 1, $this->data, 100);
        $pedido2->salvar();
        $bdpedido = Pedido::buscarPedido();
        $this->verificar(count($bdpedido) == 2);


    }


}
