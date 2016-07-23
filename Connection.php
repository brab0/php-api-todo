<?php

class Connection
{ 
	private $connection;

	function __construct() {
		$server = '127.0.0.1';
		$user = 'root';
		$pass = '';
		$database = 'todo';

		$this->connection = new mysqli($server, $user, $pass, $database);
	}

	function get(){		
		return $this->connection;
	}
}