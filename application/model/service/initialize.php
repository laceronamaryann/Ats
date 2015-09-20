<?php
$root = $_SERVER['DOCUMENT_ROOT'] . 'Ats';

include($root . '/application/model/class/server.php');
include($root . '/application/model/class/database.php');
include($root . '/application/model/class/businessField.php');
include($root . '/application/model/class/user.php');
include($root . '/application/model/class/company.php');
include($root . '/application/model/class/status.php');
include($root . '/application/model/class/result.php');

use Core\Server;
use Core\Database;

$server = new Server("184.107.179.178","rhalfs server",Server::MYSQL);
$database = new Database("ats","atstest", "");

session_start();

$_SESSION['server'] = $server;
$_SESSION['database'] = $database;
?>