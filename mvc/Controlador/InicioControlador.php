<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Usuario;

class InicioControlador extends Controlador
{
    public function criar()
    {
        $this->visao('inicio/index.php');
    }
}
