<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'admin' => [
            'logs' => 'r',
            'room' => 'c,r,u,d',
            'addOn' => 'c,r,u,d',
            'facility' => 'c,r,u,d',
            'registration' => 'r,u',
            'type' => 'c,r,u,d',
        ],
        'receptionist' => [
            'logs' => 'r',
            'room' => 'r',
            'registration' => 'c,r,u',
        ],
        'cleaner' => [
            'room' => 'r,u',
        ],
        'user' => [
            'logs' => 'r',
            'registration' => 'c,r',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
