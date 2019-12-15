/**
 * encrypta2 Meet Cryptocurrencies
 * Aplicación de miniconcurso de criptomonedas
 * Librería del cliente
 *
 * Copyright 2019-2020 Juan Carrión
 * Licenciado bajo GNU General Public License v3.0
 */

$(function() {

	$(".alert").alert();

	$("#score-update-modal").on("shown.bs.modal", function (event) {
		var button = $(event.relatedTarget); // Button that triggered the modal
		$("#score-update-modal #current-contestant-id").val(button.data("contestant-id"));
		$("#score-update-modal #current-contestant-name").val(button.data("contestant-name"));
		$("#score-update-modal #current-contestant-new-score").attr("placeholder", button.data("contestant-score"));
		$("#delete-button").attr("href", "manage?delete=" + button.data("contestant-id"));
	});

});