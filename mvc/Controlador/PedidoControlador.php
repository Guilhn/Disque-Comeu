<?php
namespace Controlador;

use \Modelo\Produto;

class PedidoControlador extends Controlador
{

    public function index()
    {
        $this->verificarLogado();
        $this->visao('pedidos/index.php', [], 'administrador.php');
    }
}
