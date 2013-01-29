<?php
					
if (LOG) {
	Log::init();
}

/** Autoload any classes that are required **/

function __autoload($className)
{
	if($className == '' || $className == null) {
		return;
	}

	$className = strtolower($className);
	
	if (file_exists(FOLDER_LIBRARY . DS . $className . '.php')) {
		require_once(FOLDER_LIBRARY . DS . $className . '.php');
	} elseif (file_exists(FOLDER_CONTROLLER . DS . $className . '.php')) {
		require_once(FOLDER_CONTROLLER . DS . $className . '.php');
	} elseif (file_exists(FOLDER_MODEL . DS . $className . '.php')) {	
		require_once(FOLDER_MODEL . DS . $className . '.php');
	} elseif (file_exists(FOLDER_APPLICATION . DS . $className . '.php')) {
		require_once(FOLDER_APPLICATION . DS . $className . '.php');
	} else {
		trigger_error('File Error \''.$className.'.php\' not found.', E_FRAMEWORK);
		
		if (!DEVELOPMENT_ENVIRONMENT) {
			http_response_code(404);
		}
	}
}

Application::init();