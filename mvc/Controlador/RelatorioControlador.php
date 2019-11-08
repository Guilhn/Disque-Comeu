<?php
namespace Controlador;

use \Modelo\Produto;

class RelatorioControlador extends Controlador
{

    public function index()
    {
        $this->visao('relatorio/index.php', [], 'administrador.php');
    }
}
