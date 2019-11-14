<?php
namespace Controlador;

use \Modelo\Produto;
use \Framework\DW3Sessao;
use \Framework\DW3Controlador;

class PedidoControlador extends Controlador
{

    public function index()
    {
        $this->verificarLogado();
        $this->visao('pedidos/index.php', [], 'administrador.php');
    }


    public function armazenar()
    {

    }



}
