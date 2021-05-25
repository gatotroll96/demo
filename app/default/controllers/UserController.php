<?php
	class UserController extends Controller{
		public function __construct(){
			parent::__construct();
		}		

	    // đăng ký 
	   	public function registerAction(){
			$this->_templateObj->setFileConfig('template.ini');
	    	$this->_templateObj->setFileTemplate('index.php');
	    	$this->_templateObj->setFolderTemplate('default/main/');
	    	$this->_templateObj->load();
	    	$this->_view->setTitle('Đăng Ký');
	    	

			if(isset($this->_arrData['form']['submit'])){
				if(Session::get('token') == $this->_arrData['form']['token']){
					Session::delete('token');
					header('location: index.php?module=default&controller=user&action=register');
	    			exit();
				}else{
					Session::set('token', $this->_arrData['form']['token']);
				}
				$validate  = new Validate($this->_arrData['form']);
				$queryEmail = "SELECT `id` FROM `user` WHERE `email` = '".$this->_arrData['form']['email']."'";
    			$queryUserName = "SELECT `id` FROM `user` WHERE `username` = '".$this->_arrData['form']['username']."'";   			   				
	    		$validate->addRule('username', 'string-notexistRecord', array('min'=> 3, 'max'=>40,'database'=>$this->_db, 'query' => $queryUserName));	    			    		
	    		$validate->addRule('email', 'email-notexistRecord' , array('database'=>$this->_db,'query' => $queryEmail));
	    		$validate->addRule('password', 'password' , array('action'=>'add'));
		    	$validate->run();
	    		
	    		if($validate->isValid()== false){
	    			$this->_view->errorValidate = $validate->showErrorsPublic();
	    		}else{
	    			$dataActive = $this->_db->regiserUser($this->_arrData);
	    			$linkRegisterSuccess = URL::createLink('default','index','notice',array('type' => 'register-success'));
	    			/*$to = $dataActive['email'];
	    			$subject = "ACTIVE ACCOUNT";
	    			$linkActive = URL::createLink('default', 'user' , 'active' , array('id'=> $dataActive['id'],'code'=>$dataActive['active_code']));
	    			$header = "From: bookstore@example.com";
	    			mail($to,$subject,$linkActive,$header);*/
	    			header('location: '.$linkRegisterSuccess.'');
	    			exit();
	    		}
			}	    	
	    	$this->_view->render('user\register',true);
	    }

	    public function activeAction(){
	    	echo '<pre>';
			print_r($this->_arrData);
			echo '</pre>';
	    }

	    public function loginAction(){
			$this->_templateObj->setFileConfig('template.ini');
	    	$this->_templateObj->setFileTemplate('index.php');
	    	$this->_templateObj->setFolderTemplate('default/main/');
	    	$this->_templateObj->load();
	    	$this->_view->setTitle('Đăng Nhập');
			if(@$this->_arrData['form']['token'] > 0){				
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
		    		header('location: index.php?module=default&controller=index&action=index');
		    		exit();
		    	}				
			}
	    	$this->_view->render('user\login',true);
	    }

	    public function indexAction(){
	    	$this->_templateObj->setFileConfig('template.ini');
	    	$this->_templateObj->setFileTemplate('index.php');
	    	$this->_templateObj->setFolderTemplate('default/main/');
	    	$this->_templateObj->load();
	    	$this->_view->render('user\index',true);
	    }

	    public function historyAction(){
	    	$this->_templateObj->setFileConfig('template.ini');
	    	$this->_templateObj->setFileTemplate('index.php');
	    	$this->_templateObj->setFolderTemplate('default/main/');
	    	$this->_templateObj->load();
	    	$this->_view->historyBuy = $this->_db->infoCart();

	    	$this->_view->render('user\history',true);
	    }


	}