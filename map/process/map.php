<?php
		/*
		* /application/map/process/map.php
		* @author Harimao
		* @since 2013/10/23
		* @last update 2015/03/31
		* @Module v3.5 ( Alice )
		* @Brief :: Map info
		* @Comment :: 지도 내용 상세 보기
		*/

		$alice_path = "../../";

		$cat_path = "../../";

		include_once $alice_path . "_core.php";

		$mode = $_POST['mode'];
		$no = $_POST['no'];	// 지도 마크 순서
		$data_no = $_POST['data_no'];	// 데이터 no

		$get_alba = $alba_user_control->get_alba_no($data_no);	// 알바 정보

		$get_comapny = $user_control->get_member_company_no($get_alba['wr_company']);

		$wr_company_name = stripslashes($get_comapny['mb_company_name']);	 // 회사명

		if($get_alba['wr_volume_always']){	 // 상시모집이라면
			$end_date = "상시모집";
		} else {
			$end_date = $get_alba['wr_volume_date'];
		}
		if($get_alba['wr_volume_end']){	// 채용시까지라면
			$volume_date = "(모집시마감)";
		} else {
			if($utility->valid_day($get_alba['wr_volume_date'])){
				$wr_volume_date = $utility->date_diff( $get_alba['wr_volume_date'], date('Y-m-d') );
				$volume_date = "(마감일 ".$wr_volume_date."일전)";
			} else {
				$volume_date = "(마감됨)";
			}
		}

		$alba_info = $alba_user_control->get_alba_list($get_alba['no']);


		// 직종
		$job_type_arr = array( "job_type0" => $get_alba['wr_job_type0'], "job_type1" => $get_alba['wr_job_type1'], "job_type2" => $get_alba['wr_job_type2'] );
		$job_type = $alba_user_control->list_type($job_type_arr);

		ob_start();
		include_once $alice['map_path'] . "/views/_include/alba.inc.php";
		$msg = ob_get_contents();
		ob_end_clean();


		$result = array();

		if($get_alba['wr_area_point']){
			$wr_area_point = explode(',',$get_alba['wr_area_point']);
			$result['x'] = $wr_area_point[0];
			$result['y'] = $wr_area_point[1];
			$result['msg'] = $msg;
		}

		echo json_encode($result);
?>

