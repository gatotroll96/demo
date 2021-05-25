<?php
	$qty = 0;
	$total = 0;
	$linkCart = URL::createLink('default', 'book', 'cart');
	$dataCart = Session::get('cart');
	if(!empty($dataCart)){
		$qty = array_sum($dataCart['quantity']);
		$total = array_sum($dataCart['price']);
	}
?>

<div class="cart">
	<div class="title"><span class="title_icon"><img src="<?php echo $ImgUrl;?>images/cart.gif"/></span>My cart</div>
	<div class="home_cart_content">
	<?php echo $qty;?> x items | <span class="red">TOTAL: <?php echo $total;?>$</span>
	</div>
	<a href="<?php echo $linkCart;?>" class="view_cart">view cart</a>
</div>