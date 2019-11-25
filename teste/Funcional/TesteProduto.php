<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Produto;

class TesteProduto extends Teste
{

    public function testeIndex()
    {
        $this->logar();
        $resposta = $this->get(URL_RAIZ . 'produtos');
        $this->verificarContem($resposta, 'Produtos');

    }

    public function testeListar()
    {
        $this->logarAdmin();
        $resposta = $this->get(URL_RAIZ . 'produtos/listar');
        $this->verificarContem($resposta, 'Pratos');
        
    }

    public function testeCriar()
    {
        $this->logarAdmin();
        $resposta = $this->get(URL_RAIZ . 'produtos/criar');
        $this->verificarContem($resposta, 'Cadastrar Prato');
    }
    
    public function testeArmazenar()
    {
        
    }

    public function testeEditar()
    {
        $this->logarAdmin();
        $produto = new Produto('nome teste', '1', 'Descricao Teste', '1');
        $produto->salvar();
        $resposta = $this->get(URL_RAIZ . 'produtos/'. $produto->getId() . '/editar');
        $this->verificarContem($resposta, 'Editar Prato');
        $this->verificarContem($resposta, $produto->getNome());
        $this->verificarContem($resposta, $produto->getCategoriaId());
        $this->verificarContem($resposta, $produto->getDescricao());
        
    }

    public function testeAtualizar()
    {
        $this->logarAdmin();
        $produto = new Produto('nome teste', '1', 'Descricao Teste', '1');
        $produto->salvar();
        $resposta = $this->patch(URL_RAIZ . 'produtos/' . $produto->getId(), [
            'nome' => 'produto atualizado',
            'categoria_id' => 2,
            'descricao' => 'produto atualizado',
            'valor' => 12,
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'produtos/listar');
        $resposta = $this->get(URL_RAIZ . 'produtos/listar');
        $this->verificarContem($resposta, 'produto atualizado');
        $this->verificarContem($resposta, '12');        
    }
    
}
