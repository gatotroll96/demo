<?php
	class URL{
		public static function createLink($module, $controller, $action, $arr = null, $router = null){
			$link = '';
			if(!empty($router)) return ROOT_URL . $router;
			
			if(!empty($arr)){
				foreach ($arr as $key => $value) {
					$link .= '&'.$key. '=' .$value;
				}
			}
			$url = 'index.php?module='.$module.'&controller='.$controller.'&action='.$action.$link;
			return $url;
		}
	}