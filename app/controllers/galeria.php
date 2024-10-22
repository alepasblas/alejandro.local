<?php

require_once __DIR__ . "/../../src/entity/file.class.php";
require_once __DIR__ . '/../../src/exceptions/fileException.class.php';
require_once __DIR__ . '/../../src/exceptions/categoriaException.class.php';
require_once __DIR__ . '/../../src/entity/imagen.class.php';
require_once __DIR__ . '/../../src/database/connection.class.php';
require_once __DIR__ . '/../../repository/imagenesRepository.php';
require_once __DIR__ . '/../../repository/categoriaRepository.php';
require_once __DIR__ . '/../../core/bootstrap.php';

$errores = [];
$descripcion = "";
$titulo = "";
$mensaje = '';
try {

    $conexion = App::getConnection();

    $categoriaRepository = new CategoriaRepository();
    $imagenesRepository = new ImagenesRepository();

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

require_once __DIR__ .'/../views/galeria.view.php';