<?php

/**
 * Class Controller
 * @description base class for the controllers
 */
class Controller{

	protected $method;
	protected $request;
	protected $paths;

	function __construct($paths, $method, $request){

		$this->paths = $paths;
		$this->method = $method;
		$this->request = $request;

		//$this->urldecode();
	}

	// private function urldecode(){

	// 	if(isset($this->paths[3])){

	// 		$matches = array();

	// 		// url
	// 		$url = $this->paths[3];

	// 		preg_match('/\?.*$/', $url, $matches);

	// 		if(sizeof($matches)){

	// 			// remove the "?"
	// 			$url = substr($matches[0], 1);

	// 			//echo 'URL '; echo $url;

	// 			if(!empty($url)){

	// 				$url = urldecode($url);

	// 				// get all query params
	// 				foreach (explode('&', $url) as $chunk) {
	// 					$param = explode("=", $chunk);

	// 					if ($param) {

	// 						// save the url param on the request
	// 						$this->request[$param[0]] = $param[1];
	// 					}
	// 				}
	// 			}
	// 		}

	// 		//echo print_r($this->request);
	// 	}

	// }

	/**
	 * @name response
	 * @description make a json response
	 * @param array $data
	 * @param string $message
	 * @param bool|false $error
	 */
	protected function response($data, $message, $error = false){
		// json response
		$response = array(
			'data' => $data,
			'message' => $message,
			'error' => $error,
		);

		// print the json response
		echo json_encode($response);

		// return result
		return $response['error'];
	}
}
