<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Pedido;
use \Framework\DW3Sessao;

class TestePedido extends Teste
{
    public function testeIndex(){
        $this->logar();
        $resposta = $this->get(URL_RAIZ . 'pedidos');
        $this->verificarContem($resposta, 'Pedidos');
    }

    public function testeEditar(){
        $this->logarAdmin();
        $usuario = DW3Sessao::get('usuario');
        $data = date('Y-m-d');
        $pedido = new Pedido($usuario->getId(), 1, $data, 100);
        $pedido->salvar();
        $resposta = $this->get(URL_RAIZ . 'pedidos/'. $pedido->getId() . '/editar');
        $this->verificarContem($resposta, 'Status do pedido');
        $this->verificarContem($resposta, $pedido->getId());
        $this->verificarContem($resposta, $pedido->getTotal());
    }
    
    public function testeAtualizar(){
        $this->logarAdmin();
        $usuario = DW3Sessao::get('usuario');
        $data = date('Y-m-d');
        $pedido = new Pedido($usuario->getId(), 1, $data, 100);
        $pedido->salvar();
        $resposta = $this->patch(URL_RAIZ . 'pedidos/' . $pedido->getId(), [
            'status_pedido' => 2,
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'pedidos');
        $resposta = $this->get(URL_RAIZ . 'pedidos');
        $this->verificarContem($resposta, 'Leu o pedido');
        
    }

    public function testeArmazenar(){
        $this->logar();
        $resposta = $this->post(URL_RAIZ . 'pedidos', [
            'total' => 100,
        ]);
        $resposta = $this->get(URL_RAIZ . 'produtos');
        $this->verificarContem($resposta, 'Produtos');
    }
}
