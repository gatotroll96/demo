<?php
	class CategoryController extends Controller{
		public function __construct(){
			parent::__construct();			
		}

		public function indexAction(){
			// set template
			$this->_templateObj->setFileConfig('template.ini');
	    	$this->_templateObj->setFileTemplate('index.php');
	    	$this->_templateObj->setFolderTemplate('admin/main/');
	    	$this->_templateObj->load();

	    	$totalItems = $this->_db->countItem($this->_arrData
	    	);
	    	$currentPage = (isset($this->_arrData['filter_page'])) ? $this->_arrData['filter_page'] : 1;
	    	$pagination = array('totalItemsPerPage' => '7','pageRange' => '3', 'currentPage' => $currentPage);
	    	$this->_view->page = new Pagination($totalItems, $pagination);
	    		    	
	    	// list item
	    	$this->_view->items = $this->_db->listItem($this->_arrData
	    	);
	    	$this->_view->setTitle('Admin Manager: Category');
	    	$this->_view->render('category\index',true);
	    }

	    // thay đổi từng status
	    public function ajaxStatusAction(){
	    	$result = $this->_db->changeStatus($this->_arrData, array('task'=>'change-ajax-status'));
	    	echo json_encode($result);
	    }

	    // thay đổi nhiều status
	    public function statusAction(){
	    	$this->_db->changeStatus($this->_arrData, array('task'=>'change-status'));
	    	header('location: index.php?module=admin&controller=category&action=index');
	    	exit();
	    }

	    // ADD
	    public function addAction(){
	    	
	    	
	    	$this->_templateObj->setFileConfig('template.ini');
	    	$this->_templateObj->setFileTemplate('index.php');
	    	$this->_templateObj->setFolderTemplate('admin/main/');
	    	$this->_templateObj->load();
	    	$this->_view->setTitle('Admin Manager: ADD category');

	    	if(!empty($_FILES)){
	    		$this->_arrData['form']['picture'] = $_FILES['picture'];	    		
	    	}
	    	if(isset($this->_arrData['id'])){
	    		$this->_view->data = $this->_db->infoItems($this->_arrData);	    	
	    		if($this->_arrData['id'] != $this->_view->data['id']){
	    			header('location: index.php?module=admin&controller=category&action=index');
	    			exit();
	    		}
	    	}
	    	if(@$this->_arrData['form']['token'] > 0){
	    		$validate = new Validate($this->_arrData['form']);
	    		$validate->addRule('name', 'string', array('min'=> 3, 'max'=>60));
	    		$validate->addRule('status', 'status', array('deny'=> array('default')));	    		
	    		$validate->addRule('ordering', 'int', array('min'=> 1, 'max'=>40));
	    		$validate->validateFile('picture',array('min'=> 1,'max'=>4000000,'extension'=>array('jpg','gif','png')));
	    		$validate->run();
	    		if($validate->isValid()== false){
	    			$this->_view->errorValidate = $validate->showErrors();
	    		}else{
	    			if($this->_arrData['type'] == 'apply'){
	    				if(isset($this->_arrData['form']['id'])){
	    					$lastID = $this->_db->editItems($this->_arrData);
	    					$link = URL::createLink('admin', 'category', 'add', array('id'=>$lastID));
	    					header('location: '.$link.'');
	    					exit();
	    				}else{
	    					$lastID = $this->_db->addItems($this->_arrData);
	    					$link = URL::createLink('admin', 'category', 'add', array('id'=>$lastID));
	    					header('location: '.$link.'');
	    					exit();
	    				}	    				
	    			}
	    			if($this->_arrData['type'] == 'Save'){
	    				if(isset($this->_arrData['form']['id'])){
	    					$this->_db->editItems($this->_arrData);
	    					header('location: index.php?module=admin&controller=category&action=index');
	    					exit();
	    				}else{
	    					$this->_db->addItems($this->_arrData);
	    					header('location: index.php?module=admin&controller=category&action=index');
	    					exit();
	    				}	    					    					    				
	    			}
	    			if($this->_arrData['type'] == 'savenew'){
	    				if(isset($this->_arrData['form']['id'])){
	    					$this->_db->editItems($this->_arrData);
	    					header('location: index.php?module=admin&controller=category&action=add');
	    					exit();
	    				}else{
	    					$this->_db->addItems($this->_arrData);
	    					header('location: index.php?module=admin&controller=category&action=add');
	    					exit();
	    				}	    					    					    				
	    			}
	    		}	    		
	    	}	    	
	    	$this->_view->render('category\add',true);
	    }

	    public function deteleitemsAction(){
	    	$this->_db->deleteItems($this->_arrData);
	    	header('location: index.php?module=admin&controller=category&action=index');
	    	exit();
	    }
	}

	/*echo '<pre>';
	print_r();
	echo '</pre>';*/
?>