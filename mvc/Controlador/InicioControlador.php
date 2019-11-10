<?php
namespace Controlador;

use \Framework\DW3Controlador;
use \Framework\DW3Sessao;


class InicioControlador extends Controlador
{
    public function criar()
    {
        $this->visao('inicio/index.php');
    }
}
