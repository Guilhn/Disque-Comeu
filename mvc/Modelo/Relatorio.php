<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Relatorio
{
    const BUSCAR_TODOS = 'SELECT id, usuario_id, status_pedido_id, data_pedido, total FROM pedidos WHERE TRUE';

    public static function buscarRegistros($filtro = [])
    {
        $sqlWhere = '';
        $parametros = [];
        if (array_key_exists('dataInicio', $filtro) && $filtro['dataInicio'] != '') {
            $parametros[] = $filtro['dataInicio'];
            $sqlWhere .= ' AND data_pedido >= ?';
        }
        if (array_key_exists('dataFim', $filtro) && $filtro['dataFim'] != '') {
            $parametros[] = $filtro['dataFim'];
            $sqlWhere .= ' AND data_pedido <= ?';
        }
        
        $sql = self::BUSCAR_TODOS . $sqlWhere . '  ORDER BY id desc';
        $comando = DW3BancoDeDados::prepare($sql);
        foreach ($parametros as $i => $parametro) {
            $comando->bindValue($i+1, $parametro, PDO::PARAM_STR);
        }
        $comando->execute();
        $registros = $comando->fetchAll();
        $totalPedidos = 0;
        foreach ($registros as $registro) {
            $totalPedidos += $registro['total'];
        }
        $registros[] = [
            'total_pedido' => $totalPedidos
        ];
        return $registros;
    }
}
