<?php
namespace Controlador;

use \Modelo\Produto;
use \Framework\DW3Sessao;
use \Framework\DW3Controlador;

class ProdutoControlador extends Controlador
{

    public function index()
    {
        $this->verificarLogado();
        $lista_produtos = Produto::buscarProdutos();
        $this->visao('produtos/index.php', [
            'produtos' => $lista_produtos,
            'mensagem' => DW3Sessao::getFlash('mensagem', null)
        ], 'administrador.php');
    }

    public function criar()
    {   
        $this->verificarLogado();
        $this->visao('produtos/criar.php', [], 'administrador.php');
    }

    public function armazenar()
    {
        $this->verificarLogado();
        $foto = array_key_exists('foto', $_FILES) ? $_FILES['foto'] : null;
        $produto = new Produto($_POST['nome'], $_POST['id_categoria'], $_POST['descricao'], $_POST['valor'], $foto);

        if ($produto->isValido()) {
            $produto->salvar();
            DW3Sessao::setFlash('mensagem', 'Produto cadastrado com sucesso!');
            $this->redirecionar(URL_RAIZ . 'produtos');

        } else {
            $this->setErros($produto->getValidacaoErros());
            $this->visao('produtos/criar.php', [], 'administrador.php');
        }
    }

    public function editar($id)
    {
        $this->verificarLogado();
        $produto = Produto::buscarId($id);
        $categoria = Produto::buscarNomeCategoria($produto->getId());
        $this->visao('produtos/editar.php', [
            'produto' => $produto,
            'categoria' => $categoria
        ], 'administrador.php');
    }

    public function atualizar($id)
    {
        $this->verificarLogado();
        $produto = Produto::buscarId($id);
        $categoria = Produto::buscarNomeCategoria($produto->getId());
        $produto->setNome($_POST['nome']);
        $produto->setIdCategoria($_POST['id_categoria']);
        $produto->setDescricao($_POST['descricao']);
        $produto->setValor($_POST['valor']);
        $produto->setId($id);
        if ($produto->isValido()) {
            $produto->salvar();
            DW3Sessao::setFlash('mensagem', 'Produto atualizado com sucesso.');
            $this->redirecionar(URL_RAIZ . 'produtos');

        } else {
            $this->setErros($produto->getValidacaoErros());
            $this->visao('produtos/editar.php', [
                'produto' => $produto,
                'categoria' => $categoria
            ], 'administrador.php');
        }
        
    }

    

}
