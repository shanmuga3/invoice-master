<?php

return [
    'role_structure' => [
        'admin' => [
            'admin_users'       => 'c,r,u,d',
            'roles'             => 'c,r,u,d',
            'invoice'           => 'c,r,u,d',
            'reports'           => 'r,e',
        ],
    ],
    'user_roles' => [
        'admin' => [
            [
                'username' => "admin",
                'email' => 'admin@gmail.com',
                'password' => '12345678',
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'view',
        'u' => 'update',
        'd' => 'delete',
        'e' => 'export',
    ],
];