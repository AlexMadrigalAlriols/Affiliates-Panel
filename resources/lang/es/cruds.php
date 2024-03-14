<?php

return [
    'search' => [
        'title' => 'Explorar',
        'title_singular' => 'Explorar',
    ],
    'dashboard' => [
        'title' => 'Tablero',
        'title_singular' => 'Tablero',
    ],
    'rewards' => [
        'title' => 'Recompensas',
        'title_singular' => 'Recompensa',
    ],
    'vouchers' => [
        'title' => 'Cupónes',
        'title_singular' => 'Cupón',
        'title_wallet' => 'Mi billetera',
        'fields' => [
            'id' => 'ID',
            'user' => 'Cliente',
            'shop' => 'Tienda',
            'reward' => 'Recompensa',
            'expiration_date' => 'Fecha de Expiración'
        ]
    ],
    'create_voucher' => [
        'title' => 'Crear Cupón'
    ],
    'announces' => [
        'title' => 'Mensajes',
        'title_singular' => 'Mensaje',
    ],
    'settings' => [
        'title' => 'Ajustes',
        'title_singular' => 'Ajustes',
    ],
    'users' => [
        'title' => 'Clientes',
        'title_singular' => 'Cliente',
        'fields' => [
            'id' => 'ID',
            'name' => 'Nombre',
            'last_name' => 'Apellidos',
            'email' => 'Email',
            'email_long' => 'Correo Electrónico',
            'phone' => 'Teléfono',
            'level' => 'Nivel',
            'code' => 'Código',
            'password' => 'Contraseña'
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
