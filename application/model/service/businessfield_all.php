<?php
include ('initialize.php');

use Core\Server;
use Core\Database;
use Core\BusinessField;
use Core\Result;

$array['result'] = array();
$array['businessfield'] = array();
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
		ats.business_field.id,
		ats.business_field.business_field_name,
		ats.business_field.business_field_description

		FROM ats.business_field	
		');

	$query->execute();

	

	while ($row = $query->fetch(PDO::FETCH_BOTH)) {
		$businessField = new BusinessField();
		$businessField->Id = $row["id"];
		$businessField->Name = $row["business_field_name"];
		$businessField->Description = $row["business_field_description"];
		array_push($array['businessfield'], $businessField);
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
