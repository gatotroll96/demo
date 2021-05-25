<?php
        $xhtml = "";
        $categoryID = (isset($this->_arrGetPost['ctgr'])) ? $this->_arrGetPost['ctgr'] : "";
        $dbCategory = new Model();
        $query = "SELECT `name`,`id` FROM `category` WHERE `status` = 1";
        $data = $dbCategory->listRecord($query);
        if(!empty($data)){
              foreach ($data as $key => $value) {
                $link = URL::createLink('default', 'book', 'list', array('ctgr' => $value['id']));
                        if($categoryID == $value['id']){
                                $xhtml .=  '<li><a class="active" href="'.$link.'">'.$value['name'].'</a></li>';
                        }else{
                               $xhtml .=  '<li><a href="'.$link.'">'.$value['name'].'</a></li>'; 
                        }
                }  
        }
        

?>
<div class="title"><span class="title_icon"><img src="<?php echo $ImgUrl;?>images/bullet5.gif" /></span>Categories</div> 
                
<ul class="list">
        <?php
                echo $xhtml;
        ?>                                              
</ul>