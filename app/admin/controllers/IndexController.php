<?php		
	class IndexController extends Controller{
	
	    public function __construct(){
	    	parent::__construct();
	    	
	    }
	    public function indexAction(){
	    	$this->_templateObj->setFileConfig('template.ini');
	    	$this->_templateObj->setFileTemplate('index.php');
	    	$this->_templateObj->setFolderTemplate('admin/main/');
	    	$this->_templateObj->load();	    	
	    	$this->_view->imagesUrl = TEMPLATE_URL . $this->_templateObj->getFolderTemplate();
	    	$this->_view->setTitle('Administration');
	    	$this->_view->render('index\index',true);
	    }


	    public function profileAction(){
	    	$this->_templateObj->setFileConfig('template.ini');
	    	$this->_templateObj->setFileTemplate('index.php');
	    	$this->_templateObj->setFolderTemplate('admin/main/');
	    	$this->_templateObj->load();
	    	
	    	$this->_view->setTitle('My Profile');
	    	$this->_view->render('index\profile',true);
	    }


	    public function loginAction(){
	    	$this->_templateObj->setFileConfig('template.ini');
	    	$this->_templateObj->setFileTemplate('login.php');
	    	$this->_templateObj->setFolderTemplate('admin/main/');
	    	$this->_templateObj->load();
	    	$this->_view->setTitle('Login');
	    	

			if(@$this->_arrData['form']['token'] > 0){
				echo '<pre>';
			print_r($this->_arrData);
			echo '</pre>';				
				$username = $this->_arrData['form']['username'];
				$password = $this->_arrData['form']['password'];
				// query de validate
				$query = "SELECT `id` FROM `user` WHERE `username` = '".$username."' AND `password` = '".$password."'";
				$validate = new Validate($this->_arrData['form']);
				$validate->addRule('username', 'existRecord', array('database'=>$this->_db, 'query' => $query));
				$validate->run();
				if($validate->isValid() == false){
	    			$this->_view->errorValidate = $validate->showErrors();
		    	}else{
		    		$infoUser = $this->_db->infoUser($this->_arrData['form']);
		    		$arrSession = array('login' => 	true,
		    							'info' 	=>	$infoUser,
		    							'time'	=> time(),
		    							'group_acp' =>	$infoUser['group_acp']);
		    		Session::set('user',$arrSession);
		    		header('location: index.php?module=admin&controller=index&action=index');
		    		exit();
		    	}				
			}
			
	    	$this->_view->render('index\login',true);	    	
	    }

	    public function logoutAction(){
	    	Session::delete('user');
	    	header('location: index.php?module=admin&controller=index&action=login');
		    exit();
	    }
	}
	

	/*echo '<pre>';
	print_r($this->_db->infoUser($this->_arrData['form']));
	echo '</pre>';*/