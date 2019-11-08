<?php
namespace Controlador;

use \Modelo\Produto;

class ProdutoControlador extends Controlador
{

    public function index()
    {
        $this->visao('produtos/index.php', [], 'administrador.php');
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
            $this->redirecionar(URL_RAIZ . 'produtos');

        } else {
            $this->setErros($produto->getValidacaoErros());
            $this->visao('produtos/criar.php');
        }
    }

    public function sucesso()
    {
        $this->visao('usuarios/sucesso.php');
    }
}
