<?php

namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Pedido extends Modelo
{
    const BUSCAR_ID = 'SELECT id, usuario_id, status_pedido_id, data_pedido, total FROM pedidos WHERE id = ?';
    const BUSCAR_PEDIDO_ID_USUARIO = 'SELECT id, usuario_id, status_pedido_id, data_pedido, total FROM pedidos WHERE usuario_id = ?';
    const BUSCAR_PEDIDOS = 'SELECT id, usuario_id, status_pedido_id, data_pedido, total FROM pedidos ORDER BY id desc';
    const BUSCAR_NOME_STAUS = 'SELECT status_pedido FROM status_pedidos WHERE id = ?';
    const INSERIR = 'INSERT INTO pedidos(usuario_id,status_pedido_id,data_pedido,total) VALUES (?, ?, ?, ?)';
    const ATUALIZAR_STATUS = 'UPDATE pedidos SET status_pedido_id = ? WHERE id = ?';
    const CONTAR_TODOS = 'SELECT count(id) FROM pedidos WHERE usuario_id = ?';
    const CONTAR_PEDIDOS_STATUS = 'SELECT count(id) FROM pedidos WHERE usuario_id = ?';


    private $id;
    private $usuarioId;
    private $statusPedidoId;
    private $dataPedido;
    private $total;


    public function __construct(
        $usuarioId,
        $statusPedidoId = 1,
        $dataPedido = null,
        $total,
        $id = null
    ) {
        $this->id = $id;
        $this->usuarioId = $usuarioId;
        $this->statusPedidoId = $statusPedidoId;
        $this->dataPedido = $dataPedido;
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

    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    public function setUsuarioId($usuarioId)
    {
        $this->usuarioId = $usuarioId;
    }

    public function getDataPedido()
    {
        return $this->dataPedido;
    }

    public function getDataPedidoFormatada()
    {
        $data = date_create($this->dataPedido);
        return date_format($data, 'd/m/Y');
    }

    public function getStausPedidoId()
    {
        return $this->statusPedidoId;
    }

    public function setStausPedidoId($statusPedidoId)
    {
        $this->statusPedidoId = $statusPedidoId;
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
        $comando->bindValue(1, $this->usuarioId);
        $comando->bindValue(2, $this->statusPedidoId);
        $comando->bindValue(3, $this->dataPedido);
        $comando->bindValue(4, $this->total);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public function atualizar()
    {
        $comando = DW3BancoDeDados::prepare(self::ATUALIZAR_STATUS);
        $comando->bindValue(1, $this->statusPedidoId, PDO::PARAM_STR);
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
            $registro['usuario_id'],
            $registro['status_pedido_id'],
            $registro['data_pedido'],
            $registro['total'],
            $registro['id']
        );
    }

    public static function buscarPedidoIdUsuario($filtro = [], $id, $limit = 2, $offset = 0)
    {

        $sqlWhere = '';
        $parametro = '';
   
        if (array_key_exists('status_id', $filtro) && $filtro['status_id'] != '') {
            $parametro = $filtro['status_id'];
            $sqlWhere .= ' AND status_pedido_id = ?';
        }

        $sql = self::BUSCAR_PEDIDO_ID_USUARIO . $sqlWhere . ' ORDER BY id desc LIMIT ? OFFSET ?';

        $comando = DW3BancoDeDados::prepare($sql);
        $parametroNumero = 1;
        $comando->bindValue($parametroNumero, $id, PDO::PARAM_INT);

        if ($parametro != '') {
            $comando->bindValue($parametroNumero + 1, $parametro, PDO::PARAM_INT);
            $parametroNumero++;
        }

        $comando->bindValue($parametroNumero + 1, $limit, PDO::PARAM_INT);
        $comando->bindValue($parametroNumero + 2, $offset, PDO::PARAM_INT);
        $comando->execute();
        $registros = $comando->fetchAll();
        $listaPedidos = [];
        foreach ($registros as $registro) {
            $listaPedidos[] = new Pedido(
                $registro['usuario_id'],
                $registro['status_pedido_id'],
                $registro['data_pedido'],
                $registro['total'],
                $registro['id']

            );
        }
        return $listaPedidos;
    }

    public static function contarTodos($id)
    {
        $comando = DW3BancoDeDados::prepare(self::CONTAR_TODOS);        
        $comando->bindValue(1, $id);
        $comando->execute();
        $total = $comando->fetch();
        return intval($total[0]);
    }

    public static function contarPedidosStatus($usuarioId, $statusId)
    {
        $sqlWhere = '';

        if ($statusId != null) {
            $sqlWhere .= ' AND status_pedido_id = ?';
        }

        $sql = self::CONTAR_PEDIDOS_STATUS . $sqlWhere;
        $comando = DW3BancoDeDados::prepare($sql);
        $parametroNumero = 1;
        $comando->bindValue($parametroNumero, $usuarioId);
        if ($usuarioId != null) {
            $comando->bindValue($parametroNumero + 1, $statusId);
        }
        $comando->execute();
        
        $total = $comando->fetch();
        
        return intval($total[0]);

        
    }

    public static function buscarNomeStatus($statusPedidoId)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_NOME_STAUS);
        $comando->bindValue(1, $statusPedidoId, PDO::PARAM_STR);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {

            $objeto = $registro['status_pedido'];
        }
        return $objeto;
    }


    public static function buscarPedido()
    {
        $registros = DW3BancoDeDados::query(self::BUSCAR_PEDIDOS);
        $listaPedidos = [];
        foreach ($registros as $registro) {
            $listaPedidos[] = new Pedido(
                $registro['usuario_id'],
                $registro['status_pedido_id'],
                $registro['data_pedido'],
                $registro['total'],
                $registro['id']

            );
        }
        return $listaPedidos;
    }
}
