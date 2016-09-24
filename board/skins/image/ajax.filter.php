<?php
	include_once "../../_engine.php";

	if (!function_exists('convert_charset')){
		/*
		-----------------------------------------------------------
			Charset 을 변환하는 함수
		-----------------------------------------------------------
		iconv 함수가 있으면 iconv 로 변환하고
		없으면 mb_convert_encoding 함수를 사용한다.
		둘다 없으면 사용할 수 없다.
		*/
		function convert_charset($from_charset, $to_charset, $str) {
			if( function_exists('iconv') )
				return iconv($from_charset, $to_charset, $str);
			elseif( function_exists('mb_convert_encoding') )
				return mb_convert_encoding($str, $to_charset, $from_charset);
			else
				die("Not found 'iconv' or 'mbstring' library in server.");
		}
	}

	header("Content-Type: text/html; charset=utf-8");

	$subject = strtolower(stripslashes($_POST['subject']));
	$content = strtolower(strip_tags($_POST['content']));

	$cf_filter = $board['bo_filter'];

	$filter = explode(",", trim($cf_filter));
	$subj = "";
	$cont = "";
	for ($i=0; $i<count($filter); $i++) {
		$str = $filter[$i];
		// 제목 필터링 (찾으면 중지)
		$pos = strpos($subject, $str);
		
		if ($pos !== false)
			$subj = $str;

		// 내용 필터링 (찾으면 중지)
		$pos = strpos($content, $str);
		if ($pos !== false)
				$cont = $str;

	}

	die("{\"subject\":\"$subj\",\"content\":\"$cont\"}");

?>