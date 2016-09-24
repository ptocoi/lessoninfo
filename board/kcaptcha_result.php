<?php

	$alice_path = "../";

	$cat_path = "../";

	include_once $alice_path . "_core.php";

	$count = (int)$_SESSION['captcha_count'];
	if ($count >= 5) { // 설정값 이상이면 자동등록방지 입력 문자가 맞아도 오류 처리
		echo false;
	} else {
		$utility->set_session("captcha_count", $count + 1);
		echo ($_SESSION['captcha_keystring'] == $_POST['captcha_key']) ? true : false;
	}
?>