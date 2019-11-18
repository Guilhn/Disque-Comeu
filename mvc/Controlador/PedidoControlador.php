<?php

namespace Controlador;

use \Modelo\Produto;
use \Modelo\Pedido;
use \Modelo\Itens_Pedido;
use \Framework\DW3Sessao;
use \Framework\DW3Controlador;

class PedidoControlador extends Controlador
{

    public function index()
    {
        $this->verificarLogado();
        $lista_pedidos = Pedido::buscarPedido();
        $this->visao('pedidos/index.php', [
            'pedidos' => $lista_pedidos,
            'mensagem' => DW3Sessao::getFlash('mensagem', null)
        ], 'administrador.php');
    }

    public function editar($id)
    {
        $this->verificarLogado();
        $pedido = Pedido::buscarId($id);
        $status = Pedido::buscarNomeStatus($pedido->getIdStausPedido());
        $this->visao('pedidos/editar.php', [
            'pedido' => $pedido,
            'status' => $status
        ], 'administrador.php');
    }

    public function atualizar($id)
    {
        $this->verificarLogado();
        $pedido = Pedido::buscarId($id);
        $pedido->setIdStausPedido($_POST['status_pedido']);
        $pedido->salvar();
        DW3Sessao::setFlash('mensagem', 'Status atualizado com sucesso!');
        $this->redirecionar(URL_RAIZ . 'pedidos');
    }


    public function armazenar()
    {
        $this->verificarLogado();
        $usuarioId = DW3Sessao::get('usuario');
        $data = date('Y-m-d');
        $pedido = new Pedido($usuarioId, '1', $data, $_POST['total'], null);
        $pedido->salvar();

        $idPedido = $pedido->getId();
        $item_carrinho = DW3Sessao::get('carrinho');
        if ($item_carrinho != null) {
            $tamanho = count($item_carrinho);
            $carrinho = [];
            for ($i = 0; $i < $tamanho; $i++) {
                $carrinho[] = Produto::buscarId($item_carrinho[$i]);
            }
            for ($i = 0; $i < $tamanho; $i++) {
                $itensPedido = new Itens_Pedido($idPedido, $carrinho[$i]->getId(), $carrinho[$i]->getValor());
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
