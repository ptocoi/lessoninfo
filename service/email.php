<?php
		/*
		* /application/service/email.php
		* @author Harimao
		* @since 2013/11/01
		* @last update 2014/07/08
		* @Module v3.5 ( Alice )
		* @Brief :: Agreement info
		* @Comment :: �̿����� ����Ѵ�.
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// ���� ����θ� ���� cat path ( app_config.php ������ $cat_path �� ���� )

		$page_name = "service";

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
		/*
		$wr_type = "on2on";
		$cs_category = $category_control->__CategoryList($wr_type);	// ������ �з�

		$hphone_num = explode('-',$member['mb_hphone']);
		$hp_num_option = $config->get_hp_num($hphone_num[0]);	 // �޴�����ȣ ����
		
		$phone_num = explode('-',$member['mb_phone']);
		$tel_num_option = $config->get_tel_num($phone_num[0]);	 // ��ȭ��ȣ ����

		$mb_email = explode('@',$member['mb_email']);
		$email_option = $config->get_email();	 // �̸��� ���� ������
		*/

		##
		# Include view
		if(is_file($alice['self'] . 'views/email.html'))
			include_once $alice['self'] . 'views/email.html';
		else
			$config->error_info( $alice['self'] . 'views/email.html' );


		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// �ӵ����� ��
			$_time = $_end - $_begin;
			echo "<p>�۾�����ð� :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>