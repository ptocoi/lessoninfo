<?php
		/*
		* /application/member/register_form.php
		* @author Harimao
		* @since 2013/07/02
		* @last update 2015/05/13
		* @Module v3.5 ( Alice )
		* @Brief :: Member register form
		* @Comment :: 회원가입 폼
		*/
		
		$alice_path = "../";

		$cat_path = "../";	// 변수 상대경로를 위한 cat path ( app_config.php 파일의 $cat_path 에 대입 )

		$page_name = "member";

		$navi_page = "register_form";

		$navi_name = "회원 정보입력";

		include_once $cat_path . "_engine.php";

		##
		# Variables
		$virtualno = ($_POST['dupinfo']) ? $_POST['dupinfo'] : $_POST['di'];
		if($virtualno){	// 아이핀에서 넘어온 경우
			$realname = $_POST['realname'];	// 아이핀에서 넘어온 이름
			$birthdate = $_POST['birthdate'];
			$birth_year = substr($birthdate,0,4);
			$birth_month = substr($birthdate,4,2);
			$birth_day = substr($birthdate,6,2);
			$sex = $_POST['sex'];
			$sex_text = ($sex=='1') ? "남":"여";
			$sex_sel = ($sex=='1') ? "0" : "1";
		}
		$result_cd = $_POST['result_cd'];
		if($result_cd=='B000'){	// 본인인증 완료
			$realname = $_POST['name'];
			$birthdate = $_POST['birthday'];
			$birth_year = substr($birthdate,0,4);
			$birth_month = substr($birthdate,4,2);
			$birth_day = substr($birthdate,6,2);
			$sex = $_POST['gender'];
			$sex_text = ($sex=='1') ? "남":"여";
			$sex_sel = ($sex=='1') ? "0" : "1";
			$hp_num = $utility->phone_pdash($_POST['tel_no']);
			$hp_nums = explode('-',$hp_num);
		}

		if($_SESSION['adult_view'] && $_SESSION['certify_info']){	// 성인인증 정보가 있다면 걍 continue
			$virtualno = $_SESSION['certify_info'][0];
			$realname = ($_SESSION['certify_info'][6]) ? iconv("EUC-KR","UTF-8",$_SESSION['certify_info'][6]) : iconv("EUC-KR","UTF-8",$_SESSION['certify_info'][7]);
			$birthdate = $_SESSION['certify_info'][11];
			$birth_year = substr($birthdate,0,4);
			$birth_month = substr($birthdate,4,2);
			$birth_day = substr($birthdate,6,2);
			$sex = $_SESSION['certify_info'][9];
			$sex_text = ($sex=='1') ? "남":"여";
			$sex_sel = ($sex=='1') ? "0" : "1";
			//$hp_num = $utility->phone_pdash($_POST['tel_no']);
			//$hp_nums = explode('-',$hp_num);
		}
		
		$use_ipin = $env['use_ipin'];
		$use_hphone = $env['use_hphone'];
		$use_map = $env['use_map'];
		$mb_type = ($_COOKIE['register_mb_type']) ? $_COOKIE['register_mb_type'] : $_POST['mb_type'];	 // GET 으로 넘어오는걸 막자
		if(!$mb_type){	// type 이 넘어 오지 않은 경우 메인으로 보낸다.
			$utility->popup_msg_js($user_control->_errors('0002'),"./register.php");
			exit;
		}
		if($is_member){	 // 이미 회원이라면
			$utility->popup_msg_js($user_control->_errors('0016'),$alice['main_path']);
			exit;
		}
		
		$tel_num_option = $config->get_tel_num();
		$hp_num_option = $config->get_hp_num($hp_nums[0]);
		$email_option = $config->get_email();
		$biz_type_option = $config->get_biz_type();

		if($mb_type=='company'){	 // 기업회원일때만
			$form_list = $category_control->category_codeList('company_form', " `rank` asc ");	// 카테고리 리스트
			$daum_local_key = $env['daum_local_key'];
			$naver_map_key = $env['naver_map_key'];
			
			$map_control->get_map();	 // 지도

			switch($use_map){
				case 'daum':
					$map_color = "#617BFF";
					$map_script = "<script src=\"//apis.daum.net/maps/maps3.js?apikey=".$env['daum_map_key']."&libraries=services\"></script>";
				break;
				case 'naver':
					$map_color = "#33CC00";
					$map_script = "";
				break;
				case 'google':
					$map_color = "#C0C0C0";
					$map_script = "";
				break;
			}

			##
			# Call Editor
			echo "<script src='".$alice['editor_path']."/cheditor/cheditor.js'></script>";
			echo $utility->call_cheditor('mb_biz_vision', '680px', '300px');
			echo $utility->call_cheditor('mb_biz_result', '680px', '300px');
		}

		##
		# Plugin, UI, CSS include
		echo $config->_plugin(array('form'));

		##
		# Include view
		if(is_file($alice['self'] . 'views/register_form.html'))
			include_once $alice['self'] . 'views/register_form.html';
		else
			$config->error_info( $alice['self'] . 'views/register_form.html' );

		include_once "../include/tail.php";	// tail

		// Debugging check
		if( $is_debug == true ) {
			$_end = $utility->get_time();		// 속도측정 끝
			$_time = $_end - $_begin;
			echo "<p>작업수행시간 :: " . $_time."</p>";
		}

		$db->close();		// DB Close

?>