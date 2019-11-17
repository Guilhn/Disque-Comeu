<?php
namespace Controlador;

use \Modelo\Produto;
use \Modelo\Pedido;
use \Framework\DW3Sessao;
use \Framework\DW3Controlador;

class CarrinhoControlador extends Controlador
{

    public function armazenar($id)
    {
        
        $this->verificarLogado();
        $carrinho = [];

        $carrinho = DW3Sessao::get('carrinho', []);
        
        $carrinho [] = $id;

        DW3Sessao::set('carrinho', $carrinho);
        DW3Sessao::setFlash('mensagem', 'Produto adicionado ao carrinho!');
        $this->redirecionar(URL_RAIZ . 'produtos');
        //Redirecionar - Criar flash
    }

    public function criar()
    {
        $this->verificarLogado();
        $item_carrinho = DW3Sessao::get('carrinho');
        if ($item_carrinho != null) {
            $tamanho = count($item_carrinho);
            $carrinho = [];
            $totalCarrinho = 0;
            for ($i=0; $i < $tamanho; $i++) 
            { 
                $carrinho[] = Produto::buscarId($item_carrinho[$i]);
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

    public function destruir()
    {
        DW3Sessao::deletar('carrinho');
        $this->redirecionar(URL_RAIZ . 'produtos');
    }
    
 

}

