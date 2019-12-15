<?php 

require_once("private.php");

$no_change = false;
$score_updated = false;
$update_error = false;

if (! empty($_POST)) {
	if (! isset($_POST["current-contestant-new-score"])) {
		$no_change = true;
	} else {
		$new_score = $_POST["current-contestant-new-score"];

		if ($new_score == "") {
			$no_change = true;
		} else {
			if (Contestant::dbUpdateScore($_POST["current-contestant-id"], $new_score)) {
				$score_updated = true;
			} else {
				$update_error = true;
			}
		}
	}
}

if (isset($_GET["delete"])) {
	if (Contestant::dbRemove($_GET["delete"])) {
		header("Location: manage");
	} else {
		$update_error = true;
	}
}

?><!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="css/bootstrap-4.3.1.min.css">
	<link rel="stylesheet" href="css/e2mcspa-manage.css?v=0.0000<?php echo time(); ?>">

	<title>Administrar – <?php echo $e2mcspa_app_title; ?></title>
</head>
<body>
	<nav class="navbar navbar-light bg-light">
		<a class="navbar-brand" href="#">
			<img src="img/logo-moneda-eticoin.png" width="30" height="30" id="navbar-logo-eticoin" class="d-inline-block align-top" alt="">
			Meet cryptocurrencies
		</a>
	</nav>

	<div class="modal fade" id="score-update-modal" tabindex="-1" role="dialog" aria-labelledby="modifyScoreModal" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modifyScoreModal">Cambiar puntuación</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="modify-score-form" method="post" action="manage">
					<div class="modal-body">
						<input type="hidden" name="current-contestant-id" id="current-contestant-id" value="0">
						<div class="form-group">
							<label for="current-contestant-name">Participante</label>
							<input type="email" class="form-control" id="current-contestant-name" placeholder="initial-null" disabled>
						</div>
						<div class="form-group">
							<label for="current-contestant-new-score">Nueva puntuación</label>
							<input type="number" class="form-control" name="current-contestant-new-score" id="current-contestant-new-score" placeholder="initial-null">
						</div>
					</div>
					<div class="modal-footer">
						<a class="btn btn-danger" href="#" id="delete-button">Eliminar participante</a>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div id="contestant-list-container">
				
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Participantes</h5>
						<?php

if ($no_change) {

						?>
						<div class="alert alert-warning alert-dismissible fade show" role="alert">
							Sin cambios
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<?php

} elseif ($update_error) {
	
						?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							Error al actualizar
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<?php

} elseif ($score_updated) {
	
						?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							Actualizado correctamente
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<?php

}

						?>
					</div>

					<div class="list-group list-group-flush">
						<?php

$contestants = Contestant::dbGetAll();

if ($contestants) {
	foreach ($contestants as $c) {
						?><a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#score-update-modal" data-contestant-id="<?php echo $c["id"]; ?>" data-contestant-name="<?php echo $c["name"]; ?>" data-contestant-score="<?php echo $c["score"]; ?>"><?php echo $c["name"]; ?> (<?php echo $c["score"]; ?> ETC)</a><?php
	}
} else {
						?><div class="list-group-item">Aún no hay participantes</div><?php
}

						?>
					</div>

					<div class="card-body">
						<a href="#" class="card-link">:)</a>
					</div>
				</div>

	</div>

	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/popper-1.14.7.min.js"></script>
	<script src="js/bootstrap-4.3.1.min.js"></script>
	<script src="js/e2mcspa-manage-0.0.1.js?v=0.0000<?php echo time(); ?>"></script>
</body>
</html>