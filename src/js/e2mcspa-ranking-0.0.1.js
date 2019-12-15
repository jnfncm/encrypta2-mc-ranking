/**
 * encrypta2 Meet Cryptocurrencies
 * Aplicación de miniconcurso de criptomonedas
 * Librería del cliente
 *
 * Copyright 2019-2020 Juan Carrión
 * Licenciado bajo GNU General Public License v3.0
 */

var globalState;

function updateGlobalState() {
	console.log("Running");
	$.post("https://encrypta2.ml/ranking.api.php", { app: "e2mcspa", section: "ranking" }, function (data) {
		console.log("Received");

		if (data.contestants === null) {
			console.log("Empty");
			
			$("#contestant-list").empty();

			setTimeout(updateGlobalState, 8000);
		} else {
			let oldGlobalState = globalState;
			globalState = data;

			if (JSON.stringify(oldGlobalState) == JSON.stringify(globalState)) {
				console.log("No change");
				setTimeout(updateGlobalState, 4000);
			} else {
				console.log("Updated")

				var zeroPointsContestants = [];
				var notZeroPointsContestants = [];

				data.contestants.forEach(function (contestant) {
					if (contestant.score == 0) {
						zeroPointsContestants.push(contestant);
					} else {
						notZeroPointsContestants.push(contestant);
					}
				});

				$("#contestant-list").empty();

				var rank = notZeroPointsContestants.length;

				notZeroPointsContestants.sort(function (a, b) { return a.score - b.score; }).forEach(function (contestant) {
					$("#contestant-list").prepend('<div class="contestant"><p class="rank">#' + rank + '</p><p class="name">' + contestant.name + '</p><p class="score"><span class="value">' + contestant.score + '</span> ETC</p><div class="clearfix"></div></div>');
					rank--;
				});

				zeroPointsContestants.forEach(function (contestant) {
					$("#contestant-list").append('<div class="contestant zero"><p class="name">' + contestant.name + '</p><div class="clearfix"></div></div>');
				});

				setTimeout(updateGlobalState, 8000);
			}
		}
	});
}

$(function() {

	updateGlobalState();

});