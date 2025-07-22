<?php
// index.php
require_once 'init.php';

$url = isset($_GET['url']) ? $_GET['url'] : 'produto';
$url = rtrim($url, '/');
$url = explode('/', $url);

$controllerName = ucfirst($url[0]) . 'Controller';
$action = isset($url[1]) ? $url[1] : 'index';

if (file_exists('controllers/' . $controllerName . '.php')) {
    require_once 'controllers/' . $controllerName . '.php';
    $controller = new $controllerName();
    
    if (method_exists($controller, $action)) {
        call_user_func_array([$controller, $action], []);
    } else {
        die('Ação não encontrada');
    }
} else {
    die('Controlador não encontrado');
}
?>