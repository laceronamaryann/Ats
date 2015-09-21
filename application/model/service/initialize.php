<?php
$root = $_SERVER['DOCUMENT_ROOT'] . 'Ats';

include($root . '/application/model/class/server.php');
include($root . '/application/model/class/database.php');
include($root . '/application/model/class/businessField.php');
include($root . '/application/model/class/user.php');
include($root . '/application/model/class/company.php');
include($root . '/application/model/class/status.php');
include($root . '/application/model/class/result.php');

include($root . '/application/model/class/clientresponse.php');
include($root . '/application/model/class/companyaddress.php');
include($root . '/application/model/class/contact.php');
include($root . '/application/model/class/contacttype.php');
include($root . '/application/model/class/privilege.php');
include($root . '/application/model/class/productdescription.php');

use Core\Server;
use Core\Database;

$server = new Server("184.107.179.178","rhalfs server",Server::MYSQL);
$database = new Database("ats","atstest", "ats");

session_start();

$_SESSION['server'] = $server;
$_SESSION['database'] = $database;
?>