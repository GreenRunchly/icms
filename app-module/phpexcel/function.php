<?php

	/// Mengambil Data Excel
	function app_excel_get_data( $file_where, $at_sheet=0, $which_cell=['A','B'], $at_row=0, $last_row=''){

		/// Load PHP Excel Library
		require_once __DIR__ . "/phpexcel-1.8/Classes/PHPExcel.php";

		$output = array();
		$output['success'] = 0;

		if ( ! empty( $file_where ) ){

			$excelReader = PHPExcel_IOFactory::createReaderForFile($file_where);
			$excelObj = $excelReader->load($file_where);
			$worksheet = $excelObj->getSheet($at_sheet);

			if ( empty ( $last_row ) ){
				$last_row = $worksheet->getHighestRow();
			}
			

			$data = [];
			for ($row = $at_row; $row <= $last_row; $row++) {
				$tempdata = [];
			    foreach ($which_cell as $kcell => $cell) {
			    	$tempdata[$cell] = $worksheet->getCell($cell.$row)->getValue();
			    }
			    $data[] = $tempdata;
			}
			$output['result'] = $data;
			$output['success'] = 1;
		}

		return $output;

	}