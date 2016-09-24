<?php
		/*
		* /application/company/views/_load/company.php
		* @author Harimao
		* @since 2014/08/13
		* @last update 2015/03/18
		* @Module v3.5 ( Alice )
		* @Brief :: Company info ajax load
		* @Comment :: 기업정보
		*/

		$alice_path = "../../../";
		
		$cat_path = "../../../";

		include_once $alice_path . "_core.php";

		$mode = $_POST['mode'];
		$no = $_POST['no'];


		switch($mode){
			
			## 기업정보 추출
			case 'get_company_info':
			
				$company = $member_control->get_company_memberNo($no);	// no 기준

				$mb_id = $company['mb_id'];
				
				$result['company_name'] = $company['mb_company_name'];
				$result['ceo_name'] = $company['mb_ceo_name'];
				$result['biz_no'] = $company['mb_biz_no'];
				$result['biz_zipcode'] = $company['mb_biz_zipcode'];
				$result['mb_biz_address0'] = $company['mb_biz_address0'];
				$result['mb_biz_address1'] = $company['mb_biz_address1'];
				$logo_file = "../../../data/member/" . $mb_id . "/logo/" . $company['mb_logo'];
				if(is_file($logo_file)){
					$result['is_logo'] = true;
					$result['mb_logo'] = "../data/member/" . $mb_id . "/logo/" . $company['mb_logo'];
				} else {
					$result['is_logo'] = false;
					//$result['mb_logo'] = "../images/basic/bg_noPhoto.gif";
					$result['mb_logo'] = "../data/logo/".$employ_logo['wr_content'];
				}

				$result['mb_homepage'] = $company['mb_homepage'];

				$wr_photo = $user_control->member_photo_list($mb_id," and `company_no` = '".$no."' ", " order by `photo_no` asc ");

				$photo_0_file = "../../../data/member/" . $mb_id . "/photos/" . $wr_photo[0]['photo_name'];
				//$result['photo_0'] = (is_file($photo_0_file)) ? "../data/member/" . $mb_id . "/photos/" . $wr_photo[0]['photo_name'] : "../images/comn/no_profileimg.gif";
				$result['photo_0'] = (is_file($photo_0_file)) ? "../data/member/" . $mb_id . "/photos/" . $wr_photo[0]['photo_name'] : "../data/logo/".$employ_logo['wr_content'];
				
				$photo_1_file = "../../../data/member/" . $mb_id . "/photos/" . $wr_photo[1]['photo_name'];
				//$result['photo_1'] = (is_file($photo_1_file)) ? "../data/member/" . $mb_id . "/photos/" . $wr_photo[1]['photo_name'] : "../images/comn/no_profileimg.gif";
				$result['photo_1'] = (is_file($photo_1_file)) ? "../data/member/" . $mb_id . "/photos/" . $wr_photo[1]['photo_name'] : "../data/logo/".$employ_logo['wr_content'];

				$photo_2_file = "../../../data/member/" . $mb_id . "/photos/" . $wr_photo[2]['photo_name'];
				//$result['photo_2'] = (is_file($photo_2_file)) ? "../data/member/" . $mb_id . "/photos/" . $wr_photo[2]['photo_name'] : "../images/comn/no_profileimg.gif";
				$result['photo_2'] = (is_file($photo_2_file)) ? "../data/member/" . $mb_id . "/photos/" . $wr_photo[2]['photo_name'] : "../data/logo/".$employ_logo['wr_content'];

				$photo_3_file = "../../../data/member/" . $mb_id . "/photos/" . $wr_photo[3]['photo_name'];
				//$result['photo_3'] = (is_file($photo_3_file)) ? "../data/member/" . $mb_id . "/photos/" . $wr_photo[3]['photo_name'] : "../images/comn/no_profileimg.gif";
				$result['photo_3'] = (is_file($photo_3_file)) ? "../data/member/" . $mb_id . "/photos/" . $wr_photo[3]['photo_name'] : "../data/logo/".$employ_logo['wr_content'];

				$photo_4_file = "../../../data/member/" . $mb_id . "/photos/" . $wr_photo[4]['photo_name'];
				//$result['photo_4'] = (is_file($photo_4_file)) ? "../data/member/" . $mb_id . "/photos/" . $wr_photo[4]['photo_name'] : "../images/comn/no_profileimg.gif";
				$result['photo_4'] = (is_file($photo_4_file)) ? "../data/member/" . $mb_id . "/photos/" . $wr_photo[4]['photo_name'] : "../data/logo/".$employ_logo['wr_content'];

				echo json_encode($result);

			break;

		}	// switch end.
?>