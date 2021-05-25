<?php
	
	class Bootstrap{

		public function __construct(){
			$params = array_merge($_GET, $_POST);
			$module = (isset($params['module'])) ? $params['module'] : 'default';
			$controller = (isset($params['controller'])) ? $params['controller'] : 'index';
			$action = (isset($params['action'])) ? $params['action'] : 'index';

			$actionName = $action . 'Action';
			$controllerName = ucfirst($controller) . 'Controller';
			$filePath = APPLICATION_PATH . $module . DS . 'controllers' . DS . $controllerName . '.php';

			if(file_exists($filePath)){
				require_once $filePath;
				$controllerObject = new $controllerName();
				$linkBackHome = URL::createLink('default','index','notice',array('type'=>'back-home'));

				if(method_exists($controllerObject,$actionName) == true){
					$userInfo 	= Session::get('user');
					@$logged 	= ($userInfo['login'] == true && $userInfo['time'] + TIME_LOGIN >= time());
					$pageLogin 	= ($controller == 'index') && ($action =='login');
					if($module == 'admin'){
						if($logged == true){
							if($userInfo['group_acp'] == 1){
								if($pageLogin == true){
									header('location: index.php?module=admin&controller=index&action=index');
	    							exit();
	    						}else{
									$controllerObject->$actionName();
								}
							}else{
								Session::delete('user');
								$linkDirectional = URL::createLink('default','index','notice',array('type'=>'not-permission'));
								header('location: '.$linkDirectional.'');
	    						exit();
							}
						}else{
							Session::delete('user');
							if($pageLogin == true){	$controllerObject->$actionName();}
							if($pageLogin == false){
								header('location: index.php?module=admin&controller=index&action=login');
	    						exit(); 
							}
						}
					}else if($module == 'default'){
						if($logged == true){
							$checkAction = ($action == 'login') || ($action =='register');
							if($controller == 'user' && $checkAction == true){
								header('location: index.php?module=default&controller=index&action=index');
	    						exit();
							}else{
								$controllerObject->$actionName();
							}
						}else{
							Session::delete('user');
							if($controller == 'user' && $action == 'index' || $action == 'history'){
								header('location: index.php?module=default&controller=index&action=login');
	    						exit();
							}else{
								$controllerObject->$actionName();
							}																	
						}
					}
					$controllerObject->$actionName();
				}else{					
					header('location: '.$linkBackHome.'');
	    			exit();
				}
			}else{
				header('location: '.$linkBackHome.'');
	    		exit();
			}	
		}

		public function _error(){
			require_once APPLICATION_PATH . 'default' . DS . 'controllers' . DS . 'ErrorController.php';
			$errorController = new ErrorController();
			$errorController->IndexAction();
		}
	}