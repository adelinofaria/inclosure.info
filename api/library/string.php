<?php

class String
{
	public static function isNullorEmpty($string)
	{
		return (!isset($string) || trim($string)==='');
	}
	
	public static function startsWith($haystack, $needle)
	{
	    return !strncmp($haystack, $needle, strlen($needle));
	}
	
	public static function endsWith($haystack, $needle)
	{
	    $length = strlen($needle);
	    if ($length == 0) {
	        return true;
	    }
	
	    return (substr($haystack, -$length) === $needle);
	}
}