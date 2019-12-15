<?php 

require_once("private.php");

?><!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="css/bootstrap-4.3.1.min.css">
	<link rel="stylesheet" href="css/e2mcspa-ranking.css?v=0.0000<?php echo time(); ?>">

	<title>Ranking – <?php echo $e2mcspa_app_title; ?></title>
</head>
<body>
	<div class="center-container">
		<div id="view-ranking" class="center-content">

			<div id="contestant-list" class="center-wrapper"></div>
			
		</div>
	</div>

	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="js/popper-1.14.7.min.js"></script>
	<script src="js/bootstrap-4.3.1.min.js"></script>
	<script src="js/e2mcspa-ranking-0.0.1.js?v=0.0000<?php echo time(); ?>"></script>
</body>
</html>