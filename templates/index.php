<?php require_once __DIR__ . "/../src/entity/imagen.class.php";


$imagenes[] = new Imagen('1.jpg', 'Descripcion1', 1, 456, 610, 130);
$imagenes[] = new Imagen('2.jpg', 'Descripcion2', 2, 460, 620, 140);
$imagenes[] = new Imagen('3.jpg', 'Descripcion3', 3, 470, 615, 125);
$imagenes[] = new Imagen('4.jpg', 'Descripcion4', 1, 450, 605, 135);
$imagenes[] = new Imagen('5.jpg', 'Descripcion5', 2, 465, 600, 145);
$imagenes[] = new Imagen('6.jpg', 'Descripcion6', 3, 455, 625, 120);
$imagenes[] = new Imagen('7.jpg', 'Descripcion7', 1, 475, 610, 138);
$imagenes[] = new Imagen('8.jpg', 'Descripcion8', 2, 460, 630, 110);
$imagenes[] = new Imagen('9.jpg', 'Descripcion9', 3, 455, 615, 150);
$imagenes[] = new Imagen('10.jpg', 'Descripcion10', 1, 470, 600, 132);
$imagenes[] = new Imagen('11.jpg', 'Descripcion11', 2, 465, 620, 128);
$imagenes[] = new Imagen('12.jpg', 'Descripcion12', 3, 455, 605, 142);



require_once __DIR__ . "/views/index.view.php";