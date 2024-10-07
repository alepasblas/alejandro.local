<?php
      require_once __DIR__ . '/../index.php';
      require_once __DIR__ . '/../../src/utils/utils.class.php';
?>
<div class="last-box row">
  <div class="col-xs-12 col-sm-4 col-sm-push-4 last-block">
    <div class="partner-box text-center">
      <p>
        <i class="fa fa-map-marker fa-2x sr-icons"></i>
        <span class="text-muted">35 North Drive, Adroukpape, PY 88105, Agoe Telessou</span>
      </p>
      <h4>Our Main Partners</h4>
      <hr>
      <div class="text-muted text-left">

        <?php
          $nuevoArray=utils::extraeElementosAleatorios($asociados, 3) ??[];
          foreach ($nuevoArray as $key) {
        ?>
        <ul class="list-inline">
          <li><img src="<?php echo $key->getUrlAsociados()?>" alt="<?php echo $key->getDescripcion()?>"></li>
          <li><?php echo $key->getNombre()?></li>
        </ul>
        <?php
          }
        ?>

      </div>
    </div>
  </div>
</div>