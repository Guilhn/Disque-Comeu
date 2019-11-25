<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Categoria;


class TesteCategoria extends Teste
{

    public function testeBuscarCategorias()
    {
        $categorias = Categoria::buscarCategorias();
        $this->verificar(count($categorias) == 4);
    }

    public function testeBuscarStatus()
    {
        $status = Categoria::buscarStatus();
        $this->verificar(count($status) == 4);
    }

}
