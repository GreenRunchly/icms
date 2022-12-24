<?php /// Url to Page Handler a.k.a Theme Handler
	
	/// Set Default Specific Pages
	if ( ! isset($icms_pages)){
		$icms_pages = array(
			"" 	=>	"index.php"
		);
	}

	/// Get URL
	$urlhandler = rtrim( str_ireplace( str_ireplace($_SERVER['DOCUMENT_ROOT'], '', APP_PATH.'/'), '', stripslashes( trim( htmlspecialchars( $_SERVER['REQUEST_URI'] ) ) ) ), '/' );

	/// Controller Permalink Halaman
	if ( isset( $icms_pages[ $urlhandler ] ) ){
		if (file_exists( theme_dir() . '/' . $icms_pages[ $urlhandler ] )){
			include theme_dir() . '/' . $icms_pages[ $urlhandler ]; /// Constant Page
		}else{
			if (file_exists( theme_dir() . '/404.php')){ /// Not Found
				include theme_dir() . '/404.php'; 
			}else{
				echo "notfound";
			}
		}
	}else{
		if (file_exists( theme_dir() . '/core/urlhandler.php')){
			include theme_dir() . '/core/urlhandler.php'; /// Theme Custom URL Handler
		}else{
			if (file_exists( theme_dir() . '/404.php')){ /// Not Found
				include theme_dir() . '/404.php'; 
			}else{
				echo "notfound";
			}
		}
	}

?>