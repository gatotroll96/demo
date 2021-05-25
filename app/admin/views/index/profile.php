<?php
	include_once 'toolbar/index.php';
	echo @$this->errorValidate;
	echo Helper::cmsMessage(@$_SESSION['message']);
    Session::delete('message');
?>	
<div id="element-box">
	<div class="m">
		<form action="#" method="post" name="adminForm" id="adminForm" class="form-validate">
			<!-- FORM LEFT -->
			<?php
				$infoUser = Session::get('user');
				$valueFullName = $infoUser['info']['fullname'];
				$inputFullName = Helper::cmsInput('text','form[fullname]' ,'fullname', $valueFullName, 'inputbox readonly' , 40);
				$rowFullName =  Helper::cmsRowForm('Full Name', $inputFullName);
				
				

			?>
			<div class="width-100 fltlft">
				<fieldset class="adminform">
					<legend>Details</legend>
					<ul class="adminformlist">
						<?php 
							echo $rowFullName;
							/*echo $rowStatus;
							echo $rowGrACP;
							echo $rowOrdering;
							echo $rowID;*/
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