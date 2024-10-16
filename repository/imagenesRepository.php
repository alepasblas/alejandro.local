<?php
require_once __DIR__ . '/../src/database/queryBuilder.class.php';

class ImagenesRepository extends QueryBuilder
{
    /**
     * @param string $table
     * @param string $classEntity
     */
    public function __construct(string $table = 'imagenes', string $classEntity = 'Imagen')
    {
        parent::__construct($table, $classEntity);
    }
}
