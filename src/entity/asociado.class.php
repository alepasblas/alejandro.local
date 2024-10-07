<?php
class Asociado{
    private $id = null;
    private $nombre;
    private $logo;
    private $descripcion;
    const RUTA_LOGOS_ASOCIADOS = "/public/images/asociados/";

    public function __construct($nombre = "", $descripcion = "", $logo="") {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->logo = $logo;

    }

    public function getUrlAsociados(): string {
        return self::RUTA_LOGOS_ASOCIADOS . $this->getLogo();
    }
    public function getId(): string {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }
    public function getDescripcion(): string {
        return $this->descripcion;
    }
    public function getLogo(): string {
        return $this->logo;
    }

    public function setLogo(string $logo): self {
        $this->logo = $logo;
        return $this;
    }
    public function setNombre(string $nombre): self {
        $this->nombre = $nombre;
        return $this;
    }

    public function setDescripcion(string $descripcion): self {
        $this->descripcion = $descripcion;
        return $this;
    }

    public function __toString(): string {
        return $this->descripcion;
    }


}
?>