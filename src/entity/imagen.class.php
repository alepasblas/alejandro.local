<?php
class Imagen {

    const RUTA_IMAGENES_PORTFOLIO = '/public/images/index/portfolio/';
    const RUTA_IMAGENES_GALERIA = '/public/images/index/gallery/';
    const RUTA_IMAGENES_CLIENTES = '/public/images/clients/';
    const RUTA_IMAGENES_SUBIDAS = '/public/images/galeria/';
    const RUTA_IMAGENES_ASOCIADOS = '/public/images/asociados/';
    private $id;
    private $nombre;
    private $descripcion;
    private $categoria;
    private $numVisualizaciones;
    private $numLikes;
    private $numDownloads;
  

    public function __construct($nombre = "", $descripcion = "", $categoria = "", $numVisualizaciones = 0, $numLikes = 0, $numDownloads = 0) {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->categoria = $categoria;
        $this->numVisualizaciones = $numVisualizaciones;
        $this->numLikes = $numLikes;
        $this->numDownloads = $numDownloads;
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

    public function getCategoria(): string {
        return $this->categoria;
    }

    public function getNumVisualizaciones(): int {
        return $this->numVisualizaciones;
    }

    public function getNumLikes(): int {
        return $this->numLikes;
    }

    public function getNumDownloads(): int {
        return $this->numDownloads;
    }

    public function setNombre(string $nombre): self {
        $this->nombre = $nombre;
        return $this;
    }

    public function setDescripcion(string $descripcion): self {
        $this->descripcion = $descripcion;
        return $this;
    }

    public function setCategoria(string $categoria): self {
        $this->categoria = $categoria;
        return $this;
    }

    public function setNumVisualizaciones(int $numVisualizaciones): self {
        $this->numVisualizaciones = $numVisualizaciones;
        return $this;
    }

    public function setNumLikes(int $numLikes): self {
        $this->numLikes = $numLikes;
        return $this;
    }

    public function setNumDownloads(int $numDownloads): self {
        $this->numDownloads = $numDownloads;
        return $this;
    }

    public function __toString(): string {
        return $this->descripcion;
    }

    public function getUrlPortfolio(): string {
        return self::RUTA_IMAGENES_PORTFOLIO . $this->getNombre();
    }
    
    public function getUrlGaleria(): string {
        return self::RUTA_IMAGENES_GALERIA . $this->getNombre();
    }
    
    public function getUrlClientes(): string {
        return self::RUTA_IMAGENES_CLIENTES . $this->getNombre();
    }
    public function getUrlSubidas(): string {
        return self::RUTA_IMAGENES_SUBIDAS . $this->getNombre();
    }
    public function getUrlAsociados(): string {
        return self::RUTA_IMAGENES_ASOCIADOS . $this->getNombre();
    }
    
    
}
?>
