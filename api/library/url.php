<?php

class Url
{
	protected $variables = array();
	
	function __construct()
	{
		$this->variables['queryString'] = explode('&', $_SERVER['QUERY_STRING']);
		$this->variables['httpMethod'] = $_SERVER['REQUEST_METHOD'];
		$array =  explode('?', $_SERVER["REQUEST_URI"], 2);
		$this->variables['url'] = $array[0];
		
		if (!String::isNullOrEmpty($this->variables['url'])) {
			if (String::startsWith($this->variables['url'], RELATIVE_PATH)) {
				$replaceCount = 1;
				$requestUri = str_replace(RELATIVE_PATH, DS, $this->variables['url'], $replaceCount);
			} else {
				$requestUri = RELATIVE_PATH;
			}
		}
		
		$urlArray = array_values(array_filter(explode('/', $requestUri), 'strlen'));
		
		if (!isset($urlArray[0]) || $urlArray[0] == '') {
			$this->variables['controller'] = DEFAULT_CONTROLLER;
		} else {
			$this->variables['controller'] = $urlArray[0];
			array_shift($urlArray);
			
			if (count($urlArray) > 0) {
				$this->variables['id'] = $urlArray[0];
				array_shift($urlArray);
			
				if (count($urlArray) > 0) {
					$this->variables['resource'] = $urlArray[0];
				}
			}
		}
	}
	
	function __get($name)
	{
        if (array_key_exists($name, $this->variables)) {
            return $this->variables[$name];
        } else {
        	return null;
        }
	}
	
	public function __set($name, $value)
    {
        $this->variables[$name] = $value;
    }
	
	
	public static function shortenUrl($data)
	{
		$data = preg_replace_callback('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@', array(get_class($this), '_fetchTinyUrl'), $data);
		return $data;
	}

	public static function fetchTinyUrl($url)
	{
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch,CURLOPT_URL,'http://tinyurl.com/api-create.php?url='.$url[0]);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		return '<a href="'.$data.'" target = "_blank" >'.$data.'</a>';
	}
}