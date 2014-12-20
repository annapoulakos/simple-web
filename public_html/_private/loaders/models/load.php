<?php

if (!defined('__MODEL_AUTOLOADER__')) {

    function model_autoloader ($class) {
        $class = strtolower($class);

        if (file_exists(dirname(__FILE__). "/models/{$class}.php")) {
            include dirname(__FILE__). "/models/{$class}.php";
        }
    }
    spl_autoload_register('model_autoloader', true, true);

    define('__MODEL_AUTOLOADER__', true);
}
