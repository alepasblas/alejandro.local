<?php 
require_once __DIR__ . '/views/galeria.view.php';

require_once __DIR__ . "/../src/entity/file.class.php";
require_once __DIR__ . '/../src/exceptions/fileException.class.php';


$errores = [];
$titulo = "";
$descripcion = "";
$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $titulo = trim(htmlspecialchars($_POST['titulo']));
        $descripcion = trim(htmlspecialchars($_POST['descripcion']));
        $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
        $imagen = new File('imagen', $tiposAceptados);
    } catch (FileException $fileException) {
        $errores[] = $fileException->getMessage();
    }
}

