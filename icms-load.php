<?php /// Load Controller Module

	session_start();

	/// App Config
	require_once __DIR__ . '/' . APP_MOD_PREFIX . 'repair.php';
	die();

	/// App Config
	require_once __DIR__ . '/' . APP_MOD_PREFIX . 'config.php';

	/// Load Global Function
	require_once __DIR__ . '/' . APP_MOD_PREFIX . 'function.php';

	/// Load DB Config
	if ( file_exists( app_theme_dir() . '/core/db.php' ) ) {
		include app_theme_dir() . '/core/db.php';
		/// Connect to Main db used in ICMS
		if ( ! defined( 'ICMS_DB_NAME' ) ){
			$icms_db_conn = app_db_connect();
		}
	}else{
		define('ICMS_DB_NAME', ''); /// Masukan nama database as default
	    define('ICMS_DB_USER', ''); /// User database as default
	    define('ICMS_DB_USER_PASS', ''); /// User password akun database as default
	    define('ICMS_DB_HOST', ''); /// Server db as default
	}

	/// Load Theme Function
	if ( file_exists( app_theme_dir() . '/core/function.php' ) ) {
		include app_theme_dir() . '/core/function.php';
	}

	/// Load Theme module
	if ( file_exists( app_theme_dir() . '/core/module.php' ) ) {
		include app_theme_dir() . '/core/module.php';
	}

	/// Load Theme Pages Index
	if ( file_exists( app_theme_dir() . '/core/pages.php' ) ) {
		include app_theme_dir() . '/core/pages.php';
	}

	/// URL Handler
	require_once __DIR__ . '/' . APP_MOD_PREFIX . 'themehandler.php';
	