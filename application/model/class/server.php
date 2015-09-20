<?php 
namespace Core;
class Server {
	public $Ip;
	public $Name;
	public $Type;

	const MYSQL = 0;
	const MSSQL = 1;
	const HTTP = 2;
	const FTP = 3;

	function __construct($Ip, $Name, $Type) {
		$this->Ip = $Ip;
		$this->Name = $Name;
		$this->Type = $Type;
	}
}
?>