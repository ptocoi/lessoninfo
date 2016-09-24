<?php
		/*
		* /application/popup/print_proof_resume.php
		* @author Harimao
		* @since 2013/10/16
		* @last update 2013/10/16
		* @Module v3.5 ( Alice )
		* @Brief :: Alba proot print popup
		* @Comment :: 취업활동 증명서 팝업창
		*/
		
		$alice_path = "./";

		$cat_path = "./";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "popup";

		include_once $cat_path . "_engine.php";

		##
		# Variables
		$apply_no = explode(',',$_GET['apply_no']);
		$apply_no_cnt = count($apply_no);
		$mb_ssn = substr(str_replace('-','',$member['mb_birth']),2,6);
		$mb_address = $member['mb_address0'] . " ".$member['mb_address1'];
		$mb_phones = ($member['mb_phone']) ? $member['mb_phone'] : $member['mb_hphone'];
		$proof_last_no = sprintf('%06d',$alba_individual_control->proof_last_no()+1);


		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('form'));

		##
		# Include view
		if(is_file($alice['self'] . 'views/print_proof_resume.html'))
			include_once $alice['self'] . 'views/print_proof_resume.html';
		else
			$config->error_info( $alice['self'] . 'views/print_proof_resume.html' );

		$config_control->_tail(true);	// tail;

		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>