<?php
	class IndexController extends Controller{
		public function __construct(){
			parent::__construct();			
		}

		//HOME
		public function indexAction(){
			$this->_templateObj->setFileConfig('template.ini');
	    	$this->_templateObj->setFileTemplate('index.php');
	    	$this->_templateObj->setFolderTemplate('default/main/');
	    	$this->_templateObj->load();
	    	$this->_view->setTitle('Book store');

	    	// list item cho phần home
	    	$this->_view->special_book = $this->_db->listItem($this->_arrData, 'special-book');
	    	$this->_view->new_book = $this->_db->listItem($this->_arrData, 'new-book');

	    	$this->_view->render('index\index',true);
	    }


		// hiển thị thông báo
		public function noticeAction(){
			$this->_templateObj->setFileConfig('template.ini');
	    	$this->_templateObj->setFileTemplate('index.php');
	    	$this->_templateObj->setFolderTemplate('default/main/');
	    	$this->_templateObj->load();
	    	$this->_view->setTitle('index');
	    	$this->_view->render('index\notice',true);
	    }

	    public function logoutAction(){
	    	Session::delete('user');
	    	Session::delete('cart');
	    	header('location: index.php?module=default&controller=index&action=index');
	    	exit();
	    }

	}