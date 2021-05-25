<?php
	
	require_once SCRIPTS_PATH.'PhpThumb'.DS.'ThumbLib.inc.php';	 	
	class Upload{
		// array(60=>90) ==> $key là width, value = height
		public function uploadFile($file, $folder, $array ,$option = null){
			if($option == null){
				if(!empty($file['tmp_name'])){
					$uploadDir 		= UPLOAD_PATH.$folder.DS;
					$newFileName 	= uniqid();
					$extension 		= '.'.pathinfo($file['name'], PATHINFO_EXTENSION);
					$fileName 		= $uploadDir.$newFileName.$extension;

					copy($file['tmp_name'], $fileName);

					
					foreach ($array as $key => $value) {
						$thumb = PhpThumbFactory::create($fileName);
						$thumb->resize($key,$value);
						$thumb->save($uploadDir.$key.'x'.$value.'_'.$newFileName.$extension);
					}
					
				}
			}
			return $newFileName.$extension;
		}

		public function removeFile($file, $folder){
			$fileName 		= UPLOAD_PATH.$folder.DS.$file;
			unlink($fileName);
		}
	}
?>