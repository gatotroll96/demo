<?php
    
    $xhtml = "";    
    if(!empty($this->historyBuy)){
        foreach ($this->historyBuy as $key => $value) {
            $cartId         = $value['id'];
            $date           = date("H:i d/m/Y", strtotime($value['date']));
            $arrBookID      = json_decode($value['books']);
            $arrPrice       = json_decode($value['prices']);
            $arrName        = json_decode($value['names'],JSON_BIGINT_AS_STRING);
            $arrQuantity    = json_decode($value['quantities']);
            $arrTotal       = json_decode($value['total']);
            $arrPicture     = json_decode($value['pictures']);
            $totally        = array_sum($arrTotal);

            $xhtmlContent = "";     //chú ý phải để $xhtmlContent để tránh $xhtmlContent bị lặp lại
            foreach($arrBookID as $keyB => $valueB){
                $linkDetail =  URL::createLink('default', 'book', 'detail', array('b_id'=>$valueB));
                $linkImg = UPLOAD_URL .'book'.DS.'60x90_'.$arrPicture[$keyB];
                $xhtmlContent .= '<tr>
                                    <td><a href="'.$linkDetail.'"><img src="'.$linkImg.'" alt="" title="" border="0" class="cart_thumb" /></a></td>
                                    <td>'.$arrName[$keyB].'</td>
                                    <td>'.$arrPrice[$keyB].'$</td>
                                    <td>'.$arrQuantity[$keyB].'</td>
                                    <td>'.$arrTotal[$keyB].'$</td>               
                                </tr>';
            }
        $xhtml .= '<div class="history-cart">
                    <h3>Mã đơn hàng: '.$cartId.' - Thời gian: '.$date.'</h3>
                    <table class="cart_table">
                        <tr class="cart_title">
                            <td>Item pic</td>
                            <td>Book name</td>
                            <td>Unit price</td>
                            <td>Qty</td>
                            <td>Total</td>               
                        </tr>
                        '.$xhtmlContent.'
                        <tr>
                    <td colspan="4" class="cart_total"><span class="red">TOTAL:</span></td>
                    <td> '.$totally.'$</td>                
                    </tr>            

                    </table>
                    </div>';
            
        }
    }else{
        $xhtml = '<h3>Không có sản phảm nào </h3>';
    }

?>


<div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>My History</div>

<div class="feat_prod_box_details">

    <?php 
        echo $xhtml;
    ?>



<a href="index.php?module=default&controller=user&action=index" class="continue">&lt; My Profile</a>
<a href="index.php?module=default&controller=index&action=index" class="checkout">Home &gt;</a>


 

</div>