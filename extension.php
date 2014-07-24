<?php

return [
    'main' => 'Oneup\\Twig\\TwigExtension',
    'autoload' => [
        'Oneup\\Twig\\' => 'src'
    ],
    'controllers' => 'src/Controller/*Controller.php',
    'menu' => [
        'hello' => [
            'label'  => 'Twig',
            'icon'   => 'extension://twig/extension.svg',
            'url'    => '@twig/twig',
            'active' => '@twig/twig*',
            'access' => 'twig: manage twigs' // wtf?
        ]
    ]
];
