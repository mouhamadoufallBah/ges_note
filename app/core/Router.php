<?php
require_once(PATHBASE . "/app/core/Controller.php");
$protocole = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
define("WEB_ROUTE", $protocole . '://' . $_SERVER['HTTP_HOST']);

$routes = [
    '/' => [
        'controller' => 'noteController',
        'action' => 'showPage'
    ],
    '/login' => [
        'controller' => 'authController',
        'action' => 'login'
    ],
    '/updateNote' => [
        'controller' => 'noteController',
        'action' => 'updateNote'
    ],
    '/logout' => [
        'controller' => 'authController',
        'action' => 'logout'
    ],

];

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (!isset($routes[$uri])) {

    http_response_code(404);
    echo "Page introuvable";
    exit;
}
// dd(!isset($routes[$uri]));

$controller = $routes[$uri]['controller'];
$action = $routes[$uri]['action'];
if (file_exists(dirname(__DIR__) . "/controllers/$controller.php")) {
    require_once dirname(__DIR__) . "/controllers/$controller.php";
    if (function_exists($action)) {
        $action();
    }
} else {
    http_response_code(404);
    echo "Not found";
}
