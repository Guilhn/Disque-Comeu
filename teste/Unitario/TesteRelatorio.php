<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Relatorio;
use \Modelo\Pedido;
use \Modelo\Usuario;

class TesteRelatorio extends Teste
{

    public function testebuscarRegistros()
    {
        $contato1 = new Usuario('usuario', 'teste', 'usuario', 'email@teste.com', '123456');
        $contato1->salvar();
        $data = date('Y-m-d');
        $pedido = new Pedido($contato1->getId(), 1, $data, 100);
        $pedido->salvar();
        $registros = Relatorio::buscarRegistros();
        $this->verificar(count($registros) == 2);
        $this->verificar($registros[0]['status_pedido_id'] == 1);
        $this->verificar($registros[1]['total_pedido'] == 100);
    }





}
