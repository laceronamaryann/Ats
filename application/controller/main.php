<?php
	use Core\Server;
	use Core\Database;
	use Core\User;

	$server = new Server("184.107.179.178","rhalfs server",Server::MYSQL);
	$database = new Database("rhalf","trivalassasin8", "");

	$_SESSION['server'] = $server;
	$_SESSION['database'] = $database;
	
	if (isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
		include($root . '/application/view/layout/container.php');
		echo '
		<script>
		
		user = new User();
		user.Id = ' . $user->Id . ';
		user.Name = "' . $user->Name. '";
		user.Password = "' . $user->Password. '";
		user.Privilege = "' . $user->Privilege. '";
		user.Status = "' . $user->Status. '";
		user.DateTimeCreated = "' . $user->DateTimeCreated. '";
		user.DateTimeRenewed = "' . $user->DateTimeRenewed. '";
		user.Email = "' . $user->Email. '";
		user.AccessLength = "' . $user->AccessLength. '";


		notify("Welcome " + user.Name + "!");
		//sessionStorage.setItem("user",JSON.stringify(user));
		</script>

		'; 

	} else {
		echo '<script>dialogLogin();</script>'; 
	}
?>
