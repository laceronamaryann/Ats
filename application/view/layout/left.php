<div id="accordion">
	<div id="accordion-sales">Sales</div>
	<ul id="menu">
		<li id="salesCompany">Company</li>
		<li id="salesCompanyActivities">User Activities</li>

		<!-- <li id="companyAddBusinessField">Add Business Field</li> -->
	</ul>
	<div>Section 2</div>
	<div>asas</div>
	<div>Section 3</div>
	<div>as</div>
	<div>Section 4</div>
	<div>sa</div>
	<div>Section 4</div>
	<div>sa</div>
	<div>Section 4</div>
	<div>sa</div>
	<div>Section 4</div>
	<div>sa</div>
	<div>Section 4</div>
	<div>sa</div>
	<div>Section 4</div>
	<div>sa</div>
</div>



<script type="text/javascript">
	$(function() {
		$('#accordion').accordion({
			collapsible: true,
			heightStyle: "content",
			active: false
			// activate: function(event,ui) {
			// 	if (ui.oldPanel) {
			// 		// $.get("application/view/dynamic/company.html", function(data){
			// 		// 	$('#content').html(data);
			// 		// });
			// 		alert(ui.newPanel);
			// 	}
			
			// }
		});
		$('#menu').menu();
	});

	$('#salesCompanyActivities').click(function() {
		companyActivities();	
	});

	$('#salesCompany').click(function() {
		companyView();	
	});
	$('#companyAddBusinessField').click(function() {
		dialogCompanyAddBusinessField();		
	});



</script>