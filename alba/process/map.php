<?php
		/*
		* /application/alba/process/map.php
		* @author Harimao
		* @since 2013/10/17
		* @last update 2015/03/31
		* @Module v3.5 ( Alice )
		* @Brief :: Alba map info
		* @Table :: alice_receive
		* @Comment :: 정규직 입사지원
		*/

		$alice_path = "../../";

		$cat_path = "../../";

		include_once $alice_path . "_core.php";

		$mode = $_POST['mode'];
		$no = $_POST['no'];
		$data_no = $_POST['data_no'];	// 공고/이력서 no

		switch($mode){

			## 제목만 출력
			case 'subject':	

				$get_alba = $alba_user_control->get_alba_no($data_no);	// 정규직 정보

				$wr_subject = stripslashes($get_alba['wr_subject']);	 // 공고 제목
				$wr_company_name = stripslashes($get_alba['wr_company_name']);	 // 회사명

				ob_start();
				include_once $alice['alba_path'] . "/views/_include/subject.inc.php";
				$msg = ob_get_contents();
				ob_end_clean();

				$result = array();
				if($get_alba['wr_area_0_point']){
					$wr_area_0_points = explode(',',$get_alba['wr_area_0_point']);
					$area_0_point['x'] = $wr_area_0_points[0];
					$area_0_point['y'] = $wr_area_0_points[1];
					$area_0_point['msg'] = $msg;
					array_push($result,$area_0_point);
				}
				if($get_alba['wr_area_1_point']){
					$wr_area_1_points = explode(',',$get_alba['wr_area_1_point']);
					$area_1_point['x'] = $wr_area_1_points[0];
					$area_1_point['y'] = $wr_area_1_points[1];
					$area_1_point['msg'] = $msg;
					array_push($result,$area_1_point);
				}
				if($get_alba['wr_area_2_point']){
					$wr_area_2_points = explode(',',$get_alba['wr_area_2_point']);
					$area_2_point['x'] = $wr_area_2_points[0];
					$area_2_point['y'] = $wr_area_2_points[1];
					$area_2_point['msg'] = $msg;
					array_push($result,$area_2_point);
				}

				echo json_encode($result[$no]);
				
			break;
		}
?>