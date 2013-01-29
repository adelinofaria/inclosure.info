<?php

class View
{
	protected $variables = array();
	protected $_controller;
	
	function __construct($controller)
	{
		$this->_controller = $controller;
	}

	/** Set Variables **/

	function set($name,$value)
	{
		$this->variables[$name] = $value;
	}

	/** Display Template **/
	
    function render($doNotRenderHeader = 0)
    {
		$html = new HTML;
		extract($this->variables);
		
		if ($doNotRenderHeader == 0) {
			if (file_exists(ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . 'header.php')) {
				include (ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . 'header.php');
			} else {
				include (ROOT . DS . 'application' . DS . 'views' . DS . 'header.php');
			}
		}

		if (file_exists(ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . '.php')) {
			include (ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . '.php');		 
		}
			
		if ($doNotRenderHeader == 0) {
			if (file_exists(ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . 'footer.php')) {
				include (ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . 'footer.php');
			} else {
				include (ROOT . DS . 'application' . DS . 'views' . DS . 'footer.php');
			}
		}
    }
}