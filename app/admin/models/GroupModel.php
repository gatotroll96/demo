<?php
	class GroupModel extends Model{
		protected $_tableName = 'group';

		public function __construct(){
			parent::__construct();
			$this->setTable($this->_tableName);
		}

		public function listItem($arrData = null, $option = null){
			$query[] = "SELECT `group`.*";
			$query[] = " FROM `".$this->_tableName."`";

			// filter : keyword
			$flagWhere = false;
			if(!empty($arrData['filter_search'])){
				$query[] = "WHERE `name` LIKE '%".$arrData['filter_search']."%'";
				$flagWhere	= true;
			}

			// filter : status
			if(isset($arrData['filter_state'])  && $arrData['filter_state'] != 'default'){
				if($flagWhere == true){
					$query[]	= "AND `status` = '" . $arrData['filter_state'] . "'";
				}else{
					$query[]	= "WHERE `status` = '" . $arrData['filter_state'] . "'";
					$flagWhere	= true;
				}
			}
			// sort list
			if(!empty($arrData['colum']) && !empty($arrData['columdir'])){
				$colum = $arrData['colum'];
				$columdir = $arrData['columdir'];
				$query[] = "ORDER BY `".$colum."` ".$columdir."";
			}else{
				$query[] = "ORDER BY `id` DESC";
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
			$query[] = "SELECT COUNT(`id`) AS `total`";
			$query[] = " FROM `".$this->_tableName."`";

			// filter : keyword
			$flagWhere = false;
			if(!empty($arrData['filter_search'])){
				$query[] = "WHERE `name` LIKE '%".$arrData['filter_search']."%'";
				$flagWhere	= true;
			}

			// FILTER : STATUS
			if(isset($arrData['filter_state'])  && $arrData['filter_state'] != 'default'){
				if($flagWhere == true){
					$query[]	= "AND `status` = '" . $arrData['filter_state'] . "'";
				}else{
					$query[]	= "WHERE `status` = '" . $arrData['filter_state'] . "'";
					$flagWhere	= true;
				}
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
					$query = "UPDATE `group` SET `status` = ".$status." WHERE `id` IN (".$idUpdate.");";				
					$this->query($query);
					Session::set('message',array('class'=>'success', 'content' => 'status đã đc thay đổi'));						
				}else{
					Session::set('message',array('class'=>'error', 'content' => 'chọn status muốn thay đổi'));	
				}
							
			}
		}
		public function infoItems($arrData = null, $option = null){
			if($option == null){
				$query[] = "SELECT `id`, `name`,`group_acp`,`ordering`,`status`";
				$query[] = " FROM `".$this->_tableName."`";
				$query[] = "WHERE `id` = ".$arrData['id']."";
				$query = implode(" ", $query);
				$result = $this->singleRecord($query);
				return $result;
			}
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
				$query = "DELETE FROM `group` WHERE `id` IN (".$idUpdate.");";				
				$this->query($query);
			}
		}		
	}