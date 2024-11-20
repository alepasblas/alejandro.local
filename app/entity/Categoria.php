<?php
namespace alejandro\app\entity;
use alejandro\core\database\IEntity;
use alejandro\app\repository\ImagenesRepository;

class Categoria implements IEntity
{
    
    private $id = null;
    private $nombre;
    private $numImagenes;
    

    public function __construct($nombre = "", $numImagenes = 0)
    {
        $this->nombre = $nombre;
        $this->numImagenes = $numImagenes;
    }


    public function getId(): string
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }
    public function getNumImagenes(): int
    {
        return $this->numImagenes;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function setnumImagenes(int $numImagenes): self
    {
        $this->numImagenes = $numImagenes;
        return $this;
    }

    public function __toString(): string
    {
        return $this->nombre + ", " + $this->numImagenes;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'numImagenes' => $this->getnumImagenes(),
        ];
    }
}
