<?php
		/*
		* /application/rss/index.php
		* @author Harimao
		* @since 2013/10/31
		* @last update 2015/03/30
		* @Module v3.5 ( Alice )
		* @Brief :: RSS Feed
		* @Comment :: 알바 공고 RSS feed
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "rss";

		include_once $alice_path . "_core.php";

		##
		# Variables
		$section = $_GET['section'];
		$now = date("D, d M Y H:i:s O");


		$result = "<rss version=\"2.0\">\n";
		$result .= "<channel>\n";

		$result .= "<title>".$env['site_title']."</title>\n";
		$result .= "<link>http://".$HOST."</link>\n";
		$result .= "<description>".$env['meta_description']."</description>\n";
		$result .= "<language>ko</language>\n";
		$result .= "<pubDate>".$now."</pubDate>\n";
		$result .= "<lastBuildDate>".$now."</lastBuildDate>\n";
		$result .= "<docs>".$alice['url']."/rss/index.php</docs>\n";
		$result .= "<generator>".$env['site_name']." RSS FEED Generator</generator>\n";
		$result .= "<managingEditor>".$env['email']."</managingEditor>\n";
		$result .= "<webMaster>".$env['email']."</webMaster>\n";

		switch($section){

			case 'main':	// 메인

				$list_con = " and ( `wr_service_platinum` >= curdate() or `wr_service_prime` >= curdate() or `wr_service_grand` >= curdate() or `wr_service_banner` >= curdate() or `wr_service_list` >= curdate() ) ";

			break;

			case 'alba':	// 채용공고
				
				$list_con = " and ( `wr_service_platinum_sub` >= curdate() or `wr_service_banner_sub` >= curdate() or `wr_service_list_sub` >= curdate() ) ";

			break;

		}

		$alba_list = $alba_user_control->__AlbaList("", "", " where `wr_open` = 1 and `wr_is_adult` = 0 and `wr_report` = 0 and `is_delete` = 0 " . $list_con );

		foreach($alba_list['result'] as $val){

			$no = $val['no'];

			$get_alba = $alba_control->get_alba($no);
			
			$pubDate = date("D, d M Y H:i:s O",strtotime($val['wr_udate']))==date("D, d M Y H:i:s O",strtotime(0000-00-00)) ? date("D, d M Y H:i:s O",strtotime($val['wr_wdate'])) : date("D, d M Y H:i:s O",strtotime($val['wr_udate']));

			// 근무지역
			$area_arr = array( "area_0" => $val['wr_area_0'], "area_1" => $val['wr_area_1'], "area_2" => $val['wr_area_2'] );
			$job_area = $alba_user_control->list_area_info($area_arr);

			// 모집인원
			$volume_arr = array( "volume" => $val['wr_volume'], "volumes" => $val['wr_volumes'] );
			$volmue = $alba_user_control->list_volume($volume_arr);

			// 급여조건
			$pay_type = $category_control->get_categoryCodeName($val['wr_pay_type']);
			$wr_pay = number_format($val['wr_pay'])."원";
			$pay_conference = $val['wr_pay_conference'];	// 협의가능

			// 우대조건
			$preferential = explode(',',$val['wr_preferential']);
			$preferential_cnt = count($preferential);
			$is_preferential = false;
			if($preferential[0]!=''){
				$is_preferential = true;
				$wr_preferential_arr = array();
				for($i=0;$i<$preferential_cnt;$i++){
					$wr_preferential_name = $category_control->get_categoryCodeName($preferential[$i]);	
					array_push($wr_preferential_arr,$wr_preferential_name);
				}
				$wr_preferential = implode($wr_preferential_arr,", ");
			}

			// 경력
			$wr_career = ($val['wr_career_type']) ? $category_control->get_categoryCodeName($val['wr_career']) : "경력무관";

			// 학력
			$wr_ability = $category_control->get_categoryCodeName($val['wr_ability']);

			// 연령
			$age_arr = array( "age_limit" => $val['wr_age_limit'], "age" => $val['wr_age'], "age_etc" => $val['wr_age_etc'] );
			$wr_age = $alba_user_control->list_age($age_arr);
			$age = $wr_age['result'];

			// 성별
			$wr_gender = $alba_user_control->gender_val[$get_alba['wr_gender']];

			// 모집일
			$volume_arr = array( "volume_date" => $val['wr_volume_date'], "volume_always" => $val['wr_volume_always'], "volume_end" => $val['wr_volume_end'] );
			$volume_date = $alba_user_control->volume_date($volume_arr);

			/* 지원정보/방법 */
			if($volume_date['date']){	// 마감일이 있는 경우
				$volume_dates = explode('-',$volume_date['date']);
				$volume_end_date = $volume_dates[0] . "년 " . $volume_dates[1] . "월 " . $volume_dates[2]."일 ";
				$week_korean = $utility->week_korean($volume_dates[0].$volume_dates[1].$volume_dates[2]);
				$volume_end_date .= "(".$week_korean.")";
			} else {
				$volume_end_date = $volume_date['text'];
			}

			$wr_requisition = explode(',',$val['wr_requisition']);	// 지원방법
			/* // 지원정보/방법 */

			$service_check = $service_control->service_check('etc_alba');
			$open_is_pay = $service_check['is_pay'];
			$service_open = $utility->valid_day($member_service['mb_service_alba_open']);	// 공고 열람 서비스 기간 체크

			// 열람권 기간/건수 확인
			$is_open_service = false;
			if( $utility->valid_day($member_service['mb_service_alba_open']) ){
				$is_open_service = $member_service['mb_service_alba_open'];
			}
			$is_open_count = false;
			if( $utility->valid_day($member_service['mb_service_alba_open']) && $member_service['mb_service_alba_count'] ){	// 건수 사용이 가능하다면
				$is_open_count = $member_service['mb_service_alba_count'];
			}

			//echo $member['mb_id']."@".$get_alba['wr_id']." <==<br/>";

			$is_open_alba = $alba_resume_user_control->is_open_resume('alba',$member['mb_id'],$get_alba['wr_id'], $no);	// 열람한 정보가 있는지

			if($open_is_pay){
				//if( $service_open || $is_open_alba ) { // 열람 기간이 있다면
				if( $is_open_count && !$is_open_alba ){	 // 열람 건수가 있다면
					$wr_content = "열람권이 필요합니다.";
					$wr_person = "";
				} else if( $service_open && $is_open_alba ) {
					$wr_content = strip_tags($val['wr_content']);
					$wr_person = $val['wr_person'];
				} else {
					$wr_content = "열람권이 필요합니다.";
					$wr_person = "";
				}
			} else {
				$wr_content = strip_tags($val['wr_content']);
				$wr_person = $val['wr_person'];
			}

			//echo $is_open_count."@".$is_open_alba."@".$service_open." <==<Br/>";

			//echo $service_open."@".$is_open_alba." <==<Br/>";

			$wr_content = str_replace(array("\r\n", "<br>", "<P>", "</P>", "&amp;", "&nbsp;", "&copy"), array("","","","","&"," ","ⓒ"), $wr_content);

			$result .= "<item>\n";
				$result .= "<title><![CDATA[".stripslashes($val['wr_subject'])."]]></title>\n";
				$result .= "<link> ../alba/alba_detail.php?no=".$val['no']."</link>\n";
				$result .= "<category><![CDATA[회사명:".$val['wr_company_name']."]]></category>\n";
				$result .= "<category><![CDATA[근무지역:".$job_area."]]></category>\n";
				//$result .= "<category><![CDATA[모집분야:]]></category>\n";
				//$result .= "<category><![CDATA[고용형태]]></category>\n";
				$result .= "<category><![CDATA[모집인원:".$volmue."]]></category>\n";
				$result .= "<category><![CDATA[급여조건:".$wr_pay."]]></category>\n";
				$result .= "<category><![CDATA[우대조건:".$wr_preferential."]]></category>\n";
				$result .= "<category><![CDATA[경력:".$wr_career."]]></category>\n";
				$result .= "<category><![CDATA[학력:".$wr_ability."]]></category>\n";
				$result .= "<category><![CDATA[연령:".$age."]]></category>\n";
				$result .= "<category><![CDATA[성별:".$wr_gender."]]></category>\n";
				$result .= "<category><![CDATA[마감일:".$volume_end_date."]]></category>\n";
				//$result .= "<category><![CDATA[지원방법]]></category>\n";
				$result .= "<description><![CDATA[".$wr_content."]]></description>\n";
				$result .= "<author>".$wr_person."</author>\n";
				$result .= "<pubDate>".$pubDate."</pubDate>\n";
				//$result .= "<guid>http://liftoff.msfc.nasa.gov/2003/06/03.html#item573</guid>\n";
			$result .= "</item>\n";

		}

		$result .= "</channel>\n";
		$result .= "</rss>";

	//header("Content-Type: application/rss+xml; charset=utf-8");
	header('Content-type: text/xml; charset=utf-8'); 
	//header('Content-Type: text/xml');

	/*
	echo "<xmp>";
	//print_R($_GET);
	//echo $result;
	//print_R($alba_list);
	echo $result;
	echo "</xmp>";
	*/

	echo '<?xml version="1.0" encoding="utf-8"?>'; 
	echo $result;
?>