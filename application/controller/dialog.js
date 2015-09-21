function dialogLogin() {
	$('#dialog').remove();
	$('body').append('<div id="dialog"></div>');
	$.get('application/view/dynamic/login.html', function( data ) {
		$('#dialog').html(data);
		$('#dialog').dialog({
			title: "Login",
			show:  "fade",
			hide: "fade",
			height: "auto",
			width: "auto"
		});
		$('#dialog').dialog("open");
	});
}

function dialogCompanyAdd() {
	$('#dialog').remove();
	$('body').append('<div id="dialog"></div>');
	$.get('application/view/dynamic/company_add.html', function( data ) {
		$('#dialog').html(data);
		$('#dialog').dialog({
			title: "Add Company",
			show:  "fade",
			hide: "fade",
			height: "auto",
			width: "auto"
		});
		$('#dialog').dialog("open");
	});
}

function dialogCompanyUpdate(company) {
	$('#dialog').remove();
	$('body').append('<div id="dialog"><script>var company = '+ JSON.stringify(company) + '</script></div>');
	$.get('application/view/dynamic/company_update.html', function( data ) {
		$('#dialog').html(data);
		$('#dialog').dialog({
			title: "Update Company",
			show:  "fade",
			hide: "fade",
			height: "auto",
			width: "auto",
			object: company
		});
		$('#dialog').dialog("open");
	});
}

function dialogGoogleSearchAddress(company) {
	$('#dialogGoogleSearchAddress').remove();
	$('body').append('<div id="dialogGoogleSearchAddress"><script>var company = '+ JSON.stringify(company) + '</script></div>');
	$.get('application/view/dynamic/google_seach_address.html', function( data ) {
		$('#dialogGoogleSearchAddress').html(data);
		$('#dialogGoogleSearchAddress').dialog({
			title: "Get Address",
			show:  "fade",
			hide: "fade",
			height: 350,
			width: 600,
			object: company
		});
		$('#dialogGoogleSearchAddress').dialog("open");
	});
}


function companyView() {
	$('#tabControl #companyView').remove();
	$('[href="#companyView"]').remove();
	$('#tabControl').append("<div id='companyView'/>");
	$.get('application/view/dynamic/company.html', function( data ) {
		$('#tabControl #companyView').html(data);
		$('#tabControl ul').append("<li><a href='#companyView'>Company</a></li>");
		$('#tabControl').tabs("refresh");
		$('#tabControl').tabs({collapsible:false});
	});
}

function companyActivities() {
	$('#tabControl #companyActivities').remove();
	$('[href="#companyActivities"]').remove();
	$('#tabControl').append("<div id='companyActivities'/>");
	$.get('application/view/dynamic/company_activities.html', function( data ) {
		$('#tabControl #companyActivities').html(data);
		$('#tabControl ul').append("<li><a href='#companyActivities'>Activities</a></li>");
		$('#tabControl').tabs("refresh");
		$('#tabControl').tabs({collapsible:false});
	});
}


// function dialogCompanyAddBusinessField() {
// 	$('body').append('<div id="dialog" style="font-size: 0.8em"></div>');
// 	$.get('forms/companyAddBusinessField.html', function( data ) {
// 		$('#dialog').html(data);
// 	});
// 	$('#dialog').dialog({
// 		title: "Add Business Field",
// 		heightStyle: "content"
// 	});
// 	$('#dialog').dialog("open");
// }
