<?php

/** File System **/
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', '/home/inclosur/public_html/inclosure.info/production/api');

/** Folder Locations **/
define('FOLDER_APPLICATION', ROOT . DS . 'application');
define('FOLDER_CONTROLLER', FOLDER_APPLICATION . DS . 'controller');
define('FOLDER_LANGUAGE', FOLDER_APPLICATION . DS . 'language');
define('FOLDER_MODEL', FOLDER_APPLICATION . DS . 'model');
define('FOLDER_VIEW', FOLDER_APPLICATION . DS . 'view');
define('FOLDER_LIBRARY', ROOT . DS . 'library');
define('FOLDER_TEMP', ROOT . DS . 'temp');
define('FOLDER_CACHE', FOLDER_TEMP . DS . 'cache');

/** Configuration Variables **/
define('_COOKIE_KEY_', 'cookieKey');
define('COOKIE_KEY', 'cookieKey');
define('CONTENT_URL', 'contentURL');
define('COOKIE_IV', 'cookieiv');

/** SSL Configuration **/
define('SSL_ENABLED', true);
define('SSL_ONLY', true);

/** DATABASE COONECTIONS VARIABLES **/
define('DB_NAME', 'inclosur_production');
define('DB_USER', 'inclosur_root');
define('DB_PASSWORD', 'Zuv6n4s3achA');
define('DB_HOST', 'localhost');

/** PATHS **/
define('SCHEMA', 'http://');
define('DOMAIN', 'api.inclosure.info');
define('RELATIVE_PATH', '/');
define('DEFAULT_CONTROLLER', 'default');

/** Log Configuration **/
define('LOG', true);
define('DEBUG', false);

/** WEBSITE CONFIGURATIONS **/
define('ANALYTICS_CODE', 'xxxxxxxxxxx');

/** PAGING CONFIGURATIONS **/
define('PAGINATE_LIMIT', '5');
define('LANG', 'en');

/** Irregular Words For Inflection

$irregularWords = array(
	'singular' => 'plural' 
);
 
**/
$irregularWords = array(

);