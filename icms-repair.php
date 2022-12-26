<?php

	$updatestatus = json_decode(file_get_contents('https://raw.githubusercontent.com/GreenRunchly/icms/main/server/latest.json'), true);
	$updatestatus[0][1] = '1.1';

	if ( ! empty( $updatestatus[0][0] ) ){

		if ( $updatestatus[0][0] != $updatestatus[0][1] ){

			$updatefile = file_put_contents('update.temp',file_get_contents('https://github.com/GreenRunchly/icms/archive/refs/heads/main.zip'));

			$zip = new ZipArchive;
			$openedzipfile = $zip->open('update.temp');
			if ($openedzipfile == true) {
				
				foreach ( $updatestatus[1] as $zipfilekey => $zipfilename) {
					$datafile = $zip->getFromName( $zipfilename );
					file_put_contents( $zipfilename , $datafile);
				}

				$zip->close();

				unlink('update.temp');
			}

		}else{

			

		}

	}
?>