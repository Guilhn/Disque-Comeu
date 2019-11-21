<?php
namespace Controlador;


use \Modelo\Produto;
use \Modelo\Categoria;


class InicioControlador extends Controlador
{

    private function calcularPaginacao()
    {
        $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
        $limit = 6;
        $offset = ($pagina - 1) * $limit;
        $listaProdutos = Produto::buscarProdutos($_GET, $limit, $offset);
        $ultimaPagina = ceil(Produto::contarTodos() / $limit);
        return compact('pagina', 'listaProdutos', 'ultimaPagina');
    }

    public function criar()
    {
        $paginacao = $this->calcularPaginacao();
        $categorias = Categoria::buscarCategorias();
        $this->visao('inicio/index.php', [
            'produtos' => $paginacao['listaProdutos'],
            'pagina' => $paginacao['pagina'],
            'ultimaPagina' => $paginacao['ultimaPagina'],
            'categorias' => $categorias
        ]);
    }
}
