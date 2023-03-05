<?php 
	if (file_exists( app_theme_dir() . '/404.php')){ /// Not Found
		include app_theme_dir() . '/404.php'; 
	}else{
		echo "404 - create '404.php' file in your theme to make your own error page or create 'urlhandler.php' in 'core' folder inside your theme folder to make your own url handler";
	}
?>