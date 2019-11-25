<?php
namespace Controlador;

use \Modelo\Produto;
use \Modelo\Pedido;
use \Framework\DW3Sessao;
use \Framework\DW3Controlador;

class CarrinhoControlador extends Controlador
{

    public function criar()
    {
        $this->verificarLogado();
        $itemCarrinho = DW3Sessao::get('carrinho');
        if ($itemCarrinho != null) {
            $tamanho = count($itemCarrinho);
            $carrinho = [];
            $totalCarrinho = 0;
            for ($i=0; $i < $tamanho; $i++) 
            { 
                $carrinho[] = Produto::buscarId($itemCarrinho[$i]);
            }
            for ($i=0; $i < $tamanho; $i++) 
            { 
                $totalCarrinho += $carrinho[$i]->getValor();
            }
            $this->visao('carrinho/index.php', [
                'carrinho' => $carrinho,
                'total' => $totalCarrinho
            ], 'consumidor.php');
        }else {
            $this->visao('carrinho/index.php', [], 'consumidor.php');
        }
    }

    public function armazenar()
    {        
        $this->verificarLogado();
        $carrinho = [];

        $carrinho = DW3Sessao::get('carrinho', []);
        
        $carrinho [] = $_POST['produto_id'];

        DW3Sessao::set('carrinho', $carrinho);
        DW3Sessao::setFlash('mensagem', 'Produto adicionado ao carrinho!');
        $this->redirecionar(URL_RAIZ . 'produtos');
    }

    

    public function destruir()
    {
        DW3Sessao::deletar('carrinho');
        DW3Sessao::setFlash('mensagem', 'carrinho excluido');
        $this->redirecionar(URL_RAIZ . 'produtos');
    }
    
 

}

