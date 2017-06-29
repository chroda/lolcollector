<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'lolc',
            'path' => __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // Riot settings
        'riot' => (object) [
            'key'     => '2a0a5c1e-7355-42dc-8e2b-f25d5ee9771f',
            'server'  => 'br1',
            'baseurl' => 'api.riotgames.com',
        ],
    ],
];
