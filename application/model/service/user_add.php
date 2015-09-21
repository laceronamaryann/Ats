<?php
include ('initialize.php');

use Core\Server;
use Core\Database;
use Core\Company;
use Core\Result;
use Core\User;

$array['result'] = array();
$array['user'] = array();

$connection = null;

try {
	$user = new User();
	
	if (!isset($_POST['Username']))
		throw new Exception("Username is not set.", 1);
	if (!isset($_POST['Password']))
		throw new Exception("Password is not set.", 1);
	if (!isset($_POST['Hash']))
		throw new Exception("Hash is not set.", 1);
	if (!isset($_POST['Email']))
		throw new Exception("Email is not set.", 1);
	if (!isset($_POST['Privilege']))
		throw new Exception("Privilege is not set.", 1);
	if (!isset($_POST['Status']))
		throw new Exception("Status is not set.", 1);
	if (!isset($_POST['AccessLength']))
		throw new Exception("Access Length is not set.", 1);



	$user->Username = $_POST['Userame'];
	$user->Password = sha1($_POST['Password']);
	$user->Hash = sha1($_POST['Hash']);
	$user->Email = ($_POST['Email']);
	$user->Privilege = ($_POST['Privilege']);
	$user->Status = ($_POST['Status']);
	$user->AccessLength = ($_POST['AccessLength']);




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
	INSERT INTO ats.user (
    ats.user.user_name,
    ats.user.user_password,
    ats.user.user_datetime_created,
    ats.user.user_datetime_renewed,
    ats.user.user_hash,
    ats.user.user_email,
    ats.user.user_privilege,
    ats.user.user_status,
    ats.user.user_access_length
    
    )

VALUES (
	'". $user->Username . "',
	'". $user->Password . "',
	NOW(),
	'". $user->DateTimeRenewed . "',
	'". $user->Hash . "',
	'". $user->Email . "',
	'". $user->Privilege . "',
	'". $user->Status . "',
	'". $user->AccessLength . "'
	);";

$query = $connection->prepare($sql);

	 	// throw new Exception($sql);

if (!$query->execute()) {
	throw new Exception($user->Username . " not added!", 1);
}


/*Query 2*/
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

	WHERE
	ats.user.id = '. $connection->lastInsertId() .'
	');

$query->execute();

$row = $query->fetch(PDO::FETCH_BOTH);
$user = new User();
$user->Id = $row['id']; 
$user->Username = $row['user_name']; 
$user->Status =	$row['user_status'];
$user->Privilege = $row['user_privilege'];
$user->DateTimeCreated = $row['user_datetime_created'];
$user->DateTimeRenewed = $row['user_datetime_renewed'];
$user->Email = $row['user_email']; 
$user->AccessLength = $row['user_access_length']; 


array_push($array['user'], $user
	);
//-------------------------------------------------------------------
$result = new Result(Result::SUCCESS,"Added new User!");
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
