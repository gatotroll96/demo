<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <?php echo $this->_jsFiles;?>
    <?php echo $this->_metaHTTP;?>
    <?php echo $this->_metaName;?>
    <?php echo $this->_title;?>
    <?php echo $this->_cssFiles;?>

    
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Book Store</title>
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
    <?php 
        include_once 'html/footer.php';
    ?>   
</div>
</body>
</html>