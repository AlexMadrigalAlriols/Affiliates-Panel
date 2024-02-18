<?php

return [
    'search' => [
        'title' => 'Buscar',
        'title_singular' => 'Buscar',
    ],
    'dashboard' => [
        'title' => 'Tablero',
        'title_singular' => 'Tablero',
    ],
    'paychecks' => [
        'title' => 'Cheques Regalo',
        'title_singular' => 'Cheque Regalo',
        'fields' => [
            'id' => 'ID',
            'user' => 'Cliente',
            'shop' => 'Tienda',
            'import' => 'Importe',
            'expiration_date' => 'Fecha de Expiración'
        ]
    ],
    'create_paycheck' => [
        'title' => 'Crear Cheque Regalo'
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
        'title' => 'Clientes',
        'title_singular' => 'Cliente',
        'fields' => [
            'id' => 'ID',
            'name' => 'Nombre',
            'email' => 'Email',
            'phone' => 'Teléfono',
            'level' => 'Nivel',
            'code' => 'Código',
        ]
    ],
    'tickets' => [
        'title' => 'Tickets',
        'title_singular' => 'Ticket',
        'title_long' => 'Tickets',
        'fields' => [
            'id' => 'ID',
            'client' => 'Cliente',
            'import' => 'Importe',
            'items' => 'Articulos',
            'created_at' => 'Fecha',
            'returned' => 'Reembolsado',
            'quantity' => 'Cantidad',
        ]
    ],
    'create_ticket' => [
        'title' => 'Crear Ticket'
    ],
];
