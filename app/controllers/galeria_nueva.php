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
$titulo = "";
$descripcion = "";
$mensaje = "";
try {
    $titulo = trim(htmlspecialchars($_POST['titulo']));
    $descripcion = trim(htmlspecialchars($_POST['descripcion']));
    $categoria = trim(htmlspecialchars($_POST['categoria']));
    if (empty($categoria))
        throw new CategoriaException;

    $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
    $imagen = new File('imagen', $tiposAceptados); // El nombre 'imagen' es el que se ha puesto en el formulario de galeria.view.php
    $imagen->saveUploadFile(Imagen::RUTA_IMAGENES_SUBIDAS);
    $imagenGaleria = new Imagen($imagen->getFileName(), $descripcion, $categoria);
    $imagenesRepository = new ImagenesRepository();
    $imagenesRepository->guarda($imagenGaleria);
} catch (FileException $fileException) {
    $errores[] = $fileException->getMessage();
} catch (QueryException $queryException) {
    $errores[] = $queryException->getMessage();
} catch (AppException $appException) {
    $errores[] = $appException->getMessage();
} catch (CategoriaException) {
    $errores[] = "No se ha seleccionado una categoría válida";
}
App::get('router')->redirect('galeria');
