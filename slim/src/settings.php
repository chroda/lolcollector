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
            'key'     => 'RGAPI-c21679bd-3596-4cd7-8212-1be4aeeec04c',
            'server'  => 'br1',
            'baseurl' => 'api.riotgames.com',
        ],
    ],
];
