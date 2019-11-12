<?php
namespace Controlador;

use \Modelo\Produto;
use \Framework\DW3Sessao;

class ProdutoControlador extends Controlador
{

    public function index()
    {
        $lista_produtos = Produto::buscarProdutos();
        $this->visao('produtos/index.php', [
            'produtos' => $lista_produtos,
            'mensagem' => DW3Sessao::getFlash('mensagem', null)
        ], 'administrador.php');
    }

    public function criar()
    {
        $this->visao('produtos/criar.php', [], 'administrador.php');
    }

    public function armazenar()
    {
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
        $produto = Produto::buscarId($id);
        $this->visao('produtos/editar.php', [
            'produto' => $produto
        ], 'administrador.php');
    }

}
