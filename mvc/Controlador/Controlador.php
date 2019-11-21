<?php
namespace Controlador;

use \Modelo\Usuario;
use \Framework\DW3Controlador;
use \Framework\DW3Sessao;

abstract class Controlador extends DW3Controlador
{
    use ControladorVisao;
    
    protected $usuario;

    protected function verificarLogado()
    {
    	$usuario = $this->getUsuario();
        if ($usuario == null) {
        	$this->redirecionar(URL_RAIZ . 'login');
        }
    }

    protected function getUsuario()
    {
        if ($this->usuario == null) {
        	$usuario = DW3Sessao::get('usuario');
        	if ($usuario == null) {
        		return null;
        	}
        	$this->usuario = Usuario::buscarId($usuario->getId());
        }
        return $this->usuario;
    }
}
