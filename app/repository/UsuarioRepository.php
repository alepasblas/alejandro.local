<?php
namespace alejandro\app\repository;

use alejandro\core\database\QueryBuilder;
use alejandro\app\entity\Usuario;

use alejandro\app\exceptions\NotFoundException;
use alejandro\app\exceptions\QueryException;

class UsuarioRepository extends QueryBuilder
{
    /**
     * Constructor de UsuarioRepository
     *
     * @param string $table
     * @param string $classEntity
     */
    public function __construct(string $table = 'usuarios', string $classEntity = Usuario::class)
    {
        parent::__construct($table, $classEntity);
    }

    /**
     * Guarda un nuevo usuario en la base de datos.
     *
     * @param Usuario $usuario
     * @throws QueryException
     */
    public function guarda(Usuario $usuario)
    {
        $fnGuardaUsuario = function () use ($usuario) {
            $this->save($usuario);
        };
        $this->executeTransaction($fnGuardaUsuario); // Ejecuta el guardado dentro de una transacción.
    }

    /**
     * Obtiene un usuario por su ID.
     *
     * @param int $id
     * @return Usuario
     * @throws NotFoundException
     * @throws QueryException
     */
    public function getUsuarioPorId(int $id): Usuario
    {
        return $this->find($id);
    }

}
