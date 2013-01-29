<?php

/** Enviroment Mode: localhost, development, production **/
define('ENVIROMENT_MODE', 'localhost');

if (ENVIROMENT_MODE == 'localhost') {
	require_once('config.localhost.php');
} elseif (ENVIROMENT_MODE == 'development') {
	require_once('config.development.php');
} elseif (ENVIROMENT_MODE == 'production') {
	require_once('config.production.php');
}