function notify(message) {
	var div = "<div id='notify'>" + message + "</div>";
	$('#notify').remove();
	$('body').append(div);

	$("#notify").css({
		'border' : '1px solid #0000FF',
		'border-radius' : '5px',
		'background' : 'rgba(0,0,255,0.1)',
		'color' : '#000000',
		'min-width' : '200px',
		'min-height' : '20px',
		'position' : 'absolute',
		'right' : '0px',
		'margin' : '5px',
		'padding' : '5px',
		'display' : 'none'
	});

	$("#notify").show("drop");
	setTimeout(function() {
		$("#notify").hide("drop");
	},3000);
}

function notifyError(message) {
	var div = "<div id='notify'>" + message + "</div>";
	$('#notify').remove();
	$('body').append(div);

	$("#notify").css({
		'border' : '1px solid #FF0000',
		'border-radius' : '5px',
		'background' : 'rgba(255,0,0,0.1)',
		'color' : '#000000',
		'min-width' : '200px',
		'min-height' : '20px',
		'position' : 'absolute',
		'right' : '0px',
		'margin' : '5px',
		'padding' : '5px',
		'display' : 'none'
	});

	$("#notify").show("drop");
	setTimeout(function() {
		$("#notify").hide("drop");
	},5000);
}
