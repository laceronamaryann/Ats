<?php
include ('initialize.php');


use Core\Server;
use Core\Database;
use Core\BusinessField;
use Core\Company;
use Core\Result;

$array = array();
$connection = null;

try {
	$company = new Company();
	$company->Name = $_POST['Name'];
	$company->Description = $_POST['Description'];
	$company->AddedBy = $_POST['AddedBy'];
	$company->BusinessField = $_POST['BusinessField'];



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

	$sql = "
	INSERT INTO ats.company (company_name, company_description, company_added_by, company_datetime_created,company_status, company_business_field)
	VALUES ('" . $company->Name . "','".$company->Description."'," . $company->AddedBy .",NOW(), 3 ,". $company->BusinessField .");";

	$query = $connection->prepare($sql);
	

	if ($query->execute()) {
		$result = new Result(Result::SUCCESS,"Added new Company!");
		array_push($array, $result);
	} else {
		$result = new Result(Result::FAILED,"Not saved!");
		array_push($array, $result);
	}

} catch(PDOException $pdoException) {
	$result = new Result(Result::FAILED, $pdoException->getMessage());
	array_push($array, $result);
} catch(Exception $exception) {
	$result = new Result(Result::FAILED, $exception->getMessage());
	array_push($array, $result);
}

echo json_encode($array);
$connection = null;
?>
