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

		/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#66b6fc+0,b2e1ff+100 */
		background: rgb(102,182,252); /* Old browsers */
		background: -moz-linear-gradient(top,  rgba(102,182,252,1) 0%, rgba(178,225,255,1) 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(102,182,252,1)), color-stop(100%,rgba(178,225,255,1))); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top,  rgba(102,182,252,1) 0%,rgba(178,225,255,1) 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top,  rgba(102,182,252,1) 0%,rgba(178,225,255,1) 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top,  rgba(102,182,252,1) 0%,rgba(178,225,255,1) 100%); /* IE10+ */
		background: linear-gradient(to bottom,  rgba(102,182,252,1) 0%,rgba(178,225,255,1) 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#66b6fc', endColorstr='#b2e1ff',GradientType=0 ); /* IE6-9 */
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


		/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#b2e1ff+0,66b6fc+100;Blue+3D+%236 */
		background: rgb(178,225,255); /* Old browsers */
		background: -moz-linear-gradient(top,  rgba(178,225,255,1) 0%, rgba(102,182,252,1) 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(178,225,255,1)), color-stop(100%,rgba(102,182,252,1))); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top,  rgba(178,225,255,1) 0%,rgba(102,182,252,1) 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top,  rgba(178,225,255,1) 0%,rgba(102,182,252,1) 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top,  rgba(178,225,255,1) 0%,rgba(102,182,252,1) 100%); /* IE10+ */
		background: linear-gradient(to bottom,  rgba(178,225,255,1) 0%,rgba(102,182,252,1) 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b2e1ff', endColorstr='#66b6fc',GradientType=0 ); /* IE6-9 */

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

	#accordion #menuOptions,
	#accordion #menuSales {
		margin: 0px;
		padding: 5px;
	}

	#tabControl {
		margin: 5px;
		padding: 0px;
		font-size: 11px;
	}
</style>