<div class="left_content">
    <div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>My account</div>
    <div class="feat_prod_box_details">       
        <div class="contact_form">
        <div class="form_subtitle">login into your account</div>
         <form name="register" action="index.php?module=default&controller=user&action=login" method="POST">          
            <div class="form_row">
            <label class="contact"><strong>Username:</strong></label>
            <input type="text" class="contact_input" name="form[username]" value=""/>
            </div>


            <div class="form_row">
            <label class="contact"><strong>Password:</strong></label>
            <input type="password" class="contact_input" name="form[password]" value="" />
            </div>                     

            <div class="form_row">
                <div class="terms">
                <input type="checkbox" name="terms" />
                Remember me
                </div>
            </div> 

            
            <div class="form_row">
            <input type="submit" class="register" value="login" />
            <input type="hidden" name="form[token]" value="<?php echo time();?>" />
            </div>   
            
          </form>     
            
        </div>  
    
    </div>                        
<div class="clear"></div>
</div>