<?php

return [
    'settings' => [
        'addContentLengthHeader' => false,
        'displayErrorDetails' => true,
        'db' => [
            'host' => 'localhost',
            'port' => '',
            'name' => 'slimtest1',
            'user' => 'slimtest1',
            'pass' => 'slimtest199'
        ], 
        'monolog' => [
            'logfile' => 'logs/app.log'
        ], 
        'view' => [
            'template_path' => 'src/templates',
            'twig' => [
                //'cache' => 'cache/twig',
                'cache' => false,
                'debug' => false,
            ],
        ],              
    ]
];