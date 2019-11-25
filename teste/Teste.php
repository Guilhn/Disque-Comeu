<?php
namespace Teste;

use \Modelo\Usuario;
use \Framework\DW3Teste;
use \Framework\DW3Sessao;

class Teste extends DW3Teste
{
	protected $usuario;

	public function logar()
	{
		$this->usuario = new Usuario('usuario', 'teste', 'usuario', 'email@teste.com', '123456');
		$this->usuario->salvar();
		DW3Sessao::set('usuario', $this->usuario);
	}
	
}
