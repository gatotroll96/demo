<?php
    
    
    // SPECIAL BOOK
    $xhtmlSpecialBook = "";
    if(!empty($this->special_book)){
        foreach ($this->special_book as $key => $value) {
            $linkImg = UPLOAD_URL .'book'.DS.'98x150_'.$value['picture'];
            $linkDetail = URL::createLink('default','book','detail', array('b_id'=>$value['id']));
            $description = Helper::createDescription($value['description'], 250 , 200);
            $xhtmlSpecialBook .= '<div class="feat_prod_box">            
                                    <div class="prod_img"><a href="'.$linkDetail.'"><img src="'.$linkImg.'" alt="" title="" border="0" /></a></div>
                                    
                                    <div class="prod_det_box">
                                        <div class="box_top"></div>
                                        <div class="box_center">
                                        <div class="prod_title">'.$value['name'].'</div>
                                        <p class="details">'.$description.'</p>
                                        <a href="'.$linkDetail.'" class="more">- more details -</a>
                                        <div class="clear"></div>
                                        </div>
                                        
                                        <div class="box_bottom"></div>
                                    </div>    
                                <div class="clear"></div>
                                </div>';
        }
    }

    // NEW BOOK
    $xhtmlNewBook = "";
    if(!empty($this->new_book)){
        foreach ($this->new_book as $key => $value) {
            $linkImg = UPLOAD_URL .'book'.DS.'60x90_'.$value['picture'];
            $linkDetail = URL::createLink('default','book','detail', array('b_id'=>$value['id']));
            $xhtmlNewBook .= '<div class="new_prod_box">
                        <a href="'.$linkDetail.'">'.$value['name'].'</a>
                        <div class="new_prod_bg">
                        <span class="new_icon"><img src="'.TEMPLATE_URL.'default/main/images/new_icon.gif" alt="" title="" /></span>
                        <a href="'.$linkDetail.'"><img src="'.$linkImg.'" alt="" title="" class="thumb" border="0" /></a>
                        </div>           
                    </div>';
        }
    }
?>

<div class="title"><span class="title_icon"><img src="<?php echo $ImgUrl;?>images/bullet1.gif" alt="" title="" /></span>Special Books </div>
        
        		
            <?php 
                echo $xhtmlSpecialBook;
            ?>

            
        	      
            
            
            
           <div class="title"><span class="title_icon"><img src="<?php echo $ImgUrl;?>images/bullet2.gif" alt="" title="" /></span>New books</div> 
           
           <div class="new_products">
           
                    <?php
                        echo $xhtmlNewBook;
                    ?>

            </div> 