<div id="accordion">
	<div id="accordion-sales">Sales</div>
	<ul id="menuSales">
		<li id="salesCompany">Company</li>
		<li id="salesCompanyActivities">User Activities</li>
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