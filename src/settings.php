<?php

return [
    'settings' => [
        'displayErrorDetails' => $_ENV["DISPLAY_ERROR"], // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        /**********************************************************************************
         ********************************* View Config ************************************
         *********************************************************************************/

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        /**********************************************************************************
         *********************************** Logging **************************************
         *********************************************************************************/

        // Monolog settings
        'logger' => [
            'name' => $_ENV["APP_NAME"],
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/info/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // Monolog settings
        'errorLog' => [
            'name' => $_ENV["APP_NAME"],
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/error/app-error.log',
            'level' => \Monolog\Logger::WARNING,
        ],

        /**********************************************************************************
         ******************************** DATABASE & CONFIG  ******************************
         *********************************************************************************/

    ], //end settings array
];
