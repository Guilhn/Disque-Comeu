<?php

namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Itens_Pedido extends Modelo
{
    const BUSCAR_ID = 'SELECT id, id_pedido, id_produto, quantidade, valor FROM itens_pedidos WHERE id = ?';
    const BUSCAR_ID_PEDIDO = 'SELECT id, id_pedido, id_produto, quantidade, valor FROM itens_pedidos WHERE id_pedido = ?';
    const BUSCAR_ITENS_PEDIDOS = 'SELECT id, id_pedido, id_produto, quantidade, valor FROM itens_pedidos';
    const INSERIR = 'INSERT INTO itens_pedidos(id_pedido,id_produto,quantidade,valor) VALUES (?, ?, ?, ?)';
    
    private $id;
    private $id_pedido;
    private $id_produto;
    private $quantidade;
    private $valor;


    public function __construct(
        $id_pedido,
        $id_produto,
        $quantidade,
        $valor,
        $id = null
    ) {
        $this->id = $id;
        $this->id_pedido = $id_pedido;
        $this->id_produto = $id_produto;
        $this->quantidade = $quantidade;
        $this->valor = $valor;

    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIdPedido()
    {
        return $this->id_pedido;
    }

    public function setIdPedido($id_pedido)
    {
        $this->id_pedido = $id_pedido;
    }

    public function getIdProduto()
    {
        return $this->id_produto;
    }

    public function setIdProduto($id_produto)
    {
        $this->id_produto = $id_produto;
    }


    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function setTotal($valor)
    {
        $this->valor = $valor;
    }

    public function verificarErros()
    { 
        
    }

    public function salvar()
    {
        $this->inserir();
        
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->id_pedido);
        $comando->bindValue(2, $this->id_produto);
        $comando->bindValue(3, $this->quantidade);
        $comando->bindValue(4, $this->valor);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public static function buscarId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
        $comando->bindValue(1, $id);
        $comando->execute();
        $registro = $comando->fetch();
        return new Itens_Pedido(
            $registro['id_pedido'],
            $registro['id_produto'],
            $registro['quantidade'],
            $registro['valor'],
            $registro['id']
        );
    }

    public static function buscarIdPedido($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID_PEDIDO);
        $comando->bindValue(1, $id);
        $comando->execute();
        $registro = $comando->fetch();
        return new Itens_Pedido(
            $registro['id_pedido'],
            $registro['id_produto'],
            $registro['quantidade'],
            $registro['valor'],
            $registro['id']
        );
    }

    public static function buscarItensPedido()
    {
        $registros = DW3BancoDeDados::query(self::BUSCAR_ITENS_PEDIDOS);
        $itens_pedido = [];
        foreach ($registros as $registro) {
            $itens_pedido[] = new Itens_Pedido(
                $registro['id_pedido'],
                $registro['id_produto'],
                $registro['quantidade'],
                $registro['valor'],
                $registro['id']

            );
        }
        return $itens_pedido;
    }
}
