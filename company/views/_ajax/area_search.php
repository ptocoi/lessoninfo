<?php
		/*
		* /application/company/views/_ajax/area_search.php
		* @author Harimao
		* @since 2013/07/29
		* @last update 2015/04/01
		* @Module v3.5 ( Alice )
		* @Brief :: Alba regist ajax load
		* @Comment :: 알바 등록시 필요한 사항들 로드
		*/

		$alice_path = "../../../";
		
		$cat_path = "../../../";

		include_once $alice_path . "_core.php";

		$mode = $_POST['mode'];
		$keyword = $_POST['keyword'];

		$result = array();

		switch($mode){

			## 네이버 지도 검색
			case 'naver_map_search':

				$search_addr = $_POST['search_addr'];

				$result = $map_control->get_naver_geocode($search_addr);

				//print_R($result);

				if($result[0]){

					echo json_encode($result[0]);

				} else {

					$search_addrs = explode(' ',$search_addr);
					$search_addr = $search_addrs[0]." ".$search_addrs[1]." ".$search_addrs[2];

					$result = $map_control->get_naver_geocode($search_addr);

					echo json_encode($result[0]);

				}

			break;

			## 구글 지도 검색
			case 'google_map_search':

				$search_addr = $_POST['search_addr'];

				$results = $map_control->get_google_geocode($search_addr);

				$address = explode("location",$results);

				$address = explode(":",$address[1]);

				$lat = explode(',',$address[2]);
				$lng = explode('}',$address[3]);

				$result['lat'] = trim($lat[0]);
				$result['lng'] = trim($lng[0]);

				echo implode($result,'/');

			break;


		}	// switch end.

?>