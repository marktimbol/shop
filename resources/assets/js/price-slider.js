$(function() {
	$('#price-slider').slider({
		range: true,
		min: 0,
		max: 500,
		values: [0, 300],
		slide: function(event, ui) {
			$('#price-range').text(
				'From: AED' + ui.values[0] + 
				' - AED' + ui.values[1]
			);
			console.log(ui.values[0], ui.values[1]);
		}
	});

	$('#price-range').text(
		'From: AED' + $('#price-slider').slider('values', 0) + 
		' - AED' + $('#price-slider').slider('values', 1)
	);
});