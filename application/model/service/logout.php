<?php
include ('initialize.php');

use Core\Result;

$array['result'] = array();

try {
	session_destroy();

	$result = new Result(Result::SUCCESS,"Success!");
	array_push($array['result'],$result);
} catch(Exception $exception) {
	$result = new Result(Result::FAILED, $exception->getMessage());
	array_push($array['result'], $result);
}

echo json_encode($array);
?>