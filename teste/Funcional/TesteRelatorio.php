<?php
namespace Teste\Funcional;

use \Teste\Teste;

class TesteRelatorio extends Teste
{

    public function testeIndex(){

        $this->logarAdmin();
        $resposta = $this->get(URL_RAIZ . 'relatorio');
        $this->verificarContem($resposta, 'Relatório');

    }
    
}
