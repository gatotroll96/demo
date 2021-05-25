<?php
	class UserModel extends Model{
		protected $_tableName = 'user';
		public function __construct(){
			parent::__construct();
			$this->setTable($this->_tableName);
		}

		public function regiserUser($arrData){
			
				unset($arrData['form']['token']);
				unset($arrData['form']['submit']);
				$arrData['form']['register_ip'] = $_SERVER['REMOTE_ADDR'];
				$arrData['form']['status'] 		= 0;
				$arrData['form']['active_code'] = uniqid();
				$arrData['form']['created']	= date("Y-m-d H:m:s", time());
				$this->setTable($this->_tableName);
				$newQuery = $this->createInsertSQL($arrData['form']);
				$query 	= "INSERT INTO `".$this->_tableName."`(".$newQuery['cols'].") VALUES (".$newQuery['vals'].")";
				$this->query($query);

				$lastID = $this->lastID();
				$query1[] = "SELECT `id`,`email`,`active_code`";
				$query1[] = " FROM `".$this->_tableName."`";
				$query1[] = "WHERE `id` = ".$lastID."";
				$query1 = implode(" ", $query1);
				$result = $this->singleRecord($query1);							
			
			return $result;
		}

		public function infoUser($arrData, $option = null){
			$query[] = "SELECT `u`.`id`,`fullname`,`email`,`username`,`u`.`group_id`, `g`.`group_acp`";
			$query[] = "FROM `user` AS `u` LEFT JOIN `group` AS `g` ON `u`.`group_id` = `g`.`id`";
			$query[] = "WHERE `username` = '".$arrData['username']."' AND `password` = '".$arrData['password']."'";
			$query = implode(" ", $query);
			return $this->singleRecord($query);
		}

		public function infoCart(){
			$userInfo = Session::get('user');
			$username	= $userInfo['info']['username'];
			$query[] = "SELECT `id`, `books`, `prices`, `quantities`, `total`, `names`, `pictures`, `date`";
			$query[] = "FROM `cart`";
			$query[] = "WHERE `username` = '".$username."'";
			$query = implode(" ", $query);
			return $this->listRecord($query);
		}

		
	}