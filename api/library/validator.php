<?php

class Validator
{
	/*
	**  validateTextOnly()
	**  Checks that a string only contains letters and numbers, no special characters
	**  or funny stuff. Spaces ARE allowed - if you don't want these either use
	**  validateTextOnlyNoSpaces
	**
	**  @param   string
	**  @return  boolean
	*/
	public static function validateTextOnly($ps_str)
	{
		$result = ereg("^[A-Za-z0-9\?\!\,\.\;\)\:\(\) ]+$", $ps_str);
		if ($result) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	/*
	**  validateTextOnlyNoSpaces()
	**  Same as validateTextOnly but spaces are also not allowed
	**
	**  @param   string
	**  @return  boolean
	*/
	public static function validateTextOnlyNoSpaces($ps_str)
	{
		$result = ereg("^[A-Za-z0-9]+$", $ps_str );
		if ($result) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	/*
	**  validateNoSpaces()
	**  Allows anything except spaces
	**
	**  @param   string
	**  @return  boolean
	*/
	public static function validateNoSpaces($ps_str)
	{
		$result =  strpos($ps_str, ' ');
		if ($result == FALSE) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	/*
	**  validateEmail()
	**  Check if a text input is a valid email address
	**
	**  @param   string
	**  @return  boolean
	*/
	public static function validateEmail($ps_str)
	{
		$regexp="/^[a-z0-9]+([a-z0-9_\+\\.-]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i";
		if(!preg_match($regexp, $ps_str) ) {
			return false;
		} else {
			return true;
		}
	}
	
	/*
	**  validateIsTrue()
	**  Check is an item is equal to 1 or TRUE
	**
	**  @param   string
	**  @return  boolean
	*/
	public static function validateIsTrue($p_input)
	{
		if ($p_input == 1 || $p_input == '1') {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	/*
	**  validateNumber()
	**  Check if an input is a numeric value. This is just a wrapper function for
	**  is_numeric.
	**
	**  @param   string
	**  @return  boolean
	*/
	public static function validateNumber($p_input)
	{
		if (is_numeric($p_input)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	/*
	**  validateDate()
	**  Check if an input is a valid date. Note that prior to PHP v5.1, strtotime
	**  used to return -1 if the value was not a valid date string. Now it returns
	**  FALSE instead. This function will check for both.
	**
	**  @param   string
	**  @return  boolean
	*/
	public static function validateDate($p_input)
	{
		if (strtotime($p_input) === -1 || strtotime($p_input) === FALSE || $p_input == '') {
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	/*
	**  validateURL()
	**  Check if an input is a valid URL
	**
	**  @param   string
	**  @return  boolean
	*/
	public static function validateURL($url_val)
	{
		$url_pattern = "http\:\/\/[[:alnum:]\-\.]+(\.[[:alpha:]]{2,4})+";
		$url_pattern .= "(\/[\w\-]+)*"; # folders like /val_1/45/
		$url_pattern .= "((\/[\w\-\.]+\.[[:alnum:]]{2,4})?"; # filename like index.html
		$url_pattern .= "|"; # end with filename or ?
		$url_pattern .= "\/?)"; # trailing slash or not
		$error_count = 0;
		if (strpos($url_val, '?')) {
			$url_parts = explode('?', $url_val);
			if (!preg_match("/^" . $url_pattern . "$/", $url_parts[0])) {
				$error_count++;
			}
			if (!preg_match("/^(&?[\w\-]+=\w*)+$/", $url_parts[1])) {
				$error_count++;
			}
		} else {
			if (!preg_match("/^" . $url_pattern . "$/", $url_val)) {
				$error_count++;
			}
		}
		if ($error_count > 0) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
}