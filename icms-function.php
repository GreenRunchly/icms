<?php /// Global Function Controller

function theme_dir() { /// Path direktori tema yang dipakai
	return APP_PATH.'/app-theme/'.APP_THEME;
}

function theme_url() { /// Path direktori tema yang dipakai
	return app_url().'/app-theme/'.APP_THEME;
}

function app_url() { /// Path direktori tema yang dipakai
	return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://".$_SERVER["HTTP_HOST"].(rtrim($_SERVER["REQUEST_URI"],'/'));
}