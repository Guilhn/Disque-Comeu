<?php
namespace Controlador;

use \Modelo\Produto;

class RelatorioControlador extends Controlador
{

    public function index()
    {
        $this->verificarLogado();
        $this->visao('relatorio/index.php', [], 'administrador.php');
    }
}
