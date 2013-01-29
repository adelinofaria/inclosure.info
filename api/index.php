<?php

if($_SERVER["REDIRECT_STATUS"] == '404')
	die();

session_start();

require_once('./config/config.php');
require_once('./library/degradation.php');
require_once('./library/bootstrap.php');