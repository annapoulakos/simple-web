<?php
/***************************************************************************************
DO NOT UNDER ANY CIRCUMSTANCES COMMIT THIS FILE ONCE YOU HAVE ADDED YOUR
DATABASE CREDENTIALS. SERIOUSLY. IT'S NOT THAT FUCKING DIFFICULT TO UNDERSTAND.
***************************************************************************************/
if (!defined('__IDIORM_LOADED__')) {

    include dirname(__FILE__). '/idiorm.php';
    include dirname(__FILE__). '/paris.php';

    \Idiorm\ORM::configure('mysql:host=YOUR_DB_HOST;dbname=YOUR_DB_NAME');
    \Idiorm\ORM::configure('username', 'YOUR_DB_USERNAME');
    \Idiorm\ORM::configure('password', 'YOUR_DB_PASSWORD');

    function idiorm_autoload ($class) {
        $class = strtolower($class);

        if (file_exists(dirname(__FILE__). "/models/{$class}.php")) {
            include dirname(__FILE__). "/models/{$class}.php";
        }
    }
    spl_autoload_register('idiorm_autoload', true, true);

    define('__IDIORM_LOADED__', true);
}
