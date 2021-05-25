<?php
	include_once 'toolbar/index.php';
	include_once 'submenu/index.php';
	echo @$this->errorValidate;
	echo Helper::cmsMessage(@$_SESSION['message']);
    Session::delete('message');
?>	
<div id="element-box">
	<div class="m">
		<form action="#" method="post" name="adminForm" id="adminForm" class="form-validate">
			<!-- FORM LEFT -->
			<?php
				
				
				$rowID = "";
				if(isset($this->_arrGetPost['id'])){
					$valueID = $this->_arrGetPost['id'];
					$inputID = Helper::cmsInput('text','form[id]' , 'id', $valueID, 'inputbox readonly' , 40);
					$rowID = Helper::cmsRowForm('ID', $inputID);
					$valueName = $this->data['name'];
					$keySelectStatus = $this->data['status'];
					$keySelectGrAcp = $this->data['group_acp'];
					$valueOrdering = $this->data['ordering'];
				}else{
					$valueName = (!empty($this->_arrGetPost['form']['name'])) ? $this->_arrGetPost['form']['name'] : "";
					$keySelectStatus = (!empty($this->_arrGetPost['form']['status'])) ? $this->_arrGetPost['form']['status'] : "";
					$keySelectGrAcp = (!empty($this->_arrGetPost['form']['group_acp'])) ? $this->_arrGetPost['form']['group_acp'] : "";
					$valueOrdering = (!empty($this->_arrGetPost['form']['ordering'])) ? $this->_arrGetPost['form']['ordering'] : "";
				}
				// thẻ input Name
				$inputName = Helper::cmsInput('text', 'form[name]','name',$valueName , 'inputbox required', 40);
				$rowName = Helper::cmsRowForm('Name',$inputName,true);
				// thẻ selec cho status
				
				$selectBoxStatus = Helper::craeteSelectbox('form[status]',"", array('default' => 'Select Status', '1' => '-publish-', '0' => '-unpublish-'),$keySelectStatus);
				$rowStatus = Helper::cmsRowForm('Status', $selectBoxStatus);
				// thẻ seclec cho Gr ACP
				
				$selectBoxGrACP = Helper::craeteSelectbox('form[group_acp]',"", array('default' => 'Select Group Acp', '1' => '1', '0' => '0'),$keySelectGrAcp);
				$rowGrACP = Helper::cmsRowForm('Group ACP', $selectBoxGrACP);
				// thẻ input cho Ordering
				
				$inputOrdering = Helper::cmsInput('text', 'form[ordering]','ordering', $valueOrdering, null, 40);
				$rowOrdering = Helper::cmsRowForm('Ordering', $inputOrdering);
				//ID cho edit (readonly)
				

			?>
			<div class="width-100 fltlft">
				<fieldset class="adminform">
					<legend>Details</legend>
					<ul class="adminformlist">
						<?php 
							echo $rowName;
							echo $rowStatus;
							echo $rowGrACP;
							echo $rowOrdering;
							echo $rowID;
						?>
					</ul>
					<div class="clr"></div>
					<div>
						<input type="hidden" name="form[token]" value="<?php echo time(); ?>">
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
