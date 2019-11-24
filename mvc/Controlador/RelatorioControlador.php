<?php
namespace Controlador;

use \Modelo\Produto;
use \Modelo\Relatorio;

class RelatorioControlador extends Controlador
{

    public function index()
    {

        $this->visao('relatorios/index.php', [
            'registros' => Relatorio::buscarRegistros($_GET)
        ], 'administrador.php');
    }
}
