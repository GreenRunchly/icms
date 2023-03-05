<?php /// Global Function Controller

/// Get app theme directory (/home/ieu.link/app-theme/myapp)
function app_theme_dir() { /// Path direktori tema yang dipakai
	return APP_PATH.'/app-theme/'.APP_THEME;
}

/// Get app theme url (https://ieu.link/app-theme/myapp)
function app_theme_url() { /// Path direktori tema yang dipakai
	return app_url().'/app-theme/'.APP_THEME;
}

/// Get main app directory (/home/ieu.link/)
function app_dir() { /// Path direktori tema yang dipakai
	return APP_PATH;
}

/// Get main app url (https://ieu.link)
function app_url() { /// Path direktori tema yang dipakai
	return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://".$_SERVER["HTTP_HOST"].(rtrim($_SERVER["REQUEST_URI"],'/'));
}

/// Get app theme directory (/home/ieu.link/app-module)
function app_module_dir() { /// Path direktori tema yang dipakai
	return APP_PATH.'/app-module';
}

// Remove folders and files 
function app_remove_file($dir) {
    if (is_dir($dir)) {
        $files = scandir($dir);
        foreach ($files as $file){
            if ($file != "." && $file != "..") app_remove_file("$dir/$file");
            rmdir($dir);
        }
    }
    else if (file_exists($dir)) unlink($dir);
}

// Copy folders and files       
function app_copy_file($src, $dst) {
    if (file_exists ( $dst ))
        app_remove_file ( $dst );
    if (is_dir ( $src )) {
        mkdir ( $dst );
        $files = scandir ( $src );
        foreach ( $files as $file )
            if ($file != "." && $file != "..")
                app_copy_file ( "$src/$file", "$dst/$file" );
    } else if (file_exists ( $src ))
        copy ( $src, $dst );
}

/// Connect db
function app_db_connect($sn=ICMS_DB_HOST,$un=ICMS_DB_USER,$pw=ICMS_DB_USER_PASS,$dn=ICMS_DB_NAME){

	$output = array();
	$output['success'] = 0;

	$conn = new mysqli($sn, $un, $pw, $dn);
	if ($conn->connect_error) {
	    error_log("Koneksi gagal terjadi pada ".date("Y-m-d H:i:s",strtotime("now")).", dikarenakan :".$conn->connect_error);
	}else{
	    $output['conn'] = $conn;
	    $output['success'] = 1;
	}

	return $output;

}

/// Do Query
function app_db_query($conn,$sql){
    return $conn->query($sql);
}

/// Select data in table
function app_db_select( $table_where, $key_where=[], $isi_where=[]){
	global $icms_db_conn;

	$output = array();
	$output['success'] = 0;

	if ( ! empty( $table_where ) ){

		$table_where_txt = "`" . mysqli_real_escape_string( $icms_db_conn['conn'], $table_where) . "`";

		/// Filter Data
		foreach ($isi_where as $iwhere => $ihere) {
			$isi_where[ $iwhere ] = mysqli_real_escape_string( $icms_db_conn['conn'], $ihere);
		}
		foreach ($key_where as $kwhere => $where) {
			$key_where[ $kwhere ] = mysqli_real_escape_string( $icms_db_conn['conn'], $where);
		}

		$key_where_txt = ''; /// Membuat query awal
		foreach ($key_where as $kwhere => $where) {
			
			if ( empty( $key_where_txt ) ){ /// Set WHERE pada query
				$key_where_txt = 'WHERE ';
			}
			
			/// Set masing-masing kolom
			$key_where_txt = $key_where_txt . "`" . $where . "`='" . $isi_where[ $kwhere ] . "'";

			if ( $kwhere < ( count( $key_where ) - 1 ) ){ /// Menambahkan koma pada setiap kolom
				$key_where_txt = $key_where_txt . ', ';
			}
		}	

		$query = "SELECT * FROM " . $table_where_txt . $key_where_txt;

		$hasil = app_db_query( $icms_db_conn['conn'], $query);
		if ($hasil->num_rows > 0) {
		    while($row = $hasil->fetch_assoc()) {
		        $output['result'][] = $row;
		    }
		    $output['success'] = 1;
		}
	
	}

	return $output;

}
