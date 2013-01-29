<?php

class Debug
{
	static private $_ERROR= array();
	
	static function init()
	{
		register_shutdown_function('Debug::show');
	}
	
	static function show()
	{
		echo '<div onclick="javascript:getElementById(\'error_log_div\').style.display = \'none\';" id="error_log_div" style="overflow:auto;max-width:90% !important;z-index:99999999;max-height:90%;position:fixed;top:10px;left:10px;font-family:\'Arial\' ;cursor:pointer;background-color:#FFF;color:#000;font-size:12px;border:solid 1px #F00;padding:5px 20px 5px 5px;line-height:10px">';
		$max = count(self::$_ERROR);
		
		if ($max == 0) {
			echo '<strong style="padding-left:15px">The ship is safe.</strong> Yarr.<script type="text/javascript">window.setTimeout(function(){ document.getElementById(\'error_log_div\').style.display = \'none\'; }, 3000);</script>';
		} else {
			for ($i = $max - 1; $i >= 0; $i--) {
				echo array_shift(self::$_ERROR);
			}
		}
		echo '</div>';
	}

	static function printError($errno, $error)
	{
		switch ($errno) {
			case -3: //STMP Phpmailer
				 self::$_ERROR[count( self::$_ERROR)]='<pre style="margin:0;padding:0;color:#000;"><span style="color:#677">'.$error.'<span></pre>';
				break;
			case -2: //Mysql
				 self::$_ERROR[count( self::$_ERROR)]='<pre style="margin:0;padding:0;color:#000;"><span style="color:#837">'.$error.'<span></pre>';
				break;
			case -1:
				ob_start();
				var_dump($errstr);
				$result = ob_get_clean();
				 self::$_ERROR[count( self::$_ERROR)]='<pre style="margin:0;padding:0;color:#000;"><span style="color:#00F">'.$error.'<span></pre>';
				break;
			case 0: //Framework
				 self::$_ERROR[count( self::$_ERROR)]='<pre style="margin:0;padding:0;color:#000;"><span style="color:#68351F">'.$error.'<span></pre>';
				break;
			case E_ERROR:
			case E_CORE_ERROR:
			case E_COMPILE_ERROR:
			case E_USER_ERROR:
				 self::$_ERROR[count( self::$_ERROR)]='<span style="color:#F00">'.$error.'<span><br/>';
				exit(1);
				break;
			case 2: //E_USER_WARNING:
				 self::$_ERROR[count( self::$_ERROR)]='<span style="color:#F00">'.$error.'<span><br/>';
				break;
			case 8: //E_USER_NOTICE:
				 self::$_ERROR[count( self::$_ERROR)]='<span style="color:#F83">'.$error.'<span><br/>';
				break;
			default:
				 self::$_ERROR[count( self::$_ERROR)]='<span style="color:#F0F">'.$error.'<span><br/>';
				break;
		}
	}
}