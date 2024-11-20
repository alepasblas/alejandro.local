<!-- Principal Content Start -->
<div id="galeria">
    <div class="container">
        <div class="col-xs-12 col-sm-8 col-sm-push-2">
            <h1>IMAGEN GALERIA</h1>
            <hr>
            <div class="imagenes_galeria">
                <img src="<?= $imagenes->getUrlSubidas() ?>" alt="<?= $imagenes->getDescripcion() ?> "
                title="<?= $imagenes->getDescripcion() ?>" width="500px" height="500px">
                <br>Descripción: <?= $imagenes->getDescripcion() ?>
                <br>Categoria:<?= $imagenesRepository->getCategoria($imagenes)->getNombre() ?>
                <br>Número de visualizaciones: <?= $imagenes->getNumVisualizaciones() ?>
                <br>Número de likes: <?= $imagenes->getNumLikes() ?>
                <br>Número de downloads: <?= $imagenes->getNumDownloads() ?>
            </div>
        </div>
    </div>
</div>