<?php

// dependencies
require_once('ControllerClass.php');
require_once('carsFetch.php');

/**
 * Class ItemsController
 */
class ItemsController extends Controller{

	function __construct($paths, $method, $request){

		// call the parent contruct
		parent::__construct($paths, $method, $request);

		switch($this->method){
			case 'GET':
				// id is defined
				if(isset($this->request['id'])){
					$this->get($this->request['id']);
				}else{
					if(isset($this->request['names'])){
						$this->carsNames();
					}else{
						$this->all();
					}
				}
				break;

			case 'POST':
				if(isset($request['name'])){
					$this->create($request['name']);
				}
				break;

			case 'PUT':
				if(isset($request['id']) && isset($request['name'])){
					$this->update($request['id'], $request['name']);
				}
				break;

			case 'DELETE':
				break;

			default:
				return false;
		}
	}

	/**
	 * @name get
	 * @description get an item
	 * @param {int} $id
	 */
	private function get($id){
		// items class instance
		$items = new carsFetch();

		// get the item
		if($itemData = $items->get($id)){
			return $this->response($itemData, '');
		}

		return $this->response('', "Could not get the item $id", true);
	}

	/**
	 * @name all
	 * @description get all items
	 * @return mixed
	 */
	private function all(){

		$items = new carsFetch();

		if($itemsData = $items->all()){
			return $this->response($itemsData, '');
		}

		return $this->response('', "Could not get the items", true);

	}

		/**
	 * @name all
	 * @description get all items
	 * @return mixed
	 */
	private function carsNames(){

		$items = new carsFetch();

		if($itemsData = $items->carsNames()){
			return $this->response($itemsData, '');
		}

		return $this->response('', "Could not get the items", true);

	}

	/**
	 * @name create
	 * @description create a new item
	 * @param string $name
	 * @return mixed
	 */
	private function create($name){

		$item = new carsFetch();

		if($data = $item->create($name)){
			return $this->response($data, 'New item has been created', false);
		}

		return $this->response('', 'Could not create a new item', true);
	}

	/**
	 * @name update
	 * @description update an item
	 * @param int $id
	 * @param string $name
	 * @return mixed
	 */
	private function update($id, $name){

		$item = new carsFetch();

		if($item->update($id, $name)){
			return $this->response('', 'Item has been updated', false);
		}

		return $this->response('', "Could not update the item $id", true);
	}

}


