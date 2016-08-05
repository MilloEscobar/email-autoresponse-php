<?php
require_once 'db_connection.php';
/**
* cars class
*/
class CarsFetch extends Database{
	/**
	* Get all cars
	* @return {array} cars
	*/
	function all(){
		// get all cars 
		$query = $this->connection->prepare('SELECT * FROM cars');
		// execute the query
		if($query->execute()){
			// return the query result
			return $query->fetchAll();
		}
		return false;
	}

	/**
	* Get all cars
	* @return {array} cars
	*/
	function carsNames(){
		// get all cars 
		$query = $this->connection->prepare('SELECT Name , ID FROM cars');
		// execute the query
		if($query->execute()){
			// return the query result
			return $query->fetchAll();
		}
		return false;
	}

	/**
	* Get an item
	*@param {int} id
	*/
	function get($id){
		// get the item
		$query = $this->connection->prepare('SELECT * FROM cars WHERE ID = :id');
		// bind data
		$bind = array(
			':id' => $id
		);
		// execute the query
		if($query->execute($bind)){
			// return the query result
			return $query->fetch();
		}
	}
	/**
	* Create an item
	* @param {string} name
	*/
	function create($name, $price, $cuantity){
		
		// create the query
		$query = $this->connection->prepare('INSERT INTO cars (name, price, cuantity) VALUES (:name, :price, :cuantity)');
		
		// date time
		$now = $this->now();
		// bind data to be inserted
		$bind = array(
			':name' => 		$name,
			':price' => 	$price,
			':cuantity' => 	$cuantity
		);
		// execute the sql query
		return $query->execute($bind);
	}
	/**
	* Update an item
	* @param {int} id
	* @param {string} name
	*/
	function update($id, $name , $price, $cuantity){
		// update an item
		$query = $this->connection->prepare('UPDATE cars SET name = :name, price = :price, cuantity = :cuantity WHERE id = :id');
		// updated date time
		$updated = $this->now();
		// bind data
		$bind = array(
			':id' => 		$id, 
			':name' => 		$name,
			':price' => 	$price,
			':updated' => 	$cuantity
		);
		if($query->execute($bind)){
			return true;
		}
		return false;
	}
	/**
	* Delete an item
	* @param {int} id
	*/
	function delete($id){
		// delete the item
		$query = $this->connection->prepare('DELETE FROM cars WHERE id = :id');
		$bind = array(':id' => $id);
		if($query->execute($bind)){
			return true;
		}
		return false;
	}
	/**
	* Get the now date time
	* @return {string} date time
	*/
	private function now(){
		
		// create the date time
		$now = new DateTime('now');
		$now = $now->format('Y-m-d H:i:s');
		return $now;
	}
}
?>