<?php

function services_autoloader($class_name) {
    $autoloadDir = [
        'models',
        'services',
        'controllers',
        'migrations',
        'middlewares',
    ];

    foreach ($autoloadDir as $dir) {
        $file = __DIR__.'/'.$dir.'/'.$class_name.'.php';

        if (file_exists($file)) {
            require_once $file;
        }
    }
}

// add a new autoloader by passing a callable into spl_autoload_register()
spl_autoload_register('services_autoloader');
