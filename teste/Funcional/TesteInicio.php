<?php
namespace Teste\Funcional;

use \Teste\Teste;

class TesteInicio extends Teste
{

    public function testeInicio()
    {
        $resposta = $this->get(URL_RAIZ . 'inicio');
        $this->verificarContem($resposta, 'Infelizmente não temos produtos cadastrado ainda!');

    }
    
}
