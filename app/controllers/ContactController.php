<?php

namespace alejandro\app\controllers;


use alejandro\core\Response;
use alejandro\app\entity\Imagen;
use alejandro\app\entity\Asociado;

class ContactController
{
    /**
     * @throws QueryException
     */
    public function index()
    {
        Response::renderView(
            'contact',
            'layout'
        );
    }
}