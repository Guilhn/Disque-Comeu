<?php
namespace Controlador;

use \Modelo\Produto;
use \Modelo\Pedido;
use \Framework\DW3Sessao;
use \Framework\DW3Controlador;

class CarrinhoControlador extends Controlador
{

    public function armazenar($id)
    {
        $produto = Produto::buscarId($id);
        $usuarioId = DW3Sessao::get('usuario');
        var_dump($produto);
        exit;
    
    }
    
 

}
