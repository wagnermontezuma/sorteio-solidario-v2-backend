<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
     */

    'menu' => [
        [
            'icon' => 'fa fa-th-large',
            'title' => 'Dashboard',
            'url' => 'dashboard',
        ],
        [
            'icon' => 'fa fa-coffee',
            'title' => 'Cozinhas',
            'url' => 'controle.cozinha.index',
            'active_url' => 'controle.cozinha',
            'permission' => 'Visualizar cozinha',
        ],
        [
            'icon' => 'fa fa-tags',
            'title' => 'Categorias',
            'url' => 'controle.categoria.index',
            'active_url' => 'controle.categoria',
            'permission' => 'Visualizar categoria',
        ],
        [
            'icon' => 'fas fa-mortar-pestle',
            'title' => 'Receitas',
            'url' => 'controle.receita.index',
            'active_url' => 'controle.receita',
            'permission' => 'Visualizar receita',
        ],
        [
            'icon' => 'fa fa-mobile',
            'title' => 'Configurações do APP',
            'url' => 'controle.app-info.index',
            'active_url' => 'controle.app-info',
            'permission' => 'Visualizar Configurações do APP',
        ],
        [
            'icon' => 'fa fa-lock',
            'title' => 'Controle de Acesso',
            'url' => 'javascript:;',
            'caret' => true,
            'sub_menu' => [
                [
                    'url' => 'controle.usuario.index',
                    'title' => 'Usuários',
                ],
                [
                    'url' => 'controle.roles.index',
                    'title' => 'Grupo de usuários',
                ],
            ],
        ],
        [
            'icon' => 'fas fa-cog',
            'title' => 'Configurações',
            'url' => 'controle.config.edit',
        ],
    ],
];
