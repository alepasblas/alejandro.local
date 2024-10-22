<?php
require_once __DIR__ . "/../../src/entity/file.class.php";
require_once __DIR__ . '/../../src/exceptions/fileException.class.php';
require_once __DIR__ . '/../../src/entity/imagen.class.php';
require_once __DIR__ . '/../../src/entity/asociado.class.php';
require_once __DIR__ . '/../../src/database/connection.class.php';
require_once __DIR__ . '/../../repository/asociadosRepository.php';
require_once __DIR__ . '/../../core/bootstrap.php';


$errores = [];
$nombre = "";
$descripcion = "";
try {
    $asociadosRepository = new AsociadosRepository();

    $nombre = trim(htmlspecialchars($_POST['nombre']));
    $descripcion = trim(htmlspecialchars($_POST['descripcion']));
    
    $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
    $imagen = new File('imagen', $tiposAceptados);
    $imagen->saveUploadFile(Imagen::RUTA_IMAGENES_ASOCIADOS);

    $asociados = new Asociado($imagen->getFileName(),$descripcion);
    $asociadosRepository->save($asociados);


} catch (FileException $fileException) {
    $errores[] = $fileException->getMessage();
} catch (QueryException $queryException) {
    $errores[] = $queryException->getMessage();
} catch (AppException $appException) {
    $errores[] = $appException->getMessage();
} catch (CategoriaException) {
    $errores[] = "No se ha seleccionado una categoría válida";
}
App::get('router')->redirect('asociados');
