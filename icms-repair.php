<?php

	$updatestatus = json_decode(file_get_contents('https://raw.githubusercontent.com/GreenRunchly/icms/main/server/latest.json'), true);
	$updatestatus[0][1] = '1.0';

	if ( ! empty( $updatestatus[0][0] ) ){

		if ( $updatestatus[0][0] != $updatestatus[0][1] ){

			$randomea = md5( floor( microtime(true) * 1000 ) );

			$updatefile = file_put_contents( $randomea . '.zip',file_get_contents('https://github.com/GreenRunchly/icms/archive/refs/heads/main.zip'));

			$zip = new ZipArchive;
			$openedzipfile = $zip->open( $randomea . '.zip');
			if ($openedzipfile == true) {
				
				foreach ( $updatestatus[1] as $zipfilekey => $zipfilename) {
					$datafile = $zip->getFromName( $zipfilename );

					$zipfilename = ltrim( str_ireplace( "icms-main", '', $zipfilename), '/' );
					
					unlink( $zipfilename );

					if ( ! is_dir( dirname( $zipfilename ) ) ) {
						if ( ! file_exists( $zipfilename ))
						mkdir( dirname( $zipfilename ) , 0777, true);
					}
					if ( ! file_exists( $zipfilename ) )
					file_put_contents( $zipfilename , $datafile);
				}

				$zip->close();

				unlink( $randomea . '.zip');
			}

		}else{

			

		}

	}

?>