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
    ],
    '/usuarios/criar' => [
        'GET' => '\Controlador\UsuarioControlador#criar',
    ],
];
