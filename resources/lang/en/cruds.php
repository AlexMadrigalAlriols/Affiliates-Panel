<?php

return [
    'search' => [
        'title' => 'Explore',
        'title_singular' => 'Explore',
    ],
    'dashboard' => [
        'title' => 'Dashboard',
        'title_singular' => 'Dashboard',
    ],
    'rewards' => [
        'title' => 'Rewards',
        'title_singular' => 'Reward',
    ],
    'vouchers' => [
        'title' => 'Vouchers',
        'title_singular' => 'Voucher',
        'title_wallet' => 'My wallet',
        'fields' => [
            'id' => 'ID',
            'user' => 'Customer',
            'shop' => 'Shop',
            'reward' => 'Reward',
            'expiration_date' => 'Expiration Date'
        ]
    ],
    'create_voucher' => [
        'title' => 'Create Voucher'
    ],
    'announces' => [
        'title' => 'Mensajes',
        'title_singular' => 'Mensaje',
    ],
    'settings' => [
        'title' => 'Configuración',
        'title_singular' => 'Configuración',
    ],
    'users' => [
        'title' => 'Customers',
        'title_singular' => 'Customer',
        'fields' => [
            'id' => 'ID',
            'name' => 'Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'email_long' => 'Email Address',
            'phone' => 'Phone',
            'level' => 'Level',
            'code' => 'Code',
            'password' => 'Password'
        ]
    ],
    'tickets' => [
        'title' => 'Tickets',
        'title_singular' => 'Ticket',
        'title_long' => 'Tickets History',
        'fields' => [
            'id' => 'ID',
            'client' => 'Customer',
            'import' => 'Import',
            'items' => 'Items',
            'created_at' => 'Date',
            'returned' => 'Returned',
            'quantity' => 'Quantity',
        ]
    ],
    'create_ticket' => [
        'title' => 'Create Ticket'
    ],
];
