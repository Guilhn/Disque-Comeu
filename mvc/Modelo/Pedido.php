<?php

namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Pedido extends Modelo
{
    const BUSCAR_ID = 'SELECT id, id_usuario, id_status_pedido, data_pedido, total FROM pedidos WHERE id = ?';
    const BUSCAR_PEDIDO_ID_USUARIO = 'SELECT id, id_usuario, id_status_pedido, data_pedido, total FROM pedidos WHERE id_usuario = ?';
    const BUSCAR_PEDIDOS = 'SELECT id, id_usuario, id_status_pedido, data_pedido, total FROM pedidos';
    const BUSCAR_POR_STATUS = 'SELECT id, id_usuario, id_status_pedido, data_pedido, total FROM pedidos WHERE id_status_pedido = ? LIMIT 1';
    const BUSCAR_NOME_STAUS = 'SELECT status_pedido FROM status_pedidos WHERE id = ?';
    const INSERIR = 'INSERT INTO pedidos(id_usuario,id_status_pedido,data_pedido,total) VALUES (?, ?, ?, ?)';
    const ATUALIZAR_STATUS = 'UPDATE pedidos SET id_status_pedido = ? WHERE id = ?';
    
    private $id;
    private $id_usuario;
    private $id_status_pedido;
    private $data_pedido;
    private $total;


    public function __construct(
        $id_usuario,
        $id_status_pedido = 1,
        $data_pedido = null,
        $total,
        $id = null
    ) {
        $this->id = $id;
        $this->id_usuario = $id_usuario;
        $this->id_status_pedido = $id_status_pedido;
        $this->data_pedido = $data_pedido;
        $this->total = $total;

    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    public function getDataPedido()
    {
        return $this->data_pedido;
    }

    public function getDataPedidoFormatada()
    {
        $data = date_create($this->data_pedido);
        return date_format($data, 'd/m/Y');
    }

    public function setDataPedido()
    {
        $this->data_pedido = date('Y-m-d h:i:s');
    }


    public function getIdStausPedido()
    {
        return $this->id_status_pedido;
    }

    public function setIdStausPedido($id_status_pedido)
    {
        $this->id_status_pedido = $id_status_pedido;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setTotal($total)
    {
        $this->total = $total;
    }



    public function verificarErros()
    { 
        
    }

    public function salvar()
    {
        if ($this->id == null) {
            $this->inserir();
        } else {
            $this->atualizar();
        }
        
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->id_usuario);
        $comando->bindValue(2, $this->id_status_pedido);
        $comando->bindValue(3, $this->data_pedido);
        $comando->bindValue(4, $this->total);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public function atualizar()
    {
        $comando = DW3BancoDeDados::prepare(self::ATUALIZAR_STATUS);
        $comando->bindValue(1, $this->id_status_pedido, PDO::PARAM_STR);
        $comando->bindValue(2, $this->id, PDO::PARAM_INT);
        $comando->execute();
    }

    public static function buscarId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
        $comando->bindValue(1, $id);
        $comando->execute();
        $registro = $comando->fetch();
        return new Pedido(
            $registro['id_usuario'],
            $registro['id_status_pedido'],
            $registro['data_pedido'],
            $registro['total'],
            $registro['id']
        );
    }

    public static function buscarPedidoIdUsuario($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_PEDIDO_ID_USUARIO);
        $comando->bindValue(1, $id);
        $comando->execute();
        $registros = $comando->fetchAll();
        $lista_pedidos = [];
        foreach ($registros as $registro) {
            $lista_pedidos[] = new Pedido(
                $registro['id_usuario'],
                $registro['id_status_pedido'],
                $registro['data_pedido'],
                $registro['total'],
                $registro['id']

            );
        }
        return $lista_pedidos;
    }

    public static function buscarNomeStatus($id_status_pedido)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_NOME_STAUS);
        $comando->bindValue(1, $id_status_pedido, PDO::PARAM_STR);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {

            $objeto = $registro['status_pedido'];
        }
        return $objeto;
    }

    public static function buscarStaus($id_status_pedido)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_POR_STATUS);
        $comando->bindValue(1, $id_status_pedido, PDO::PARAM_STR);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Pedido(
                $registro['id_usuario'],
                $registro['id_status_pedido'],
                $registro['data_pedido'],
                $registro['total'],
                $registro['id']
            );
        }
        return $objeto;
    }

    public static function buscarPedido()
    {
        $registros = DW3BancoDeDados::query(self::BUSCAR_PEDIDOS);
        $lista_pedidos = [];
        foreach ($registros as $registro) {
            $lista_pedidos[] = new Pedido(
                $registro['id_usuario'],
                $registro['id_status_pedido'],
                $registro['data_pedido'],
                $registro['total'],
                $registro['id']

            );
        }
        return $lista_pedidos;
    }
}
