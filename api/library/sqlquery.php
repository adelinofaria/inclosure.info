<?php

class SQLQuery
{
    protected $_dbHandle;
    protected $_result;
	protected $_query;
	protected $_table;
	
	protected $_joins = array();
	protected $_lefts = array();
	protected $_rights = array();
	protected $_joinSets = array();
	
	protected $_gets = array();

	protected $_describe = array();
	
	protected $_distinct = false;
	protected $_orderBy;
	protected $_orderSQL = false;
	protected $_groupBy = array();
	protected $_order;
	protected $_extraConditions = array();
	protected $_hO;
	protected $_hM;
	protected $_hMABTM;
	protected $_page;
	protected $_limit;

    /** Connects to database **/
	
    function connect($address, $account, $pwd, $name)
    {
        $this->_dbHandle = @mysql_connect($address, $account, $pwd) or trigger_error(mysql_error(), E_MYSQL);
        if ($this->_dbHandle != 0) {
            if (mysql_select_db($name, $this->_dbHandle)) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
 
    /** Disconnects from database **/

    function disconnect()
    {
        if (@mysql_close($this->_dbHandle) != 0) {
            return 1;
        } else {
        	return 0;
        }
    }
    
    /** Select Query **/

	function get()
	{
		for ($i = 0; $i < func_num_args(); $i++) {
			if (substr_count(func_get_arg($i), ',') == 1) {
				$string = explode(',', func_get_arg($i));
				$this->gets['default'][$this->_model][]=$string[0].','.$string[1];
			} elseif(substr_count(func_get_arg($i), ',') == 2) {
				$string = explode(',',func_get_arg($i));
				$this->gets[$string[2]][$this->_model][]=$string[0].','.$string[1];
			} else {
				$this->gets['default'][$this->_model][]=func_get_arg($i);
			}
		}
	}
	
	function where($field, $value, $type='=',$table='')
	{
		if ($table == '') {
			$table = $this->_model;
		} else {
			if (array_key_exists($table, $this->_joinSets)) {
				//$table = ucfirst(strtolower($table));
			} else {
				trigger_error("Join not assigned --> ".$this->_table." with ".$table, E_MYSQL);
			}
		}
		if($type != '<' && $type != '>' && $type != '=') {
			$type='=';
		}
		$this->_extraConditions[] = '`'.$table.'`.`'.$field.'` '.$type.' \''.mysql_real_escape_string($value).'\' AND ';
		return sizeof($this->_extraConditions)-1;
	}
	
	function whereS()
	{
		if (func_num_args() >= 3) {
			if (strtolower(func_get_arg(0)) == 'or') {
				$firstCondition = 'OR';
			} else {
				$firstCondition = 'AND';
			}
			if (strtolower(func_get_arg(1)) == 'or') {
				$secondCondition = 'OR';
			} else {
				$secondCondition = 'AND';
			}
			if (func_num_args() == 3) {
				$this->_extraConditions[func_get_arg(2)] = '('.substr($this->_extraConditions[func_get_arg(2)],0,-4).') '.$firstCondition.' ';
			} else {
				$this->_extraConditions[func_get_arg(2)] = '('.substr($this->_extraConditions[func_get_arg(2)],0,-4).' '.$firstCondition.' ';
				$this->_extraConditions[func_get_arg(func_num_args()-1)] = substr($this->_extraConditions[func_get_arg(func_num_args()-1)],0,-4).') '.$secondCondition.' ';
			}
		} else {
			trigger_error("Where without args", E_MYSQL);
		}
	}

	function like($field, $value, $table =  '')
	{
		if ($table == '') {
			$table = $this->_model;
		}
		$this->_extraConditions[] = '`'.$table.'`.`'.$field.'` LIKE \'%'.mysql_real_escape_string($value).'%\' AND ';
	}

	function showHasOne()
	{
		$this->_hO = 1;
	}

	function showHasMany()
	{
		$this->_hM = 1;
	}

	function showHMABTM()
	{
		$this->_hMABTM = 1;
	}

	function setLimit($limit)
	{
		$this->_limit = $limit;
	}

	function setPage($page)
	{
		$this->_page = $page;
	}
	
	function setDistinct($page)
	{
		$this->_distinct = $page;
	}

	function groupBy($groupby,$table='')
	{
		if ($table == '') {
			$table = $this->_model;
		}
		$this->_groupBy[0] = $table;
		$this->_groupBy[1] = $groupby;
	}	

	function orderBy($orderBy, $order = 'ASC',$sql=false)
	{
		$this->_orderBy = $orderBy;
		$this->_order = $order;
		$this->_orderSQL =  $sql;
	}
	
	function addJoinSet($table,$field,$field2)
	{
		//$table = ucfirst(strtolower($table));
		$this->_joinSets[$table] = array($field,$field2);
	}
	
	function join()
	{
		//$table = ucfirst(strtolower($table));
		if (func_num_args() > 0) {
			$table = func_get_arg(0);
			if (array_key_exists($table, $this->_joinSets)) {
				for ($i=1;$i<func_num_args();$i++) {
					if (substr_count(func_get_arg($i), ',')==1) {
						$string = explode(',', func_get_arg($i));
						$this->gets['default'][$table][]=$string[0].','.$string[1];
					} elseif (substr_count(func_get_arg($i), ',') == 2) {
						$string = explode(',', func_get_arg($i));
						$this->gets[$string[2]][$table][]=$string[0].','.$string[1];
					} else {
						$this->gets['default'][$table][]=func_get_arg($i);
					}
				}
				$this->_joins[] = $table;
			} else {
				trigger_error("Join not assigned --> ".$this->_table." with ".$table, E_MYSQL);
			}
		} else {
			trigger_error("Join without args", E_MYSQL);
		}
	}
	
	function left()
	{
		//$table = ucfirst(strtolower($table));
		if (func_num_args() > 0) {
			$table = func_get_arg(0);
			if (array_key_exists($table, $this->_joinSets)) {
				for ($i = 1; $i < func_num_args(); $i++) {
					if (substr_count(func_get_arg($i), ',')==1) {
						$string = explode(',',func_get_arg($i));
						$this->gets['default'][$table][]=$string[0].','.$string[1];
					} elseif (substr_count(func_get_arg($i), ',') == 2) {
						$string = explode(',', func_get_arg($i));
						$this->gets[$string[2]][$table][]=$string[0].','.$string[1];
					} else {
						$this->gets['default'][$table][]=func_get_arg($i);
					}
				}
				$this->_lefts[] = $table;
			} else {
				trigger_error("Left Join not assigned --> ".$this->_table." with ".$table, E_MYSQL);
			}
		} else {
			trigger_error("Left Join without args", E_MYSQL);
		}
	}
	
	function right()
	{
		//$table = ucfirst(strtolower($table));
		if (func_num_args() > 0) {
			$table = func_get_arg(0);
			if (array_key_exists($table, $this->_joinSets)) {
				for ($i = 1; $i < func_num_args(); $i++) {
					if (substr_count(func_get_arg($i), ',') == 1) {
						$string = explode(',',func_get_arg($i));
						$this->gets['default'][$table][]=$string[0].','.$string[1];
					} elseif (substr_count(func_get_arg($i), ',') == 2) {
						$string = explode(',', func_get_arg($i));
						$this->gets[$string[2]][$table][]=$string[0].','.$string[1];
					} else {
						$this->gets['default'][$table][]=func_get_arg($i);
					}
				}
				$this->_rights[] = $table;
			} else {
				trigger_error("Left Join not assigned --> ".$this->_table." with ".$table, E_MYSQL);
			}
		} else {
			trigger_error("Left Join without args", E_MYSQL);
		}
	}
	
	function search()
	{
		global $inflect;

		$from = '`'.$this->_table.'` as `'.$this->_model.'` ';
		$conditions = '\'1\'=\'1\' AND ';
		$conditionsChild = '';
		$fromChild = '';
		$tmp_gets = '';

		if ($this->_hO == 1 && isset($this->hasOne)) {
			
			foreach ($this->hasOne as $alias => $model) {
				$table = strtolower($inflect->pluralize($model));
				$singularAlias = strtolower($alias);
				$from .= 'LEFT JOIN `'.$table.'` as `'.$alias.'` ';
				$from .= 'ON `'.$this->_model.'`.`'.$singularAlias.'_id` = `'.$alias.'`.`id`  ';
			}
		}
		
		/*for($i=0;$i<count($this->_joins);$i++){
			$from .= 'INNER JOIN `'.strtolower($this->_joins[$i]).'s` as `'.$this->_joins[$i].'` ';			
		}
		for($i=0;$i<count($this->_joins);$i++){
			$conditions .= '`'.$this->_model.'`.`'.$this->_joinSets[$this->_joins[$i]][0].'`=`'.$this->_joins[$i].'`.`'.$this->_joinSets[$this->_joins[$i]][1].'` AND ';	
		}*/
		for ($i = 0; $i < count($this->_joins); $i++) {
			$from .= 'INNER JOIN `'.$this->_joins[$i].'s` as `'.$this->_joins[$i].'` ON `'.$this->_model.'`.`'.$this->_joinSets[$this->_joins[$i]][0].'`=`'.$this->_joins[$i].'`.`'.$this->_joinSets[$this->_joins[$i]][1].'` ';
		}
		for ($i = 0; $i < count($this->_lefts); $i++) {
			$from .= 'LEFT JOIN `'.$this->_lefts[$i].'s` as `'.$this->_lefts[$i].'` ON `'.$this->_model.'`.`'.$this->_joinSets[$this->_lefts[$i]][0].'`=`'.$this->_lefts[$i].'`.`'.$this->_joinSets[$this->_lefts[$i]][1].'` ';
		}
		for ($i = 0; $i < count($this->_rights); $i++) {
			$from .= 'RIGHT JOIN `'.$this->_rights[$i].'s` as `'.$this->_rights[$i].'` ON `'.$this->_model.'`.`'.$this->_joinSets[$this->_rights[$i]][0].'`=`'.$this->_rights[$i].'`.`'.$this->_joinSets[$this->_rights[$i]][1].'` ';
		}

		if ($this->id) {
			$conditions .= '`'.$this->_model.'`.`id` = \''.mysql_real_escape_string($this->id).'\' AND ';
		}
		for ($i = 0; $i < count($this->_extraConditions); $i++) {
			$conditions .= $this->_extraConditions[$i];
		}
		if ($conditions[strlen($conditions)-2] == 'D'){
			$conditions = substr($conditions,0,-4);
		} else {
			$conditions = substr($conditions,0,-3);
		}
		
		if (isset($this->_orderBy)) {
			if ($this->_orderSQL) {
				$conditions .= ' ORDER BY `'.$this->_orderBy.'` '.$this->_order;
			} else {
				$conditions .= ' ORDER BY `'.$this->_model.'`.`'.$this->_orderBy.'` '.$this->_order;
			}
		}

		if (isset($this->_groupBy) && count($this->_groupBy) > 0) {
			$conditions .= ' GROUP BY `'.$this->_groupBy[0].'`.`'.$this->_groupBy[1].'` ';
		}

		if (isset($this->_page)) {
			$offset = ($this->_page-1)*$this->_limit;
			$conditions .= ' LIMIT '.$this->_limit.' OFFSET '.$offset;
		}
		if (isset($this->gets) && (count($this->gets) > 0)) {
			foreach ($this->gets as $type=>$id) {
				if ($type == 'default') {
					foreach ($id as $table => $column) {
						foreach ($column as $name) {
							if ($name == '*') {
								$tmp_gets .= '`'.$table.'`.'.'*,';
							} else {
								if (substr_count($name,',') == 1) {
									$string = explode(',',$name);
									$tmp_gets .= '`'.$table.'`.`'.$string[0].'` as '.$string[1].',';
								} else {
									$tmp_gets .= '`'.$table.'`.`'.$name.'`,';
								}
							}
						}
					}
				} else {
					foreach ($id as $table => $column) {
						foreach ($column as $name) {
							$string = explode(',',$name);
							$tmp_gets .= $type.'(`'.$table.'`.`'.$string[0].'`) as '.$string[1].',';
						}
					}
					
				}
			}
			$tmp_gets = substr($tmp_gets,0,strlen($tmp_gets)-1);
		} else {
			$tmp_gets = '*';
		}
		
		if ($this->_distinct) {
			$this->_query = 'SELECT DISTINCT '.$tmp_gets.' FROM '.$from.' WHERE '.$conditions;
		} else {
			$this->_query = 'SELECT '.$tmp_gets.' FROM '.$from.' WHERE '.$conditions;
		}
		
		//Log::log($this->_query);
		//echo '<!--'.$this->_query.'-->';
		//echo $this->_query."\n";
		$this->_result = mysql_query($this->_query, $this->_dbHandle) or trigger_error(mysql_error(), E_MYSQL);
		$result = array();
		$table = array();
		$field = array();
		$tempResults = array();
		$numOfFields = mysql_num_fields($this->_result);
		for ($i = 0; $i < $numOfFields; ++$i) {
		    array_push($table,mysql_field_table($this->_result, $i));
		    array_push($field,mysql_field_name($this->_result, $i));
		}
		if (mysql_num_rows($this->_result) > 0 ) {
			while ($row = mysql_fetch_row($this->_result)) {
				for ($i = 0;$i < $numOfFields; ++$i) {
					$tempResults[$table[$i]][$field[$i]] = $row[$i];
				}

				if ($this->_hM == 1 && isset($this->hasMany)) {
					foreach ($this->hasMany as $aliasChild => $modelChild) {
						$queryChild = '';
						$conditionsChild = '';
						$fromChild = '';

						$tableChild = strtolower($inflect->pluralize($modelChild));
						$pluralAliasChild = strtolower($inflect->pluralize($aliasChild));
						$singularAliasChild = strtolower($aliasChild);

						$fromChild .= '`'.$tableChild.'` as `'.$aliasChild.'`';
						
						$conditionsChild .= '`'.$aliasChild.'`.`'.strtolower($this->_model).'_id` = \''.$tempResults[$this->_model]['id'].'\'';
	
						$queryChild =  'SELECT * FROM '.$fromChild.' WHERE '.$conditionsChild;	
						#echo '<!--'.$queryChild.'-->';
						$resultChild = mysql_query($queryChild, $this->_dbHandle)or trigger_error(mysql_error(), E_MYSQL);
				
						$tableChild = array();
						$fieldChild = array();
						$tempResultsChild = array();
						$resultsChild = array();
						
						if (mysql_num_rows($resultChild) > 0) {
							$numOfFieldsChild = mysql_num_fields($resultChild);
							for ($j = 0; $j < $numOfFieldsChild; ++$j) {
								array_push($tableChild,mysql_field_table($resultChild, $j));
								array_push($fieldChild,mysql_field_name($resultChild, $j));
							}

							while ($rowChild = mysql_fetch_row($resultChild)) {
								for ($j = 0;$j < $numOfFieldsChild; ++$j) {
									$tempResultsChild[$tableChild[$j]][$fieldChild[$j]] = $rowChild[$j];
								}
								array_push($resultsChild,$tempResultsChild);
							}
						}
						
						$tempResults[$aliasChild] = $resultsChild;
						mysql_free_result($resultChild);
					}
				}

				if ($this->_hMABTM == 1 && isset($this->hasManyAndBelongsToMany)) {
					foreach ($this->hasManyAndBelongsToMany as $aliasChild => $tableChild) {
						$queryChild = '';
						$conditionsChild = '';
						$fromChild = '';

						$tableChild = strtolower($inflect->pluralize($tableChild));
						$pluralAliasChild = strtolower($inflect->pluralize($aliasChild));
						$singularAliasChild = strtolower($aliasChild);

						$sortTables = array($this->_table,$pluralAliasChild);
						sort($sortTables);
						$joinTable = implode('_',$sortTables);

						$fromChild .= '`'.$tableChild.'` as `'.$aliasChild.'`,';
						$fromChild .= '`'.$joinTable.'`,';
						
						$conditionsChild .= '`'.$joinTable.'`.`'.$singularAliasChild.'_id` = `'.$aliasChild.'`.`id` AND ';
						$conditionsChild .= '`'.$joinTable.'`.`'.strtolower($this->_model).'_id` = \''.$tempResults[$this->_model]['id'].'\'';
						$fromChild = substr($fromChild,0,-1);

						$queryChild =  'SELECT * FROM '.$fromChild.' WHERE '.$conditionsChild;	
						#echo '<!--'.$queryChild.'-->';
						$resultChild = mysql_query($queryChild, $this->_dbHandle)or trigger_error(mysql_error(), E_MYSQL);
				
						$tableChild = array();
						$fieldChild = array();
						$tempResultsChild = array();
						$resultsChild = array();
						
						if (mysql_num_rows($resultChild) > 0) {
							$numOfFieldsChild = mysql_num_fields($resultChild);
							for ($j = 0; $j < $numOfFieldsChild; ++$j) {
								array_push($tableChild,mysql_field_table($resultChild, $j));
								array_push($fieldChild,mysql_field_name($resultChild, $j));
							}

							while ($rowChild = mysql_fetch_row($resultChild)) {
								for ($j = 0;$j < $numOfFieldsChild; ++$j) {
									$tempResultsChild[$tableChild[$j]][$fieldChild[$j]] = $rowChild[$j];
								}
								array_push($resultsChild,$tempResultsChild);
							}
						}
						
						$tempResults[$aliasChild] = $resultsChild;
						mysql_free_result($resultChild);
					}
				}
				array_push($result,$tempResults);
			}

			if (mysql_num_rows($this->_result) == 1 && $this->id != null) {
				mysql_free_result($this->_result);
				$this->clear();
				return($result[0]);
			} else {
				mysql_free_result($this->_result);
				$this->clear();
				return($result);
			}
		} else {
			mysql_free_result($this->_result);
			$this->clear();
			return $result;
		}
	}

    /** Custom SQL Query **/

	function custom($query)
	{
		global $inflect;

		$this->_result = mysql_query($query, $this->_dbHandle)or trigger_error(mysql_error(), E_MYSQL);

		$result = array();
		$table = array();
		$field = array();
		$tempResults = array();

		if (substr_count(strtoupper($query), "SELECT") > 0) {
			if (mysql_num_rows($this->_result) > 0) {
				$numOfFields = mysql_num_fields($this->_result);
				for ($i = 0; $i < $numOfFields; ++$i) {
					array_push($table,mysql_field_table($this->_result, $i));
					array_push($field,mysql_field_name($this->_result, $i));
				}
				while ($row = mysql_fetch_row($this->_result)) {
					for ($i = 0;$i < $numOfFields; ++$i) {
						$table[$i] = ucfirst($inflect->singularize($table[$i]));
						$tempResults[$table[$i]][$field[$i]] = $row[$i];
					}
					array_push($result,$tempResults);
				}
			}
			mysql_free_result($this->_result);
		}	
		$this->clear();
		return($result);
	}	

    /** Describes a Table **/

	protected function _describe()
	{
		$this->_describe = Cache::get('describe'.$this->_table);

		if (!$this->_describe) {
			$this->_describe = array();
			$query = 'DESCRIBE '.$this->_table;
			$this->_result = mysql_query($query, $this->_dbHandle) or trigger_error(mysql_error(), E_MYSQL);
			while ($row = mysql_fetch_row($this->_result)) {
				 array_push($this->_describe,$row[0]);
			}

			mysql_free_result($this->_result);
			Cache::set('describe'.$this->_table,$this->_describe);
		}

		foreach ($this->_describe as $field) {
			$this->$field = null;
		}
	}

    /** Delete an Object **/

	function delete()
	{
		if ($this->id) {
			$query = 'DELETE FROM '.$this->_table.' WHERE `id`=\''.mysql_real_escape_string($this->id).'\'';		
			$this->_result = mysql_query($query, $this->_dbHandle)or trigger_error(mysql_error(), E_MYSQL);
			$this->clear();
			if ($this->_result == 0) {
			    /** Error Generation **/
				return -1;
		   }
		} else {
			/** Error Generation **/
			return -1;
		}
	}

    /** Saves an Object i.e. Updates/Inserts Query **/

	function save()
	{
		$query = '';
		if (isset($this->id) || isset($this->_extraConditions[0])) {
			$updates = '';
			foreach ($this->_describe as $field) {
				if ($this->$field) {
					$updates .= '`'.$field.'` = \''.mysql_real_escape_string($this->$field).'\',';
				}
			}

			$updates = substr($updates,0,-1);
			if (isset($this->id)) {
				$query = 'UPDATE '.$this->_table.' as '.$this->_model.' SET '.$updates.' WHERE `id`=\''.mysql_real_escape_string($this->id).'\'';			
			} else {
				$query = 'UPDATE '.$this->_table.' as '.$this->_model.' SET '.$updates.' WHERE ';
				for ($i=0;$i<count($this->_extraConditions);$i++) {
					$query .= $this->_extraConditions[$i];
				}
				$query = substr($query,0,-4);
			}
		} else {
			$fields = '';
			$values = '';
			foreach ($this->_describe as $field) {
				if (isset($this->$field)) {
					$fields .= '`'.$field.'`,';
					$values .= '\''.mysql_real_escape_string($this->$field).'\',';
				}
			}
			$values = substr($values,0,-1);
			$fields = substr($fields,0,-1);

			$query = 'INSERT INTO '.$this->_table.' ('.$fields.') VALUES ('.$values.')';
		}
		#echo '<!--'.$query.'-->';
		$this->_result = mysql_query($query, $this->_dbHandle) or trigger_error(mysql_error(), E_MYSQL);
		$this->clear();
		if ($this->_result == 0) {
            /** Error Generation **/
			return -1;
        }
		return mysql_insert_id();
	}
 
	/** Clear All Variables **/

	function clear()
	{
		foreach($this->_describe as $field) {
			$this->$field = null;
		}

		$this->_orderby = null;
		$this->_extraConditions = null;
		/*inner join BOF*/
		$this->_joins = array();
		/*inner join EOF*/
		$this->_hO = null;
		$this->_hM = null;
		$this->_hMABTM = null;
		$this->_page = null;
		$this->_order = null;
	}

	/** Pagination Count **/

	function totalPages()
	{
		if ($this->_query && $this->_limit) {
			$pattern = '/SELECT (.*?) FROM (.*)LIMIT(.*)/i';
			$replacement = 'SELECT COUNT(*) FROM $2';
			$countQuery = preg_replace($pattern, $replacement, $this->_query);
			$this->_result = mysql_query($countQuery, $this->_dbHandle)or trigger_error(mysql_error(), E_MYSQL);
			$count = mysql_fetch_row($this->_result);
			$totalPages = ceil($count[0]/$this->_limit);
			return $totalPages;
		} else {
			/* Error Generation Code Here */
			return -1;
		}
	}

    /** Get error string **/

    function getError()
    {
        return mysql_error($this->_dbHandle);
    }
}