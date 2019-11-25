<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Produto;
use \Framework\DW3Sessao;

class TesteCarrinho extends Teste
{

    public function testeCriar(){

        $this->logar();
        $resposta = $this->get(URL_RAIZ . 'carrinho');
        $this->verificarContem($resposta, 'Carrinho');

    }
    
    public function testeArmazenar(){
        $this->logar();
        (new Produto('nome teste', '1', 'Descricao Teste', '1'))->salvar();
        $resposta = $this->post(URL_RAIZ . 'carrinho', [
            'produto_id' => 1,
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'produtos');
        $resposta = $this->get(URL_RAIZ . 'produtos');
        $this->verificarContem($resposta, 'Produtos');

    }
    

    public function testeDestruir(){
        $this->logar();
        (new Produto('nome teste', '1', 'Descricao Teste', '1'))->salvar();
        $resposta = $this->post(URL_RAIZ . 'carrinho', [
            'produto_id' => 1,
        ]);
        $resposta = $this->delete(URL_RAIZ . 'carrinho');
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'produtos');
        $this->verificar(DW3Sessao::get('carrinho') == null);
    }

    
}
