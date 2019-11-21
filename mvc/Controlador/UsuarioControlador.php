<?php

namespace Controlador;

use \Modelo\Usuario;
use \Modelo\Produto;
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

    private function calcularPaginacao()
    {
        $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
        $limit = 2;
        $offset = ($pagina - 1) * $limit;
        $usuario = DW3Sessao::get('usuario');
        $pedidos = Pedido::buscarPedidoIdUsuario($usuario->getId(), $limit, $offset);
        $ultimaPagina = ceil(Pedido::contarTodos($usuario->getId()) / $limit);
        return compact('pagina', 'pedidos', 'ultimaPagina');
    }

    public function pedidos()
    {
        $this->verificarLogado();
        $paginacao = $this->calcularPaginacao();
        $this->visao('usuarios/pedidos.php', [
            'pedidos' => $paginacao['pedidos'],
            'pagina' => $paginacao['pagina'],
            'ultimaPagina' => $paginacao['ultimaPagina'],
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
