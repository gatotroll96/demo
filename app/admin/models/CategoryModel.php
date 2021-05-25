<?php
	require_once EXTENS_PATH.'Upload.php';
	class CategoryModel extends Model{
		protected $_tableName = 'category';
		public function __construct(){
			parent::__construct();
			$this->setTable($this->_tableName);

		}

		public function listItem($arrData = null, $option = null){
			$query[] = "SELECT `".$this->_tableName."`.*";
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
				$query[] = "SELECT `id`, `name`,`ordering`,`status`,`picture`";
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
				$arrData['form']['picture'] = $uploadObj->uploadFile($arrData['form']['picture'],'category', array(60=>90));		
				$arrData['form']['created'] 	= date("Y-m-d H:m:s", time());
				$arrData['form']['created_by'] 	= $infoUser['info']['fullname'];
				$newQuery = $this->createInsertSQL($arrData['form']);
				echo $query 	= "INSERT INTO `".$this->_tableName."`(".$newQuery['cols'].") VALUES (".$newQuery['vals'].")";
				$this->query($query);
				Session::set('message',array('class'=>'success', 'content' => 'Saved'));
				return $this->lastID();				
			}
		}
		public function editItems($arrData = null){
			if(isset($arrData['form'])){
				//remove img, kich thước của img là 60x90
				$uploadObj = new Upload();
				$uploadObj->removeFile($arrData['form']['filenamepicture'],'category');
				$fileName60x90 = '60x90_'.$arrData['form']['filenamepicture'];
				$uploadObj->removeFile($fileName60x90,'category');
				// Add img, kich thước của img là 60x90
				$fileNameAdd = $uploadObj->uploadFile($arrData['form']['picture'],'category',array(60=>90));

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
				$uploadObj->removeFile($value,'category');
				$fileName60x90 =  '60x90_'.$value;
				$uploadObj->removeFile($fileName60x90,'category');				
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