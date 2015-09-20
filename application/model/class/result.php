<?php 
namespace Core;
class Result {
	public $Status;
	public $Message;

	const SUCCESS = 'SUCCESS';
	const FAILED = 'FAILED';

	function __construct($Status, $Message) {
		$this->Status = $Status;
		$this->Message = $Message;
	}
}
?>