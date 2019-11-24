<?php

namespace Controlador;

use \Modelo\Produto;
use \Modelo\Pedido;
use \Modelo\Categoria;
use \Modelo\ItemPedido;
use \Framework\DW3Sessao;

class PedidoControlador extends Controlador
{

    public function index()
    {
        $this->verificarLogado();
        $listaPedidos = Pedido::buscarPedido();
        $this->visao('pedidos/index.php', [
            'pedidos' => $listaPedidos,
            'mensagem' => DW3Sessao::getFlash('mensagem', null)
        ], 'administrador.php');
    }

    public function editar($id)
    {
        $this->verificarLogado();
        $pedido = Pedido::buscarId($id);
        $status = Categoria::buscarStatus();
        $this->visao('pedidos/editar.php', [
            'pedido' => $pedido,
            'status' => $status
        ], 'administrador.php');
    }

    public function atualizar($id)
    {
        $this->verificarLogado();
        $pedido = Pedido::buscarId($id);
        $pedido->setStausPedidoId($_POST['status_pedido']);
        $pedido->salvar();
        DW3Sessao::setFlash('mensagem', 'Status atualizado com sucesso!');
        $this->redirecionar(URL_RAIZ . 'pedidos');
    }


    public function armazenar()
    {
        $this->verificarLogado();
        $usuario = DW3Sessao::get('usuario');
        $data = date('Y-m-d');
        $pedido = new Pedido($usuario->getId(), '1', $data, $_POST['total'], null);
        $pedido->salvar();

        $idPedido = $pedido->getId();
        $itemCarrinho = DW3Sessao::get('carrinho');
        if ($itemCarrinho != null) {
            $tamanho = count($itemCarrinho);
            $carrinho = [];
            for ($i = 0; $i < $tamanho; $i++) {
                $carrinho[] = Produto::buscarId($itemCarrinho[$i]);
            }
            for ($i = 0; $i < $tamanho; $i++) {
                $itensPedido = new ItemPedido($idPedido, $carrinho[$i]->getId(), $carrinho[$i]->getValor());
                $itensPedido->salvar();
            }
            DW3Sessao::deletar('carrinho');
            DW3Sessao::setFlash('mensagem', 'Pedido realizado com sucesso!');
            $this->redirecionar(URL_RAIZ . 'produtos');
        } else {
            $this->visao('carrinho/index.php', [], 'consumidor.php');
        }
    }
}
