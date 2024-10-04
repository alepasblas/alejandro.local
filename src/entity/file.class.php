<?php
require_once __DIR__ . "/../src/exceptions/fileException.class.php";

class File
{
    /**
    * param string $fileName
    * param array $arrTypes
    * @throws FileException
    */

    private $file; // Contenido del fichero que se sube al servidor
    private $fileName; // Nombre del fichero
    // Se pasa el nombre del fichero y una lista con los tipos de archivos que acepta la clase.
    public function __construct (string $fileName, array $arrTypes)
    {
        $this->file = $_FILES[$fileName]; // $_FILES guarda los datos que se envían en forma de fichero
        $this->fileName='';
        if(!isset($this->file)) // Comprobar si ya existe el fichero
        {
            throw new FileException('Debes seleccionar un fichero');
        }
        if ( $this->file['error'] !== UPLOAD_ERR_OK ) // Si se ha producido algún error en la subida
        {
            switch ($this->file['error'])
            {
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new FileException('El fichero es demasiado grande');

                case UPLOAD_ERR_PARTIAL:
                    throw new FileException('No se ha podido subir el fichero completo');

                default:
                    throw new FileException('No se ha podido subir el fichero');

                break;
            }
        }
        // Comprobar si los archivos pasados son de un tipo admitido
        if (in_array($this->file['type'], $arrTypes) === false){
            throw new FileException('Tipo de fichero no soportado');

        }
    }
    public function getFileName()
    {
    return $this->fileName;
    }
    
}  
?>