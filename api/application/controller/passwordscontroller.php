<?php
class PasswordsController extends Controller
{
	protected $password;
	var $doNotRenderHeader = true;
	
	function __construct($controller)
	{
		$this->password = new Password();
		parent::__construct($controller);
	}
	
	function get()
	{
		if (User::authenticate()) {
			$args = func_get_args();
			$queryString = $args[0];
			$id = isset($args[1]) ? $args[1] : null;
			$resource = isset($args[2]) ? $args[2] : null;
			
			$array = User::authenticatedUser();
			$this->password->where('userId', $array['id']);
			
			if ($id) {
				if (Validator::validateNumber($id)) {
					$this->password->id = $id;	
					$response = $this->password->search();
					if (count($response) > 0) {
						echo json_encode($response['Password']);
					} else {
						http_response_code(404);
					}
				} else {
					trigger_error('Invalid parameter \''.$id.'\'', E_USER_ERROR);
					http_response_code(400);
				}
			} else {
				$response = $this->password->search();
				echo json_encode($response);
			}
		}
		die();
	}
	
	function post()
	{
		if (User::authenticate()) {
			$args = func_get_args();
			$queryString = $args[0];
			$id = isset($args[1]) ? $args[1] : null;
			$resource = isset($args[2]) ? $args[2] : null;
			
			if ($id) {
				http_response_code(403);
			} else {
				$body = file_get_contents('php://input');
				$json = json_decode($body, true);
				
				if (!empty($json['name']) && !empty($json['username']) && !empty($json['password'])) {
					$this->password->name = $json['name'];
					$this->password->username = $json['username'];
					$this->password->password = $json['password'];
					$this->password->save();
					http_response_code(201);
				} else {
					trigger_error('Minimum parameters missing name=\''.$name.'\' username=\''.$username.'\' password=\''.$password.'\'', E_FRAMEWORK);
					http_response_code(400);
				}
			}
		}
		die();
	}
	
	function put()
	{
		if (User::authenticate()) {
			$args = func_get_args();
			$queryString = $args[0];
			$id = isset($args[1]) ? $args[1] : null;
			$resource = isset($args[2]) ? $args[2] : null;
			
			if ($id) {
				if (Validator::validateNumber($id)) {
					$body = file_get_contents('php://input');
					$json = json_decode($body, true);
					
					if (!empty($json['name']) && !empty($json['username']) && !empty($json['password'])) {
						$this->password->name = $json['name'];
						$this->password->username = $json['username'];
						$this->password->password = $json['password'];
						$this->password->where('id', $id);
						$this->password->save();
						http_response_code(202);
					} else {
						http_response_code(400);
					}
				} else {
					trigger_error('Invalid parameter \''.$id.'\'', E_FRAMEWORK);
					http_response_code(400);
					die();
				}
			} else {
				http_response_code(403);
			}
		}
		die();
	}
	
	function delete()
	{
		if (User::authenticate()) {
			$args = func_get_args();
			$queryString = $args[0];
			$id = isset($args[1]) ? $args[1] : null;
			
			if ($id) {
				if (Validator::validateNumber($id)) {
					$this->password->id = $id;
					$this->password->delete();
					http_response_code(202);
				} else {
					trigger_error('Invalid parameter \''.$id.'\'', E_FRAMEWORK);
					http_response_code(400);
					die();
				}
			} else {
				http_response_code(403);
			}
		}
		die();
	}
}