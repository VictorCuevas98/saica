<?php
// Aside menu



return [

    'items' => [
        // Dashboard

        [
            'roles'=>['ADMIN','admin.roles','admin.users','admin.permissions'],
            'section' => 'Control de usuarios',

        ],
        [
            'roles'=>['ADMIN','admin.roles'],
            'title' => 'Roles',
            'icon' => 'media/svg/icons/Files/User-folder.svg',
            'page' => 'roles',
        ],
        [
            'roles'=>['ADMIN','admin.permissions'],
            'title' => 'Permisos',
            'icon' => 'media/svg/icons/Files/Protected-file.svg',
            'page' => 'permissions',
        ],
        [
            'roles'=>['ADMIN','admin.users'],
            'title' => 'Usuarios',
            'icon' => 'media/svg/icons/Communication/Contact1.svg',
            'page' => 'users',
        ],
        [
            'roles'=>['ADMIN','admin.users'],
            'title' => 'Solicitudes de registro',
            'icon' => 'media/svg/icons/Communication/Mail-notification.svg',
            'page' => '/admin/usuarios/solicitudes',
        ],
        //ADMINISTRATIVO
        //CONTRATOS
        [
            'roles'=>['ADMIN|admin.contratos'],
            'section' => 'Administrativo',
        ],
        [
            'roles'=>['ADMIN|admin.contratos'],
            'title' => 'Contratos',
            'icon' => 'media/svg/icons/Communication/Clipboard-list.svg',
            'bullet' => 'line',
            'submenu' => [
                [
                    'title' => 'Consultar Contratos',
                    'bullet' => 'dot',
                    'page' => '/contratos'
                ],
                [
                    'title' => 'Crear Contrato',
                    'bullet' => 'dot',
                    'page' => '/contratos/crear'
                ],
            ],
        ],
        [
            'permissions'=>['catalogos.verMenu'],
            'title' => 'Catálogos',
            'icon' => 'media/svg/icons/Devices/Android.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'roles'=>['ADMIN|admin.catalogos.articulos'],
                    'title' => 'Artículos',
                    'page' => '/articulos',
                    'bullet' => 'dot',
                ],
                [
                    'roles'=>['ADMIN|admin.catalogos.cabms'],
                    'title' => 'CABMS',
                    'page' => '/cabms',
                    'bullet' => 'dot',
                ],
                [
                    'roles'=>['ADMIN|admin.catalogos.partidasEspecificas'],
                    'title' => 'Partidas especificas',
                    'page' => '/partidas',
                    'bullet' => 'dot',
                ],
                [
                    'roles'=>['ADMIN|admin.catalogos.laboratorios'],
                    'title' => 'Laboratorios',
                    'page' => '/laboratorios',
                    'bullet' => 'dot',
                ],
                [
                    'roles'=>['ADMIN|admin.catalogos.almacenes'],
                    'title' => 'Almacenes',
                    'page' => '/almacenes',
                    'bullet' => 'dot',
                ],
                [
                    'roles'=>['ADMIN|admin.catalogos.preguntasRevision'],
                    'title' => 'Preguntas revisión entrada',
                    'page' => '/preguntas',
                    'bullet' => 'dot',
                ],
                [
                    'roles'=>['ADMIN|admin.catalogos.unidadesConsolidadoras'],
                    'title' => 'Unidades Consolidadoras',
                    'page' => '/unidades',
                    'bullet' => 'dot',
                ],
                [
                    'roles'=>['ADMIN|admin.catalogos.fundamentoLegal'],
                    'title' => 'Fundamento Legal',
                    'page' => '/fundamentoLegal',
                    'bullet' => 'dot',
                ],
            ],
        ],
        //ENTRADAS

        [
            'permissions'=>['entradas.contratosAbiertos.ver_menu','entradas.contratosCerrados.ver_menu'],
            'title' => 'Entradas',
            'icon' => 'media/svg/icons/Navigation/Right-2.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'permissions'=>['entradas.contratosAbiertos.ver_menu','entradas.contratosCerrados.ver_menu'],
                    'title' => 'por contrato abierto o cerrado',
                    'bullet' => 'dot',
                    'page' => '/fondoOficinas',
                ],
                
            ],
        ],


        //ALMACEN

        [
            'roles' => 'ADMIN|admin.almacen|pedidos proveedor',
            'section' => 'Almacen',
        ],



        [
            'roles' => 'ADMIN|admin.almacen',
            'title' => 'Salidas',
            'icon' => 'media/svg/icons/Navigation/Left-2.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Crear Salida',
                    'bullet' => 'dot',
                ],
                [
                    'title' => 'Ver Salidas',
                    'bullet' => 'dot',
                ],
            ],
        ],
        [
            'roles' => 'ADMIN|admin.almacen',
            'title' => 'Pedidos',
            'icon' => 'media/svg/icons/Communication/Clipboard-check.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Consultar Pedido',
                    'bullet' => 'dot',
                ],
            ],
        ],
        [
            'roles' => 'ADMIN|pedidos proveedor',
            'title' => 'Pedidos Proveedor',
            'icon' => 'media/svg/icons/Communication/Clipboard-check.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Pedidos a Proveedor',
                    'page' => '/pedidos-proveedor',
                    'bullet' => 'dot',
                ],
            ],
        ],
        //UNIDAD MEDICA
        [
            'roles' => 'ADMIN|admin.unidadMedica',
            'section' => 'Unidad Medica',
        ],
        [
            'roles' => 'ADMIN|admin.unidadMedica',
            'title' => 'Pedidos',
            'icon' => 'media/svg/icons/Communication/Clipboard-check.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Crear Pedido',
                    //'page' => '/pedidos',
                    'bullet' => 'dot',
                ],
                [
                    'title' => 'Consultar Pedido',
                    'bullet' => 'dot',
                ],
            ],
        ],

        //PEDIDOS
        [
            'roles' => 'ADMIN|admin.pedidos',
            'section' => 'Pedidos',
        ],
        [
            'roles' => 'ADMIN|admin.pedidos',
            'title' => 'Mis Pedidos',
            'icon' => 'media/svg/icons/Shopping/Box1.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Crear pedido',
                    'page' => '/pedidosProgramacion',
                    'bullet' => 'dot',
                ],
                [
                    'title' => 'Pedidos realizados',
                    'page' => '/pedidosProgramacion/consultarPedidos',
                    'bullet' => 'dot',
                ],
            ],
        ],
        [
            'roles' => 'ADMIN|admin.pedidos',
            'title' => 'Pedidos recibidos',
            'icon' => 'media/svg/icons//Code/Done-circle.svg',
            'bullet' => 'line',
            'root' => true,
            'title' => 'Pedidos recibidos',
            'page' => '/pedidosProgramacion/consultarPedidosRecibido',
            'bullet' => 'dot',
        ]

    ]

];
