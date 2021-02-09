<?php
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
            'url'  => '/item1',
            'can'  => '',
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
            'text' => 'Pessoas',
            'url'  => '/people',
        ],
        [
            'text' => 'Instituição',
            'url'  => '/institutions',
        ],
        [
            'text' => 'Departamento',
            'url'  => '/departaments',
        ],
        [
            'text' => 'Título',
            'url'  => '/designations',
        ],
        [
            'text' => 'Cargo',
            'url'  => '/roles',
        ],
        [
            'text' => 'Contato',
            'url'  => '/contact',
        ],
        [
            'text' => 'Área',
            'url'  => '/areas',
        ],
        [
            'text' => 'Titulares',
            'url'  => '/holders',
        ],
        [
            'text' => 'Suplentes',
            'url'  => '/surrogates',
        ],
        [
            'text'    => 'SubMenu2',
            'submenu' => $submenu2,
            'can'  => 'admin',
        ]
    ]
];
