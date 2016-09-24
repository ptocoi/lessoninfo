<?php
		/*
		* /application/alba/views/_ajax/json_data.php
		* @author Harimao
		* @since 2013/08/21
		* @last update 2013/08/21
		* @Module v3.5 ( Alice )
		* @Brief :: Json data
		* @Comment :: 각종 데이터 json 변환
		*/

		$alice_path = "../../../../";
		
		$cat_path = "../../../";

		include_once $alice_path . "_core.php";


		switch($mode){

			## 지역정보
			case 'area':

				$area_list = $category_control->category_pcodeList( 'area', $code,"" ," and `view` = 'yes' ");

				$result = array();
				$result['AREA_INFO']['GU_CNT'] = count($area_list);
				foreach($area_list as $key => $val){
					$result['AREA_INFO']['GU_INFO'][$key]['GU_NAME'] = $val['name'];
					$result['AREA_INFO']['GU_INFO'][$key]['GU_CODE'] = $val['code'];
				}

				echo json_encode($result);

			break;
		}

?>