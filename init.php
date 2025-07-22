<?php
// init.php
session_start();
require_once 'config/database.php';

// Autoload básico para modelos
spl_autoload_register(function ($class_name) {
    if (file_exists('models/' . $class_name . '.php')) {
        require_once 'models/' . $class_name . '.php';
    }
});
?>