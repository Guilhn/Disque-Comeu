<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\RaizControlador#index',
    ],
    '/inicio' => [
        'GET' => '\Controlador\InicioControlador#criar',
    ],
    '/login' => [
        'GET' => '\Controlador\LoginControlador#criar',
        'POST' => '\Controlador\LoginControlador#armazenar',
        'DELETE' => '\Controlador\LoginControlador#destruir',
    ],
    '/usuarios' => [
        'POST' => '\Controlador\UsuarioControlador#armazenar',
    ],
    '/usuarios/criar' => [
        'GET' => '\Controlador\UsuarioControlador#criar',
    ],    
    '/admin' => [
        'GET' => '\Controlador\AdminControlador#criar',
        'POST' => '\Controlador\AdminControlador#armazenar',        
    ],
    '/produtos' => [
        'GET' => '\Controlador\ProdutoControlador#index',
        'POST' => '\Controlador\ProdutoControlador#armazenar',
    ],
    '/produtos/?' => [
        'PATCH' => '\Controlador\ProdutoControlador#atualizar',
    ],
    '/produtos/listar' => [
        'GET' => '\Controlador\ProdutoControlador#listar',
    ],
    '/produtos/criar' => [
        'GET' => '\Controlador\ProdutoControlador#criar',
    ],
    '/produtos/?/editar' => [
        'GET' => '\Controlador\ProdutoControlador#editar',
    ],
    '/pedidos' => [
        'GET' => '\Controlador\PedidoControlador#index',
        'POST' => '\Controlador\PedidoControlador#armazenar',
    ],
    '/pedidos/?' => [
        'PATCH' => '\Controlador\PedidoControlador#atualizar',
    ],
    '/pedidos/?/editar' => [
        'GET' => '\Controlador\PedidoControlador#editar',
    ],
    '/carrinho' => [
        'GET' => '\Controlador\CarrinhoControlador#criar',
        'DELETE' => '\Controlador\CarrinhoControlador#destruir',
        'POST' => '\Controlador\CarrinhoControlador#armazenar',
    ],
    '/relatorio' => [
        'GET' => '\Controlador\RelatorioControlador#index',
    ],
    '/perfil' => [
        'GET' => '\Controlador\UsuarioControlador#perfil',
    ],
    '/meus-pedidos' => [
        'GET' => '\Controlador\UsuarioControlador#pedidos',
    ],
];
