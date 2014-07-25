<?php

return [
    'main' => 'Oneup\\PagekitTwig\\TwigExtension',
    'autoload' => [
        'Oneup\\PagekitTwig\\' => 'src'
    ],
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
