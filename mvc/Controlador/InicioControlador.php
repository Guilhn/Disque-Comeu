<?php
namespace Controlador;


use \Modelo\Produto;
use \Framework\DW3Controlador;
use \Framework\DW3Sessao;


class InicioControlador extends Controlador
{
    public function criar()
    {
        $lista_produtos = Produto::buscarProdutos();
        $this->visao('inicio/index.php', [
            'produtos' => $lista_produtos
        ]);
    }
}
