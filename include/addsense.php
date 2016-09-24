<?php
		/*
		* /application/include/adsense.php
		* @author Harimao
		* @since 2013/07/02
		* @last update 2015/05/08
		* @Module v3.5 ( Alice )
		* @Brief :: Google adsense iframe
		* @Comment :: 애드센스 iframe (그냥 출력하면 오류가 발생하여 iframe 으로 만듦)
		*/
		
		$alice_path = "../";

		$cat_path = "../";

		include_once $alice_path . "_core.php";

		$no = $_GET['no'];

		$get_banner = $banner_control->get_banner($no);

		echo stripslashes($get_banner['content']);
?>