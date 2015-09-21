<?php
include ('initialize.php');

use Core\Server;
use Core\Database;
use Core\BusinessField;
use Core\Company;
use Core\Result;

$array['result'] = array();
$array['company'] = array();

$connection = null;

try {
	$company = new Company();
	
	if (!isset($_POST['Name']))
		throw new Exception("Name is not set.", 1);
	if (!isset($_POST['Description']))
		throw new Exception("Description is not set.", 1);
	if (!isset($_POST['AddedBy']))
		throw new Exception("AddedBy is not set.", 1);
	if (!isset($_POST['BusinessField']))
		throw new Exception("BusinessField is not set.", 1);

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
	/*Query 1*/
	$sql = "
	INSERT INTO ats.company_adress (
		ats.company_adress.company_adress_name, 
		ats.company_adress.company_adress_latitude, 
		ats.company_adress.company_adress_longitude, 
		ats.company_adress.company_adress_company,
		ats.company_adress.company_adress_detail)

VALUES ('" . 
	$company->Name . "','". 
	$company->Description . "','" . 
	$company->AddedBy ."','". 
	$company->BusinessField ."');";

$query = $connection->prepare($sql);

	 	// throw new Exception($sql);

if (!$query->execute()) {
	throw new Exception($company->Name . " not added!", 1);
}


// /*Query 2*/
// $query = $connection->prepare('
// 	SELECT
// 	ats.company.id,
// 	ats.company.company_name,
// 	ats.company.company_description,
// 	ats.company.company_datetime_created,
// 	ats.company.company_business_field,
// 	ats.company.company_status,
// 	ats.company.company_added_by

// 	FROM ats.company

// 	WHERE
// 	ats.company.id = '. $connection->lastInsertId() .'
// 	');

// $query->execute();

// $row = $query->fetch(PDO::FETCH_BOTH);
// $company = new Company();
// $company->Id = $row['id']; 
// $company->Name = $row['company_name']; 
// $company->Description =	$row['company_description'];
// $company->DateTimeCreated = $row['company_datetime_created'];
// $company->BusinessField = $row['company_business_field'];
// $company->Status = $row['company_status'];
// $company->AddedBy = $row['company_added_by']; 

// array_push($array['company'], $company);
//-------------------------------------------------------------------
$result = new Result(Result::SUCCESS,"Added new Company!");
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
