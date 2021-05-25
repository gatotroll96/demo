<?php
	
	// ====================== PATHS ===========================
	define ('DS'				, '/');
	define ('ROOT_PATH'			, dirname(__FILE__));					
	define ('LIBRARY_PATH'		, ROOT_PATH . DS . 'libs' . DS);		
	define ('PUBLIC_PATH'		, ROOT_PATH . DS . 'public' . DS);		
	define ('APPLICATION_PATH'	, ROOT_PATH . DS . 'app' . DS);						
	define ('TEMPLATE_PATH'		, PUBLIC_PATH . 'template' . DS);
	define ('UPLOAD_PATH'		, PUBLIC_PATH . 'files' . DS);
	define ('SCRIPTS_PATH'		, PUBLIC_PATH . 'scripts' . DS);			
	define ('BLOCK_PATH'		, ROOT_PATH .DS. 'block' . DS);
	define ('EXTENS_PATH'		, LIBRARY_PATH . 'extens'. DS);			
	
	define	('ROOT_URL'			, DS . 'demo' . DS);
	define	('APPLICATION_URL'	, ROOT_URL . 'app' . DS);
	define	('PUBLIC_URL'		, ROOT_URL . 'public' . DS);
	define	('TEMPLATE_URL'		, PUBLIC_URL . 'template' . DS);
	define	('UPLOAD_URL'		, PUBLIC_URL . 'files' . DS);
	
	define	('DEFAULT_MODULE'		, 'default');
	define	('DEFAULT_CONTROLLER'	, 'index');
	define	('DEFAULT_ACTION'		, 'index');

	// ====================== DATABASE ===========================
	define ('DB_HOST'			, 'localhost');
	define ('DB_USER'			, 'root');						
	define ('DB_PASS'			, '');						
	define ('DB_NAME'			, 'bookstore');						
	define ('DB_TABLE'			, 'user');

	// ====================== CONFIG ===========================
	define ('TIME_LOGIN'			, 3600);						
