<?php
		/*
		* /application/popup/find_id.php
		* @author Harimao
		* @since 2015/07/28
		* @last update 2015/07/28
		* @Module v3.5 ( Alice )
		* @Brief :: 
		* @Comment :: 이메일 수신거부 팝업창
		*/
		
		$alice_path = "./";

		$cat_path = "./";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "popup";

		include_once $cat_path . "_engine.php";

		##
		# Variables
		$sending_email = $_GET['email'];
		$member_info = $db->query_fetch(" select * from `alice_member` where `mb_email` = '".$sending_email."' and find_in_set('email', `mb_receive`) ");
		$mb_receive = $member_info['mb_receive'];

        if($mb_receive) {

			$receive_arr = explode(",", $mb_receive);
			foreach($receive_arr as $val) {
			   if($val == 'sms') { $re_val = $val; }
				  $ggom_val = ($re_val) ? "," : "";
			   if($val == 'memo') { $re_val .= $ggom_val.$val; }
			}
           $result = $db->_query(" update `alice_member` set `mb_receive`='".$re_val."' where `mb_email` = '".$sending_email."' ");
        
		}

		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('placeholder'));

		##
		# Include view
		if(is_file($alice['self'] . 'views/email_opt.html'))
			include_once $alice['self'] . 'views/email_opt.html';
		else
			$config->error_info( $alice['self'] . 'views/email_opt.html' );

		$config_control->_tail(true);	// tail;

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>