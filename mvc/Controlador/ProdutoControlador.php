<?php
namespace Controlador;

use \Modelo\Produto;
use \Modelo\Categoria;
use \Framework\DW3Sessao;
use \Framework\DW3Controlador;

class ProdutoControlador extends Controlador
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

    public function index()
    {
        $this->verificarLogado();
        $paginacao = $this->calcularPaginacao(6);
        $categorias = Categoria::buscarCategorias();
        $this->visao('produtos/index.php', [
            'totalProdutos' => $paginacao['totalProdutos'],
            'limit' => $paginacao['limit'],
            'produtos' => $paginacao['listaProdutos'],
            'pagina' => $paginacao['pagina'],
            'ultimaPagina' => $paginacao['ultimaPagina'],
            'categorias' => $categorias,
            'mensagem' => DW3Sessao::getFlash('mensagem', null)
        ],'consumidor.php');
    }

    public function listar()
    {

        $this->verificarLogado();
        $paginacao = $this->calcularPaginacao(8);
        $categorias = Categoria::buscarCategorias();
        $this->visao('produtos/listar.php', [
            'totalProdutos' => $paginacao['totalProdutos'],
            'limit' => $paginacao['limit'],
            'produtos' => $paginacao['listaProdutos'],
            'pagina' => $paginacao['pagina'],
            'ultimaPagina' => $paginacao['ultimaPagina'],
            'categorias' => $categorias,
            'mensagem' => DW3Sessao::getFlash('mensagem', null)
        ],'administrador.php');
    }

    public function criar()
    {   
        $categorias = Categoria::buscarCategorias();
        $this->verificarLogado();
        $this->visao('produtos/criar.php', [
            'categorias' => $categorias
        ], 'administrador.php');
    }


    public function armazenar()
    {
        $this->verificarLogado();
        $foto = array_key_exists('foto', $_FILES) ? $_FILES['foto'] : null;
        $produto = new Produto($_POST['nome'], $_POST['categoria_id'], $_POST['descricao'], $_POST['valor'], $foto);

        if ($produto->isValido()) {
            $produto->salvar();
            DW3Sessao::setFlash('mensagem', 'Produto cadastrado com sucesso!');
            $this->redirecionar(URL_RAIZ . 'produtos/listar');

        } else {
            $categorias = Categoria::buscarCategorias();
            $this->setErros($produto->getValidacaoErros());
            $this->visao('produtos/criar.php', [
                'categorias' => $categorias
            ], 'administrador.php');
        }
    }

    public function editar($id)
    {
        $this->verificarLogado();
        $produto = Produto::buscarId($id);
        $categorias = Categoria::buscarCategorias();
        $this->visao('produtos/editar.php', [
            'produto' => $produto,
            'categorias' => $categorias
        ], 'administrador.php');
    }

    public function atualizar($id)
    {
        $this->verificarLogado();
        $produto = Produto::buscarId($id);
        $categorias = Categoria::buscarCategorias();
        $produto->setNome($_POST['nome']);
        $produto->setCategoriaId($_POST['categoria_id']);
        $produto->setDescricao($_POST['descricao']);
        $produto->setValor($_POST['valor']);
        $produto->setId($id);
        if ($produto->isValido()) {
            $produto->salvar();
            DW3Sessao::setFlash('mensagem', 'Produto atualizado com sucesso.');
            $this->redirecionar(URL_RAIZ . 'produtos/listar');

        } else {
            $this->setErros($produto->getValidacaoErros());
            $this->visao('produtos/editar.php', [
                'produto' => $produto,
                'categorias' => $categorias
            ], 'administrador.php');
        }
        
    }

    

}
