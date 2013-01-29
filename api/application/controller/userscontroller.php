<?php
class UsersController extends Controller
{
	protected $user;
	var $doNotRenderHeader = true;
	
	function __construct($controller)
	{
		$this->user = new User();
		parent::__construct($controller);
	}
	
	function get()
	{
		if (User::authenticate()) {
			$args = func_get_args();
			$queryString = $args[0];
			$id = isset($args[1]) ? $args[1] : null;
			$resource = isset($args[2]) ? $args[2] : null;
			
			if ($id) {
				if (Validator::validateNumber($id)) {
					if (Validator::validateNumber($id)) {
						$response = $this->user->where('id', $id);
					} else {
						trigger_error('Invalid parameter \''.$id.'\'', E_USER_ERROR);
						http_response_code(400);
						die();
					}
					$response = $this->user->search();
					echo json_encode($response);
				} else {
					trigger_error('Invalid parameter \''.$id.'\'', E_FRAMEWORK);
					http_response_code(400);
				}
			} else {
				http_response_code(403);
			}
		}
		die();
	}
	
	function post()
	{
		$args = func_get_args();
		$queryString = $args[0];
		$id = isset($args[1]) ? $args[1] : null;
		$resource = isset($args[2]) ? $args[2] : null;
		
		if ($id) {
			http_response_code(403);
		} else {
			$body = file_get_contents('php://input');
			$json = json_decode($body, true);
			
			if (!empty($json['email']) && !empty($json['password'])) {
				$this->user->email = $json['email'];
				$this->user->password = md5($json['password']);
				$this->user->save();
				http_response_code(201);
			} else {
				http_response_code(400);
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
					
					if (!empty($json['email']) && !empty($json['password'])) {
						$this->user->email = $json['email'];
						$this->user->password = md5($json['password']);
						$this->user->where('id', $id);
						$this->user->save();
						http_response_code(202);
					} else {
						http_response_code(400);
					}
				} else {
					trigger_error('Invalid parameter \''.$id.'\'', E_FRAMEWORK);
					http_response_code(400);
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
					$this->user->id = $id;
					$this->user->delete();
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