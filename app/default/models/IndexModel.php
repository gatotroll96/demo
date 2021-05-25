<?php
	class IndexModel extends Model{
		protected $_tableName = 'book';
		public function __construct(){
			parent::__construct();
		}

		public function listItem($arrData, $option= null){
			// list cho phần special book
			if($option == 'special-book'){
				$query[] = "SELECT * FROM `".$this->_tableName."`";
				$query[] = "WHERE `status` = 1 AND `special` = 1";
				$query[] = "ORDER BY `ordering` ASC";
				$query[] = "LIMIT 0 , 2";
			}

			// list cho phần new book
			if($option == 'new-book'){
				$query[] = "SELECT * FROM `".$this->_tableName."`";
				$query[] = "WHERE `status` = 1";
				$query[] = "ORDER BY `id` DESC";
				$query[] = "LIMIT 0 , 3";
			}

			


			$query = implode(" ", $query);
			@$result = $this->listRecord($query);
			return $result;
		}
		
	}