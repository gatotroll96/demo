<?php
	class IndexModel extends Model{
		protected $_tableName = 'user';

		public function __construct(){
			parent::__construct();
			$this->setTable($this->_tableName);
		}

		public function infoUser($arrData, $option = null){
			$query[] = "SELECT `u`.`id`,`fullname`,`username`,`email`,`u`.`group_id`, `g`.`group_acp`";
			$query[] = "FROM `user` AS `u` LEFT JOIN `group` AS `g` ON `u`.`group_id` = `g`.`id`";
			$query[] = "WHERE `username` = '".$arrData['username']."' AND `password` = '".$arrData['password']."'";
			echo $query = implode(" ", $query);
			return $this->singleRecord($query);
		}
	}