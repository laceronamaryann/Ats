<div id="accordion">
	<div id="accordion-sales">Sales</div>
	<ul id="menuSales">
		<li id="salesCompany">Company</li>
		<li id="salesCompanyLogs">User Activities</li>
	</ul>
	<div id="accordion-options">Options</div>
	<ul id="menuOptions">
		<li id="userLogout">Logout</li>
	</ul>
</div>



<script type="text/javascript">

	$('#accordion').accordion({
		collapsible: true,
		heightStyle: "content",
		active: false
	});

	$('#menuSales').menu();
	$('#menuOptions').menu();

	$('#salesCompanyLogs').click(function() {
		companyLogs();	
	});

	$('#salesCompany').click(function() {
		companyView();	
	});
	$('#userLogout').click(function() {
		dialogLogout();		
	});



</script>