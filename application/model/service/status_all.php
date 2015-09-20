<?php
include ('initialize.php');

use Core\Server;
use Core\Database;
use Core\Status;
use Core\Result;

$array['status'] = array();
$array['result'] = array();

$connection = null;
try {
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
		ats.status.id,
		ats.status.status_name,
		ats.status.status_description

		FROM ats.status	
		');

	$query->execute();

	while ($row = $query->fetch(PDO::FETCH_BOTH)) {
		$status = new Status();
		$status->Id = $row["id"];
		$status->Name = $row["status_name"];
		$status->Description = $row["status_description"];
		array_push($array['status'], $status);
	}

	//-------------------------------------------------------------------
	$result = new Result(Result::SUCCESS,"Success!");
	array_push($array['result'],$result);
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
