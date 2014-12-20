<?php

if (!defined('__CORE_BOOTSTRAP__')) {

    /**
     * Imports a custom library
     * @param  {string} $library The dot-notation path to the library.
     */
    function import ($library) {
        $library = dirname(dirname(__FILE__)). '/'. strtolower(str_replace('.', '/', $library)) . '/load.php';

        if (file_exists($library)) {
            include $library;
        }
    }

    /**
     * SPL Registry Autoloader
     * @param  {string} $class The name of the class to load
     */
    function core_autoload ($class) {
        $class = strtolower($class);

        if (file_exists(dirname(__FILE__). "/{$class}.php")) {
            include dirname(__FILE__). "/{$class}.php";
        }
    }
    spl_autoload_register('core_autoload', true, true);

    define ('__CORE_BOOTSTRAP__', true);
}
