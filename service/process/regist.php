<?php
		/*
		* /application/service/process/regist.php
		* @author Harimao
		* @since 2013/10/01
		* @last update 2015/03/13
		* @Module v3.5 ( Alice )
		* @Brief :: Service process
		* @Comment :: 서비스별 처리 프로세스
		*/

		$alice_path = "../../";

		$cat_path = "../../";

		include_once $alice_path . "_core.php";

		$mode = $_POST['mode'];
		$ajax = $_POST['ajax'];
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
		
		$result = array();	// 최종 결과값

		$result['mode'] = $mode;


		switch($mode){

			case 'qna_insert':		## 고객센터 문의
			case 'advert_insert':	## 광고 문의
			case 'concert_insert':	## 제휴 문의

				/* captcha 확인 */
				if (!$is_member || $is_guest) {	// 비회원 일때
					$key = $_SESSION['captcha_keystring'];
					if (!($key && $key == $_POST['wr_key'])) {
						session_unregister("captcha_keystring");
						echo '0046';	// config::자동등록방지 글을 정확히 입력해 주세요.
						exit;
					}
				}
				/* //captcha 확인 */

				if (substr_count($_POST['wr_content'], "&#") > 50) {
					echo '0034';	// config::내용에 올바르지 않은 코드가 다수 포함되어 있습니다.
					exit;
				}

				$vals['wr_type'] = $wr_type;
				$vals['wr_cate'] = $_POST['wr_cate'];
				$vals['wr_id'] = $wr_id;

				if(!$wr_name || $wr_name==''){
					echo '0005';	// cs_control::이름을 입력해 주세요.
					exit;
				} else {
					$vals['wr_name'] = $wr_name;
				}

				$vals['wr_biz'] = $_POST['wr_biz'];	// 주요사업
				$vals['wr_biz_name'] = $_POST['wr_biz_name'];	// 업체명
				$vals['wr_biz_type'] = $_POST['wr_biz_type'];	// 제휴부분

				if(!$wr_email || $wr_email==''){
					echo '0006';	// cs_control::이메일 주소를 입력해 주세요.
					exit;
				} else {
					$vals['wr_email'] = @implode($wr_email,'@');
				}

				for($i=0;$i<$wr_hphone_cnt;$i++){
					if($wr_hphone[$i]==''){
						echo '0007';	// cs_control::휴대폰 번호를 입력해 주세요.
						exit;
					}
				}

				$vals['wr_phone'] = @implode($wr_phone,'-');
				$vals['wr_hphone'] = @implode($wr_hphone,'-');

				$vals['wr_site'] = ($_POST['wr_site']) ? $utility->add_http($_POST['wr_site']) : "";

				if($mode=='concert_insert'){	// 제휴/광고문의
					if(!$wr_biz_name){
						echo '0008';	// cs_control::업체명을 입력해 주세요.
						exit;
					} else {
						$vals['wr_biz_name'] = $wr_biz_name;
					}
				}

				if (!isset($_POST['wr_subject']) || !trim($_POST['wr_subject'])) {
					echo '0009';	// cs_control::제목을 입력해 주세요.
					exit;
				} else {
					$vals['wr_subject'] = $_POST['wr_subject'];
				}

				if (!isset($_POST['wr_content']) || !trim($_POST['wr_content'])) {
					echo '0010';	// cs_control::내용을 입력해 주세요.
					exit;
				} else {
					$vals['wr_content'] = $_POST['wr_content'];
				}

				$vals['wr_date'] = $now_date;

				$result['result'] = $cs_control->insert_cs($vals);

			break;

		}

		echo @implode('/',$result);

?>