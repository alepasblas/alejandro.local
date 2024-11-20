<?php

namespace alejandro\app\controllers;


use alejandro\core\Response;
use alejandro\app\entity\Imagen;
use alejandro\app\entity\Asociado;

use alejandro\app\exceptions\AppException;
use alejandro\app\exceptions\CategoriaException;
use alejandro\app\exceptions\FileException;
use alejandro\app\exceptions\QueryException;
use alejandro\app\repository\ImagenesRepository;
use alejandro\app\repository\CategoriaRepository;
use alejandro\core\App;
use alejandro\app\entity\File;
use alejandro\core\database\QueryBuilder;
use alejandro\core\helpers\FlashMessage;


class GaleriaController
{
    /**
     * @throws QueryException
     */
    public function index()
    {
        $errores = FlashMessage::get('errores', []);
        $titulo = FlashMessage::get('titulo');
        $descripcion = FlashMessage::get('descripcion');
        $categoriaSeleccionada = FlashMessage::get('categoriaSeleccionada');
        try {
            $categoriaRepository = new CategoriaRepository();
            $imagenesRepository = App::getRepository(ImagenesRepository::class);

            $categorias = $categoriaRepository->findAll();
            $imagenes = $imagenesRepository->findAll();
            FlashMessage::set('titulo', "Todo bien");
        } catch (FileException $fileException) {
            FlashMessage::set('errores', [$fileException->getMessage()]);
        } catch (QueryException $queryException) {
            FlashMessage::set('errores', [$queryException->getMessage()]);
        } catch (AppException $appException) {
            FlashMessage::set('errores', [$appException->getMessage()]);
        } catch (CategoriaException) {
            FlashMessage::set('errores', ["No se ha seleccionado una categoría válida"]);
        }

        $errores = $_SESSION['errores'] ?? [];
        $titulo = $_SESSION['titulo'] ?? '';
        FlashMessage::unset('descripcion');
        FlashMessage::unset('categoriaSeleccionada');

        Response::renderView(
            'galeria',
            'layout',
            compact('imagenes', 'categorias', 'errores', 'descripcion', 'titulo', 'imagenesRepository', 'categoriaSeleccionada')
        );
    }
    public function nueva()
    {
        try {
            $titulo = trim(htmlspecialchars($_POST['titulo']));
            $descripcion = trim(htmlspecialchars($_POST['descripcion']));
            FlashMessage::set('descripcion', $descripcion);
            FlashMessage::set('titulo', $titulo);

            $categoria = trim(htmlspecialchars($_POST['categoria']));
            if (empty($categoria))
                throw new CategoriaException;
            $_SESSION['categoriaSeleccionada'] = $categoria;

            $tiposAceptados = ['image/jpeg', 'image/gif', 'image/png'];
            $imagen = new File('imagen', $tiposAceptados); // El nombre 'imagen' es el que se ha puesto en el formulario de galeria.view.php
            $imagen->saveUploadFile(Imagen::RUTA_IMAGENES_SUBIDAS);
            $imagenGaleria = new Imagen($imagen->getFileName(), $descripcion, $categoria);
            $imagenesRepository = App::getRepository(ImagenesRepository::class);
            $imagenesRepository->guarda($imagenGaleria);
            FlashMessage::set('mensaje', "Todo bien");

            App::get('logger')->add("Se ha guardado una imagen: " . $imagenGaleria->getNombre());
        } catch (FileException $fileException) {
            FlashMessage::set('errores', [$fileException->getMessage()]);
        } catch (QueryException $queryException) {
            FlashMessage::set('errores', [$queryException->getMessage()]);
        } catch (AppException $appException) {
            FlashMessage::set('errores', [$appException->getMessage()]);
        } catch (CategoriaException) {
            FlashMessage::set('errores', ["No se ha seleccionado una categoría válida"]);
        }
        $mensaje = "Se ha guardado una imagen: " . $imagenGaleria->getNombre();
        App::get('logger')->add($mensaje);
        $mensaje = $_SESSION['mensaje'] ?? '';
        FlashMessage::unset('descripcion');
        FlashMessage::unset('titulo');
        App::get('router')->redirect('galeria');


        Response::renderView(
            'galeria',
            'layout',
            compact('imagenGaleria', 'titulo', 'imagenesRepository', 'imagen', 'descripcion' , 'categoria'  )
        );
    
    }

    public function show($id)
    {
        $imagenesRepository = App::getRepository(ImagenesRepository::class);
        $imagenes = $imagenesRepository->find($id);
        FlashMessage::set('imagenes', $imagenes);
        FlashMessage::set('imagenesRepository', $imagenesRepository);

        FlashMessage::unset('imagenes');
        FlashMessage::unset('imagenesRepository');
        Response::renderView(
            'imagen-show',
            'layout',
            compact('imagenes', 'imagenesRepository')
        );
    }
}
