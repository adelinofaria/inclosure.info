<?php

class Html
{
	function link($text, $path, $prompt = null, $confirmMessage = "Are you sure?")
	{
		$path = str_replace(' ', '-', $path);
		if ($prompt) {
			$data = '<a href="javascript:void(0);" onclick="javascript:jumpTo(\''.BASE_PATH.'/'.$path.'\',\''.$confirmMessage.'\')">'.$text.'</a>';
		} else {
			$data = '<a href="'.BASE_PATH.'/'.$path.'">'.$text.'</a>';	
		}
		return $data;
	}
	
	function includeJs($fileName) {
		$data = '<script type="text/javascript" src="'.BASE_PATH.'/js/'.$fileName.'.js"></script>';
		return $data;
	}

	function includeCss($fileName) {
		$data = '<link rel="StyleSheet" href="'.BASE_PATH.'/css/'.$fileName.'.css" type="text/css" ></link>';
		return $data;
	}

	function includeJQuery() {
		if (!jQuery)
		{
		    echo $this->includeJs('jquery');
		}
	}
}