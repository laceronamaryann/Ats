<?php
include ('initialize.php');

use Core\Server;
use Core\Database;
use Core\Company;
use Core\User;
use Core\Result;


/*Objects included on Json*/
$array['result'] = array();
$array['user'] = array();
/*Variables*/


$connection = null;
try {
	//----------------------------------------------------------------------

	if ($server->Type == Server::MSSQL) {
		$connection = new PDO("mssql:host=$server->Ip;dbname=", $user, $pass);
		$connection = new PDO("sybase:host=$server->Ip;dbname=", $user, $pass);
	} else if ($server->Type == Server::MYSQL) {
		$connection = new PDO("mysql:host=$server->Ip;dbname=", $database->Username, $database->Password);
	}else{
		$connection = new PDO("sqlite:my/database/path/database.db");
	}
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);

	//-----------------------------------------------------------------------

	$query = $connection->prepare('
		SELECT
		ats.user.id,
		ats.user.user_name,
		ats.user.user_status,
		ats.user.user_privilege,
		ats.user.user_datetime_created,
		ats.user.user_datetime_renewed,
		ats.user.user_email,
		ats.user.user_access_length

		FROM ats.user
		');

	$query->execute();

	while($row = $query->fetch(PDO::FETCH_BOTH)) {
		$user = new User();
		$user->Id = $row['id']; 
		$user->Name = $row['user_name']; 
		$user->Status =	$row['user_status'];
		$user->Privilege = $row['user_privilege'];
		$user->DateTimeCreated = $row['user_datetime_created'];
		$user->DateTimeRenewed = $row['user_datetime_renewed'];
		$user->Email = $row['user_email']; 
		$user->AccessLength = $row['user_access_length']; 
		
		array_push($array['user'], $user);
	}

	//-------------------------------------------------------------------
	$result = new Result(Result::SUCCESS,"Success!");
	array_push($array['result'], $result);
} catch(PDOException $pdoException) {
	$result = new Result(Result::FAILED, $pdoException->getMessage());
	array_push($array['result'], $result);
} catch(Exception $exception) {
	$result = new Result(Result::FAILED, $exception->getMessage());
	array_push($array['result'], $result);
}
$connection = null;
echo json_encode($array);
?>
