<?php
    $query[] = "SELECT `id`,`name`, `picture`"; 
    $query[] = "FROM `book` WHERE `sale_off` > 0 ORDER BY `id` DESC LIMIT 0 , 3";
    $query = implode(" ", $query);
    $promoBook = $database->listRecord($query);
    $xhtml = "";
    if(!empty($promoBook)){
        foreach ($promoBook as $key => $value) {
            $linkDetail = URL::createLink('default','book','detail', array('b_id'=> $value['id']));
            $linkImg = UPLOAD_URL .'book'.DS.'60x90_'.$value['picture'];
            $xhtml .= '<div class="new_prod_box">
                            <a href="'.$linkDetail.'">'.$value['name'].'</a>
                            <div class="new_prod_bg">
                            <span class="new_icon"><img src="'.$ImgUrl.'images/promo_icon1.png" alt="" title="" /></span>
                            <a href="'.$linkDetail.'"><img src="'.$linkImg.'" alt="" title="" class="thumb" border="0" /></a>
                            </div>           
                        </div>';
        }
    }
?>

<div class="title"><span class="title_icon"><img src="<?php echo $ImgUrl;?>images/bullet4.gif" alt="" title="" /></span>Promotions</div> 
    <?php
        echo $xhtml;
    ?>