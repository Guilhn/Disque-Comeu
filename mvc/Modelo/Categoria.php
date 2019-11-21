<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Categoria extends Modelo
{
    const BUSCAR_CATEGORIAS = 'SELECT * FROM categorias';
    const BUSCAR_STATUS = 'SELECT * FROM status_pedidos';

    private $id;
    private $nome;

    public function __construct($id, $nome) {
        $this->id = $id;
        $this->nome = $nome;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public static function buscarCategorias()
    {
        $registros = DW3BancoDeDados::query(self::BUSCAR_CATEGORIAS);
        $objetos = [];
        foreach ($registros as $registro) {
            $objetos[] = new Categoria($registro['id'], $registro['categoria']);
        }
        return $objetos;
    }

    public static function buscarStatus()
    {
        $registros = DW3BancoDeDados::query(self::BUSCAR_STATUS);
        $objetos = [];
        foreach ($registros as $registro) {
            $objetos[] = new Categoria($registro['id'], $registro['status_pedido']);
        }
        return $objetos;
    }
}
