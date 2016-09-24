<?php
	$alice_path = "../../";

	$cat_path = "../../";

	include_once $alice_path . "_core.php";

	$mode = $_POST['mode'];
	$no = $_POST['no'];
	$wr_type = $_POST['wr_type'];	// cs 분류

	$wr_id = ($_POST['wr_id']) ? $_POST['wr_id'] : 'guest';	 // 회원/비회원 구분
	$wr_name = trim(strip_tags(mysql_escape_string($_POST['wr_name'])));
	$wr_biz_name = trim(strip_tags(mysql_escape_string($_POST['wr_biz_name'])));
	$wr_email = $_POST['wr_email'];
	$wr_hphone = $_POST['wr_hphone'];
	$wr_hphone_cnt = count($wr_hphone);
	$wr_phone = $_POST['wr_phone'];

	$get_cs = $cs_control->get_cs($no);

	/* captcha 확인 */
	if (!$is_member || $is_guest) {	// 비회원 일때
		$key = $_SESSION['captcha_keystring'];
		if (!($key && $key == $_POST['wr_key'])) {
			session_unregister("captcha_keystring");
			$utility->popup_msg_js( $config->_errors('0046') );
			exit;
		}
	}
	/* //captcha 확인 */

	if (substr_count($_POST['wr_content'], "&#") > 50) {
		$utility->popup_msg_js( $config->_errors('0034') );
		exit;
	}

	$vals['wr_type'] = $wr_type;
	$vals['wr_cate'] = $_POST['wr_cate'];
	$vals['wr_id'] = $wr_id;

	if(!$wr_name || $wr_name==''){
		$utility->popup_msg_js( $cs_control->_errors('0005') );
		exit;
	} else {
		$vals['wr_name'] = $wr_name;
	}

	$vals['wr_biz'] = $_POST['wr_biz'];	// 주요사업
	$vals['wr_biz_name'] = $_POST['wr_biz_name'];	// 업체명
	$vals['wr_biz_type'] = $_POST['wr_biz_type'];	// 제휴부분

	if(!$wr_email || $wr_email==''){
		$utility->popup_msg_js( $cs_control->_errors('0006') );
		exit;
	} else {
		$vals['wr_email'] = @implode($wr_email,'@');
	}

	for($i=0;$i<$wr_hphone_cnt;$i++){
		if($wr_hphone[$i]==''){
			$utility->popup_msg_js( $cs_control->_errors('0007') );
			exit;
		}
	}

	$vals['wr_phone'] = @implode($wr_phone,'-');
	$vals['wr_hphone'] = @implode($wr_hphone,'-');

	$vals['wr_site'] = ($_POST['wr_site']) ? $utility->add_http($_POST['wr_site']) : "";

	if($mode=='concert_insert'){	// 제휴/광고문의
		if(!$wr_biz_name){
			$utility->popup_msg_js( $cs_control->_errors('0008') );
			exit;
		} else {
			$vals['wr_biz_name'] = $wr_biz_name;
		}
	}

	if (!isset($_POST['wr_subject']) || !trim($_POST['wr_subject'])) {
		$utility->popup_msg_js( $cs_control->_errors('0009') );
		exit;
	} else {
		$vals['wr_subject'] = $_POST['wr_subject'];
	}

	if (!isset($_POST['wr_content']) || !trim($_POST['wr_content'])) {
		$utility->popup_msg_js( $cs_control->_errors('0010') );
		exit;
	} else {
		$vals['wr_content'] = $_POST['wr_content'];
	}

	$vals['wr_date'] = $now_date;

	$result = $cs_control->insert_cs($vals);

	$utility->popup_msg_js("고객문의가 완료되었습니다.");

?>