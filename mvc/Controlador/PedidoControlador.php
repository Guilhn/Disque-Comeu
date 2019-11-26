<?php

namespace Controlador;

use \Modelo\Produto;
use \Modelo\Pedido;
use \Modelo\Categoria;
use \Modelo\ItemPedido;
use \Framework\DW3Sessao;

class PedidoControlador extends Controlador
{

    private function calcularPaginacao($limit)
    {
        $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
        $offset = ($pagina - 1) * $limit;
        $pedidos = Pedido::buscarPedidos($_GET, $limit, $offset);
        $ultimaPagina = ceil(Pedido::contarTodosPedidos() / $limit);
        if (!empty($_GET['status_id'])) {
            $totalPedidos = Pedido::contarTodosPedidosStatus($_GET['status_id']);
        } else {
            $totalPedidos = Pedido::contarTodosPedidos();
        }
        return compact('pagina', 'pedidos', 'ultimaPagina', 'limit', 'totalPedidos');
    }

    public function index()
    {
        $this->verificarLogado();
        $status = Categoria::buscarStatus();
        $paginacao = $this->calcularPaginacao(6);
        $this->visao('pedidos/index.php', [
            'totalPedidos' => $paginacao['totalPedidos'],
            'limit' => $paginacao['limit'],
            'pedidos' => $paginacao['pedidos'],
            'pagina' => $paginacao['pagina'],
            'ultimaPagina' => $paginacao['ultimaPagina'],
            'status' => $status,
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
