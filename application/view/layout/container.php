<?php
$server = $_SESSION['server'];
$database = $_SESSION['database'];
$user = $_SESSION['user'];
?>

<div id="container" class="container">
	<div id="header" class="header" ></div>
	<div id="middle" class="middle">
		<div id="left" class="left"></div>
		<div id="panel" class="panel"></div>
	</div>
	<div id="footer"  class="footer"></div>
</div>



<script type="text/javascript">
	$.get("application/view/layout/header.php", function(result){
		$('#header').html(result);
	});
	$.get("application/view/layout/footer.php", function(result){
		$('#footer').html(result);
	});
	$.get("application/view/layout/left.php", function(result){
		$('#left').html(result);
	});
	$.post("application/view/layout/panel.php", function(result){
		$('#panel').html(result);
	});

</script>



<style type="text/css">
	body .container {
		margin: 0;
		padding: 0;
		background-color: #FFFF00;
		position: absolute;
		width: 100%;
		height: 100%;
		
	}

	body .header {
		margin: 0;
		padding: 0;
		background-color: #EEEEEE;
		width: 100%;
		height: 100px;

	}

	body .middle {
		margin: 0;
		padding: 0;
		background-color: #FFFFFF;
		width: 100%;
		height: calc(100% - (100px + 50px)); 

	}
	body .footer {
		margin: 0;
		padding: 0;
		background-color: #EEEEEE;
		width: 100%;
		height: 50px;
		clear: both;
	}
	body .middle .left {
		margin: 0;
		padding: 0;
		/*background-color: #0000FF;*/
		width: 250px;
		height: 100%;
		float: left;
		overflow-y: hidden; 

	}
	body .middle .panel {
		margin: 0;
		padding: 0;
		/*background-color: #0000FF;*/
		width: calc(100% - 250px);
		height: 100%;
		float: left;
		overflow-y: scroll; 
	}
</style>

<style type="text/css">
	#accordion {
		margin: 5px;
		padding: 0px;
		font-size: 11px;
	}
	#accordion #menu {
		margin: 0px;
		padding: 5px;
	}

	#tabControl {
		margin: 5px;
		padding: 0px;
		font-size: 11px;
	}
</style>