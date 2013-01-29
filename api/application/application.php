<?php

class Application
{
	public static function init()
	{
		$url = new Url();
		$controllerName = ucfirst($url->controller).'Controller';
		$dispatch = new $controllerName($url->controller);
		
		if ((int)method_exists($controllerName, $url->httpMethod)) {
			call_user_func_array(array($dispatch, "beforeAction"), $url->queryString);
			
			if (!$url->id) {
				call_user_func_array(array($dispatch, $url->httpMethod), array($url->queryString));
			} else {
				if (!$url->resource) {
					call_user_func_array(array($dispatch, $url->httpMethod), array($url->queryString, $url->id));
				} else {
					call_user_func_array(array($dispatch, $url->httpMethod), array($url->queryString, $url->id, $url->resource));
					
				}
			}
			
			call_user_func_array(array($dispatch, $url->httpMethod), array('id' => $url->id, 'resource' => $url->resource, 'queryString' => $url->queryString));
			
			call_user_func_array(array($dispatch, "afterAction"), $url->queryString);
		} else {
			trigger_error('Invalid Http Method \''.$url->httpMethod.'\'', E_FRAMEWORK);
			
			if (!DEVELOPMENT_ENVIRONMENT) {
				http_response_code(404);
			}
		}
		
		/* uri/controler/action/arg1/arg2/
		$dispatch = new $controllerName($url['controller'],$url['action']);
		if ((int)method_exists($controllerName, $url['action'])) {
			call_user_func_array(array($dispatch,"beforeAction"),$url['queryString']);
			call_user_func_array(array($dispatch,$url['action']),$url['queryString']);
			$dispatch->render();
			call_user_func_array(array($dispatch,"afterAction"),$url['queryString']);
			if (LOG_ENABLED) {
				Log::show();
			}
		} else {
			if (!DEVELOPMENT_ENVIRONMENT) {
				echo '<meta HTTP-EQUIV="REFRESH" content="0; url='.SCHEMA.DOMAIN.RELATIVE_PATH.$url['controller'].'">';
			} else {
				echo 'method not found: '.$url['controller'].'.'.$url['action'].'();';
			}
		}
		*/
	}
}
