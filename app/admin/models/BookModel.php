<?php
	require_once EXTENS_PATH.'Upload.php';
	class BookModel extends Model{
		protected $_tableName = 'book';
		public function __construct(){
			parent::__construct();
			$this->setTable($this->_tableName);

		}

		public function listItem($arrData = null, $option = null){
			$query[] = "SELECT `b`.`id`, `b`.`name`, `b`.`description`, `b`.`price`,`b`.`special`, `b`.`sale_off`, `b`.`picture`, `b`.`status`, `b`.`ordering`, `c`.`name` AS `category_name`";
			$query[] = " FROM `".$this->_tableName."` AS `b` LEFT JOIN `category` AS `c` ON `b`.`category_id` = `c`.`id`";
			$query[] = "WHERE `b`.`id` > 0 ";

			// filter : keyword
			
			if(!empty($arrData['filter_search'])){
				$query[] = "AND `b`.`name` LIKE '%".$arrData['filter_search']."%'";
				
			}

			// filter : status
			if(isset($arrData['filter_state'])  && $arrData['filter_state'] != 'default'){
					$query[]	= "AND `b`.`status` = '" . $arrData['filter_state'] . "'";				
			}

			// filter : group
			if(isset($arrData['filter_state_gr'])  && $arrData['filter_state_gr'] != 'default'){
					$query[]	= "AND `b`.`category_id` = '" . $arrData['filter_state_gr'] . "'";				
			}			
			// sort list
			if(!empty($arrData['colum']) && !empty($arrData['columdir'])){
				$colum = $arrData['colum'];
				$columdir = $arrData['columdir'];
				$query[] = "ORDER BY `".$colum."` ".$columdir."";
			}else{
				$query[] = "ORDER BY `b`.`name` ASC ";
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
			$query[] = "SELECT COUNT(`b`.`id`) AS `total`";
			$query[] = " FROM `".$this->_tableName."` AS `b` LEFT JOIN `category` AS `c` ON `b`.`category_id` = `c`.`id`";
			$query[] = "WHERE `b`.`id` > '0' ";

			// filter : keyword
			if(!empty($arrData['filter_search'])){
				$query[] = "AND `name` LIKE '%".$arrData['filter_search']."%'";
			

			// FILTER : STATUS
			if(isset($arrData['filter_state'])  && $arrData['filter_state'] != 'default'){
					$query[]	= "AND `b`.`status` = '" . $arrData['filter_state'] . "'";
				}
			}

			// filter : group
			if(isset($arrData['filter_state_gr'])  && $arrData['filter_state_gr'] != 'default'){
					$query[]	= "AND `b`.`category_id` = '" . $arrData['filter_state_gr'] . "'";				
			}
					
			$query = implode(" ", $query);
			@$result = $this->singleRecord($query);
			return $result['total'];
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
					$query = "UPDATE `".$this->_tableName."` SET `status` = ".$status." WHERE `id` IN (".$idUpdate.");";
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
				$query[] = "SELECT `id`, `name`,`ordering`,`status`,`picture`,`sale_off`, `price`,`special`,`description`,`category_id`";
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
				$infoUser = Session::get('user');				
				$uploadObj = new Upload();
				unset($arrData['form']['token']);
				unset($arrData['form']['filenamepicture']);					
				$arrData['form']['picture'] = $uploadObj->uploadFile($arrData['form']['picture'],'book',array(98=>150, 60=>90));		
				$arrData['form']['created'] 	= date("Y-m-d H:m:s", time());
				$arrData['form']['created_by'] 	= $infoUser['info']['fullname'];
				$newQuery = $this->createInsertSQL($arrData['form']);
				$query 	= "INSERT INTO `".$this->_tableName."`(".$newQuery['cols'].") VALUES (".$newQuery['vals'].")";
				$this->query($query);
				Session::set('message',array('class'=>'success', 'content' => 'Saved'));
				return $this->lastID();				
			}
		}
		public function editItems($arrData = null){
			if(isset($arrData['form'])){
				//remove img, kich thước của img là 60x90, 98x150
				$uploadObj = new Upload();

				$uploadObj->removeFile($arrData['form']['filenamepicture'],'book');
				$fileName98x150 =  '98x150_'.$arrData['form']['filenamepicture'];
				$fileName60x90 =  '60x90_'.$arrData['form']['filenamepicture'];
				$uploadObj->removeFile($fileName98x150,'book');
				$uploadObj->removeFile($fileName60x90,'book');

				// Add img, kich thước của img là 60x90
				$fileNameAdd = $uploadObj->uploadFile($arrData['form']['picture'],'book',array(98=>150, 60=>90));

				// thực hiện edit
				unset($arrData['form']['token']);
				unset($arrData['form']['filenamepicture']);
				$arrData['form']['picture']	= 	$fileNameAdd;
				$set = $this->createUpdateSQL($arrData['form']);
				$where = $this->createWhereUpdate(array('id'=>$arrData['form']['id']));
				$query = "UPDATE `".$this->_tableName."` SET " . $set . " WHERE ".$where."";
				$this->query($query);
				Session::set('message',array('class'=>'success', 'content' => 'Saved'));
				return $arrData['form']['id'];
			}
		}

		//delete item
		public function deleteItems($arrData){
			$idUpdate = $this->createWhereDeleteSQL($arrData['cid']);

			//remove img, kich thước của img là 60x90
			$uploadObj = new Upload();
			$query = "SELECT `id`,`picture` AS `name` FROM ".$this->_tableName." WHERE `id` IN (".$idUpdate.")";
			$arrInfoImg = $this->fetchPairs($query);
			foreach ($arrInfoImg as $key => $value) {
				$uploadObj->removeFile($value,'book');
				$fileName98x150 =  '98x150_'.$value;
				$fileName60x90 =  '60x90_'.$value;
				$uploadObj->removeFile($fileName98x150,'book');
				$uploadObj->removeFile($fileName60x90,'book');				
			}

			// delete 
			if(!empty($arrData['cid'])){
				$query1 = "DELETE FROM `".$this->_tableName."` WHERE `id` IN (".$idUpdate.");";				
				$this->query($query1);
				Session::set('message',array('class'=>'error', 'content' => 'Deleted'));
			}else{
				Session::set('message',array('class'=>'error', 'content' => 'chọn phần tử muốn xóa'));
			}
		}
	}
?>