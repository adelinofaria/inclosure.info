<?php
class Lang {
	static private $lang = array();
	static private $refresh = false;
	
	static private $currentLanguage ='en';
	function __construct() {
		$lang['general'] = array();
	}
	static public function refresh($refresh=true){
		self::$refresh = $refresh;
	}
	static public function set($language,$variation=false){
		if(!$variation) $variation = $language;
		$language = strtolower($language);
		$variation = strtoupper($variation);
		if(file_exists(ROOT.'/application/languages/'.$language.'_'.$variation.'.po')){
			$parser = new POParser(ROOT.'/tmp/cache',self::$refresh);
			self::$lang['general'] = $parser->parse(ROOT.'/application/languages/'.$language.'_'.$variation.'.po');
		/*	$handler = opendir(ROOT.'/application/languages/');
			while ($file = readdir($handler)) {
			  if ($file != "." && $file != ".." && strpos($file,$language.'_'.$variation)==0 &&  strpos($file,'.po')==strlen($file)-3 && $file!=$language.'_'.$variation.'.po') {
				self::$lang[substr($file,6,strlen($file)-9)] = $parser->parse(ROOT.'/application/languages/'.$file,self::$refresh);
			  }
			}
			closedir($handler);
			*/
			$currentLanguage = $language;
		}else{
			Log::log('Language '.$language.'_'.$variation.' not found',0);
		}
	}
	static public function get($key,$opt=false,$opt2=false){
		/*$index = 0;*/
		$group = 'general';
		if($opt!=false){
			$group = $opt;
		}
		/*if($opt2 == false && $opt!=false){
			if(is_numeric($opt)){
				$index = $opt;
			}else{
				$group = $opt;
			}
		}elseif($opt!=false){
			if(is_numeric($opt)){
				$index = $opt;
				$group = $opt2;
			}elseif(is_numeric($opt2)){
				$index = $opt2;
				$group = $opt;
			}else{
				Log::log("Language::invalid parameters get('".$key."','".$opt."','".$opt2."')",0);
			}
		}*/
		if(isset(self::$lang[$group][$key]/*[$index]*/))
			return self::$lang[$group][$key]/*[$index]*/;
		//Log::log("Language::get('".$key."','".$opt."','".$opt2."') not set",0);
		Log::log("Language:: <strong style=\"text-decoration:underline\">".$key."</strong> key not set",0);
		return $key;
	}
}