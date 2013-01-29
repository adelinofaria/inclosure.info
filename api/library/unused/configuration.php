<?php

/**
  * Configuration class, Configuration.php
  * Allow to set, get and delete configuration values in the database
  * @category classes
  */

class Configuration extends ObjectModel
{
	public 		$id;
	public 		$name;
	public 		$value;
	public 		$date_add;
	public 		$date_upd;

	protected	$fieldsRequired = array('name');
	protected	$fieldsSize = array('name' => 32);
	protected	$fieldsValidate = array('name' => 'isConfigName');

	protected	$table = 'configuration';
	protected 	$identifier = 'id';

	/** @var array Configuration cache */
	private static $_CONF;
	/** @var array Configuration multilang cache */
	private static $_CONF_LANG;

	public function getFields()
	{
		parent::validateFields();
		$fields['name'] = pSQL($this->name);
		$fields['value'] = pSQL($this->value);
		$fields['date_add'] = pSQL($this->date_add);
		$fields['date_upd'] = pSQL($this->date_upd);
		return $fields;
	}

	/**
	  * Delete a configuration key in database (with or without language management)
	  *
	  * @param string $key Key to delete
	  * @return boolean Deletion result
	  */
	static public function deleteByName($key)
	{
	 	if (!Validate::isConfigName($key))
	 		die(Tools::displayError());

		return MySQL::getInstance()->query('DELETE FROM `configuration` WHERE `name` = \''.pSQL($key).'\'');
	}

	/**
	  * Get a single configuration value (in one language only)
	  *
	  * @param string $key Key wanted
	  * @param integer $id_lang Language ID
	  * @return string Value
	  */
	static public function get($key, $id_lang = NULL)
	{
	 	if (!is_array(self::$_CONF) or !is_array(self::$_CONF_LANG) or !Validate::isConfigName($key))
	 		die(Tools::displayError());

		elseif (key_exists($key, self::$_CONF))
			return self::$_CONF[$key];

		$result = Db::getInstance()->query('
		SELECT IFNULL(c.`value`) AS value
		FROM `configuration` c WHERE `name` = \''.pSQL($key).'\'');
		
		self::$_CONF[$key] = ($result ? $result['value'] : false);
		return self::$_CONF[$key];
	}

	/**
	  * Set TEMPORARY a single configuration value (in one language only)
	  *
	  * @param string $key Key wanted
	  * @param mixed $values $values is an array if the configuration is multilingual, a single string else.
	  * @param boolean $html Specify if html is authorized in value
	  */
	static public function set($key, $values, $html = false)
	{
		if (!Validate::isConfigName($key))
	 		die(Tools::displayError());
	 	/* Update classic values */
		if (!is_array($values))
			self::$_CONF[$key] = $values;
	}

	/**
	  * Get several configuration values (in one language only)
	  *
	  * @param array $keys Keys wanted
	  * @param integer $id_lang Language ID
	  * @return array Values
	  */
	static public function getMultiple($keys, $id_lang = NULL)
	{
	 	if (!is_array($keys) or !is_array(self::$_CONF) or ($id_lang AND !is_array(self::$_CONF_LANG)))
	 		die(Tools::displayError());

		$resTab = array();
		if (!$id_lang)
		{
			foreach ($keys AS $key)
				if (key_exists($key, self::$_CONF))
					$resTab[$key] = self::$_CONF[$key];
		}
		return $resTab;
	}

	/**
	  * Insert configuration key and value into database
	  *
	  * @param string $key Key
	  * @param string $value Value
	  * @eturn boolean Insert result
	  */
	static private function _addConfiguration($key, $value = NULL)
	{
		$result = false;
		if (!is_null($value))	
			$result = Db::getInstance()->query('
		INSERT INTO `configuration` (`name`,`value`,`date_add`,`date_upd`) VALUES (\''.pSQL($key).'\',\''.pSQL($value).'\',\''.date('Y-m-d H:i:s').'\',\''.date('Y-m-d H:i:s').'\' )');
		
		return $result;
	}

	/**
	  * Update configuration key and value into database (automatically insert if key does not exist)
	  *
	  * @param string $key Key
	  * @param mixed $values $values is an array if the configuration is multilingual, a single string else.
	  * @param boolean $html Specify if html is authorized in value
	  * @eturn boolean Update result
	  */
	static public function updateValue($key, $values, $html = false)
	{
		if ($key == NULL) return;
		if (!Validate::isConfigName($key))
	 		die(Tools::displayError());
		$db = MySQL::getInstance();

		/* Update classic values */
		if (!is_array($values))
		{
		 	if (Configuration::get($key) !== false)
		 	{
				$result = $db->query( 'UPDATE configuration SET value = "'.pSQL($values, $html).'", date_upd = "'.date('Y-m-d H:i:s').'" WHERE name = "'.pSQL($key).'"');
				self::$_CONF[$key] = $values;
			}
			else
			{
				return self::_addConfiguration($key, $values);
			}
		}

		return $result;
	}

	static public function loadConfiguration()
	{
		/* Configuration */
		self::$_CONF = array();
		$result = Db::getInstance()->ExecuteS('SELECT `name`, `value` FROM `configuration`');
		if ($result)
			foreach ($result AS $row)
				self::$_CONF[$row['name']] = $row['value'];
	}
}

?>