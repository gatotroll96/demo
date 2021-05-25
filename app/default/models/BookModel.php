<?php
	class BookModel extends Model{
		protected $_tableName = 'book';
		public function __construct(){
			parent::__construct();
		}

		public function listItem($arrData){
			$query[] = "SELECT * FROM `".$this->_tableName."`";
			$query[] = "WHERE `status` = 1 AND `category_id` = ".$arrData['ctgr']."";
			$query[] = "ORDER BY `ordering` ASC";

			// pagination			
			$totalItemsPerPage = 7;
			$currentPage = (isset($arrData['page'])) ? $arrData['page'] : 1;
			$start = 	($currentPage - 1) * $totalItemsPerPage;
			$query[] = "LIMIT ".$start." , ".$totalItemsPerPage."";

			echo $query = implode(" ", $query);
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

		// info category
		public function infoItems($arrData, $option = null){
			// lấy info name của category
			if($option == 'get-cat-name'){
				$query = "SELECT `name` FROM `category` WHERE `id` = ".$arrData['ctgr']."";
				$result = $this->singleRecord($query);
				return $result;
			}

			// detail book
			if($option == 'get-detail-book'){
				$query[] = "SELECT `id`,`name`, `picture`, `price`,`sale_off`,`description`";
				$query[] = "FROM `".$this->_tableName."`";
				$query[] = "WHERE `id` = ".$arrData['b_id']."";

				$query = implode(" ", $query);
				@$result = $this->singleRecord($query);
				return $result;
			}

			if($option == 'get-related-book'){
				$data = $this->getCategory($arrData['b_id']);
				$query[] = "SELECT `name`, `picture` , `id` , `sale_off`";
				$query[] =  "FROM `".$this->_tableName."`";
				$query[] = "WHERE `status` = 1 AND `category_id` = ".$data['category_id']."";
				$query[] = "AND `id` <> ".$arrData['b_id']."";

				$query = implode(" ", $query);
				@$result = $this->listRecord($query);
				return $result;
			}

			if($option == 'get-list-cart'){
				$data = Session::get('cart');
				$id = "";
				if(!empty($data)){
					foreach ($data['quantity'] as $key => $value) {
						$id .= $key.',';
					}
				}
				
				$query[] = "SELECT `name`, `picture` , `id`";
				$query[] =  "FROM `".$this->_tableName."`";
				$query[] = "WHERE `id` IN (".$id."0)";
				
				$query = implode(" ", $query);
				@$result = $this->listRecord($query);
				return $result;
			}
		}

		private function getCategory($arrData){
			$query = "SELECT `category_id` FROM `book` WHERE `id` = ".$arrData."";
			$result = $this->singleRecord($query);
			return $result;
		}

		public function saveHistoryBuy($arrData){
			$userInfo = Session::get('user');
			$username	= $userInfo['info']['username'];
			$id			= uniqid();			
			$books		= json_encode($arrData['form']['bookid']);
			$prices		= json_encode($arrData['form']['unitprice']);
			$quantities	= json_encode($arrData['form']['quantity']);
			$names		= json_encode($arrData['form']['name'],JSON_UNESCAPED_UNICODE);
			$pictures	= json_encode($arrData['form']['picture']);
			$total		= json_encode($arrData['form']['total']);
			$date		= date('Y-m-d H:i:s', time());

			$query[] = "INSERT INTO `cart`(`id`, `username`, `books`, `prices`, `quantities`, `total`, `names`, `pictures`, `status`, `date`)";
			$query[] = "VALUES ('$id', '$username', '$books', '$prices', '$quantities', '$total', '$names', '$pictures', '0', '$date')";

			$query = implode(" ", $query);
			$this->query($query);
			Session::delete('cart');
			header('location: index.html');
	    	exit();
		}	
	}
?>

<!-- echo '<pre>';
	print_r();
	echo '</pre>'; -->