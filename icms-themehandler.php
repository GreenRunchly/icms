<?php /// Url to Page Handler a.k.a Theme Handler

	/// Set Default Specific Pages
	/// NOTE: Only support PHP file
	if ( ! isset($icms_pages)){
		$icms_pages = array(
			"" 	=>	"index.php"
		);
	}

	/// Set Default Specific Module
	/// NOTE: Module will be enabled when is available in the "app-module" folder
	if ( ! isset($icms_module)){
		$icms_module = array();
	}

	/// Controller Module
	if ( isset( $icms_module ) ){
		foreach ( $icms_module as $module_name => $is_enable ) {
			if (( file_exists( app_module_dir() . '/' . $module_name )) && ( $is_enable == true )){
				include app_module_dir() . '/' . $module_name . '/index.php';
			}
		}
	}
	
	/// Get URL
	$urlhandler = ltrim( str_ireplace(str_ireplace($_SERVER['DOCUMENT_ROOT'], '', APP_PATH ), '', 
		rtrim( parse_url( stripslashes( trim( htmlspecialchars( $_SERVER['REQUEST_URI'] ) ) ))['path'], '/' )
	), '/');

	/// Remah Remah URL (Breadcrumb, usefull for generate unique request without query parameter ex. "ieu.link/remahremahunik"
	/// Use $urlhandler for the page url
	/// Use $urlhandlertrail for trail next the page path such as http://wa.me/phone/ea, if you have page phone, then will return "ea"
	$urlhandlerbreak = explode('/', $urlhandler); 
	$urlhandlertemp = ''; $urlhandlerfix = '';
	$urlhandlertrail = '';

	for ($i=1; $i < sizeof($urlhandlerbreak); $i++) { 
		if ($i != sizeof($urlhandlerbreak) ){
			$urlhandlertemp = $urlhandlertemp . '/';
		}
		$urlhandlertemp = $urlhandlertemp . $urlhandlerbreak[$i];

		foreach ($icms_pages as $slug_page => $file) {
			$urlhandlerfix = str_ireplace($urlhandlertemp, '', $slug_page);
		}
	}
	$urlhandlertrail = ltrim( str_ireplace($urlhandlerfix, '', $urlhandler), '/');
	$urlhandler = $urlhandlerfix;

	/// Controller Permalink Halaman
	if ( isset( $icms_pages[ $urlhandler ] ) ){
		if (file_exists( app_theme_dir() . '/' . $icms_pages[ $urlhandler ] )){
			include app_theme_dir() . '/' . $icms_pages[ $urlhandler ]; /// Constant Page
		}else{
			if (file_exists( app_theme_dir() . '/404.php')){ /// Not Found
				include app_theme_dir() . '/404.php'; 
			}else{
				echo "404 - create '404.php' file in your theme to make your own error page or create 'urlhandler.php' in 'core' folder inside your theme folder to make your own url handler";
			}
		}
	}else{
		if (file_exists( app_theme_dir() . '/core/urlhandler.php')){
			include app_theme_dir() . '/core/urlhandler.php'; /// Theme Custom URL Handler
		}else{
			if (file_exists( app_theme_dir() . '/404.php')){ /// Not Found
				include app_theme_dir() . '/404.php'; 
			}else{
				echo "404 - create '404.php' file in your theme to make your own error page or create 'urlhandler.php' in 'core' folder inside your theme folder to make your own url handler";
			}
		}
	}

?>