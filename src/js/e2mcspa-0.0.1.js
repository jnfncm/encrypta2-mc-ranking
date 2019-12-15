/**
 * encrypta2 Meet Cryptocurrencies
 * Aplicación de miniconcurso de criptomonedas
 * Librería del cliente
 *
 * Copyright 2019-2020 Juan Carrión
 * Licenciado bajo GNU General Public License v3.0
 */

$(function() {

	$("#enter-form").on("submit", function(event) {
		event.preventDefault();

		name = $("#enter-form-name").val();

		if (! /^[a-zA-Z0-9_\- ]{6,60}$/.test(name)) {
			console.error("Name did not pass local regular expression.");
			$("#result-container").prepend('<div class="alert alert-danger" role="alert">Lo sentimos, ese nombre no es válido. Comprueba que usas solo números, mayúsculas, minúsculas, guiones y guiones bajos, y entre 6 y 60 caracteres.</div>');
		} else {
			console.log("Sending...");

			$.post("https://encrypta2.ml/api", { enterFormName: name }, function(data) {
				if (data.status == "created") {
					console.log("created");
					$("#result-container").fadeOut("fast", function() {
						$(this).html('<div class="alert alert-success" role="alert">¡Hola, ' + data.contestant.name + '! Que la fuerza esté contigo.</div><p>Este nombre es meramente informativo para el ranking en pantalla. No necesitas hacer nada más aquí, simplemente recuerda tu nombre cuando entregues una solución al ejercicio.').fadeIn("fast");
					});
				} else {
					if (data.error_type == "invalid_name") {
						console.error("invalid_name");
						$("#result-container").prepend('<div class="alert alert-danger" role="alert">Lo sentimos, ese nombre no es válido. Comprueba que usas solo números, mayúsculas, minúsculas, guiones y guiones bajos, y entre 6 y 60 caracteres.</div>');
					} else if (data.error_type == "name_already_exists") {
						console.error("name_already_exists");
						$("#result-container").prepend('<div class="alert alert-danger" role="alert">Lo sentimos, ese nombre ya está registrado.</div>');
					} else if (data.error_type == "db_error") {
						console.error("db_error");
						$("#result-container").prepend('<div class="alert alert-danger" role="alert">Lo sentimos, hubo un problema con el servidor la base de datos.</div>');
					}
				}
			});

		}
	});

});