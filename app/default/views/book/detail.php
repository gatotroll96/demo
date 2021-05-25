<?php


    // Detail Book
    $linkHome = URL::createLink('default', 'index','index');
    $xhtmlDetailBook = "";
    if(!empty($this->detailBook)){
        $descriptionSummary = Helper::createDescription($this->detailBook['description'], 250 , 200);
        $linkImg = UPLOAD_URL .'book'.DS.'98x150_'.$this->detailBook['picture'];
        $linkImgZoom = TEMPLATE_URL.'default/main/';
        $linkZoom = UPLOAD_URL .'book'.DS.$this->detailBook['picture'];
        
        if($this->detailBook['sale_off'] > 0 ){
            @$saleOff = '<div class="price"><strong>SALE OFF:  </strong>
                            <span class="red">'.$this->detailBook['sale_off'].'%</span>
                        </div>';
            $price = $this->detailBook['price']-$this->detailBook['sale_off']*$this->detailBook['price']/100;
            $priceXhtml = '<div class="price"><strong>PRICE:  </strong>
                        <span class="red">'.$price.'$</span>
                        <span class="red-through"> '.$this->detailBook['price'].'$</span>
                    </div>';
        }else{
            $price = $this->detailBook['price'];
            $priceXhtml = '<div class="price"><strong>PRICE:</strong> <span class="red">'.$price.' $</span></div>';
        }
        $linkOrder = URL::createLink('default', 'book','order', array('id'=>$this->detailBook['id'],'price'=>$price));
        $xhtmlDetailBook = '<div class="prod_img"><a href="#"><img src="'.$linkImg.'" alt="" title="" border="0" /></a>
    <br /><br />
    <a id="single_image" href="'.$linkZoom.'" rel="lightbox"><img src="'.$linkImgZoom.'images/zoom.gif" alt="" title="" border="0" /></a>
    </div>
    
    <div class="prod_det_box">
        <div class="box_top"></div>
        <div class="box_center">
        <div class="prod_title">Details</div>
        <p class="details">'.$descriptionSummary.'</p>
            '.@$saleOff.$priceXhtml.'
        
        <a href="'.$linkOrder.'" class="more"><img src="'.$linkImgZoom.'images/order_now.gif" alt="" title="" border="0" /></a>
        <div class="clear"></div>
        </div>
        
        <div class="box_bottom"></div>
    </div>';
    }

    //Related Book

    $xhtmlRelatedBook = "";
    
    if(!empty($this->relatedBook)){
        foreach ($this->relatedBook as $key => $value) {
            $linkIcon = TEMPLATE_URL.'default/main/images/promo_icon1.png';
            if($value['sale_off'] > 0){
                
                $promoIcon = '<span class="new_icon"><img src="'.$linkIcon.'"></span>';
            }else{
                $promoIcon = "";
            }
            $linkImg = UPLOAD_URL .'book'.DS.'60x90_'.$value['picture'];
            $linkDetail = URL::createLink('default', 'book','detail', array('b_id'=>$value['id']));           
            $xhtmlRelatedBook .= '<div class="new_prod_box">
                                
                                <a href="'.$linkDetail.'">'.$value['name'].'</a>
                                <div class="new_prod_bg">
                                '.$promoIcon.'
                                <a href="'.$linkDetail.'"><img src="'.$linkImg.'" class="thumb" border="0" /></a>
                                </div>           
                            </div>';
        }        
    }

?>




<div class="crumb_nav">
<a href="<?php echo $linkHome; ?>">Home</a> &gt;&gt; <?php echo $this->detailBook['name']; ?>
</div>
<div class="title"><span class="title_icon"><img src="<?php echo $ImgUrl; ?>images/bullet1.gif" alt="" title="" /></span><?php echo $this->detailBook['name']; ?></div>

<div class="feat_prod_box_details">
    <?php
        echo $xhtmlDetailBook;
    ?>
	    
<div class="clear"></div>
</div>	

  
<div id="demo" class="demolayout">

    <ul id="demo-nav" class="demolayout">
    <li><a class="active tab1" href="#tab1">More details</a></li>
    <li><a class="tab2" href="#tab2">Related books</a></li>
    </ul>

<div class="tabs-container">

        <div style="display: block;" class="tab" id="tab1">
                            <p class="more_details">
                                <?php
                                    echo $this->detailBook['description'];
                                ?>
                            </p>
                                                                   
        </div>	
        
                <div style="display: none;" class="tab" id="tab2">
        
        <?php
            echo $xhtmlRelatedBook;
        ?>                 
       
        <div class="clear"></div>
                </div>	

</div>
</div>
