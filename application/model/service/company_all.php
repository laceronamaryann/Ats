<?php
include ('initialize.php');

use Core\Server;
use Core\Database;
use Core\Company;
use Core\Result;

/*Objects included on Json*/
$array['result'] = array();
$array['company'] = array();
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
		ats.company.id,
		ats.company.company_name,
		ats.company.company_description,
		ats.company.company_datetime_created,
		ats.company.company_business_field,
		ats.company.company_status,
		ats.company.company_added_by

		FROM ats.company
		');

	$query->execute();

	while($row = $query->fetch(PDO::FETCH_BOTH)) {
		$company = new Company();
		$company->Id = $row['id']; 
		$company->Name = $row['company_name']; 
		$company->Description =	$row['company_description'];
		$company->DateTimeCreated = $row['company_datetime_created'];
		$company->BusinessField = $row['company_business_field'];
		$company->Status = $row['company_status'];
		$company->AddedBy = $row['company_added_by']; 
		
		array_push($array['company'], $company);
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
