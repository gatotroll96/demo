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
					$valuePrice = (isset($this->data['price'])) ? $this->data['price'] : $this->_arrGetPost['form']['price'];
					$valueSaleoff = (isset($this->data['sale_off'])) ? $this->data['sale_off'] : $this->_arrGetPost['form']['sale_off'];
					$keySelectStatus = (isset($this->data['status'])) ? $this->data['status'] : $this->_arrGetPost['form']['status'];					
					$valueOrdering = (isset($this->data['ordering'])) ? $this->data['ordering'] : $this->_arrGetPost['form']['ordering'];
					$valuePicture = (isset($this->data['picture'])) ? $this->data['picture'] : $this->_arrGetPost['form']['filenamepicture'];
					$linkPicture = UPLOAD_URL .'book'.DS.'98x150_'.$valuePicture;
					$picture = '<li><label><img src="'.$linkPicture.'"/></label></li>';
					$valueDescription = (isset($this->data['description'])) ? $this->data['description'] : $this->_arrGetPost['form']['description'];
					$keySelectSpecial = (isset($this->data['special'])) ? $this->data['special'] : $this->_arrGetPost['form']['special'];
					@$keySelectCategory = (isset($this->data['category_id'])) ? $this->data['category_id'] : $this->_arrGetPost['form']['category_id'];
				}else{
					$valueName = (!empty($this->_arrGetPost['form']['name'])) ? $this->_arrGetPost['form']['name'] : "";
					$keySelectStatus = (!empty($this->_arrGetPost['form']['status'])) ? $this->_arrGetPost['form']['status'] : "";
					
					$valueOrdering = (!empty($this->_arrGetPost['form']['ordering'])) ? $this->_arrGetPost['form']['ordering'] : "";
					@$keySelectSpecial	= 	$this->_arrGetPost['form']['special'];
					@$keySelectCategory = $this->_arrGetPost['form']['category_id'];
					@$valuePrice = $this->_arrGetPost['form']['price'];
					@$valueDescription = $this->_arrGetPost['form']['description'];
					@$valueSaleoff = $this->_arrGetPost['form']['sale_off'];

				}
				// thẻ input Name
				$inputName = Helper::cmsInput('text', 'form[name]','name',$valueName , 'inputbox required', 40);
				$rowName = Helper::cmsRowForm('Name',$inputName,true);

				// thẻ selec cho status				
				$selectBoxStatus = Helper::craeteSelectbox('form[status]',"", array('default' => 'Select Status', '1' => '-publish-', '0' => '-unpublish-'),$keySelectStatus);
				$rowStatus = Helper::cmsRowForm('Status', $selectBoxStatus);
				
				// thẻ selec cho category
				$selectBoxCategory = Helper::craeteSelectbox('form[category_id]',"", array('default' => 'Select Category', '3' => '-Onepiece-', '4' => '-Tam Quốc-',5=>'KingDom',6=>'Attack On Titan'),$keySelectCategory);
				$rowCategory = Helper::cmsRowForm('Category', $selectBoxCategory);

				// thẻ input cho Ordering				
				$inputOrdering = Helper::cmsInput('text', 'form[ordering]','ordering', $valueOrdering, null, 11);
				$rowOrdering = Helper::cmsRowForm('Ordering', $inputOrdering);

				// the input va row cho file
				$inputFileImg = Helper::cmsInput('file', 'picture','picture', "",'inputbox', 50);
				$rowFileImg = Helper::cmsRowForm('Picture', $inputFileImg);

				// the input va row cho price
				$inputPrice = Helper::cmsInput('text', 'form[price]','price', $valuePrice,'inputbox', 11);
				$rowPrice = Helper::cmsRowForm('Price', $inputPrice);

				// the input va row cho special
				$selectBoxSpecial = Helper::craeteSelectbox('form[special]',"", array('default' => 'Select Special', '1' => '-yes-', '0' => '-no-'),$keySelectSpecial);
				$rowSpecial = Helper::cmsRowForm('Special', $selectBoxSpecial);

				// the input va row cho sale off
				$inputSale = Helper::cmsInput('text', 'form[sale_off]','sale_off',$valueSaleoff,'inputbox', 11);
				$rowSale = Helper::cmsRowForm('Sale Off', $inputSale);	

				// the input va row cho description
				$inputDescription = '<textarea id="adminForm" name="form[description] value="'.$valueDescription.'">'.$valueDescription.'</textarea>';
				$rowDescription = Helper::cmsRowForm('Description', $inputDescription);		

			?>
			<div class="width-100 fltlft">
				<fieldset class="adminform">
					<legend>Details</legend>
					<ul class="adminformlist">
						<?php 
							echo $rowName;
							echo @$picture;
							echo $rowPrice;
							echo $rowSpecial;
							echo $rowSale;
							echo $rowCategory;
							echo $rowStatus;
							echo $rowOrdering;	
							echo $rowFileImg;
														
							echo $rowID;
							echo $rowDescription;
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