<?php

class Controller{
		
		protected $_view;				// thực hiện với View obj
		protected $_db; 			// trong zend là $_model, thực hiện với model obj
		protected $_arrData;		// trong zend là $_arrParam, arr lấy từ (get và post)
		protected $_templateObj;	// thực hiện với templateObj


	    public function __construct(){
	    	$this->_arrData = array_merge($_GET, $_POST);
	    	$this->_view = new View(@$this->_arrData['module']);
	    	$this->_templateObj = new Template($this);
	    	$this->_view->_arrGetPost = $this->_arrData;
	    	$module 	= (isset($this->_arrData['module'])) ? $this->_arrData['module'] : 'default';
			$controller = (isset($this->_arrData['controller'])) ? $this->_arrData['controller'] : 'index';
	    	$this->setModel( $module, $controller);
	    }

	    // SET MODEL
	    public function setModel($moduleName, $modelName){
	    	$modelsName = ucfirst($modelName) . 'Model';
	    	$modelPath = APPLICATION_PATH . $moduleName . DS . 'models' . DS. $modelsName . '.php';
	    	require_once $modelPath;
	    	$this->_db = new $modelsName();   	
	    }

	    // GET MODEL
	    public function getModel(){
	    	return $this->_db;
	    }

	    public function getTemphate(){
	    	return $this->_templateObj;
	    }

	    public function getView(){
	    	return $this->_view;
	    }

	    public function setarrData($arrData){
	    	$this->_arrData = $arrData;
	    }

	    public function getarrData(){
	    	return $this->_arrData;
	    }
}