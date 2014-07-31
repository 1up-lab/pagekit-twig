<?php

return [

    'autoload' => [

        'AlphaTwig\\' => 'src'

    ],

    'main' => 'AlphaTwig\\AlphaTwigTheme',

    'resources' => [

        'override' => [
            'extension://system/theme/templates' => 'templates/system'
        ]

    ],

    'settings' => [

        'system'  => 'theme://alpha-twig/views/admin/settings.twig',
        'widgets' => 'theme://alpha-twig/views/admin/widgets/edit.twig'

    ],

    'positions' => [

        'logo'       => 'Logo',
        'logo-small' => 'Logo Small',
        'navbar'     => 'Navbar',
        'top'        => 'Top',
        'sidebar-a'  => 'Sidebar A',
        'sidebar-b'  => 'Sidebar B',
        'footer'     => 'Footer',
        'offcanvas'  => 'Offcanvas'

    ],

    'renderer' => [

        'blank'     => 'theme://alpha-twig/views/renderer/position.blank.twig',
        'grid'      => 'theme://alpha-twig/views/renderer/position.grid.php',
        'navbar'    => 'theme://alpha-twig/views/renderer/position.navbar.twig',
        'offcanvas' => 'theme://alpha-twig/views/renderer/position.offcanvas.twig',
        'panel'     => 'theme://alpha-twig/views/renderer/position.panel.twig'

    ]

];