<?php
		/*
		* /application/individual/process/file.php
		* @author Harimao
		* @since 2015/01/13
		* @last update 2015/03/12
		* @Module v3.5 ( Alice )
		* @Brief :: Alba file process
		* @Comment :: 정규직 이력서 파일 처리 프로세스
		*/

		$alice_path = "../../";

		$cat_path = "../../";

		include_once $alice_path . "_core.php";

		$mode = $_POST['mode'];
		$no = $_POST['no'];

		$mb_type = $_POST['mb_type'];
		$mb_id = $_POST['mb_id'];
		$wr_type = $_POST['wr_type'];

		$attach_path = $alice['data_alba_abs_path'] . '/' . $ym;
		@mkdir($attach_path, 0707);
		@chmod($attach_path, 0707);
		$file = $attach_path . "/index.html";
		if(!file_exists($file)){	// 디렉토리 보안을 위해서
			$f = @fopen($file, "w"); @fwrite($f, ""); @fclose($f); @chmod($file, 0606);
		}

		switch($mode){

			## 입력
			case 'insert':
			
				$vals['wr_type'] = $wr_type;
				$vals['wr_id'] = $mb_id;

				$tmp_file	= $_FILES['wr_content']['tmp_name'];
				$filename	= $_FILES['wr_content']['name'];
				$filesize		= $_FILES['wr_content']['size'];

				$vals['wr_source'] = addslashes($filename);

				$timg = @getimagesize($tmp_file);

				if(is_uploaded_file($tmp_file)){
					$file_extension = $config->_upload();	// 확장자 체크
					if(preg_match("/\.($file_extension)$/i", $filename)){ // 파일 확장자 체크
						$file_upload = $utility->file_upload($tmp_file, $filename, $attach_path, $_FILES);	// 파일 업로드
						$upload_file = $file_upload['upload_file'];
						$vals['wr_content'] = $ym . "/" . $upload_file;
					} else {
						$utility->popup_msg_js($alba_file_control->_errors('0003'));
						exit;
					}
				}

				$vals['wr_filesize'] = $filesize;
				$vals['wr_width'] = ($timg[0]) ? $timg[0] : 0;
				$vals['wr_height'] = ($timg[1]) ? $timg[1] : 0;
				$vals['wr_file'] = ($timg[2]) ? $timg[2] : 0;

				$vals['wr_wdate'] = $alice['time_ymdhis'];

				$result = $alba_file_control->insert_file($vals);

				if($result){
					$utility->popup_msg_js($alba_file_control->_success('0000'),"../file.php");
				} else {
					$utility->popup_msg_js($alba_file_control->_errors('0001'));
				}

			break;

			## 삭제
			case 'delete':
			
				$result = $alba_file_control->delete_file($no);

				echo $result;

			break;

			## 선택삭제
			case 'sel_delete':

				$no_cnt = count($no);
				for($i=0;$i<$no_cnt;$i++){
					$result = $alba_file_control->delete_file($no[$i]);
				}

				echo $result;

			break;
		}	// switch end.

?>