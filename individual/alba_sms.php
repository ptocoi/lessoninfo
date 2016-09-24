<?php
		/*
		* /application/individual/alba_sms.php
		* @author Harimao
		* @since 2013/08/13
		* @last update 2015/04/03
		* @Module v3.5 ( Alice )
		* @Brief :: Individual SMS send list
		* @Comment :: ����ȸ�� SMS ���ڹ߼� ����Ʈ
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// ���� ����θ� ���� cat path ( app_config.php ������ $cat_path �� ���� )

		$page_name = "individual";

		$banner_atop_position = $page_name . "_top";
		$banner_logo_position = $page_name . "_logo_banner";
		$banner_top_position = $page_name . "_top_banner";
		$banner_left_position = $page_name . "_left";
		$banner_tail_position = $page_name . "_bottom";
		$banner_left_wing_position = $page_name . "_left_scroll";
		$banner_right_wing_position = $page_name . "_right_scroll";

		include_once $cat_path . "_engine.php";

		##
		# Variables
		$type = $_GET['type'];
		$page = ($page) ? $page : 1;
		$page_rows = ($page_rows) ? $page_rows : 15;
		$where = ($mode=='search') ? " and " : " where ";
		$con = ($type=='receive') ? $where." `wr_receive` = '".$member['mb_id']."' " : $where." `wr_id` = '".$member['mb_id']."' ";
		$list = $sms_control->__LogList($page, $page_rows, $con);
		$total_page = $list['total_page'];
		$pages = $utility->user_get_paging($page_rows, $page, $total_page,"./alba_sms.php?page_rows=".$page_rows."&".$list['send_url']."&page=");

		$sdate = $_GET['sdate'];
		$sdate_cnt = count($sdate);
		$edate = $_GET['edate'];
		$edate_cnt = count($edate);

		$start_day = $sdate[0] . "-" . $sdate[1] . "-" . $sdate[2];
		$end_day = $edate[0] . "-" . $edate[1] . "-" . $edate[2];


		##
		# Plugin, UI, CSS include
		echo $config->_plugin('form');

		##
		# Include view
		if(is_file($alice['self'] . 'views/alba_sms.html'))
			include_once $alice['self'] . 'views/alba_sms.html';
		else
			$config->error_info( $alice['self'] . 'views/alba_sms.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// �ӵ����� ��
			$_time = $_end - $_begin;
			echo "<p>�۾�����ð� :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>