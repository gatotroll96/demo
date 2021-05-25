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
				
				// xử lý để lấy value cho các thẻ input bên dưới
				$rowID = "";
				if(isset($this->_arrGetPost['id']) || isset($this->_arrGetPost['form']['id'])){
					$valueID = (isset($this->_arrGetPost['id'])) ? $this->_arrGetPost['id'] : $this->_arrGetPost['form']['id'];
					$inputID = Helper::cmsInput('text','form[id]' , 'id', $valueID, 'inputbox readonly' , 40);
					$rowID = Helper::cmsRowForm('ID', $inputID);
					$valueUserName = (isset($this->data['username'])) ? $this->data['username'] : $this->_arrGetPost['form']['username'];
					$valueEmail = (isset($this->data['email'])) ? $this->data['email'] : $this->_arrGetPost['form']['email'];
					$valueFullName = (isset($this->data['fullname'])) ? $this->data['fullname'] : $this->_arrGetPost['form']['fullname'];
					$keySelectStatus = (isset($this->data['status'])) ? $this->data['status'] : $this->_arrGetPost['form']['status'];
					$keySelectGr = (isset($this->data['group_id'])) ? $this->data['group_id'] : $this->_arrGetPost['form']['group_id'];
					$valueOrdering = (isset($this->data['ordering'])) ? $this->data['ordering'] : $this->_arrGetPost['form']['ordering'];
				}else{
					$valueUserName = (!empty($this->_arrGetPost['form']['username'])) ? $this->_arrGetPost['form']['username'] : "";
					$valueEmail = (!empty($this->_arrGetPost['form']['email'])) ? $this->_arrGetPost['form']['email'] : "";
					$valueFullName = (!empty($this->_arrGetPost['form']['fullname'])) ? $this->_arrGetPost['form']['fullname'] : "";
					$keySelectStatus = (!empty($this->_arrGetPost['form']['status'])) ? $this->_arrGetPost['form']['status'] : "";
					$keySelectGr = (!empty($this->_arrGetPost['form']['group_id'])) ? $this->_arrGetPost['form']['group_id'] : "";
					$valueOrdering = (!empty($this->_arrGetPost['form']['ordering'])) ? $this->_arrGetPost['form']['ordering'] : "";
				}
				// thẻ input userName và row username
				$inputUserName = Helper::cmsInput('text', 'form[username]','username',$valueUserName , 'inputbox required', 40);
				$rowUserName = Helper::cmsRowForm('User Name',$inputUserName,true);

				//thẻ input cho email và row mail
				$inputEmail = Helper::cmsInput('text', 'form[email]','email',$valueEmail , 'inputbox required', 40);
				$rowEmail = Helper::cmsRowForm('Email',$inputEmail,true);

				//thẻ input cho email và row fullname
				$inputFullName = Helper::cmsInput('text', 'form[fullname]','fullname',$valueFullName , 'inputbox', 40);
				$rowFullName = Helper::cmsRowForm('Full Name',$inputFullName);

				// thẻ selec cho status và row status				
				$selectBoxStatus = Helper::craeteSelectbox('form[status]',"", array('default' => 'Select Status', '1' => '-publish-', '0' => '-unpublish-'),$keySelectStatus);
				$rowStatus = Helper::cmsRowForm('Status', $selectBoxStatus);

				// thẻ seclec cho Gr và row group				
				$selectBoxGr = Helper::craeteSelectbox('form[group_id]',"", $this->nameGr,$keySelectGr);
				$rowGroup = Helper::cmsRowForm('Group', $selectBoxGr);

				// thẻ input cho Orderingvà row ordering				
				$inputOrdering = Helper::cmsInput('text', 'form[ordering]','ordering', $valueOrdering, null, 40);
				$rowOrdering = Helper::cmsRowForm('Ordering', $inputOrdering);
				
				

			?>
			<div class="width-100 fltlft">
				<fieldset class="adminform">
					<legend>Details</legend>
					<ul class="adminformlist">
						<?php 
							echo $rowUserName;
							echo $rowEmail;
							echo $rowFullName;
							echo $rowStatus;
							echo $rowGroup;
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
	echo '<pre>';
	print_r($_POST);
	echo '</pre>';?>