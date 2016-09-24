<?php
		/*
		* /application/map/views/_load/area.php
		* @author Harimao
		* @since 2013/10/23
		* @last update 2015/03/31
		* @Module v3.5 ( Alice )
		* @Brief :: Area ajax load
		* @Comment :: 지역정보 로드
		*/

		$alice_path = "../../../";
		
		$cat_path = "../../../";

		include_once $alice_path . "_core.php";

		$mode = $_POST['mode'];
		$type = $_POST['type'];
		$p_code = $_POST['p_code'];
		$target = $_POST['target'];

		switch($mode){
			
			## 2/3차 지역 select 생성
			case 'second_area':
			
				$pcodeList = $category_control->category_pcodeList($type, $p_code);

				switch($target){

					// 2차 지역 추출
					case 'wr_area_1':
						$title = "시군구 선택";
						$option = "<option value=\"\">시군구</option>";
						$name = "wr_area[]";
						$targets = "wr_area_2";
					break;

					// 3차 지역 추출
					case 'wr_area_2':
						$title = "읍면동 선택";
						$option = "<option value=\"\">읍면동</option>";
						$name = "wr_area[]";
						$targets = "";
					break;

				}	// inside switch end.

				$result  = "<select class=\"ipSelect\" style=\"width:70px;\" id=\"".$target."\" name=\"".$name."\" title=\"".$title."\" onchange=\"area_sel_first(this,'".$targets."');\">";
				$result .= $option;
				if($pcodeList){
					foreach($pcodeList as $val){
						$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
						$result .= "<option value=\"".$val['code']."\">".$name."</option>";
					}
				}
				$result .= "</select>";

				echo $result;

			break;

			## 2/3차 직종 select 생성
			case 'second_job_type':
				
				if($target=='wr_job_type_1'){
					$title = "= 2차 직종선택 =";
					$option = "<option value=\"\">1차 직종을 먼저 선택해 주세요</option>";
				} else if($target=='wr_job_type_2'){
					$title = "= 3차 직종선택 =";
					$option = "<option value=\"\">2차 직종을 먼저 선택해 주세요</option>";
				}

				$targets = array( "wr_job_type_1" => "wr_job_type_2", "wr_job_type_2" => "wr_job_type_3" );

				$pcodeList = $category_control->category_pcodeList($type, $p_code);

				$result  = "<select class=\"ipSelect\" style=\"width:180px;\" id=\"".$target."\" name=\"wr_job_type[]\" title=\"".$title."\"  onchange=\"job_type_sel_first(this,'".$targets[$target]."');\">";
				$result .= "<option value=\"\">".$title."</option>";
				if($pcodeList){
					foreach($pcodeList as $val){
						$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
						$result .= "<option value=\"".$val['code']."\">".$name."</option>";
					}
				} else {
					$result .= $option;
				}
				$result .= "</select>";

				echo $result;

			break;

			// 지도검색
			case 'map_search':

				$area = explode('/',$_POST['area']);
				$area_cnt = count($area);
				$job_type = explode('/',$_POST['job_type']);


				// 지도 위치 중심 잡기
				$map_search = "";
				for($i=0;$i<$area_cnt;$i++){
					$area_name = $category_control->get_categoryCodeName($area[$i]);
					if($area_name == '전체') continue;
					$spaces = ($i >= 1) ? " " : "";
					$map_search .= $spaces . $area_name;
				}

				// 기본 검색 쿼리
				$search_con = array();
				array_push( $search_con, " where `wr_open` = 1 and `wr_is_adult` = 0 and `wr_report` = 0 and `is_delete` = 0 " );

				
				// 지역 검색
				$area_search = " ( ";
				for($i=0;$i<$area_cnt;$i++){
					//$_and = ($area_cnt != $i+1) ? " and " : "";
					$_or = ($area_cnt != $i+1) ? " or " : "";
					$area_search .= " INSTR( `wr_area_0`, '".$area[$i]."' ) " . $_or;
				}
				$area_search .= " ) ";

				array_push( $search_con, $area_search );
				array_push( $search_con, " `wr_area_0_point` != '' " );


				// 직종 검색
				if($job_type[0]){	// 첫번째 직종값은 무조건 있을까?
					array_push( $search_con, " `wr_job_type0` = '".$job_type[0]."' ");
					if($job_type[1]){
						array_push( $search_con, " `wr_job_type1` = '".$job_type[1]."' ");
					}
					if($job_type[2]){
						array_push( $search_con, " `wr_job_type2` = '".$job_type[2]."' ");
					}
				}

				$search_query = implode($search_con," and ");

				$alba_list = $alba_user_control->__AlbaList( "", "", $search_query );

				$result = array();

				$result['result']['area'] = $map_search;

				$i = 0;
				foreach($alba_list['result'] as $val){
					if($val['wr_area_0_point']){
						$result['result'][$i]['data_no'] = $val['no'];
						$wr_area_0_points = explode(',',$val['wr_area_0_point']);
						$result['result'][$i]['x'] = $wr_area_0_points[0];
						$result['result'][$i]['y'] = $wr_area_0_points[1];
					}
				$i++;
				}

				echo json_encode($result);

			break;

		}	// switch end.
?>