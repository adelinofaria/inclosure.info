<?php

define('E_SMTP', -4);
define('E_MYSQL', -3);
define('E_FRAMEWORK', -2);
define('E_CUSTOM', -1);

class Log
{
	static function init()
	{
		if (DEBUG) {
			Debug::init();
		}
		set_error_handler('Log::error_log_handler');
	}
	
	static function error_log_handler($errno, $errstr, $errfile, $errline, $errcontext)
	{
		if ($errcontext != '') {
			$errcontext = ' | ' . $errcontext;
		}
		
		switch ($errno) {
			case E_FRAMEWORK:
				$error = 'FRAMEWORK: '.$errstr.' in '.$errfile.' on line '.$errline.$errcontext;
				break;
			case E_SMTP:
				$error = 'PHPMailer: '.$errstr.' in '.$errfile.' on line '.$errline.$errcontext;
				break;
			case E_MYSQL:
				$error = 'MYSQL: '.$errstr.' in '.$errfile.' on line '.$errline.$errcontext;
				break;
			case E_CUSTOM:
				ob_start();
				var_dump($errstr);
				$result = ob_get_clean();
				$error = 'CUSTOM: '.$result.' in '.$errfile.' on line '.$errline.$errcontext;
				break;
			case E_ERROR:
			case E_CORE_ERROR:
			case E_COMPILE_ERROR:
			case E_USER_ERROR:
				$error = 'FATAL: '.$errstr.' in '.$errfile.' on line '.$errline.$errcontext;
				break;
			case E_WARNING:
			case E_USER_WARNING:
				$error = 'WARNING: '.$errstr.' in '.$errfile.' on line '.$errline.$errcontext;
				break;
			case E_NOTICE:
			case E_USER_NOTICE:
				$error = 'NOTICE: '.$errstr.' in '.$errfile.' on line '.$errline.$errcontext;
				break;
			default:
				$error = 'UNKNOWN: '.$errstr.' in '.$errfile.' on line '.$errline.$errcontext;
				break;
		}
		
		//TODO SEND TO LOG FILE OR DB
		
		if (DEBUG) {
			Debug::printError($errno, $error);
		}
		
		switch ($errno) {
			case E_ERROR:
			case E_CORE_ERROR:
			case E_COMPILE_ERROR:
			case E_USER_ERROR:
				exit(1);
				break;
		}
	}
}