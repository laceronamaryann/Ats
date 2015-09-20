<?php 
namespace Core;
class Database {
	public $Username;
	public $Password;
	public $Name;
	public $Port;

	/*
	MySQL
	Standard
	Server=myServerAddress;Database=myDataBase;Uid=myUsername;Pwd=myPassword;

	Specifying TCP port
	Server=myServerAddress;Port=1234;Database=myDataBase;Uid=myUsername;Pwd=myPassword;
	The port 3306 is the default MySql port.The value is ignored if Unix socket is used.	
	*/
	public function getConnectionString() {
		$connectionString = "Server=$this->Ip;Database=$this->Database;Uid=$this->Username;Pwd=$this->Password;";
		return $connectionString;
	}

	function __construct($Username, $Password, $Name) {
		$this->Username = $Username;
		$this->Name = $Name;
		$this->Password = $Password;
	}
}
?>