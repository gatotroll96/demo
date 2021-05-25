<?php 

	require_once 'libs/Bootstrap.php';
	require_once 'libs/Controller.php';
	require_once 'libs/View.php';
	require_once 'libs/Template.php';
	require_once 'libs/Helper.php';
	require_once 'libs/URL.php';
	require_once 'libs/Model.php';
	require_once 'define.php';
	require_once 'libs/Pagination.php';
	require_once 'libs/Session.php';
	require_once 'libs/Validate.php';

	Session::init();
	$controller = new Bootstrap(); 
	//$controller->_error();
?>