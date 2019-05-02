<?php

spl_autoload_register(function($class) {

    $base_directory = __DIR__ . '/core/';

    $file = $base_directory . $class . '.php';

    if(file_exists($file)){
        require $file;
    }

});