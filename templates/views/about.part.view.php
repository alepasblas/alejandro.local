<div class="row feedback text-center">
    <h3>CLIENTS FEEDBACK</h3>
    <hr>
    <?php
    foreach($imagenesClientes as $imagen){
    ?>
    <div class="col-xs-12 col-sm-3">
        <img class="img-responsive" src="<?php echo $imagen->getUrlClientes(); ?>" alt="client's picture">
        <h5><?php echo $imagen->getDescripcion(); ?></h5>
        <q>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</q>
    </div>
    <?php } ?>
</div>