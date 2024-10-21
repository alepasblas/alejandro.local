<?php
session_start();


require_once __DIR__ . "/../src/entity/file.class.php";
require_once __DIR__ . '/../src/exceptions/fileException.class.php';
require_once __DIR__ . '/../src/entity/imagen.class.php';
require_once __DIR__ . '/../src/entity/asociado.class.php';
require_once __DIR__ . '/../src/database/connection.class.php';
require_once __DIR__ . '/../repository/asociadosRepository.php';





$errores = [];
$nombre = "";
$descripcion = "";
$mensaje = "";


try {
    $config = require_once __DIR__ . '/../app/config.php';
    App::bind('config',$config); // Guardamos la configuración en el contenedor de servicios
    $conexion = App::getConnection();
    
    $asociadosRepository= new AsociadosRepository();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $nombre = trim(htmlspecialchars($_POST['nombre']));

        if ($nombre != null) {
            $descripcion = trim(htmlspecialchars($_POST['descripcion']));
            $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
            $imagen = new File('imagen', $tiposAceptados);
            $imagen->saveUploadFile(Imagen::RUTA_IMAGENES_ASOCIADOS);

            $asociados = new Asociado($imagen->getFileName(),$descripcion);
            $asociadosRepository->save($asociados);


        } else {
            $mensaje = "Nombre obligatorio";
        }

        
    }
    $asociadoRepo = new AsociadosRepository();
    $asociados = $asociadoRepo->findAll();

} catch (FileException $fileException) {
    $errores[] = $fileException->getMessage();
} catch (QueryException $queryException) {
    $errores[] = $queryException->getMessage();
}catch ( AppException $appException ){
    $errores[] = $appException->getMessage();
}catch (Exception $e) {
    $errores[] = "Error de conexión a la base de datos.";
}



// if (isset($_POST['captcha']) && ($_POST['captcha'] != "" && ($_SESSION['captchaGenerado']))) {
//     if ($_SESSION['captchaGenerado'] != $_POST['captcha']) {
//         $mensaje = "¡Ha introducido un código de seguridad incorrecto! Inténtelo de nuevo.";
//         $errores = [];
//         $nombre = "";
//         $descripcion = "";
//     } else {
//         // Todo correcto y se guardan los datos
//     }
// } else {
//     $mensaje = "Introduzca el código de seguridad.";
//     $errores = [];
//     $nombre = "";
//     $descripcion = "";
// }


require_once __DIR__ . "/views/asociados.view.php";
