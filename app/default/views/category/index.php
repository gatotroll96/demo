<?php
    $linkHome = URL::createLink('default','index','index');

    $xhtml = "";
    if(!empty($this->items)){
        foreach ($this->items as $key => $value) {
            $name = $value['name'];
            $linkImg = UPLOAD_URL.'category'.DS.'60x90_'.$value['picture'];
            $link = URL::createLink('default', 'book', 'list', array('ctgr'=>$value['id']));

            $xhtml .=   '<div class="new_prod_box">
                            <a href="'.$link.'">'.$name.'</a>
                            <div class="new_prod_bg">
                            <a href="'.$link.'"><img src="'.$linkImg.'" class="thumb" border="0" /></a>
                            </div>
                        </div>';
        }
    }
?>
<div class="crumb_nav">
    <a href="<?php echo $linkHome; ?>">home</a> &gt;&gt; category name
</div>
<div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>Category books</div>
    <div class="new_products">
        <?php
            echo $xhtml;
        ?>
                                             
    
    <!-- <span class="disabled"><<</span><span class="current">1</span><a href="#?page=2">2</a><a href="#?page=3">3</a>…<a href="#?page=199">10</a><a href="#?page=200">11</a><a href="#?page=2">>></a> -->
    
    <?php
        echo $this->_pagination;
    ?>
  
    
</div>