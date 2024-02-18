<?php

return [
    'search' => [
        'title' => 'Search',
        'title_singular' => 'Search',
    ],
    'dashboard' => [
        'title' => 'Dashboard',
        'title_singular' => 'Dashboard',
    ],
    'paychecks' => [
        'title' => 'Paychecks',
        'title_singular' => 'Paycheck',
        'fields' => [
            'id' => 'ID',
            'user' => 'Customer',
            'shop' => 'Shop',
            'import' => 'Import',
            'expiration_date' => 'Expiration Date'
        ]
    ],
    'create_paycheck' => [
        'title' => 'Create Paycheck'
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
            'email' => 'Email',
            'phone' => 'Phone',
            'level' => 'Level',
            'code' => 'Code',
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
