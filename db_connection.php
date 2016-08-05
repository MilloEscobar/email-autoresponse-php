<?php

/**
* Connect to the database
*/
class Database{
	// private variables
	private $username = 	'DATA BASE USER';
	private $password = 	'DATA BASE PASSWORD';
	private $host = 		'HOST';
	private $database = 	'DATA BASE NAME';
	protected $connection =  NULL;
	/**
	* Connect to the database
	*/
	function __construct(){
		try{
			// create the connection
			$this->connection = new PDO("mysql:host=".$this->host.";dbname=".$this->database, $this->username, $this->password);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// echo '<hr>Connected: <br>Host: '.$this->host.'<br>Database: '.$this->database.'<hr>';
		}catch(PDOException $error){
			echo '<hr>Connection Failed: '.$error->getMessage().'<hr>';
			die();
		}
	}
	function __destruct(){
		$this->connection = NULL;
	}
}
?>