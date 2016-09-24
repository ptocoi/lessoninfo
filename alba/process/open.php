<?php
		/*
		* /application/alba/process/open.php
		* @author Harimao
		* @since 2014/03/14
		* @last update 2015/02/27
		* @Module v3.5 ( Alice )
		* @Brief :: Alba open service update
		* @Comment :: 채용공고 열람권 사용 프로세스
		*/

		$alice_path = "../../";

		$cat_path = "../../";

		include_once $alice_path . "_core.php";

		if(!$is_member){	// 회원 체크
			$utility->popup_msg_js($user_control->_errors('0015'),$alice['member_path']."/login.php?url=".$urlencode);
			exit;
		}

		$no = $_POST['no'];
		$wr_id = $_POST['wr_id'];
		$type = $_POST['type'];

		$get_alba = $alba_user_control->get_alba_no($no);	// 정규직 정보

		// 열람권 기간/건수 확인
		$is_open_service = false;
		if( $utility->valid_day($member_service['mb_service_alba_open']) ){
			$is_open_service = $member_service['mb_service_alba_open'];
		}
		$is_open_count = false;
		if( $utility->valid_day($member_service['mb_service_alba_open']) && $member_service['mb_service_alba_count'] ){	// 건수 사용이 가능하다면
			$is_open_count = $member_service['mb_service_alba_count'];
		}

		if($is_open_count){

			$result = $alba_individual_control->open_insert($no,$get_alba['wr_id'],$type);

			echo $result;

		} else {

			echo "0005";	// 사용가능한 채용공고 열람권이 없습니다.
			exit;

		}
?>