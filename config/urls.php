<?php

return [
    'admin' => [
        [
            'name' => 'Medios de Pago',
            'route' => 'payment_methods.index',
            'icon' => 'wallet',
            'permissions' => 'view payment_methods',
        ],
        [
            'name' => 'Configuración',
            'icon' => 'settings',
            'isGroup' => true,
            'permissions' => ['view users', 'view roles', 'view permissions'],
            'children' => [
                [
                    'name' => 'Usuarios',
                    'route' => 'users.index',
                    'icon' => 'users',
                    'permissions' => 'view users',
                ],
                [
                    'name' => 'Roles',
                    'route' => 'roles.index',
                    'icon' => 'fingerprint',
                    'permissions' => 'view roles',
                ],
            ],
        ],
    ],
];
