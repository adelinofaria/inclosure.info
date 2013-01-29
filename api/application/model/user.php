<?php
class User extends Model
{
	protected static $authenticatedUser;
	
	public static function authenticatedUser()
	{
		return self::$authenticatedUser;
	}
	
	public static function authenticate()
	{
		if (!isset($_SERVER['PHP_AUTH_USER'])) {
		    header('WWW-Authenticate: Basic realm="api.inclosure.info"');
		    http_response_code(401);
		    return false;
		} else {
			$user = new User();
			$user->where('email', mysql_real_escape_string($_SERVER['PHP_AUTH_USER']));
			$user->where('password', md5(mysql_real_escape_string($_SERVER['PHP_AUTH_PW'])));
			$result = $user->search();
			
			if (sizeof($result) > 0) {
				self::$authenticatedUser = $result[0]['User'];
				return true;
			} else {
			    header('WWW-Authenticate: Basic realm="api.inclosure.info"');
			    http_response_code(401);
			    return false;
			}
		}
	}
}