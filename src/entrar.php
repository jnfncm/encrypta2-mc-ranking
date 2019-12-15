<?php 

require_once("private.php");

?><!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="css/bootstrap-4.3.1.min.css">
	<link rel="stylesheet" href="css/e2mcspa.css?v=0.0000<?php echo time(); ?>">

	<title><?php echo $e2mcspa_app_title; ?></title>
</head>
<body>
	<div class="center-container">
		<div id="view-enter" class="center-content">

			<div class="center-wrapper">
				<p>¡Bienvenido a Meet cryptocurrencies!</p>
				<div id="result-container">
					<p>Introduce tu nombre de participante o equipo para poder comenzar el miniconcurso.</p>
					<form id="enter-form">
						<div class="form-group">
							<input type="text" class="form-control" id="enter-form-name" placeholder="Por ejemplo, encrypta2" required>
						</div>
						<button type="submit" class="btn btn-primary">Entrar</button>
					</form>
				</div>
			</div>
			
		</div>
	</div>

	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/popper-1.14.7.min.js"></script>
	<script src="js/bootstrap-4.3.1.min.js"></script>
	<script src="js/e2mcspa-0.0.1.js?v=0.0000<?php echo time(); ?>"></script>
</body>
</html>