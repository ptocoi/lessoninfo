<?php
		/*
		* /application/main/views/_load/banner.php
		* @author Harimao
		* @since 2013/08/09
		* @last update 2015/03/24
		* @Module v3.5 ( Alice )
		* @Brief :: Banner ajax refresh load
		* @Comment :: 배너를 새로고침 할때나 기타 배너관련 ajax 처리시
		*/

		$alice_path = "../../../";
		
		$cat_path = "../../../";

		include_once $alice_path . "_core.php";

		$mode = $_POST['mode'];
		$position = $_POST['position'];


		switch($mode){

			## 메인 상단 배너 새로고침 (쿠키값 체크)
			case 'top_banner_refresh':
				
				echo $banner_control->get_banner_for_position('main_top');

			break;

		}

?>