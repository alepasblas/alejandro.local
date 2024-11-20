<!DOCTYPE html>
<html>

<head>
	<?php
	require_once __DIR__ . '/inicio.part.php';
	?>
</head>

<body id="page-top">

	<!-- Navigation Bar -->
	<?php
	require_once __DIR__ . '/navegacion.part.php';
	?>
	<!-- End of Navigation Bar -->

	<!-- Principal Content Start -->
	<div id="contact">
		<div class="container">
			<div class="col-xs-12 col-sm-8 col-sm-push-2">
				<h1>CONTACT US</h1>
				<hr>
				<p>Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>
				<form clas="form-horizontal" action="/contact/enviar" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<div class="col-xs-6">
							<label class="label-control">Nombre</label>
							<input class="form-control" type="text" name="nombre"/>
						</div>
						<div class="col-xs-6">
							<label class="label-control">Apellidos</label>
							<input class="form-control" type="text" name="apellidos">
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">
							<label class="label-control">Email</label>
							<input class="form-control" type="text" name="email">
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">
							<label class="label-control">Asunto</label>
							<input class="form-control" type="text" name="asunto">
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">
							<label class="label-control">Mensaje</label>
							<textarea class="form-control"></textarea name="mensaje">
							<button class="pull-right btn btn-lg sr-button">SEND</button>
						</div>
					</div>
				</form>
				<hr class="divider">
				<div class="address">
					<h3>GET IN TOUCH</h3>
					<hr>
					<p>Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero.</p>
				</div>
			</div>
		</div>
	</div>
	<!-- Principal Content Start -->

</body>

</html>