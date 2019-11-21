<?php
namespace Controlador;


use \Modelo\Produto;


class InicioControlador extends Controlador
{
    public function criar()
    {
        $listaProdutos = Produto::buscarProdutos();
        $this->visao('inicio/index.php', [
            'produtos' => $listaProdutos
        ]);
    }
}
