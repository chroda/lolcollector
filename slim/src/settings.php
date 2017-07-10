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
            'key'     => 'RGAPI-275cb55c-9be9-4581-9361-e5929bb5e699',
            'server'  => 'br1',
            'baseurl' => 'api.riotgames.com',
        ],
    ],
];
