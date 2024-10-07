<?php 

require_once __DIR__ . "/../src/entity/file.class.php";
require_once __DIR__ . '/../src/exceptions/fileException.class.php';
require_once __DIR__ . '/../src/entity/imagen.class.php';




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
        $imagen->saveUploadFile(Imagen::RUTA_IMAGENES_SUBIDAS );
        $mensaje="Imagen subida correctamente";

    } catch (FileException $fileException) {
        $errores[] = $fileException->getMessage();
    }
}



require_once __DIR__ . '/views/galeria.view.php';


