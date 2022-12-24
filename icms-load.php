<?php /// Load Controller Module

	/// App Config
	require_once __DIR__ . '/' . APP_MOD_PREFIX . 'config.php';

	/// Load Global Function
	require_once __DIR__ . '/' . APP_MOD_PREFIX . 'function.php';

	/// Load Theme Function
	require_once theme_dir() . '/core/function.php';

	/// URL Handler
	require_once __DIR__ . '/' . APP_MOD_PREFIX . 'themehandler.php';
	