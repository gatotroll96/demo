<?php
	require_once EXTENS_PATH.'PaginationCategory.php';

	class BookController extends Controller{
		public function __construct(){
			parent::__construct();			
		}

		//HOME
		public function listAction(){
			$this->_templateObj->setFileConfig('template.ini');
	    	$this->_templateObj->setFileTemplate('index.php');
	    	$this->_templateObj->setFolderTemplate('default/main/');
	    	$this->_templateObj->load();
	    	$this->_view->setTitle('Book store');
	    	$this->_view->items = $this->_db->listItem($this->_arrData);
	    	$this->_view->categoryName = $this->_db->infoItems($this->_arrData,'get-cat-name');


	    	//pagination
			$totalItems = $this->_db->countItem();
			$currentPage = (isset($this->_arrData['page']))? $this->_arrData['page'] : 1;
			$linkPagination = 'index.php?module=default&controller=book&action=list&ctgr='.$this->_arrData['ctgr'].'&page=';
			$infoPagination = array('totalItemsPerPage' => 7, 'pageRange'=>3,'currentPage'=>$currentPage);
			$pagination = new PaginationCategory($totalItems,$infoPagination);
			$this->_view->_pagination = $pagination->showPagination($linkPagination);
	    	$this->_view->render('book\list',true);
	    }

	    public function detailAction(){
			$this->_templateObj->setFileConfig('template.ini');
	    	$this->_templateObj->setFileTemplate('index.php');
	    	$this->_templateObj->setFolderTemplate('default/main/');
	    	$this->_templateObj->load();
	    	$this->_view->setTitle('Book store');
	    	$this->_view->detailBook = $this->_db->infoItems($this->_arrData,'get-detail-book');
	    	$this->_view->relatedBook = $this->_db->infoItems($this->_arrData,'get-related-book');			
	    	$this->_view->render('book\detail',true);
	    }

	    public function orderAction(){
	    	$userInfo = Session::get('user');
	    	if($userInfo['login'] == true && $userInfo['time'] + TIME_LOGIN >= time()){   	
		        $cart	= Session::get('cart');
				$bookID	= $this->_arrData['id'];
				$price	= $this->_arrData['price'];
				
				if(empty($cart)){
					$cart['quantity'][$bookID]	= 1;
					$cart['price'][$bookID]		= $price;
				}else{
					if(key_exists($bookID, $cart['quantity'])){
						$cart['quantity'][$bookID]	+=1;
						$cart['price'][$bookID]		= $price * $cart['quantity'][$bookID];
					}else{
						$cart['quantity'][$bookID]	= 1;
						$cart['price'][$bookID]		= $price;
					}
				}
				Session::set('cart', $cart);
				header('location: index.php?module=default&controller=book&action=cart');
	    		exit();
	    	}else{
				header('location: index.php?module=default&controller=user&action=login');
	    		exit();
			}

	    }


	    public function cartAction(){
			$this->_templateObj->setFileConfig('template.ini');
	    	$this->_templateObj->setFileTemplate('index.php');
	    	$this->_templateObj->setFolderTemplate('default/main/');
	    	$this->_templateObj->load();
	    	$this->_view->setTitle('Book store');

	    	$userInfo = Session::get('user');
	    	if($userInfo['login'] == true && $userInfo['time'] + TIME_LOGIN >= time()){
	    		$this->_view->listCart = $this->_db->infoItems($this->_arrData,'get-list-cart');
	    	}else{
				header('location: index.php?module=default&controller=user&action=login');
	    		exit();
			}
	    	
   			
	    	$this->_view->render('book\cart',true);
	    }

	    public function checkoutAction(){	    
			$this->_db->saveHistoryBuy($this->_arrData);
	    }

	}
?>