<?php 
	if ( file_exists( app_theme_dir().'/404.php' ) ) { include app_theme_dir().'/404.php'; } else { echo "404 - create '404.php' file in your theme to make your own error page."; }; /// This will be displayed if there's no other pages 
?>