<?php
include ('initialize.php');


use Core\Server;
use Core\Database;
use Core\BusinessField;
use Core\Company;
use Core\Result;

$array['result'] = array();
$connection = null;

try {
	$user = new User();
	$user->Username = $_POST['Username'];
	$user->Password = sha1($_POST['Password']);
	$user->Hash = sha1($_POST['Hash']);
	$user->Email = ($_POST['Email']);
	$user->Privilege = ($_POST['Privilege']);
	$user->Status = ($_POST['Status']);
	$user->AccessLength = ($_POST['AccessLength']);

	$modifiedBy = $_POST['ModifiedBy'];


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
	UPDATE ats.user 
	SET 
	user_name='" . $user->Username . "',
	user_password='". $user->Password . "',
	user_hash=" . $user->Hash . ",
	user_email=".  $user->Email .",
	user_privilege=".  $user->Privilege .",
	user_status=".  $user->Status .",
	user_access_length=".  $user->AccessLength ."
	
	WHERE ats.user.id = " . $user->Id .";";

	$query = $connection->prepare($sql);
	

	if (!$query->execute()) {
		throw new Exception($user->Username ."User has not been updated!", 1);
	}

	//-------------------------------------------------------------------
	$result = new Result(Result::SUCCESS, $user->Username ." has been updated!");
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
