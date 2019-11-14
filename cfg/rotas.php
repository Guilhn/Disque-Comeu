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
    ],
    '/sair' => [
        'GET' => '\Controlador\LoginControlador#destruir',
    ],
    '/usuarios' => [
        'POST' => '\Controlador\UsuarioControlador#armazenar',
    ],
    '/usuarios/criar' => [
        'GET' => '\Controlador\UsuarioControlador#criar',
    ],
    '/usuarios/perfil' => [
        'GET' => '\Controlador\UsuarioControlador#perfil',
    ],
    '/usuarios/pedidos' => [
        'GET' => '\Controlador\UsuarioControlador#pedidos',
    ],
    '/usuarios/carrinho' => [
        'GET' => '\Controlador\UsuarioControlador#carrinho',
    ],
    '/admin' => [
        'POST' => '\Controlador\AdminControlador#armazenar',        
    ],
    '/admin/criar' => [
        'GET' => '\Controlador\AdminControlador#criar',        
    ],
    '/produtos' => [
        'GET' => '\Controlador\ProdutoControlador#index',
        'POST' => '\Controlador\ProdutoControlador#armazenar',
    ],
    '/produtos/criar' => [
        'GET' => '\Controlador\ProdutoControlador#criar',
    ],
    '/produtos/editar/?' => [
        'GET' => '\Controlador\ProdutoControlador#editar',
        'PATCH' => '\Controlador\ProdutoControlador#atualizar',
    ],
    '/pedidos' => [
        'GET' => '\Controlador\PedidoControlador#index',
    ],
    '/relatorio' => [
        'GET' => '\Controlador\RelatorioControlador#index',
    ],
    '/carrinho/?' => [
        'GET' => '\Controlador\CarrinhoControlador#armazenar',
    ],
];
