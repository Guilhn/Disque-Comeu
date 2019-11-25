<?php
namespace Controlador;


use \Modelo\Produto;
use \Modelo\Categoria;


class InicioControlador extends Controlador
{

    private function calcularPaginacao($limit)
    {
        $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
        $offset = ($pagina - 1) * $limit;
        $listaProdutos = Produto::buscarProdutos($_GET, $limit, $offset);
        $ultimaPagina = ceil(Produto::contarTodos() / $limit);
        if (!empty($_GET['categoria_id'])) {
            $totalProdutos = Produto::contarProdutosCategoria($_GET['categoria_id']);
        } else {
            $totalProdutos = Produto::contarTodos();
        }
        return compact('pagina', 'listaProdutos', 'ultimaPagina', 'limit', 'totalProdutos');
    }

    public function criar()
    {
        $paginacao = $this->calcularPaginacao(6);
        $categorias = Categoria::buscarCategorias();
        $this->visao('inicio/index.php', [
            'totalProdutos' => $paginacao['totalProdutos'],
            'limit' => $paginacao['limit'],
            'produtos' => $paginacao['listaProdutos'],
            'pagina' => $paginacao['pagina'],
            'ultimaPagina' => $paginacao['ultimaPagina'],
            'categorias' => $categorias
        ]);
    }
}
