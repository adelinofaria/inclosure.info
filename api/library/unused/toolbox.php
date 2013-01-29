<?php

/** Check if environment is development and display errors **/

function setReporting() {
if (DEVELOPMENT_ENVIRONMENT == true) {
	error_reporting(E_ALL);
	ini_set('display_errors','On');
} else {
	error_reporting(0);
	ini_set('display_errors','Off');
	ini_set('log_errors', 'On');
	ini_set('error_log', ROOT.DS.'tmp'.DS.'logs'.DS.'error.log');
}
}

/** Check for Magic Quotes and remove them **/

function stripSlashesDeep($value) {
	$value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
	return $value;
}

function removeMagicQuotes() {
	if ( get_magic_quotes_gpc() ) {
		$_GET    = stripSlashesDeep($_GET   );
		$_POST   = stripSlashesDeep($_POST  );
		$_COOKIE = stripSlashesDeep($_COOKIE);
	}
}

/** Check register globals and remove them **/

function unregisterGlobals() {
    if (ini_get('register_globals')) {
        $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
        foreach ($array as $value) {
            foreach ($GLOBALS[$value] as $key => $var) {
                if ($var === $GLOBALS[$key]) {
                    unset($GLOBALS[$key]);
                }
            }
        }
    }
}

/** Secondary Call Function **/

function performAction($controller,$action,$queryString = null,$render = 0) {
	
	$controllerName = ucfirst($controller).'controller';
	$dispatch = new $controllerName($controller,$action);
	$dispatch->render = $render;
	return call_user_func_array(array($dispatch,$action),$queryString);
}

/** Main Call Function **/
function callHook() {
	
	$queryString = array();
	$url = routeURL();
	$controllerName = ucfirst($url['controller']).'Controller';

	$dispatch = new $controllerName($url['controller'],$url['action']);
	if ((int)method_exists($controllerName, $url['action'])) {
		call_user_func_array(array($dispatch,"beforeAction"),$url['queryString']);
		call_user_func_array(array($dispatch,$url['action']),$url['queryString']);
		$dispatch->render();
		call_user_func_array(array($dispatch,"afterAction"),$url['queryString']);
		if (DEVELOPMENT_ENVIRONMENT == true) {
			Log::show();
		}
	} else {
		/* Error Generation Code Here */
		echo '<meta HTTP-EQUIV="REFRESH" content="0; url='.BASE_PATH.$url['controller'].'">';
		//echo 'controller not found: '.$controller;
	}
	
}

/** GZip Output **/

function gzipOutput() {
    $ua = $_SERVER['HTTP_USER_AGENT'];

    if (0 !== strpos($ua, 'Mozilla/4.0 (compatible; MSIE ')
        || false !== strpos($ua, 'Opera')) {
        return false;
    }

    $version = (float)substr($ua, 30); 
    return (
        $version < 6
        || ($version == 6  && false === strpos($ua, 'SV1'))
    );
}

/** Get Required Files **/

//gzipOutput() || ob_start("ob_gzhandler");
/* Languages */
new Lang();
//function _($key,$opt=false,$opt2=false){
function __($key,$echo=true){
	$value = Lang::get($key);
	if ($value == NULL || $value == "" || $value == " ") $value = $key;
	if($echo) echo $value;
	else return $value;
}


/** Log System **/

new Log();
if (DEVELOPMENT_ENVIRONMENT == true) {
	set_error_handler("custom_error_handler", E_ALL);
}else{
	Log::off();
}
function custom_error_handler($errno, $errstr, $errfile, $errline){
    
	Log::log( $errstr,$errno, $errfile, $errline);
	return true;
}
	
$cache = new Cache();
$inflect = new Inflection();

setReporting();
removeMagicQuotes();
callHook();
//unregisterGlobals();

?>