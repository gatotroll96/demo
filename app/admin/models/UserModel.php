<?php
	class UserModel extends Model{
		protected $_tableName = 'user';

		public function __construct(){
			parent::__construct();
			$this->setTable($this->_tableName);
		}

		public function listItem($arrData = null, $option = null){
			$query[] = "SELECT `u`.`id`, `u`.`username`, `u`.`email`, `u`.`fullname`, `u`.`created`, `u`.`created_by`, `u`.`modified`, `u`.`modified_by`, `u`.`status`, `u`.`ordering`, `g`.`name` AS `group_name`";
			$query[] = " FROM `".$this->_tableName."` AS `u` LEFT JOIN `group` AS `g` ON `u`.`group_id` = `g`.`id`";
			$query[] = "WHERE `u`.`id` > 0 ";

			// filter : keyword
			
			if(!empty($arrData['filter_search'])){
				$query[] = "AND `username` LIKE '%".$arrData['filter_search']."%'";
				
			}

			// filter : status
			if(isset($arrData['filter_state'])  && $arrData['filter_state'] != 'default'){
					$query[]	= "AND `u`.`status` = '" . $arrData['filter_state'] . "'";				
			}

			// filter : group
			if(isset($arrData['filter_state_gr'])  && $arrData['filter_state_gr'] != 'default'){
					$query[]	= "AND `u`.`group_id` = '" . $arrData['filter_state_gr'] . "'";				
			}			
			// sort list
			if(!empty($arrData['colum']) && !empty($arrData['columdir'])){
				$colum = $arrData['colum'];
				$columdir = $arrData['columdir'];
				$query[] = "ORDER BY `".$colum."` ".$columdir."";
			}else{
				$query[] = "ORDER BY `u`.`username` ASC ";
			}

			// pagination			
			$totalItemsPerPage = 7;
			$currentPage = (isset($arrData['filter_page'])) ? $arrData['filter_page'] : 1;
			$start = 	($currentPage - 1) * $totalItemsPerPage;
			$query[] = "LIMIT ".$start." , ".$totalItemsPerPage."";


			$query = implode(" ", $query);
			@$result = $this->listRecord($query);
			return $result;
		}

		public function countItem($arrData = null, $option = null){
			$query[] = "SELECT COUNT(`u`.`id`) AS `total`";
			$query[] = " FROM `".$this->_tableName."` AS `u` LEFT JOIN `group` AS `g` ON `u`.`group_id` = `g`.`id`";
			$query[] = "WHERE `u`.`id` > '0' ";

			// filter : keyword
			if(!empty($arrData['filter_search'])){
				$query[] = "AND `name` LIKE '%".$arrData['filter_search']."%'";
			

			// FILTER : STATUS
			if(isset($arrData['filter_state'])  && $arrData['filter_state'] != 'default'){
					$query[]	= "AND `u`.`status` = '" . $arrData['filter_state'] . "'";
				}
			}

			// filter : group
			if(isset($arrData['filter_state_gr'])  && $arrData['filter_state_gr'] != 'default'){
					$query[]	= "AND `u`.`group_id` = '" . $arrData['filter_state_gr'] . "'";				
			}
					
			$query = implode(" ", $query);
			@$result = $this->listRecord($query);
			return $result[0]['total'];
		}
		// sử dụng để thay đổi status
		public function changeStatus($arrData = null, $option = null){
			if($option['task'] == 'change-ajax-status'){
				$status = ($arrData['status'] == 0) ? 1 : 0;
				$id = $arrData['id'];
				$query 	= "UPDATE `".$this->_tableName."` SET `status` = ".$status." WHERE `id` = ".$arrData['id']."";
				$result = $this->query($query);
				return array($id, $status, URL::createLink('admin', 'group', 'ajaxStatus', array('id'=>$id, 'status'=>$status)));
			}else if($option['task'] == 'change-status'){
				$status = $arrData['type'];
				$idUpdate = $this->createWhereDeleteSQL($arrData['cid']);
				if(!empty($arrData['cid'])){
					$query = "UPDATE `user` SET `status` = ".$status." WHERE `id` IN (".$idUpdate.");";				
					$this->query($query);
					Session::set('message',array('class'=>'success', 'content' => 'status đã đc thay đổi'));						
				}else{
					Session::set('message',array('class'=>'error', 'content' => 'chọn status muốn thay đổi'));	
				}
							
			}
		}

		// get info cho edit items
		public function infoItems($arrData = null, $option = null){
			if($option == null){
				$query[] = "SELECT `id`, `username`,`email`,`fullname`,`group_id`,`ordering`,`status`";
				$query[] = " FROM `".$this->_tableName."`";
				$query[] = "WHERE `id` = ".$arrData['id']."";
				$query = implode(" ", $query);
				$result = $this->singleRecord($query);
				return $result;
			}
		}

		// get item gr cho select gr phần user
		public function getItemsGroup(){
			$query = "SELECT `id`, `name` FROM `group`";
			$result = array('default' => 'Select Group');
			$resultQuery = $this->query($query);
			if(mysqli_num_rows($resultQuery) > 0){				
				while($row = mysqli_fetch_assoc($resultQuery)){
					$result[$row['id']] = $row['name'];
				}
			}
			return 	$result;		
		}

		// ADD Item
		public function addItems($arrData = null){
			if(isset($arrData['form'])){
				unset($arrData['form']['token']);
				$this->setTable($this->_tableName);
				$newQuery = $this->createInsertSQL($arrData['form']);
				$query 	= "INSERT INTO `$this->table`(".$newQuery['cols'].") VALUES (".$newQuery['vals'].")";
				$this->query($query);
				Session::set('message',array('class'=>'success', 'content' => 'Saved'));
				return $this->lastID();				
			}
		}
		public function editItems($arrData = null){
			if(isset($arrData['form'])){
				unset($arrData['form']['token']);
				$this->setTable($this->_tableName);
				$set = $this->createUpdateSQL($arrData['form']);
				$where = $this->createWhereUpdate(array('id'=>$arrData['form']['id']));
				$query = "UPDATE `$this->table` SET " . $set . " WHERE ".$where."";
				$this->query($query);
				Session::set('message',array('class'=>'success', 'content' => 'Saved'));
				return $arrData['form']['id'];
			}
		}

		//delete item
		public function deleteItems($arrData){
			$idUpdate = $this->createWhereDeleteSQL($arrData['cid']);
			if(!empty($arrData['cid'])){
				$query = "DELETE FROM `user` WHERE `id` IN (".$idUpdate.");";				
				$this->query($query);
			}
			Session::set('message',array('class'=>'success', 'content' => 'ĐÃ XÓA'));
		}		
	}