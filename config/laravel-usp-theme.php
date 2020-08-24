<?php

$instituicao =  [
    [
        'text' => 'Inserir',
        'url'  => 'institutions/create'
    ],
    [
        'text' => 'Gerenciar',
        'url'  => '/institutions',
    ],
    [
        'text' => 'SubItem 3',
        'url'  => '/subitem3',
        'can'  => 'admin',
    ],
];

$departamento =  [
    [
        'text' => 'Inserir',
        'url'  => 'departaments/create'
    ],
    [
        'text' => 'Gerenciar',
        'url'  => '/departaments',
    ],
];

$titulo =  [
    [
        'text' => 'Inserir',
        'url'  => 'designations/create'
    ],
    [
        'text' => 'Gerenciar',
        'url'  => '/designations',
    ],
];

$submenu2 =  [
    [
        'text' => 'SubItem 1',
        'url'  => '/subitem1'
    ],
    [
        'text' => 'SubItem 2',
        'url'  => '/subitem2',
        'can'  => 'admin',
    ],
];

return [
    'title'=> 'USPdev',
    'dashboard_url' => '/',
    'logout_method' => 'GET',
    'logout_url' => '/logout',
    'login_url' => '/login',
    'menu' => [
        [
            'text' => 'Item 1',
            'url'  => '/item1'
        ],
        [
            'text' => 'Item 2',
            'url'  => '/item2',
            'can'  => '',
        ],
        [
            'text' => 'Item 3',
            'url'  => '/item3',
            'can'  => 'admin',
        ],
        [
            'text'    => 'Instituição',
            'submenu' => $instituicao,
        ],
        [
            'text'    => 'Departamento',
            'submenu' => $departamento,
        ],
        [
            'text'    => 'Títulos',
            'submenu' => $titulo,
        ],
        [
            'text'    => 'SubMenu2',
            'submenu' => $submenu2,
            'can'  => 'admin',
        ]
    ]
];
