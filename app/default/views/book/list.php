<?php
    $xhtml = "";
    if(!empty($this->items)){ 
        foreach ($this->items as $key => $value) {
            $description = Helper::createDescription($value['description'], 250 , 200);
            $linkDetail = URL::createLink('default','book','detail', array('b_id'=>$value['id']));
            $linkImg = UPLOAD_URL .'book'.DS.'98x150_'.$value['picture'];
            $xhtml .=   '<div class="feat_prod_box">
            
                            <div class="prod_img"><a href="'.$linkDetail.'"><img src="'.$linkImg.'" alt="" title="" border="0"></a></div>
                            
                            <div class="prod_det_box">
                                <span class="special_icon"><img src="images/special_icon.gif" alt="" title=""></span>
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
    }else{
        $xhtml .= '<div class="feat_prod_box">Nội dung đang cập nhập</div>';
    }
?>
<div class="title">
    <span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /><?php echo $this->categoryName['name']; ?></span>
</div> 
    <?php
        echo $xhtml;
    ?>
<div class="pagination">
    <?php echo $this->_pagination; ?>
</div>