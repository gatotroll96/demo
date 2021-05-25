<?php
	class CategoryModel extends Model{
		protected $_tableName = 'category';
		public function __construct(){
			parent::__construct();
		}

		public function listItem($arrData){
			$query[] = "SELECT * FROM `".$this->_tableName."`";
			$query[] = "WHERE `status` = 1";
			$query[] = "ORDER BY `ordering` ASC";

			// pagination			
			$totalItemsPerPage = 7;
			$currentPage = (isset($arrData['page'])) ? $arrData['page'] : 1;
			$start = 	($currentPage - 1) * $totalItemsPerPage;
			$query[] = "LIMIT ".$start." , ".$totalItemsPerPage."";

			$query = implode(" ", $query);
			@$result = $this->listRecord($query);
			return $result;
		}

		//count item 
		public function countItem(){
			$query[] = "SELECT COUNT(`id`) AS `total`";
			$query[] = "FROM `".$this->_tableName."`";
			$query[] = "WHERE `status` = 1";

			$query = implode(" ", $query);
			@$result = $this->singleRecord($query);
			return $result['total'];
		}
		
	}
?>

<!-- echo '<pre>';
	print_r();
	echo '</pre>'; -->