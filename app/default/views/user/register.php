<?php
    @$valueInput = $this->_arrGetPost['form'];
    // row
    $rowUserName = Helper::cmsRow('UserName',Helper::cmsInput('text','form[username]','username',@$valueInput['username'],'contact_input'));
    $rowPassword = Helper::cmsRow('Password',Helper::cmsInput('password','form[password]','password',@$valueInput['password'],'contact_input'));
    $rowFullName = Helper::cmsRow('FullName',Helper::cmsInput('text','form[fullname]','fullname',@$valueInput['fullname'],'contact_input'));
    $rowEmail = Helper::cmsRow('Email',Helper::cmsInput('text','form[email]','email',@$valueInput['email'],'contact_input'));
    $rowRegister = Helper::cmsRow('Register', Helper::cmsInput('submit', 'form[submit]', 'submit','Register','register'), true);
    $rowToken = Helper::cmsRow('token', Helper::cmsInput('hidden', 'form[token]', 'token',time(),'token'), true);
?>
<div class="title"><span class="title_icon"><img src="<?php echo $ImgUrl;?>images/bullet1.gif" alt="" title="" /></span>Register</div>        
	<div class="feat_prod_box_details">                      
      	<div class="contact_form">
        <div class="form_subtitle">create new account</div>
        <?php echo @$this->errorValidate; ?>
        <form name="register" action="index.php?module=default&controller=user&action=register" method="POST">          
            <?php 
                echo  $rowUserName; 
                echo  $rowPassword;
                echo  $rowFullName;
                echo  $rowEmail;
                echo  $rowRegister;
                echo  $rowToken;
            ?>                     
        </form>     
    </div>
</div>
    