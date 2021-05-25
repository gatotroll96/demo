<?php
	class UserController extends Controller{
		public function __construct(){
			parent::__construct();
			//$this->getModel();
			
			//echo 'default contruct user models';
		}
		// hiển thị list
		public function indexAction(){
			// set template
			$this->_templateObj->setFileConfig('template.ini');
	    	$this->_templateObj->setFileTemplate('index.php');
	    	$this->_templateObj->setFolderTemplate('admin/main/');
	    	$this->_templateObj->load();

	    	// input pagination 
	    	$totalItems = $this->_db->countItem($this->_arrData
	    	);
	    	$currentPage = (isset($this->_arrData['filter_page'])) ? $this->_arrData['filter_page'] : 1;
	    	$pagination = array('totalItemsPerPage' => '7','pageRange' => '3', 'currentPage' => $currentPage);
	    	$this->_view->page = new Pagination($totalItems, $pagination);

	    	
	    	$this->_view->nameGr = $this->_db->getItemsGroup();
	    	// set title
	    	// list item
	    	$this->_view->items = $this->_db->listItem($this->_arrData
	    	);
	    	$this->_view->setTitle('Admin Manager: User group');
	    	$this->_view->render('user\index',true);

	    }

	    public function addAction(){
	    	$this->_view->setTitle('Admin Manager: ADD User');
	    	$this->_templateObj->setFileConfig('template.ini');
	    	$this->_templateObj->setFileTemplate('index.php');
	    	$this->_templateObj->setFolderTemplate('admin/main/');
	    	$this->_templateObj->load();
	    	$this->_view->nameGr = $this->_db->getItemsGroup();	    	
	    	if(isset($this->_arrData['id'])){
	    		$this->_view->data = $this->_db->infoItems($this->_arrData);
	    		echo '<pre>';
				print_r($this->_view->data);
				echo '</pre>';
	    		if($this->_arrData['id'] != $this->_view->data['id']){
	    			header('location: index.php?module=admin&controller=user&action=index');
	    			exit();
	    		}
		    }	    		    	
	    	if(@$this->_arrData['form']['token'] > 0){
	    		$validate = new Validate($this->_arrData['form']);
	    		
	    		// query dùng validate value username và email đã tồn tại chưa
    			$queryEmail = "SELECT `id` FROM `user` WHERE `email` = '".$this->_arrData['form']['email']."'";
    			$queryUserName = "SELECT `id` FROM `user` WHERE `username` = '".$this->_arrData['form']['username']."'";
    			if(isset($this->_arrData['form']['id']) || isset($this->_arrData['id'])){
    				$queryUserName .= "AND `id` <> ".$this->_arrData['form']['id']."";
    				$queryEmail .= "AND `id` <> ".$this->_arrData['form']['id']."";
    			}    				
	    		$validate->addRule('username', 'string-notexistRecord', array('min'=> 3, 'max'=>40,'database'=>$this->_db, 'query' => $queryUserName));	    			    		
	    		$validate->addRule('email', 'email-notexistRecord' , array('database'=>$this->_db,'query' => $queryEmail));
	    		$validate->addRule('status', 'status', array('deny'=> array('default')));
	    		$validate->addRule('group_id', 'status', array('deny'=> array('default')));
	    		$validate->addRule('ordering', 'int', array('min'=> 1, 'max'=>40));	    		
		    	$validate->run();
	    		
	    		if($validate->isValid()== false){
	    			$this->_view->errorValidate = $validate->showErrors();
	    		}else{
	    			if($this->_arrData['type'] == 'apply'){
	    				if(isset($this->_arrData['form']['id'])){
	    					$lastID = $this->_db->editItems($this->_arrData);
	    					$link = URL::createLink('admin', 'user', 'add', array('id'=>$lastID));
	    					header('location: '.$link.'');
	    					exit();
	    				}else{
	    					$lastID = $this->_db->addItems($this->_arrData);
	    					$link = URL::createLink('admin', 'user', 'add', array('id'=>$lastID));
	    					header('location: '.$link.'');
	    					exit();
	    				}	    				
	    			}
	    			if($this->_arrData['type'] == 'Save'){
	    				if(isset($this->_arrData['form']['id'])){
	    					$this->_db->editItems($this->_arrData);
	    					header('location: index.php?module=admin&controller=user&action=index');
	    					exit();
	    				}else{
	    					$this->_db->addItems($this->_arrData);
	    					header('location: index.php?module=admin&controller=user&action=index');
	    					exit();
	    				}	    					    					    				
	    			}
	    			if($this->_arrData['type'] == 'savenew'){
	    				if(isset($this->_arrData['form']['id'])){
	    					$this->_db->editItems($this->_arrData);
	    					header('location: index.php?module=admin&controller=user&action=add');
	    					exit();
	    				}else{
	    					$this->_db->addItems($this->_arrData);
	    					header('location: index.php?module=admin&controller=user&action=add');
	    					exit();
	    				}	    					    					    				
	    			}
	    		}	    		
	    	}
	    	
	    	$this->_view->render('user\add',true);
	    }


	    // thay đổi từng status
	    public function ajaxStatusAction(){
	    	$result = $this->_db->changeStatus($this->_arrData, array('task'=>'change-ajax-status'));
	    	echo json_encode($result);
	    }

	    // thay đổi nhiều status
	    public function statusAction(){
	    	$this->_db->changeStatus($this->_arrData, array('task'=>'change-status'));
	    	header('location: index.php?module=admin&controller=user&action=index');
	    	exit();
	    }
	    
	    // xóa
	    public function deteleitemsAction(){
	    	$this->_db->deleteItems($this->_arrData);
	    	header('location: index.php?module=admin&controller=user&action=index');
	    	exit();
	    }

	}