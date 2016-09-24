<?php
		/*
		* /application/popup/_engine.php
		* @author Harimao
		* @since 2013/07/26
		* @last update 2013/07/26
		* @Module v3.5 ( Alice )
		* @Brief :: Application Engine Injection
		* @Comment :: 상위에 있는 _core 에 접근, applicaiton 공통 작업 변수 설정
		*/

		$alice_path = "../";

		$cat_path = "../";

		include_once $alice_path . "_core.php";

		##
		# Header
		# 필요에 의한 style, jQuery plugin 추가가 가능합니다.
		# 아래는 예시 입니다.
		$style_arr = array( 'index' );
		//$plugin_arr = array( 'easing', 'jcarousellite', 'masonry', 'modernizr-transitions', 'infinitescroll', 'cookie', 'form', 'ui', 'placeholder', 'fileupload', 'fileupload-ui', 'autogrowtextarea', 'nyroModal' );
		echo $config->_user_header( '', $style_arr, '', $plugin_arr);		// body, css style, css media, jQuery plugin


		// ie 버전 체크
		$ie_version = $utility->_IE_Vercheck();

?>