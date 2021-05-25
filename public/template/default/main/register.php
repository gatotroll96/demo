<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php echo $this->_metaHTTP;?>
    <?php echo $this->_metaName;?>
    <?php echo $this->_title;?>
    <?php echo $this->_cssFiles;?>
    <?php echo $this->_jsFiles;?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Book Store</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<div id="wrap">

       <?php
    
            include_once 'html/header.php';
        ?>   
       
       
       <div class="center_content">
       	<div class="left_content">
            <?php 
            require_once APPLICATION_PATH. $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php';
           ?>  
            
          </div>	
            
              

            

            
        <div class="clear"></div>
        </div><!--end of left content-->
        <div class="right_content">
          <?php
                include_once BLOCK_PATH.'language.php';
                include_once BLOCK_PATH.'cart.php';               
            ?>              
                           
            <div class="right_box">             
              <?php include_once BLOCK_PATH.'promotions.php';  ?>                     
            </div>
             
            <div class="right_box">
                <?php include_once BLOCK_PATH.'categories.php';  ?>
                <?php include_once BLOCK_PATH.'partners.php';  ?>         
            </div> 
                 
             
        
        </div><!--end of right content-->
        
        
       
       
       <div class="clear"></div>
       </div><!--end of center content-->
       
              
       <div class="footer">
       	<div class="left_footer"><img src="<?php echo $ImgUrl;?>images/footer_logo.gif" alt="" title="" /><br /> <a href="http://csscreme.com/freecsstemplates/" title="free templates"><img src="<?php echo $ImgUrl;?>images/csscreme.gif" alt="free templates" title="free templates" border="0" /></a></div>
        <div class="right_footer">
        <a href="#">home</a>
        <a href="#">about us</a>
        <a href="#">services</a>
        <a href="#">privacy policy</a>
        <a href="#">contact us</a>
       
        </div>
        
       
       </div>
    

</div>

</body>
</html>