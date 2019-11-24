<?php

namespace Controlador;

use \Modelo\Usuario;
use \Modelo\Categoria;
use \Modelo\Pedido;
use \Modelo\ItemPedido;
use \Framework\DW3Sessao;

class UsuarioControlador extends Controlador
{
    public function criar()
    {
        $this->visao('usuarios/criar.php');
    }

    public function perfil()
    {
        $this->verificarLogado();
        $this->visao('usuarios/perfil.php', [], 'consumidor.php');
    }

    private function calcularPaginacao($limit)
    {
        $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
        $offset = ($pagina - 1) * $limit;
        $usuario = DW3Sessao::get('usuario');
        $pedidos = Pedido::buscarPedidoIdUsuario($_GET, $usuario->getId(), $limit, $offset);
        $ultimaPagina = ceil(Pedido::contarTodos($usuario->getId()) / $limit);
        if (!empty($_GET['status_id'])) {
            $totalPedidos = Pedido::contarPedidosStatus($usuario->getId(), $_GET['status_id']);
        } else {
            $totalPedidos = Pedido::contarTodos(($usuario->getId()));
        }
        return compact('pagina', 'pedidos', 'ultimaPagina', 'limit', 'totalPedidos');
    }

    public function pedidos()
    {
        $this->verificarLogado();
        $status = Categoria::buscarStatus();
        $paginacao = $this->calcularPaginacao(2);
        $this->visao('usuarios/pedidos.php', [
            'totalPedidos' => $paginacao['totalPedidos'],
            'limit' => $paginacao['limit'],
            'pedidos' => $paginacao['pedidos'],
            'pagina' => $paginacao['pagina'],
            'ultimaPagina' => $paginacao['ultimaPagina'],
            'status' => $status
        ], 'consumidor.php');
    }
    
    public function armazenar()
    {
        $foto = array_key_exists('foto', $_FILES) ? $_FILES['foto'] : null;
        $administrador = 0;
        $usuario = new Usuario($_POST['nome'], $_POST['sobrenome'], $_POST['nome_usuario'], $_POST['email'], $_POST['senha'], $administrador, $foto);

        if ($usuario->isValido()) {
            $usuario->salvar();
            DW3Sessao::setFlash('mensagem', 'Cadastro realizado com sucesso!');
            $this->redirecionar(URL_RAIZ . 'login');
            
        } else {
            $this->setErros($usuario->getValidacaoErros());
            $this->visao('usuarios/criar.php');
        }
    }
}
