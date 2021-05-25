<?php
	$message = '';
	switch ($this->_arrGetPost['type']) {
		case 'register-success':
			$message = 'Đã đăng ký thành công, xin chờ kích hoạt';
			break;
		case 'not-permission':
			$message = 'Tài khoản không có quyền truy cập';
			break;
		case 'back-home':
			$message = 'Quay lại trang chủ';
			break;
	}
?>
<div class="notice">
	<?php echo $message; ?>
</div>