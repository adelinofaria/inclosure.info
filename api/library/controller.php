<?php

class Controller
{
	protected $_controller;
	protected $_view;

	public $doNotRenderHeader;
	public $render;
	
	function __construct($controller)
	{
		$this->_controller = ucfirst($controller);
		$this->_view = new View($controller);
		$this->doNotRenderHeader = 0;
		$this->render = 1;
	}
	
	function beforeAction ()
	{
	}
	
	function afterAction()
	{
	}

	function set($name,$value)
	{
		$this->_view->set($name,$value);
	}

	function render()
	{
		if ($this->render) {
			$this->_view->render($this->doNotRenderHeader);
		}
	}
}