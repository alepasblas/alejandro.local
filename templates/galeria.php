<?php

require_once __DIR__ . "/../src/entity/file.class.php";
require_once __DIR__ . '/../src/exceptions/fileException.class.php';
require_once __DIR__ . '/../src/exceptions/categoriaException.class.php';
require_once __DIR__ . '/../src/entity/imagen.class.php';
require_once __DIR__ . '/../src/database/connection.class.php';
require_once __DIR__ . '/../repository/imagenesRepository.php';
require_once __DIR__ . '/../repository/categoriaRepository.php';


$errores = [];
$descripcion = "";
$titulo = "";
$mensaje = '';
try {
    $config = require_once __DIR__ . '/../app/config.php';
    App::bind('config', $config); // Guardamos la configuración en el contenedor de servicios
    $conexion = App::getConnection();

    $categoriaRepository = new CategoriaRepository();
    $imagenesRepository = new ImagenesRepository();


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $descripcion = trim(htmlspecialchars($_POST['descripcion']));

        $categoria = trim(htmlspecialchars($_POST['categoria']));
        if ( empty($categoria)){
            throw new CategoriaException;
        }
        


        $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
        $imagen = new File('imagen', $tiposAceptados);
        $imagen->saveUploadFile(Imagen::RUTA_IMAGENES_SUBIDAS);

        $imagenGaleria = new Imagen($imagen->getFileName(),$descripcion, $categoria);
        $imagenesRepository->guarda($imagenGaleria);

/*
        $sql = "INSERT INTO imagenes (nombre, descripcion, categoria) VALUES (:nombre,:descripcion,:categoria)";
        $pdoStatement = $conexion->prepare($sql);
        $parametros = [
            ':nombre' => $imagen->getFileName(),
            ':descripcion' => $descripcion,
            ':categoria' => $categoria
        ];
        if ($pdoStatement->execute($parametros) === false)
            $errores[] = "No se ha podido guardar la imagen en la base de datos";
        else
            $mensaje = "Se ha guardado la imagen correctamente";*/

    }
    $categorias = $categoriaRepository->findAll();
    $imagenes = $imagenesRepository->findAll();
} catch (FileException $fileException) {
    $errores[] = $fileException->getMessage();
} catch (QueryException $queryException) {
    $errores[] = $queryException->getMessage();
} catch (AppException $appException) {
    $errores[] = $appException->getMessage();
}catch ( CategoriaException ) {
    $errores[] = "No se ha seleccionado una categoría válida";
}
require_once 'views/galeria.view.php';
