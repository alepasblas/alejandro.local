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
use alejandro\app\repository\AsociadosRepository;
use alejandro\app\utils\Captcha;
use Reflector;

class AsociadosController
{
    /**
     * @throws QueryException
     */
    public function index()
    {
        $errores = [];
        $nombre = "";
        $descripcion = "";
        $mensaje = "";


        try {
            $conexion = App::getConnection();

            $asociadoRepo = new AsociadosRepository();
            $asociadoRepo = App::getRepository(AsociadosRepository::class);
            $asociados = $asociadoRepo->findAll();
        } catch (FileException $fileException) {
            $errores[] = $fileException->getMessage();
        } catch (QueryException $queryException) {
            $errores[] = $queryException->getMessage();
        } catch (AppException $appException) {
            $errores[] = $appException->getMessage();
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

        Response::renderView(
            'asociados',
            'layout',
            compact('nombre', 'descripcion', 'asociadoRepo','asociados' )

        );

        require_once __DIR__ . "/../views/asociados.view.php";

    }

    public function nueva(){
        $errores = [];
        $nombre = "";
        $descripcion = "";
        try {
            $asociadosRepository = new AsociadosRepository();

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

    }
        
    
}
