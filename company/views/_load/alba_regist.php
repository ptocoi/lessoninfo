<?php
		/*
		* /application/company/views/_load/alba_resume_regist.php
		* @author Harimao
		* @since 2013/07/29
		* @last update 2015/03/19
		* @Module v3.5 ( Alice )
		* @Brief :: Alba regist ajax load
		* @Comment :: 알바 등록시 필요한 사항들 로드
		*/

		$alice_path = "../../../";
		
		$cat_path = "../../../";

		include_once $alice_path . "_core.php";

		$mode = $_POST['mode'];
		$type = $_POST['type'];
		$p_code = $_POST['p_code'];
		$target = $_POST['target'];


		switch($mode){

			## 2/차차 지역 select 생성
			case 'second_area':
				
				$pcodeList = $category_control->category_pcodeList($type, $p_code);

				if($target=='wr_area_01'){
					$title = "시군구 선택";
					$option = "<option value=\"\">시군구</option>";
					$name = "wr_area_0[]";
					$targets = "wr_area_02";
				} else if($target=='wr_area_02'){
					$title = "읍면동 선택";
					$option = "<option value=\"\">읍면동</option>";
					$name = "wr_area_0[]";
					$targets = "";
				}

				if($target=='wr_area_11'){
					$title = "시군구 선택";
					$option = "<option value=\"\">시군구</option>";
					$name = "wr_area_1[]";
					$targets = "wr_area_12";
				} else if($target=='wr_area_12'){
					$title = "읍면동 선택";
					$option = "<option value=\"\">읍면동</option>";
					$name = "wr_area_1[]";
					$targets = "";
				}

				if($target=='wr_area_21'){
					$title = "시군구 선택";
					$option = "<option value=\"\">시군구</option>";
					$name = "wr_area_2[]";
					$targets = "wr_area_22";
				} else if($target=='wr_area_22'){
					$title = "읍면동 선택";
					$option = "<option value=\"\">읍면동</option>";
					$name = "wr_area_2[]";
					$targets = "";
				}

				$result  = "<select class=\"ipSelect\" style=\"width:70px;\" id=\"".$target."\" name=\"".$name."\" title=\"".$title."\" onchange=\"area_sel_first(this,'".$targets."');\">";
				$result .= $option;
				if($pcodeList){
					foreach($pcodeList as $val){
						if(stristr($val['code'],'all')) continue;
						$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
						$result .= "<option value=\"".$val['code']."\">".$name."</option>";
					}
				}
				$result .= "</select>";

				echo $result;

			break;

			## 2/3차 직종 select 생성
			case 'second_job_type':
				
				if($target=='wr_job_type1' || $target=='wr_job_type4' || $target=='wr_job_type7'){
					$title = "= 2차 직종선택 =";
					$option = "<option value=\"\">1차 직종을 먼저 선택해 주세요</option>";
				} else if($target=='wr_job_type2' || $target=='wr_job_type5' || $target=='wr_job_type8'){
					$title = "= 3차 직종선택 =";
					$option = "<option value=\"\">2차 직종을 먼저 선택해 주세요</option>";
				}

				$targets = array( "wr_job_type1" => "wr_job_type2", "wr_job_type2" => "wr_job_type3", "wr_job_type3" => "wr_job_type4", "wr_job_type4" => "wr_job_type5","wr_job_type5" => "wr_job_type6", "wr_job_type6" => "wr_job_type7", "wr_job_type7" => "wr_job_type8" );
				$ids = array( "wr_job_type1" => "wr_jobtype_01", "wr_job_type2" => "wr_jobtype_02", "wr_job_type4" => "wr_jobtype_11", "wr_job_type5" => "wr_jobtype_12", "wr_job_type7" => "wr_jobtype_21", "wr_job_type8" => "wr_jobtype_22" );

				$pcodeList = $category_control->category_pcodeList($type, $p_code);

				$result  = "<select class=\"ipSelect\" style=\"width:180px;\" id=\"".$ids[$target]."\" name=\"".$target."\" title=\"".$title."\"  onchange=\"job_type_sel_first(this,'".$targets[$target]."');\">";
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

			## 학교 검색
			case 'school_search':

				$keyword = $_POST['keyword'];
				$search_target = $_POST['search_target'];

				$search_category = $category_control->search_category('post');	// 검색 결과
				
				$result = "";

				if($search_category){	 // 검색 결과가 있다면
					foreach($search_category as $val){
						$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
						$search_font = $category_control->search_font($keyword, $name);	// 검색어 색입히기
						$result .= "<li style=\"cursor:pointer; padding:5px; border-bottom:1px solid #eee;\"><a href=\"javascript:search_on('".$name."', '".$type."', '".$search_target."');\">".$search_font."</a></li>";
					}
				} else {
					$result .= "<li style=\"padding:5px; border-bottom:1px solid #eee;height:30px;text-align:center;padding-top:33px;padding-bottom:33px;\">검색 결과가 없습니다.</li>";
				}

				echo $result;

			break;

			## 경력 2/3차 직종 select 생성
			case 'career_second_job_type':

				if($target=='wr_career_type_0_1' || $target=='wr_career_type_1_1' || $target=='wr_career_type_2_1' || $target=='wr_career_type_3_1' || $target=='wr_career_type_4_1' || $target=='wr_career_type_5_1' || $target=='wr_career_type_6_1' || $target=='wr_career_type_7_1' || $target=='wr_career_type_8_1' || $target=='wr_career_type_9_1' || $target=='wr_career_type_10_1'){
					$title = "2차직종선택";
					$option = "<option value=\"\">1차 직종을 먼저 선택해 주세요</option>";
				} else if($target=='wr_career_type_0_2' || $target=='wr_career_type_1_2' || $target=='wr_career_type_2_2' || $target=='wr_career_type_3_2' || $target=='wr_career_type_4_2' || $target=='wr_career_type_5_2' || $target=='wr_career_type_6_2' || $target=='wr_career_type_7_2' || $target=='wr_career_type_8_2' || $target=='wr_career_type_9_2' || $target=='wr_career_type_10_2'){
					$title = "3차직종선택";
					$option = "<option value=\"\">2차 직종을 먼저 선택해 주세요</option>";
				}

				$target_exp = explode('_',$target);
				$name = $target_exp[0] . "_" . $target_exp[1] . "_" . $target_exp[2] . "_" . $target_exp[3] . "[]";

				$targets = array( 
					"wr_career_type_0_1" => "wr_career_type_0_2",
					"wr_career_type_1_1" => "wr_career_type_1_2",
					"wr_career_type_2_1" => "wr_career_type_2_2",
					"wr_career_type_3_1" => "wr_career_type_3_2",
					"wr_career_type_4_1" => "wr_career_type_4_2",
					"wr_career_type_5_1" => "wr_career_type_5_2",
					"wr_career_type_6_1" => "wr_career_type_6_2",
					"wr_career_type_7_1" => "wr_career_type_7_2",
					"wr_career_type_8_1" => "wr_career_type_8_2",
					"wr_career_type_9_1" => "wr_career_type_9_2",
					"wr_career_type_10_1" => "wr_career_type_10_2",
				);

				$pcodeList = $category_control->category_pcodeList($type, $p_code);

				$result  = "<select class=\"ipSelect\" style=\"width:170px;\" id=\"".$target."\" name=\"".$name."\" title=\"".$title."\"  onchange=\"career_type_sel_first(this,'".$targets[$target]."');\">";
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

			## 경력 1차 직종 json 리턴
			case 'job_type_0_json':

				$result['list'] = $category_control->category_codeList('job_type');		// 직종

				echo json_encode($result);
				
			break;

			## 외국어 json 리턴
			case 'language_json':

				$result['list'] = $category_control->category_codeList('indi_language', '', 'yes');	// 외국어

				echo json_encode($result);

			break;

			## 외국어 공인시험 json 리턴
			case 'license_json':

				$result['list'] = $category_control->category_codeList('indi_language_license', '', 'yes');	// 외국어공인시험

				echo json_encode($result);

			break;

			## 연수기간 json 리턴
			case 'study_json':
				
				$result['list'] = $alba_resume_control->language_date;	 // 연수기간

				echo json_encode($result);

			break;

			case 'subway_line':			## 지하철 호선 리턴
			case 'subway_station':	## 지하철 역 리턴

				$pcodeList = $category_control->category_pcodeList($type, $p_code);

				if($mode=='subway_line')
					$result = "<option value=\"\">호선</option>";
				else if($mode=='subway_station')
					$result = "<option value=\"\">지하철역</option>";

				if($pcodeList){
					foreach($pcodeList as $val){
						$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
						$result .= "<option value=\"".$val['code']."\">".$name."</option>";
					}
				}

				echo $result;

			break;

			## 인근대학 지역 선택
			case 'college_vicinity':
			
				$pcodeList = $category_control->category_pcodeList($type, $p_code);

				$result = "<option value=\"\">인근대학 선택</option>";

				if($pcodeList){
					foreach($pcodeList as $val){
						$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
						$result .= "<option value=\"".$val['code']."\">".$name."</option>";
					}
				}

				echo $result;

			break;

			## 담당자 정보
			case 'manager_info':

				$no = $_POST['no'];

				$manager = $company_manager_control->get_manager($no);
				if($manager){
					$result = true;
				} else {
					$result = false;
				}

				echo $result."/".json_encode($manager);

			break;

		}
?>