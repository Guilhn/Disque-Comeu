<?php

namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class ItemPedido extends Modelo
{
    const BUSCAR_ID = 'SELECT id, pedido_id, produto_id, valor FROM itens_pedidos WHERE id = ?';
    const BUSCAR_ID_PEDIDO = 'SELECT id, pedido_id, produto_id, valor FROM itens_pedidos WHERE pedido_id = ?';
    const INSERIR = 'INSERT INTO itens_pedidos(pedido_id,produto_id,valor) VALUES (?, ?, ?)';
    
    private $id;
    private $pedidoId;
    private $produtoId;
    private $valor;


    public function __construct(
        $pedidoId,
        $produtoId,
        $valor,
        $id = null
    ) {
        $this->id = $id;
        $this->pedidoId = $pedidoId;
        $this->produtoId = $produtoId;
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

    public function getPedidoId()
    {
        return $this->pedidoId;
    }

    public function setPedidoId($pedidoId)
    {
        $this->pedidoId = $pedidoId;
    }

    public function getProdutoId()
    {
        return $this->produtoId;
    }

    public function setProdutoId($produtoId)
    {
        $this->produtoId = $produtoId;
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
        $comando->bindValue(1, $this->pedidoId, PDO::PARAM_INT);
        $comando->bindValue(2, $this->produtoId, PDO::PARAM_INT);
        $comando->bindValue(3, $this->valor, PDO::PARAM_INT);
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
        return new ItemPedido(
            $registro['pedido_id'],
            $registro['produto_id'],
            $registro['valor'],
            $registro['id']
        );
    }

    public static function buscarPedidoId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID_PEDIDO);
        $comando->bindValue(1, $id);
        $comando->execute();
        $registros = $comando->fetchAll();
        $lista_itens_pedido=[];
        foreach ($registros as $registro) {
            $lista_itens_pedido[] = new ItemPedido(
                $registro['pedido_id'],
                $registro['produto_id'],
                $registro['valor'],
                $registro['id']
            );
        }
        return $lista_itens_pedido;
    }

}
