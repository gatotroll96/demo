<?php
	include_once 'toolbar/index.php';
	include_once 'submenu/index.php';
	echo @$this->errorValidate;
	echo Helper::cmsMessage(@$_SESSION['message']);
    Session::delete('message');
?>	
<div id="element-box">
	<div class="m">
		<form action="#" method="post" name="adminForm" id="adminForm" class="form-validate" enctype="multipart/form-data">
			<!-- FORM LEFT -->
			<?php
				$valuePicture = "";
				$picture = "";
				$rowID = "";
				if(isset($this->_arrGetPost['id']) || !empty($this->_arrGetPost['form']['id'])){
					$valueID = (isset($this->data['id'])) ? $this->data['id'] : $this->_arrGetPost['form']['id'];
					$inputID = Helper::cmsInput('text','form[id]' , 'id', $valueID, 'inputbox readonly' , 40);
					$rowID = Helper::cmsRowForm('ID', $inputID);
					$valueName = (isset($this->data['name'])) ? $this->data['name'] : $this->_arrGetPost['form']['name'];
					$keySelectStatus = (isset($this->data['status'])) ? $this->data['status'] : $this->_arrGetPost['form']['status'];					
					$valueOrdering = (isset($this->data['ordering'])) ? $this->data['ordering'] : $this->_arrGetPost['form']['ordering'];
					$valuePicture = (isset($this->data['picture'])) ? $this->data['picture'] : $this->_arrGetPost['form']['filenamepicture'];
					$linkPicture = UPLOAD_URL .'category'.DS.'60x90_'.$valuePicture;
					$picture = '<li><label><img src="'.$linkPicture.'"/></label></li>';
				}else{
					$valueName = (!empty($this->_arrGetPost['form']['name'])) ? $this->_arrGetPost['form']['name'] : "";
					$keySelectStatus = (!empty($this->_arrGetPost['form']['status'])) ? $this->_arrGetPost['form']['status'] : "";
					
					$valueOrdering = (!empty($this->_arrGetPost['form']['ordering'])) ? $this->_arrGetPost['form']['ordering'] : "";					
				}
				// thẻ input Name
				$inputName = Helper::cmsInput('text', 'form[name]','name',$valueName , 'inputbox required', 40);
				$rowName = Helper::cmsRowForm('Name',$inputName,true);

				// thẻ selec cho status				
				$selectBoxStatus = Helper::craeteSelectbox('form[status]',"", array('default' => 'Select Status', '1' => '-publish-', '0' => '-unpublish-'),$keySelectStatus);
				$rowStatus = Helper::cmsRowForm('Status', $selectBoxStatus);
				
								
				// thẻ input cho Ordering				
				$inputOrdering = Helper::cmsInput('text', 'form[ordering]','ordering', $valueOrdering, null, 40);
				$rowOrdering = Helper::cmsRowForm('Ordering', $inputOrdering);

				// the input va row cho file
				$inputFileImg = Helper::cmsInput('file', 'picture','picture', "",'inputbox', 50);
				$rowFileImg = Helper::cmsRowForm('Picture', $inputFileImg);				

			?>
			<div class="width-100 fltlft">
				<fieldset class="adminform">
					<legend>Details</legend>
					<ul class="adminformlist">
						<?php 
							echo $rowName;
							echo $rowStatus;
							echo $rowOrdering;
							echo $rowFileImg;
							echo @$picture;
							echo $rowID;
						?>
					</ul>
					<div class="clr"></div>
					<div>
						<input type="hidden" name="form[token]" value="<?php echo time(); ?>">
						<input type="hidden" name="form[filenamepicture]" value="<?php echo $valuePicture; ?>">
					</div>
				</fieldset>
			</div>
			<div class="clr"></div>
			<div>
			</div>
		</form>
		<div class="clr"></div>
	</div>
</div>

<?php