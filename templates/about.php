<?php require_once __DIR__ . "/../src/entity/imagen.class.php";

$imagenesClientes[] = new Imagen('client4.jpg', 'LADY');
$imagenesClientes[] = new Imagen('client3.jpg', 'MEN');
$imagenesClientes[] = new Imagen('client2.jpg', 'YOUNG');
$imagenesClientes[] = new Imagen('client1.jpg', 'DON');

require_once __DIR__ . "/views/about.view.php";

