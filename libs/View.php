<?php
	
	class View
	{
		public $_moduleName;
		public $_templatePath;
		public $_title;
		public $_metaHTTp;
		public $_metaName;
		public $_cssFiles;
		public $_jsFiles;
		public $_fileView;
		public $_arrGetPost;


		public function __construct($module){
			$this->_moduleName 	= isset($module) ? $module : 'default';
		}

	    public function render($fileInclude, $loadfull = true){
	    	$path = APPLICATION_PATH . $this->_moduleName .DS. 'views' .DS. $fileInclude . '.php';
	    	if(file_exists($path)){
	    		if($loadfull == true){	    		
	    			$this->_fileView = $fileInclude;
	    			require_once $this->_templatePath;	    			
	    		}else{
	    			require_once $path;
	    		}
	    	}else{
	    		$path = APPLICATION_PATH . 'default' .DS. 'views' .DS. $fileInclude . '.php';
	    		require_once $path;   		
	    	}   		    	
	    }
	   	// thiết lập đường dẫn Template
	    public function setTemplatePath($path){
	    	$this->_templatePath = $path;
	    }
	    // SET TITLE
	    public function setTitle($value){
	     	$this->_title = '<title>' .$value. '</title>';
	    }	   

	    // SET CSS 
		public function appendCSS($arrayCSS){
			if(!empty($arrayCSS)){
				foreach ($arrayCSS as $css){
					$file = APPLICATION_URL . $this->_moduleName . DS . 'views' . DS . $css;
					$this->_cssFiles .= '<link rel="stylesheet" type="text/css" href="'.$file.'"/>';
				}
			}
		}
	
		// SET JS
		public function appendJS($arrayJS){
			if(!empty($arrayJS)){
				foreach ($arrayJS as $js){
					$file = APPLICATION_URL . $this->_moduleName . DS . 'views' . DS . $js;
					$this->_jsFiles .= '<script type="text/javascript" src="'.$file.'"></script>';
				}
			}
		}

	    public function creatTitle($value){
			return '<title>' .$value. '</title>';
		}

	    // value là arr giá trị của thuộc tính trong thẻ meta , nameMeta là thuộc tính name or http-equiv
		public function creatMeta($value, $nameMeta){
			$xhtml = '';
			if(!empty($value)){
				foreach ($value as $key => $Meta){
					$explodeMeta = explode('|',$Meta);
					$xhtml .= '<meta '.$nameMeta.'="'.$explodeMeta[0].'" content= "'.$explodeMeta[1].'"/><br/>';
				}
			}
			return $xhtml;
		}

		// tạo link css, js,...
		public function creatLink($path, $file, $type = 'css'){
			$xhtml = '';
			$creatPath = TEMPLATE_URL . $path;
			if(!empty($file)){
				foreach ($file as $key => $value){
					if($type =='css'){
						$xhtml .= '<link rel="stylesheet" type="text/css" href="'.$creatPath.DS.$value.'" />';
					}else if ($type == 'javascript') {
						$xhtml .= '<script src="'.$creatPath.DS.$value.'" type="text/javascript"></script>';						
					}
				}
			}
			return $xhtml;
		}
	}
