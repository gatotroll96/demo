<?php

class ErrorController extends Controller{
	
	    public function __construct(){
	    	parent::__construct();
	    	//echo 'admin controller construct';
	    }
	    public function IndexAction(){
	    	$this->_view->testError = 'lỗi rồi, fix đi';
	    	$this->_view->render('error/index');
	    }
	}