<?php

class Toolbox
{
	/*
	**  smallerThan()
	**  Check if an input is smaler then value
	**
	**  @param   string
	**  @param   string
	**  @return  boolean
	*/
	function smallerThan($p_input, $value)
	{
		if (strlen($p_input) < $value) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	/*
	**  biggerThan()
	**  Check if an input is bigger then value
	**
	**  @param   string
	**  @param   string
	**  @return  boolean
	*/
	function biggerThan($p_input, $value)
	{
		if (strlen($p_input) > $value) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	/*
	**  removeKeyFromArray()
	**  Removes a key from array safely
	**
	**  @param   array
	**  @param   array
	**  @param   bool
	**  @return  array
	*/
	function removeKeyFromArray( $array, $keys, $reindex = false )
	{
		$keys = (array) $keys;
		foreach( $keys as $key )
			unset( $array[$key] );
		return ( $reindex ) ? $array = array_values( $array ) : $array;
	}
	
	/*
	**  removeKeyFromArray()
	**  Removes removes empty elements and reorders
	**
	**  @param   array
	**  @param   bool
	**  @return  array
	*/
	public static function removeArrayEmptyElements($array, $reorder = true)
	{
		foreach ($array as $key => $link)
		{
		    if ($array[$key] == '')
		    {
		        unset($array[$key]);
		    }
		}
		if ($reorder)
		{
			$array = array_values($array);
		}
	}
	
	/*
	**  removeKeyFromArray()
	**  Removes removes empty, false null elements and reorders
	**
	**  @param   array
	**  @param   bool
	**  @return  array
	*/
	public static function removeArrayEmptyElements($array, $reorder = true)
	{
		foreach ($array as $key => $link)
		{
		    if ($array[$key] == '')
		    {
		        unset($array[$key]);
		    }
		}
		if ($reorder)
		{
		array_filter(explode('/', $requestUri), 'strlen')
			$array = array_values($array);
		}
	}
	
	public static function sanitize($data)
	{
		return mysql_real_escape_string($data);
	}
}