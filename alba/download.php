<?php
		/*
		* /application/alba/download.php
		* @author Harimao
		* @since 2013/08/02
		* @last update 2013/08/02
		* @Module v3.5 ( Alice )
		* @Brief :: Alba file download
		* @Comment :: 정규직 공고 양식 파일 다운로드
		*/

		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		include_once $alice_path . "_core.php";

		$no = $_GET['no'];

		$get_alba = $alba_user_control->get_alba_no($no);

		$wr_form_attach = explode('/',$get_alba['wr_form_attach']);

		$file_ext = $utility->get_extension($wr_form_attach[1]);

		$trans_arr = array( ' ' => '_', '  ' => '_');

		$file_name = strtr($get_alba['wr_company_name'],$trans_arr) . "_지원양식_" . $alice['server_time'] . "." . $file_ext;

		$filepath = $alice['data_alba_path'] . '/' . $get_alba['wr_form_attach'];
		$filepath = addslashes($filepath);
		if (!is_file($filepath) || !file_exists($filepath)){
			$utility->popup_msg_js($config->_errors('0054'));	// 파일이 존재하지 않습니다.
			exit;
		}

		if (preg_match("/^utf/i", $alice['charset']))
			$original = urlencode($file_name);
		else
			$original = $file_name;

		if(preg_match("/msie/i", $_SERVER['HTTP_USER_AGENT']) && preg_match("/5\.5/", $_SERVER['HTTP_USER_AGENT'])) {
			header("content-type: doesn/matter");
			header("content-length: ".filesize("$filepath"));
			header("content-disposition: attachment; filename=\"$original\"");
			header("content-transfer-encoding: binary");
		} else {
			header("content-type: file/unknown");
			header("content-length: ".filesize("$filepath"));
			header("content-disposition: attachment; filename=\"$original\"");
			header("content-description: php generated data");
		}
		header("pragma: no-cache");
		header("expires: 0");
		flush();

		$fp = fopen("$filepath", "rb");

		$download_rate = 10;

		while(!feof($fp)) {
			print fread($fp, round($download_rate * 1024));
			flush();
			usleep(1000);
		}
		fclose ($fp);
		flush();

?>