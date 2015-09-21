<?php
include ('initialize.php');

use Core\Server;
use Core\Database;
use Core\BusinessField;
use Core\Company;
use Core\Result;
use Core\User;


$array['result'] = array();
$array['company'] = array();

$connection = null;

try {
	$company = new Company();
	
	if (!isset($_POST['Name']))
		throw new Exception("Name is not set.", 1);
	if (!isset($_POST['Description']))
		throw new Exception("Description is not set.", 1);
	if (!isset($_POST['BusinessField']))
		throw new Exception("BusinessField is not set.", 1);

	$company->Name = $_POST['Name'];
	$company->Description = $_POST['Description'];
	$company->AddedBy = $_SESSION['user']->Id;
	$company->BusinessField = $_POST['BusinessField'];
	$company->Status = 3;


	if ($server->Type == Server::MSSQL) {
		$connection = new PDO("mssql:host=$server->Ip;dbname=", $user, $pass);
		$connection = new PDO("sybase:host=$server->Ip;dbname=", $user, $pass);
	} else if ($server->Type == Server::MYSQL) {
		$connection = new PDO("mysql:host=$server->Ip;dbname=", $database->Username, $database->Password);
	}else{
		$connection = new PDO("sqlite:my/database/path/database.db");
	}
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//-------------------------------------------------------------------

	$sql = "
		CALL ats.company_insert('" . 
		$company->Name . "','". 
		$company->Description . "'," . 
		$company->Status .",". 
		$company->BusinessField .",". 
		$company->AddedBy .");";

	$query = $connection->prepare($sql);

	if (!$query->execute()) {
		throw new Exception($company->Name . " not added!", 1);
	}
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
