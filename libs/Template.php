<?php
	
	class Template {

		private $_fileConfig;
		private $_fileTemplate;
		private $_folderTemplate;
		private $_controller;

		public function __construct($controller){
			$this->_controller = $controller;
		}

		public function load(){
			$fileConfig 	= $this->getFileConfig();
			$fileTemplate 	= $this->getFileTemplate();
			$folderTemplate = $this->getFolderTemplate();

			$pathFileConfig = TEMPLATE_PATH .$folderTemplate. $fileConfig;
			if(file_exists($pathFileConfig)){
				$arrFileConfig = @parse_ini_file($pathFileConfig);
				$view = $this->_controller->getView();
				$view->_title 		= $view->creatTitle($arrFileConfig['title']);
				$view->_metaHTTP 	= $view->creatMeta($arrFileConfig['metaHTTP'],'name');
				$view->_metaName 	= $view->creatMeta($arrFileConfig['metaName'], 'http-equiv'); //http-equiv
				$view->_cssFiles 	= $view->creatLink($this->getFolderTemplate().$arrFileConfig['dirCss'],$arrFileConfig['fileCss'],'css');
				@$view->_jsFiles = $view->creatLink($this->getFolderTemplate().$arrFileConfig['dirJs'],$arrFileConfig['fileJs'], 'javascript');

				$view->setTemplatePath(TEMPLATE_PATH .$folderTemplate. $fileTemplate);	
			}
		}	

		public function setFileConfig($value = 'template.ini'){
			$this->_fileConfig = $value;
		}

		public function getFileConfig(){
			return $this->_fileConfig;
		}

		public function setFileTemplate($value = 'index.php'){
			$this->_fileTemplate = $value;
		}

		public function getFileTemplate($value = 'template.ini'){
			return $this->_fileTemplate;
		}

		public function setFolderTemplate($value = 'main'){
			$this->_folderTemplate = $value;
		}

		public function getFolderTemplate(){
			return $this->_folderTemplate;
		}			
	}
		