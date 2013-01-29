<?php

class Cache
{
	public static function get($fileName)
	{
		if (!is_dir(FOLDER_CACHE)) {
		    mkdir(FOLDER_CACHE, 0744, true);
		}
		
		$fileName = FOLDER_CACHE.DS.$fileName;
		if (file_exists($fileName)) {
			$handle = fopen($fileName, 'rb');
			$variable = fread($handle, filesize($fileName));
			fclose($handle);
			return unserialize($variable);
		} else {
			return null;
		}
	}
	
	public static function set($fileName,$variable)
	{
		if (!is_dir(FOLDER_CACHE)) {
		    mkdir(FOLDER_CACHE, 0744, true);
		}
		
		$fileName = FOLDER_CACHE.DS.$fileName;
		$handle = fopen($fileName, 'a');
		fwrite($handle, serialize($variable));
		fclose($handle);
	}
}