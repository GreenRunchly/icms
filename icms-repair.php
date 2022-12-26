<?php

	$updatestatus = json_decode(file_get_contents('https://raw.githubusercontent.com/GreenRunchly/icms/main/server/latest.json'), true);
	$updatestatus[0][1] = '1.0';

	if ( ! empty( $updatestatus[0][0] ) ){

		if ( $updatestatus[0][0] != $updatestatus[0][1] ){

			$updatefile = file_put_contents('update.zip',file_get_contents('https://github.com/GreenRunchly/icms/archive/refs/heads/main.zip'));

			$zip = new ZipArchive;
			$openedzipfile = $zip->open('update.zip');
			if ($openedzipfile == true) {
				
				foreach ( $updatestatus[1] as $zipfilekey => $zipfilename) {
					$datafile = $zip->getFromName( $zipfilename );
					echo $datafile;
					if ( ! file_exists( str_ireplace( "icms-main", '', $zipfilename) ) ) {
						mkdir( dirname(str_ireplace( "icms-main", '', $zipfilename)) );
					}
					file_put_contents( str_ireplace( "icms-main", '', $zipfilename) , $datafile);
				}

				$zip->close();

				unlink('update.zip');
			}

		}else{

			

		}

	}

?>