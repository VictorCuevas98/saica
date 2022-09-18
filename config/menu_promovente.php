<?php
// Header menu promovente
return [

    'items' => [
        [],
        [
            'title' => 'PREVIT',
            'root' => true,
            'page' => '/',
            'new-tab' => false,
        ],
        [
            'title' => 'Proyectos',
            'root' => true,
            'toggle' => 'click',
            'submenu' => [
                'type' => 'classic',
                'alignment' => 'left',
                'items' => [
                    [
                        'title' => 'Seguimiento',
                        'desc' => '',
                        'page' => 'pages/seguimiento',
                        'icon' => 'media/svg/icons/Files/Share.svg', // or can be 'flaticon-light' or any flaticon-*
                        'bullet' => 'dot',
                    ],
                ]
            ]
        ],
    ]

];
