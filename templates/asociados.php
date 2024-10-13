<?php 
session_start();


require_once __DIR__ . "/../src/entity/file.class.php";
require_once __DIR__ . '/../src/exceptions/fileException.class.php';
require_once __DIR__ . '/../src/entity/imagen.class.php';
require_once __DIR__ . '/../src/entity/asociado.class.php';
require_once __DIR__ . '/../src/database/connection.class.php';




$errores = [];
$nombre = "";
$descripcion = "";
$mensaje = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {  
        
        $nombre = trim(htmlspecialchars($_POST['nombre']));

        if($nombre !="" || $nombre != null){
            $descripcion = trim(htmlspecialchars($_POST['descripcion']));
            $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
            $imagen = new File('imagen', $tiposAceptados);
            $imagen->saveUploadFile(Imagen::RUTA_IMAGENES_ASOCIADOS );

            $conexion = Connection::make();
            $sql = "INSERT INTO asociados (nombre, descripcion) VALUES (:nombre,:descripcion)";
            $pdoStatement = $conexion->prepare($sql);
            $parametros = [':nombre'=>$imagen->getFileName(),
            ':descripcion'=>$descripcion];
            if ( $pdoStatement->execute($parametros)===false)
            $errores[] = "No se ha podido guardar la imagen en la base de datos";
            else {
            $descripcion = "";
            $mensaje = "Se ha guardado la imagen correctamente";
            }
        }
        else{
            $mensaje="Nombre obligatorio";
        }
        



    } catch (FileException $fileException) {
        $errores[] = $fileException->getMessage();
    }
}

if ( isset($_POST['captcha']) && ($_POST['captcha']!="" && ($_SESSION['captchaGenerado']))){
    if( $_SESSION['captchaGenerado'] != $_POST['captcha'] ){
        $mensaje = "¡Ha introducido un código de seguridad incorrecto! Inténtelo de nuevo.";
        $errores=[]; $nombre=""; $descripcion="";
    } 
    else{
         // Todo correcto y se guardan los datos
    } 
   
}
else{
    $mensaje = "Introduzca el código de seguridad.";
    $errores=[]; $nombre=""; $descripcion="";
}


require_once __DIR__ . "/views/asociados.view.php";

