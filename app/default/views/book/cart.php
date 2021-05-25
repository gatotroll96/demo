<?php    
    $xhtml = "";
    $dataCart = Session::get('cart');
    if(isset($dataCart)){
        foreach (@$this->listCart as $key => $value) {
            $id = $value['id'];
            $linkDetail = URL::createLink('default', 'book', 'detail', array('b_id'=>$id));
            $linkImg = UPLOAD_URL .'book'.DS.'60x90_'.$value['picture'];
            $unitPrice = $dataCart['price'][$id];
            $qty  = $dataCart['quantity'][$id];
            $total = $unitPrice * $qty;
            $arrTotal[] = $total;
            $xhtml .=  '<tr>
                            <td><a href="'.$linkDetail.'"><img src="'.$linkImg.'" alt="" title="" border="0" class="cart_thumb" /></a></td>
                            <td>'.$value['name'].'</td>
                            <td>'.$unitPrice.'</td>
                            <td>'.$qty.'</td>
                            <td>'.$total.'$</td>               
                        </tr>';
            @$inputID .= Helper::cmsInput('hidden', 'form[bookid][]','book_id_'.$id, $id);
            @$inputImg .= Helper::cmsInput('hidden', 'form[picture][]','picture_'.$id, $value['picture']);
            @$inputName .= Helper::cmsInput('hidden', 'form[name][]','name_id'.$id, $value['name']);
            @$inputUnitPrice .= Helper::cmsInput('hidden', 'form[unitprice][]','unitprice_'.$id, $unitPrice);
            @$inputQty .= Helper::cmsInput('hidden', 'form[quantity][]','quantity_'.$id, $qty);
            @$inputTotal .= Helper::cmsInput('hidden', 'form[total][]','total_'.$id, $total);

        }        
        $totally = array_sum($arrTotal);
        $linkSubimtForm = URL::createLink('default', 'book', 'checkout');           
?>

<div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>My cart</div>        
	<div class="feat_prod_box_details">
    <form action="#" method="POST" name="adminForm" id="adminForm">    
    <table class="cart_table">
    	<tr class="cart_title">
        	<td>Item pic</td>
        	<td>Book name</td>
            <td>Unit price</td>
            <td>Qty</td>
            <td>Total</td>               
        </tr>
        <?php
            echo $xhtml.$inputID.$inputImg.$inputName.$inputUnitPrice.$inputQty.$inputTotal;
        ?>                     	          
        <tr>
        <td colspan="4" class="cart_total"><span class="red">TOTAL:</span></td>
        <td><?php echo $totally; ?>$</td>                
        </tr>                      
    </table>
    <a href="index.php?module=default&controller=category&action=index" class="continue">&lt; continue</a>
    <a onclick="javascript:submitForm('<?php echo $linkSubimtForm;?>')" href="#" class="checkout" id="checkout">checkout &gt;</a>
    </form>            
    </div>
<?php
}else{
?>
    <h3> Không có sản phẩm nào trong giỏ hàng, vui lòng quay lại Home</h3>
<?php   
}
?>