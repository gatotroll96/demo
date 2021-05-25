<?php
	require_once EXTENS_PATH.'PaginationCategory.php';

	class CategoryController extends Controller{
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
	    	$this->_view->items = $this->_db->listItem($this->_arrData);

	    	//pagination
			$totalItems = $this->_db->countItem();
			$currentPage = (isset($this->_arrData['page']))? $this->_arrData['page'] : 1;
			$linkPagination = 'index.php?module=default&controller=category&action=index&page=';
			$infoPagination = array('totalItemsPerPage' => 7, 'pageRange'=>3,'currentPage'=>$currentPage);
			$pagination = new PaginationCategory($totalItems,$infoPagination);
			$this->_view->_pagination = $pagination->showPagination($linkPagination);
	    	$this->_view->render('category\index',true);
	    }

	}
?>