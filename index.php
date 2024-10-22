<?php

try {
    require_once 'core/bootstrap.php';
    require_once 'core/router.php';
    require Router::load('app/routes.php')->direct(Request::uri(), Request::method());
    require 'app/routes.php'; // Obtenemos la tabla de rutas
    require $router->direct(Request::uri());

    $uri = trim($_SERVER['REQUEST_URI'], '/'); // Obtenemos la uri del usuario
    require $routes[$uri];
} catch (NotFoundException $notFoundException) {
    die($notFoundException->getMessage());
}
