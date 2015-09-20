<?php
namespace Data {
	class Mysql {
		public $Connection;
		public $Server;
		public $Database;

		function __construct($server, $database) {
			$this->Server = $Server;
			$this->Database = $Database;
		}

		public function Open() {
			$this->Connection = mysqli_connect($this->Server->Ip,$this->Database->Username,$this->Database->Password,$this->Database->Name);
			if (mysqli_connect_errno()) {
				throw new Exception("Failed to connect to MySQL:"  . mysqli_connect_error(), 1);
			}
		}	
	}
}

?>