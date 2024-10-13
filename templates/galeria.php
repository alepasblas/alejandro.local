<?php 

require_once __DIR__ . "/../src/entity/file.class.php";
require_once __DIR__ . '/../src/exceptions/fileException.class.php';
require_once __DIR__ . '/../src/entity/imagen.class.php';
require_once __DIR__ . '/../src/database/connection.class.php';



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
        $conexion = Connection::make();
        $sql = "INSERT INTO imagenes (nombre, descripcion, categoria) VALUES (:nombre,:descripcion,:categoria)";
        $pdoStatement = $conexion->prepare($sql);
        $parametros = [':nombre'=>$imagen->getFileName(),
        ':descripcion'=>$descripcion,
        ':categoria'=>'1'];
        if ( $pdoStatement->execute($parametros)===false)
        $errores[] = "No se ha podido guardar la imagen en la base de datos";
        else {
        $descripcion = "";
        $mensaje = "Se ha guardado la imagen correctamente";
        }

    } catch (FileException $fileException) {
        $errores[] = $fileException->getMessage();
    }
}



require_once __DIR__ . '/views/galeria.view.php';

