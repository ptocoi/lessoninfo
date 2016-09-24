<?php
		/**
		* /application/nad/design/model/alice_banner_model.class.php
		* @author Harimao
		* @since 2013/06/12
		* @last update 2015/04/15
		* @Module v3.5 ( Alice ) - b1.0
		* @Brief :: Banner Model Class
		* @Comment :: 배너 설정 컨트롤 클래스
		*/
		class alice_banner_model extends DBConnection {

			var $banner_table			= "alice_banner";
			
			var $success_code = array(
					'0000' => '배너가 등록되었습니다.',
					'0001' => '배너 수정이 완료 되었습니다.',
					'0002' => '배너가 삭제 되었습니다.',
					'0003' => '배너 설정이 저장되었습니다.',
			);
			var $fail_code = array(
					'0000' => '배너 그룹 순위 변경중 오류가 발생하였습니다.\\n\\n솔루션 개발사 :: `넷퓨(Netfu)` 1:1 게시판에 문의하세요.',
					'0001' => '이미지만 업로드 가능합니다.',
					'0002' => '배너 순위 변경중 오류가 발생하였습니다.\\n\\n솔루션 개발사 :: `넷퓨(Netfu)` 1:1 게시판에 문의하세요.',
					'0003' => '배너 출력 설정중 오류가 발생하였습니다.\\n\\n솔루션 개발사 :: `넷퓨(Netfu)` 1:1 게시판에 문의하세요.',
					'0004' => '배너 타겟 설정중 오류가 발생하였습니다.\\n\\n솔루션 개발사 :: `넷퓨(Netfu)` 1:1 게시판에 문의하세요.',
					'0005' => '배너 등록중 오류가 발생하였습니다.\\n\\n솔루션 개발사 :: `넷퓨(Netfu)` 1:1 게시판에 문의하세요.',
					'0006' => '배너 수정중 오류가 발생하였습니다.\\n\\n솔루션 개발사 :: `넷퓨(Netfu)` 1:1 게시판에 문의하세요.',
					'0007' => '배너 삭제중 오류가 발생하였습니다.\\n\\n솔루션 개발사 :: `넷퓨(Netfu)` 1:1 게시판에 문의하세요.',
					'0008' => '배너 설정중 오류가 발생하였습니다.\\n\\n솔루션 개발사 :: `넷퓨(Netfu)` 1:1 게시판에 문의하세요.',
			);

			var $banner_title = array( 
				'main' => '메인', 'alba' => '채용정보', 'resume' => '인재정보', 'adult' => '19 정규직', 'individual' => '개인서비스', 'company' => '기업서비스', 'board' => '커뮤니티', 'map' => '지도검색', 'search' => '통합검색', 'service' => '서비스안내', 'etc' => '기타공통' 
			);

			var $banner_lists			= array( 
				'main' => array( // 메인배너
					0 => array( 'position' => 'main_top', 'name' => 'A 영역', 'width' => '578', 'height' => '제한없음' ),
					1 => array( 'position' => 'main_left_scroll', 'name' => 'B 영역', 'width' => '120', 'height' => '제한없음' ), 
					2 => array( 'position' => 'main_right_scroll', 'name' => 'C 영역', 'width' => '120', 'height' => '제한없음' ), 
					3 => array( 'position' => 'mside_platinum_top', 'name' => 'D 영역', 'width' => '960', 'height' => '제한없음' ), 
					4 => array( 'position' => 'mside_prime_top', 'name' => 'E 영역', 'width' => '960', 'height' => '60' ), 
					5 => array( 'position' => 'mside_grand_top', 'name' => 'F 영역', 'width' => '960', 'height' => '126' ), 
					6 => array( 'position' => 'mside_banner_top', 'name' => 'G 영역', 'width' => '960', 'height' => '제한없음' ), 
					7 => array( 'position' => 'mside_list_top', 'name' => 'H 영역', 'width' => '960', 'height' => '제한없음' ), 
					8 => array( 'position' => 'mside_focus_top', 'name' => 'I 영역', 'width' => '960', 'height' => '제한없음' ), 
					9 => array( 'position' => 'mside_elatest_top', 'name' => 'J 영역', 'width' => '960', 'height' => '제한없음' ), 
					10 => array( 'position' => 'mside_rlatest_top', 'name' => 'K 영역', 'width' => '960', 'height' => '제한없음' ), 
					11 => array( 'position' => 'mside_board_top', 'name' => 'L 영역', 'width' => '960', 'height' => '제한없음' ), 
					12 => array( 'position' => 'main_logo_banner', 'name' => 'M 영역', 'width' => '468', 'height' => '60' ), 
					13 => array( 'position' => 'main_top_banner', 'name' => 'N 영역', 'width' => '476', 'height' => '126' ), 
					14 => array( 'position' => 'main_bottom', 'name' => 'O 영역', 'width' => '960', 'height' => '제한없음' ), 
					15 => array( 'position' => 'main_left', 'name' => 'P 영역', 'width' => '155', 'height' => '제한없음' ), //5 => array( 'position' => 'main_bottm_text', 'name' => '메인하단 텍스트', 'width' => '제한없음', 'height' => '35' ), 				
				),
				'alba' => array( // 채용정보
					0 => array( 'position' => 'alba_top', 'name' => 'A 영역', 'width' => '578', 'height' => '제한없음' ), 
					1 => array( 'position' => 'alba_top_banner', 'name' => 'B 영역', 'width' => '476', 'height' => '126' ), 
					2 => array( 'position' => 'alba_left', 'name' => 'C 영역', 'width' => '155', 'height' => '제한없음' ), 
					3 => array( 'position' => 'alba_left_scroll', 'name' => 'D 영역', 'width' => '120', 'height' => '제한없음' ), 
					4 => array( 'position' => 'alba_right_scroll', 'name' => 'E 영역', 'width' => '120', 'height' => '제한없음' ), 
					5 => array( 'position' => 'alba_bottom', 'name' => 'F 영역', 'width' => '960', 'height' => '제한없음' ),
					6 => array( 'position' => 'employ_platinum_top', 'name' => 'G 영역', 'width' => '799', 'height' => '제한없음' ), 
					7 => array( 'position' => 'employ_banner_top', 'name' => 'H 영역', 'width' => '799', 'height' => '제한없음' ), 
					8 => array( 'position' => 'employ_list_top', 'name' => 'I 영역', 'width' => '799', 'height' => '제한없음' ), 
					9 => array( 'position' => 'employ_basic_top', 'name' => 'J 영역', 'width' => '799', 'height' => '제한없음' ),
					10 => array( 'position' => 'alba_logo_banner', 'name' => 'K 영역', 'width' => '468', 'height' => '60' ), 
				),

				'resume' => array( // 인재정보
					0 => array( 'position' => 'resume_top', 'name' => 'A 영역', 'width' => '578', 'height' => '제한없음' ), 
					1 => array( 'position' => 'resume_top_banner', 'name' => 'B 영역', 'width' => '476', 'height' => '126' ), 
					2 => array( 'position' => 'resume_logo_banner', 'name' => 'C 영역', 'width' => '468', 'height' => '60' ), 
					3 => array( 'position' => 'resume_left_scroll', 'name' => 'D 영역', 'width' => '120', 'height' => '제한없음' ), 
					4 => array( 'position' => 'resume_right_scroll', 'name' => 'E 영역', 'width' => '120', 'height' => '제한없음' ), 
					5 => array( 'position' => 'sresume_focus_top', 'name' => 'F 영역', 'width' => '799', 'height' => '제한없음' ), 
					6 => array( 'position' => 'sresume_today_top', 'name' => 'G 영역', 'width' => '799', 'height' => '제한없음' ), 
					7 => array( 'position' => 'sresume_basic_top', 'name' => 'H 영역', 'width' => '799', 'height' => '제한없음' ), 
					8 => array( 'position' => 'resume_bottom', 'name' => 'I 영역', 'width' => '960', 'height' => '제한없음' ), 
					9 => array( 'position' => 'resume_left', 'name' => 'J 영역', 'width' => '155', 'height' => '제한없음' ), 

				),		
				'adult' => array( // 인재정보
					0 => array( 'position' => 'adult_top', 'name' => 'A 영역', 'width' => '578', 'height' => '제한없음' ), 
					2 => array( 'position' => 'adult_top_banner', 'name' => 'B 영역', 'width' => '476', 'height' => '126' ), 
					1 => array( 'position' => 'adult_logo_banner', 'name' => 'C 영역', 'width' => '468', 'height' => '60' ), 
					3 => array( 'position' => 'adult_left', 'name' => 'D 영역', 'width' => '155', 'height' => '제한없음' ), 
					4 => array( 'position' => 'adult_left_scroll', 'name' => 'E 영역', 'width' => '120', 'height' => '제한없음' ), 
					5 => array( 'position' => 'adult_right_scroll', 'name' => 'F 영역', 'width' => '120', 'height' => '제한없음' ), 
					6 => array( 'position' => 'adult_bottom', 'name' => 'G 영역', 'width' => '960', 'height' => '제한없음' ), 
				),
				'individual' => array( // 개인서비스
					0 => array( 'position' => 'individual_top', 'name' => 'A 영역', 'width' => '578', 'height' => '제한없음' ), 
					1 => array( 'position' => 'individual_left', 'name' => 'B 영역', 'width' => '155', 'height' => '제한없음' ), 
					2 => array( 'position' => 'individual_logo_banner', 'name' => 'C 영역', 'width' => '468', 'height' => '60' ), 
					3 => array( 'position' => 'individual_left_scroll', 'name' => 'D 영역', 'width' => '120', 'height' => '제한없음' ), 
					4 => array( 'position' => 'individual_right_scroll', 'name' => 'E 영역', 'width' => '120', 'height' => '제한없음' ), 
					5 => array( 'position' => 'individual_top_banner', 'name' => 'F 영역', 'width' => '476', 'height' => '126' ), 
					6 => array( 'position' => 'individual_bottom', 'name' => 'G 영역', 'width' => '960', 'height' => '제한없음' ), 
				),
				'company' => array( // 기업서비스
					0 => array( 'position' => 'company_top', 'name' => 'A 영역', 'width' => '578', 'height' => '제한없음' ),
					1 => array( 'position' => 'company_left', 'name' => 'B 영역', 'width' => '155', 'height' => '제한없음' ), 
					2 => array( 'position' => 'company_left_scroll', 'name' => 'C 영역', 'width' => '120', 'height' => '제한없음' ), 
					3 => array( 'position' => 'company_right_scroll', 'name' => 'D 영역', 'width' => '120', 'height' => '제한없음' ), 
					4 => array( 'position' => 'company_bottom', 'name' => 'E 영역', 'width' => '960', 'height' => '제한없음' ), 
					5 => array( 'position' => 'company_top_banner', 'name' => 'F 영역', 'width' => '476', 'height' => '126' ),	
					6 => array( 'position' => 'company_logo_banner', 'name' => 'G 영역', 'width' => '468', 'height' => '60' ), 
				),
				'map' => array( // 지도검색
					0 => array( 'position' => 'map_top', 'name' => 'A 영역', 'width' => '578', 'height' => '제한없음' ),
					1 => array( 'position' => 'map_logo_banner', 'name' => 'B 영역', 'width' => '468', 'height' => '60' ),
					2 => array( 'position' => 'map_left', 'name' => 'C 영역', 'width' => '155', 'height' => '제한없음' ), 
					3 => array( 'position' => 'map_left_scroll', 'name' => 'D 영역', 'width' => '120', 'height' => '제한없음' ), 
					4 => array( 'position' => 'map_right_scroll', 'name' => 'E 영역', 'width' => '120', 'height' => '제한없음' ), 
					5 => array( 'position' => 'map_top_banner', 'name' => 'F 영역', 'width' => '476', 'height' => '126' ), 
					6 => array( 'position' => 'map_bottom', 'name' => 'G 영역', 'width' => '960', 'height' => '제한없음' ), 
				),
				'board' => array( // 커뮤니티
					0 => array( 'position' => 'board_top', 'name' => 'A 영역', 'width' => '578', 'height' => '제한없음' ), 
					1 => array( 'position' => 'board_logo_banner', 'name' => 'B 영역', 'width' => '468', 'height' => '60' ), 
					2 => array( 'position' => 'board_left', 'name' => 'C 영역', 'width' => '155', 'height' => '제한없음' ), 
					3 => array( 'position' => 'board_left_scroll', 'name' => 'D 영역', 'width' => '120', 'height' => '제한없음' ), 
					4 => array( 'position' => 'board_right_scroll', 'name' => 'E 영역', 'width' => '120', 'height' => '제한없음' ),
					5 => array( 'position' => 'board_top_banner', 'name' => 'F 영역', 'width' => '476', 'height' => '126' ), 
					6 => array( 'position' => 'board_bottom', 'name' => 'G 영역', 'width' => '960', 'height' => '제한없음' ), 
				),
				'service' => array( // 서비스안내
					0 => array( 'position' => 'service_top', 'name' => 'A 영역', 'width' => '578', 'height' => '제한없음' ), 
					1 => array( 'position' => 'service_logo_banner', 'name' => 'B 영역', 'width' => '468', 'height' => '60' ), 
					2 => array( 'position' => 'service_top_banner', 'name' => 'C 영역', 'width' => '476', 'height' => '126' ),	
					3 => array( 'position' => 'service_left_scroll', 'name' => 'D 영역', 'width' => '120', 'height' => '제한없음' ), 
					4 => array( 'position' => 'service_right_scroll', 'name' => 'E 영역', 'width' => '120', 'height' => '제한없음' ), 
					5 => array( 'position' => 'service_bottom', 'name' => 'F 영역', 'width' => '960', 'height' => '제한없음' ), 
				),
				'search' => array( // 통합검색
					0 => array( 'position' => 'search_top', 'name' => 'A 영역', 'width' => '578', 'height' => '제한없음' ), 
					1 => array( 'position' => 'search_logo_banner', 'name' => 'B 영역', 'width' => '468', 'height' => '60' ),
					2 => array( 'position' => 'search_left_scroll', 'name' => 'C 영역', 'width' => '120', 'height' => '제한없음' ), 
					3 => array( 'position' => 'search_right_scroll', 'name' => 'D 영역', 'width' => '120', 'height' => '제한없음' ), 
					4 => array( 'position' => 'search_top_banner', 'name' => 'E 영역', 'width' => '476', 'height' => '126' ), 
					5 => array( 'position' => 'search_middle_banner', 'name' => 'F 영역', 'width' => '799', 'height' => '제한없음' ), 
					6 => array( 'position' => 'search_left', 'name' => 'G 영역', 'width' => '155', 'height' => '제한없음' ), 
					7 => array( 'position' => 'search_bottom', 'name' => 'H 영역', 'width' => '960', 'height' => '제한없음' ), 
				),
				'etc' => array( // 기타공통
					0 => array( 'position' => 'etc_login', 'name' => 'A 영역', 'width' => '300', 'height' => '250' ), 
					1 => array( 'position' => 'etc_bottom', 'name' => 'B 영역', 'width' => '제한없음', 'height' => '59' ), 
					2 => array( 'position' => 'etc_pop_login', 'name' => 'C 영역', 'width' => '200', 'height' => '200' ), 
					//3 => array( 'position' => 'etc_test', 'name' => '테스트', 'width' => '제한없음', 'height' => '제한없음' ), 
				),

			);

			var $banner_extension = array( 'jpg', 'gif', 'png', 'swf' );	// 업로드 가능 파일 확장자
			var $roll_direction = array( 0 => "scrollLeft", 1 => "scrollRight", 2 => "scrollUp", 3 => "scrollDown");	// 롤링 방향 문자
			
			var $roll_info = array( // 필요한 경우 사용 하세요
				"roll_type" => array( 0 => "고정배너", 1 => "롤링배너" ),
				"roll_direction" => array( 0 => "좌측 방향", 1 => "우측 방향", 2 => "위 방향", 3 => "아래 방향" ),
				"roll_turn" => array( 0 => "순차번경", 1 => "랜덤변경" ),
			);


				function __BannerList( $page="", $page_rows="" ){

						// 검색시 사용
						$_add = $this->_Search();

						$query = " select * from `".$this->banner_table."` " . $_add['que'] . " order by `rank` asc ";
						
						$total_count = $this->_queryR($query);

						if($page_rows){

							$total_page  = ceil($total_count / $page_rows);  // 전체 페이지 계산
							if (!$page) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
							$from_record = ($page - 1) * $page_rows; // 시작 열을 구함

							$query .= " limit $from_record, $page_rows ";

						}


						$result['result'] = $this->query_fetch_rows($query);
						$result['total_count'] = $total_count;
						$result['total_page'] = $total_page;

					
					return $result;

				}


				// 배너 정보 추출(단일) :: no 기준
				function get_banner( $no ){

						if(!$no)
							return false;

						$query = " select * from `".$this->banner_table."` where `no` = '".$no."' ";

						$result = $this->query_fetch($query);


					return $result;

				}


				// 배너 정보 추출(단일) :: position
				function _getBanner( $position, $no){

						$query = " select * from `".$this->banner_table."` where `position` = '".$position."' and `no` = '".$no."' ";

						$result = $this->query_fetch($query);


					return $result;

				}


				// 배너 랜덤 추출(단수)
				function _getBannerRand( $position, $view='yes' ){

						if(!$position)
							return false;

						$query = " select * from `".$this->banner_table."` where `position` = '".$position."' and `view` = '".$view."' order by rand() limit 1";

						$result = $this->query_fetch($query);


					return $result;
				}


				// 위치별 배너 position 정보 추출
				function _banners( $position ){

						$result = $this->banner_lists[$position];


					return $result;

				}

				
				// 파일 업로드시 확장자 구분
				function _file(){

						$result = implode('|',$this->banner_extension);


					return $result;

				}


				// 현재 position 알아내기
				function _position( $positions, $position ){

					$banner_lists = $this->banner_lists;

						$result = array();

						$positions_cnt = count($banner_lists[$positions]);

						for($i=0;$i<$positions_cnt;$i++){
							
							if($banner_lists[$positions][$i]['position']==$position){

								$result['name'] = $banner_lists[$positions][$i]['name'];
								$result['width'] = $banner_lists[$positions][$i]['width'];
								$result['height'] = $banner_lists[$positions][$i]['height'];

							}

						}


					return $result;

				}

				
				// 출력 위치에 따른 포지션별 배너 리스트
				function _positionBanners( $position, $view='yes' ){

						// 순위별
						$query = " select * from `".$this->banner_table."` where `position` = '".$position."' and `view`= '".$view."' order by `rank` asc ";

						$result = $this->query_fetch_rows($query);

					
					return $result;

				}


				// 배너 검색
				function _Search(){

						$page = $_GET['page'];

						$position = $_GET['position'];

						$que = array();
						$url = array();

						if($position){

							array_push($que, " `position` = '".$position."' ");
							array_push($url, "position=".$position);

						}

						array_push($url, 'page='.$page);

						$que = is_array($que) ? implode(' and ',$que) : '';
						$url = is_array($url) ? implode('&',$url) : '';
						$que = preg_replace("/^\s+and/i", '', $que);
						$que = $que? " where ".$que : '';
						$url = preg_replace('/^&/', '', $url);
						$send_url = $url;
						$url = $url ? $_SERVER['PHP_SELF'].'?'.$url : '';


					return array('que'=>$que, 'url'=>$url, 'send_url'=>$send_url);


				}

				// 배너 rank 최대값 구함
				function get_MaxRank( $position ){

						if(!$position) return false;

						$query = " select max(`rank`) as `rank` from `".$this->banner_table."` where `position` = '".$position."' ";

						$result = $this->query_fetch($query);

					
					return ($result['rank']) ? $result['rank'] : 0;

				}

				// 배너 그룹 rank 최대값 구함
				function get_GroupMaxRank( $position, $p_no ){

						if(!$position || !$p_no) return false;

						$query = " select max(`g_rank`) as `g_rank` from `".$this->banner_table."` where `position` = '".$position."' and `p_no` = '".$p_no."' ";

						$result = $this->query_fetch($query);

					
					return ($result['g_rank']) ? $result['g_rank'] : 0;

				}


				// 배너 그룹 정보
				function _group( $position ){
					
						if(!$position) return false;

						$result = array();

						$result['list'] = $result['banner_distinct'] = $this->query_fetch_rows(" select distinct `p_no`, `g_name` from `".$this->banner_table."` where `position` = '".$position."' order by `rank` asc ");
						
						$result['group_count'] = count($result['banner_distinct']);	 // 그룹별 건수

					
					return $result;

				}


				// 질의문에 따른 배너 리스트 출력 (그룹별로 검색시 사용)
				function banner_list( $con="" ){

						$query = " select * from `".$this->banner_table."` " . $con . " order by `g_rank` asc ";

						$total_count = $this->_queryR($query);

						$result['result'] = $this->query_fetch_rows($query);
						$result['total_count'] = $total_count;

					
					return $result;

				}

				
				// p_no 를 기준으로 단수 추출
				function banner_Pno( $p_no ){

						if(!$p_no || $p_no == '') return false;

						$query = " select * from `".$this->banner_table."` where `no` = `p_no` and `p_no` = '".$p_no."' ";

						$result = $this->query_fetch($query);


					return $result;

				}


				/*
				// 배너 그룹 정보
				function _getGroup( $position, $no ){

					global $alice, $utility;
						
						if(!$position || !$no) return false;

						//$list = $banner_distinct = $query->query_fetch(" select distinct `p_no`, `g_rank` from `".$this->banner_table."` where `no` = '".$no."' ");
						//$group_cnt = count($banner_distinct);	 // 그룹별 건수

				}
				*/

				// 포지션별 사용자측 배너 추출
				function get_banner_for_position( $position ){

					global $utility;
					global $page_name;
					
						if(!$position || $position == '') return false;

						$results = array();

						switch($position){

							## 메인 최상단 (쿠키가 필요하며, 1개씩만 출력해야 하기 때문에 별도의 쿼리가 필요함)
							case 'main_top':
							case 'alba_top':
							case 'resume_top':
							case 'adult_top':
							case 'individual_top':
							case 'company_top':
							case 'board_top':
							case 'map_top':
							case 'search_top':
							case 'board_top':
							case 'service_top':
							
								$rand_query = $this->query_fetch(" select * from `".$this->banner_table."` where `position` = '".$position."' and `view` = 1 order by rand() limit 1 ");	// 1개만 추출

								$roll_type = $rand_query['roll_type'];
								$roll_direction = $this->roll_direction[$rand_query['roll_direction']];
								$roll_time = $rand_query['roll_time'];
								$roll_turn = $rand_query['roll_turn'];

								$query_order = ($roll_turn) ? " rand() " : " `g_rank` asc ";

								$max_size = $this->query_fetch(" select `width`, `height` from `".$this->banner_table."` where `p_no` = '".$rand_query['p_no']."' order by `width` desc, `height` desc limit 1");

								$width = $max_size['width'];
								$height = $max_size['height'];

								$ids = $utility->getOrderNumber(6);

								$result = "";

								if($roll_type){	// 롤링배너

									$query = $this->query_fetch_rows(" select * from `".$this->banner_table."` where `view` = 1 and `p_no` = '".$rand_query['p_no']."' and `position` = '".$position."' order by " . $query_order );

									if($query){

										$banner_cnt = 0;
										foreach($query as $val){
											if($_COOKIE[$page_name."_banner_".$val['no']]!='done'){
												$results[] = $this->view_banner($val['no'], $val['type'], $val['position'], false, false, $width, $height);
												$banner_cnt++;
											}
										}

										$sizes = ($width && $height) ? "width:".$width."px;height:".$height."px;" : "";
										
										$results_length = count($results);

										if(!$banner_cnt) return false;

										$result .= "<div id=\"".$ids."\" style=\"position:relative;".$sizes."\">\n";
										for($i=0;$i<$banner_cnt;$i++){
											$result .= "<div id=\"".$page_name."_banner_".$query[$i]['no']."\">\n";
											$result .= $results[$i];
											if($query[$i]['cookie']){
												$result .= "<p class=\"close\"><input type=\"checkbox\" value=\"".$query[$i]['no']."\"  name=\"more_no_view\" onclick=\"more_no_views(this, '".$query[$i]['cookie']."', '".$page_name."', '".$ids."');\"><span>".$query[$i]['cookie']."일간 보지 않기</span></p>\n";
												// <button class=\"btn\" onclick=\"\" type=\"button\">닫기</button>
											}
											$result .= "</div>\n";
										}
										$result .= "</div>\n";

										$result .= "<script>";
										$result .= "$('#".$ids."').cycle({ ";
										$result .= "fx:'".$roll_direction."', ";
										//$result .= "easing: 'easeOutBounce', ";
										$result .= "delay:  ".$roll_time."000 ";
										$result .= "});";
										$result .= "</script>";

									}

								} else {	 // 고정배너

									$query = $this->query_fetch(" select * from `".$this->banner_table."` where `view` = 1 and `p_no` = '".$rand_query['p_no']."' and `position` = '".$position."' order by rand() " );

									if($query){

										$sizes = ($width && $height) ? "width:".$width."px;height:".$height."px;" : "";

										if($_COOKIE[$page_name."_banner_".$query['no']]!='done'){

										$result .= "<div id=\"".$ids."\" style=\"position:relative;".$sizes."\">\n";

											$result .= "<div id=\"".$page_name."_banner_".$query['no']."\">\n";

											$result .= $this->view_banner($query['no'], $query['type'], $query['position'], false, false, $width, $height);
											if($query['cookie']){
												$result .= "<p class=\"close\"><input type=\"checkbox\" value=\"".$query['no']."\"  name=\"more_no_view\" onclick=\"more_no_views(this, '".$query['cookie']."', '".$page_name."', '".$ids."');\"><span>".$query['cookie']."일간 보지 않기</span></p>\n";
												// <button class=\"btn\" onclick=\"more_no_views(documet.n, '".$query['cookie']."', '".$page_name."');\" type=\"button\">닫기</button>
											}

											$result .= "</div>\n";

										$result .= "</div>\n";

										}

									}
								}

							break;

							case 'main_top_banner':			## 메인 상단 
							case 'resume_top_banner':		## 이력서 상단 
							case 'individual_top_banner':	## 개인회원 상단 
							case 'company_top_banner':	## 기업회원 상단 
							case 'map_top_banner':			## 지도검색 상단 
							case 'board_top_banner':		## 게시판(커뮤니티) 상단
							case 'search_top_banner':		## 통합검색 상단
							case 'service_top_banner':		## 광고/제휴문의 등 서비스 안내 상단

							case 'main_logo_banner':		## 메인 로고
							case 'alba_logo_banner':			## 채용정보 로고
							case 'resume_logo_banner':	## 인재정보 로고
							case 'adult_logo_banner':		## 19정규직 로고
							case 'individual_logo_banner':		##  개인서비스 로고 
							case 'company_logo_banner':		## 기업서비스 로고 
							case 'map_logo_banner':		## 지도검색 로고 
							case 'board_logo_banner':		## 게시판 로고 
							case 'search_logo_banner':		## 통합검색 로고 
							case 'service_logo_banner':		## 광고/제휴문의 로고 

							case 'mside_platinum_top':
							case 'mside_prime_top':
							case 'mside_grand_top':
							case 'mside_banner_top':
							case 'mside_list_top':
							case 'mside_focus_top':
							case 'mside_elatest_top':
							case 'mside_rlatest_top':
							case 'mside_board_top':

							case 'employ_platinum_top':
							case 'employ_banner_top':
							case 'employ_list_top':
							case 'employ_basic_top':

							case 'sresume_focus_top':
							case 'sresume_today_top':
							case 'sresume_basic_top':


								$result = "";

								$get_group = $this->_group( $position );
								$group_list = $get_group['list'];
								$group_list_cnt = count($group_list);

								$g = 0;
								foreach($group_list as $group){	// 그룹 전체

									$ids = $utility->getOrderNumber(6);

									$p_no = $group['p_no'];
									$banner_list = $this->banner_list( " where `p_no` = '".$p_no."' and `view` = 1 " );

									if(!$banner_list['total_count']) continue;

									$banner_Pno = $this->banner_Pno($p_no);
									$roll_type = $banner_Pno['roll_type'];
									$roll_direction = $this->roll_direction[$banner_Pno['roll_direction']];
									$roll_time = $banner_Pno['roll_time'];
									$roll_turn = $banner_Pno['roll_turn'];

									$max_size = $this->query_fetch(" select `width`, `height` from `".$this->banner_table."` where `p_no` = '".$p_no."' order by `width` desc, `height` desc limit 1");

									$width = $max_size['width'];
									$height = $max_size['height'];

									$sizes = ($width && $height) ? "width:".$width."px;height:".$height."px;" : "";

									//$rand_class = ($group_list_cnt-1 == $g) ? " Rend" : "";
									$rand_class = ($group_list_cnt-1 == $g && $g) ? " Rend" : "";

									if($roll_type){	// 롤링배너
										
										$mr8 = ($width >= 476) ? 'mr8 ' : '';
										$result .= "<li class=\"".$mr8."mb8".$rand_class."\">\n";
										$result .= "<div id=\"".$ids."\" style=\"".$sizes."\">\n";

										foreach($banner_list['result'] as $key => $val){

											$result .= "<div id=\"".$page_name."_banner_".$val['no']."\">";
												$result .= $this->view_banner($val['no'], $val['type'], $val['position'], false, false, $width, $height);
											$result .= "</div>\n";

										}

										$result .= "</div>\n";
										$result .= "</li>\n";

										$result .= "<script>";
										$result .= "$('#".$ids."').cycle({ ";
										$result .= "fx:'".$roll_direction."', ";
										//$result .= "easing: 'easeOutBounce', ";
										$result .= "delay:  ".$roll_time."000 ";
										$result .= "});";
										$result .= "</script>";

									} else {	 // 고정배너

										$query = $this->query_fetch(" select * from `".$this->banner_table."` where `view` = 1 and `p_no` = '".$p_no."' order by rand() " );

										$sizes = ($width && $height) ? "style=\"width:".$width."px;height:".$height."px;\"" : "";

										$result .= "<li class=\"mr8 mb8".$rand_class."\">";
											$result .= $this->view_banner($query['no'], $query['type'], $query['position'], false, false, $width, $height);
										$result .= "</li>\n";

									}

								$g++;
								}

							break;

							case 'alba_top_banner': ## 채용정보 상단
							case 'adult_top_banner': ## 19정규직 상단

								$result = "";

								$get_group = $this->_group( $position );
								$group_list = $get_group['list'];
								$group_list_cnt = count($group_list);

								$g = 0;
								foreach($group_list as $group){	// 그룹 전체

									$ids = $utility->getOrderNumber(6);

									$p_no = $group['p_no'];
									$banner_list = $this->banner_list( " where `p_no` = '".$p_no."' and `view` = 1 " );

									if(!$banner_list['total_count']) continue;

									$banner_Pno = $this->banner_Pno($p_no);
									$roll_type = $banner_Pno['roll_type'];
									$roll_direction = $this->roll_direction[$banner_Pno['roll_direction']];
									$roll_time = $banner_Pno['roll_time'];
									$roll_turn = $banner_Pno['roll_turn'];

									$max_size = $this->query_fetch(" select `width`, `height` from `".$this->banner_table."` where `p_no` = '".$p_no."' order by `width` desc, `height` desc limit 1");

									$width = $max_size['width'];
									$height = $max_size['height'];

									$sizes = ($width && $height) ? "width:".$width."px;height:".$height."px;" : "";

									$rand_class = ($group_list_cnt-1 == $g) ? "class='Rend'" : "";

									if($roll_type){	// 롤링배너

										$result .= "<li ".$rand_class.">\n";
										$result .= "<div id=\"".$ids."\" style=\"".$sizes."\">\n";

										foreach($banner_list['result'] as $key => $val){

											$result .= "<div id=\"".$page_name."_banner_".$val['no']."\">";
												$result .= $this->view_banner($val['no'], $val['type'], $val['position'], false, false, $width, $height);
											$result .= "</div>\n";

										}

										$result .= "</div>\n";
										$result .= "</li>\n";

										$result .= "<script>";
										$result .= "$('#".$ids."').cycle({ ";
										$result .= "fx:'".$roll_direction."', ";
										//$result .= "easing: 'easeOutBounce', ";
										$result .= "delay:  ".$roll_time."000 ";
										$result .= "});";
										$result .= "</script>";

									} else {	 // 고정배너

										$query = $this->query_fetch(" select * from `".$this->banner_table."` where `view` = 1 and `p_no` = '".$p_no."' order by rand() " );

										$sizes = ($width && $height) ? "style=\"width:".$width."px;height:".$height."px;\"" : "";

										$result .= "<li ".$rand_class.">";
											$result .= $this->view_banner($query['no'], $query['type'], $query['position'], false, false, $width, $height);
										$result .= "</li>\n";

									}
								$g++;
								}

							break;
							
							case 'main_left':			## 메인 좌측 
							case 'alba_left':			## 정규직 좌측
							case 'adult_left':			## 19정규직 좌측
							case 'resume_left':		## 인재정보 좌측
							case 'individual_left':	## 개인회원 좌측
							case 'company_left':	## 기업회원 좌측
							case 'map_left':			## 지도검색 좌측
							case 'board_left':		## 게시판(커뮤니티) 좌측
							case 'search_left':		## 통합검색 좌측
							case 'service_left':		## 광고/제휴문의 등 서비스 안내 좌측

								$result = "";

								$get_group = $this->_group( $position );
								$group_list = $get_group['list'];

								foreach($group_list as $group){	// 그룹 전체

									$ids = $utility->getOrderNumber(6);

									$p_no = $group['p_no'];
									$banner_list = $this->banner_list( " where `p_no` = '".$p_no."' and `view` = 1 " );

									if(!$banner_list['total_count']) continue;

									$banner_Pno = $this->banner_Pno($p_no);
									$roll_type = $banner_Pno['roll_type'];
									$roll_direction = $this->roll_direction[$banner_Pno['roll_direction']];
									$roll_time = $banner_Pno['roll_time'];
									$roll_turn = $banner_Pno['roll_turn'];

									$max_size = $this->query_fetch(" select `width`, `height` from `".$this->banner_table."` where `p_no` = '".$p_no."' order by `width` desc, `height` desc limit 1");

									$width = $max_size['width'];
									$height = $max_size['height'];

									$sizes = ($width && $height) ? "width:".$width."px;height:".$height."px;" : "";

									if($roll_type){	// 롤링배너

										//$result .= "<div class=\"mt20\">\n";
										$result .= "<div class=\"mt20\" id=\"".$ids."\" style=\"".$sizes."\">\n";

										foreach($banner_list['result'] as $key => $val){

											$result .= "<div id=\"".$page_name."_banner_".$val['no']."\">";
												$result .= $this->view_banner($val['no'], $val['type'], $val['position'], false, false, $width, $height);
											$result .= "</div>\n";

										}

										$result .= "</div>\n";
										//$result .= "</div>\n";

										$result .= "<script>";
										$result .= "$('#".$ids."').cycle({ ";
										$result .= "fx:'".$roll_direction."', ";
										//$result .= "easing: 'easeOutBounce', ";
										$result .= "delay:  ".$roll_time."000 ";
										$result .= "});";
										$result .= "</script>";

									} else {	 // 고정배너

										$query = $this->query_fetch(" select * from `".$this->banner_table."` where `view` = 1 and `p_no` = '".$p_no."' order by rand() " );

										$sizes = ($width && $height) ? "style=\"width:".$width."px;height:".$height."px;\"" : "";

										$result .= "<div class=\"mt20\">";
											$result .= $this->view_banner($query['no'], $query['type'], $query['position'], false, false, $width, $height);
										$result .= "</div>\n";

									}

								}

							break;

							case 'main_bottom':		## 메인 하단
							case 'alba_bottom':		## 정규직 하단
							case 'resume_bottom':	## 인재 하단
							case 'adult_bottom':		## 19정규직 하단
							case 'individual_bottom': ## 개인서비스 하단
							case 'company_bottom':	## 기업서비스 하단
							case 'map_bottom':		## 지도검색 하단
							case 'board_bottom':		## 게시판(커뮤니티) 하단
							case 'search_bottom':		## 통합검색 하단
							case 'service_bottom':	## 광고/제휴문의 등 서비스 안내 하단

								$result = "";

								$get_group = $this->_group( $position );
								$group_list = $get_group['list'];

								foreach($group_list as $group){	// 그룹 전체

									$ids = $utility->getOrderNumber(6);

									$p_no = $group['p_no'];
									$banner_list = $this->banner_list( " where `p_no` = '".$p_no."' and `view` = 1 " );

									if(!$banner_list['total_count']) continue;

									$banner_Pno = $this->banner_Pno($p_no);
									$roll_type = $banner_Pno['roll_type'];
									$roll_direction = $this->roll_direction[$banner_Pno['roll_direction']];
									$roll_time = $banner_Pno['roll_time'];
									$roll_turn = $banner_Pno['roll_turn'];

									$max_size = $this->query_fetch(" select `width`, `height` from `".$this->banner_table."` where `p_no` = '".$p_no."' order by `width` desc, `height` desc limit 1");

									$width = $max_size['width'];
									$height = $max_size['height'];

									$sizes = ($width && $height) ? "width:".$width."px;height:".$height."px;" : "";

									if($roll_type){	// 롤링배너

										$result .= "<li class=\"ad pt5\">\n";
										$result .= "<div  id=\"".$ids."\" style=\"".$sizes."\">\n";

										foreach($banner_list['result'] as $key => $val){

											$result .= "<div id=\"".$page_name."_banner_".$val['no']."\">";
												$result .= $this->view_banner($val['no'], $val['type'], $val['position'], false, false, $width, $height);
											$result .= "</div>\n";

										}

										$result .= "</div>\n";
										$result .= "</li>\n";

										$result .= "<script>";
										$result .= "$('#".$ids."').cycle({ ";
										$result .= "fx:'".$roll_direction."', ";
										//$result .= "easing: 'easeOutBounce', ";
										$result .= "delay:  ".$roll_time."000 ";
										$result .= "});";
										$result .= "</script>";

									} else {	 // 고정배너

										$query = $this->query_fetch(" select * from `".$this->banner_table."` where `view` = 1 and `p_no` = '".$p_no."' order by rand() " );

										$sizes = ($width && $height) ? "style=\"width:".$width."px;height:".$height."px;\"" : "";

										$result .= "<div class=\"mt5\">";
											$result .= $this->view_banner($query['no'], $query['type'], $query['position'], false, false, $width, $height);
										$result .= "</div>\n";

									}

								}

							break;

							## 메인 좌측, 우측 스크롤 배너
							case 'main_left_scroll':
							case 'main_right_scroll':
							case 'alba_left_scroll':
							case 'alba_right_scroll':
							case 'adult_left_scroll':
							case 'adult_right_scroll':
							case 'resume_left_scroll':
							case 'resume_right_scroll':
							case 'individual_left_scroll':
							case 'individual_right_scroll':
							case 'company_left_scroll':
							case 'company_right_scroll':
							case 'map_left_scroll':
							case 'map_right_scroll':
							case 'board_left_scroll':
							case 'board_right_scroll':
							case 'search_left_scroll':
							case 'search_right_scroll':
							case 'service_left_scroll':
							case 'service_right_scroll':

								$result = "";

								$get_group = $this->_group( $position );
								$group_list = $get_group['list'];

								foreach($group_list as $group){	// 그룹 전체

									$ids = $utility->getOrderNumber(6);

									$p_no = $group['p_no'];
									$banner_list = $this->banner_list( " where `p_no` = '".$p_no."' and `view` = 1 " );

									if(!$banner_list['total_count']) continue;

									$banner_Pno = $this->banner_Pno($p_no);
									$roll_type = $banner_Pno['roll_type'];
									$roll_direction = $this->roll_direction[$banner_Pno['roll_direction']];
									$roll_time = $banner_Pno['roll_time'];
									$roll_turn = $banner_Pno['roll_turn'];

									$max_size = $this->query_fetch(" select `width`, `height` from `".$this->banner_table."` where `p_no` = '".$p_no."' order by `width` desc, `height` desc limit 1");

									$width = $max_size['width'];
									$height = $max_size['height'];

									$sizes = ($width && $height) ? "width:".$width."px;height:".$height."px;" : "";

									if($roll_type){	// 롤링배너

										$result .= "<div  id=\"".$ids."\" style=\"".$sizes."\">\n";

										foreach($banner_list['result'] as $key => $val){

											$result .= "<div id=\"".$page_name."_banner_".$val['no']."\">";
												$result .= $this->view_banner($val['no'], $val['type'], $val['position'], false, false, $width, $height);
											$result .= "</div>\n";

										}

										$result .= "</div>\n";

										$result .= "<script>";
										$result .= "$('#".$ids."').cycle({ ";
										$result .= "fx:'".$roll_direction."', ";
										//$result .= "easing: 'easeOutBounce', ";
										$result .= "delay:  ".$roll_time."000 ";
										$result .= "});";
										$result .= "</script>";

									} else {	 // 고정배너

										$query = $this->query_fetch(" select * from `".$this->banner_table."` where `view` = 1 and `p_no` = '".$p_no."' order by rand() " );

										$sizes = ($width && $height) ? "style=\"width:".$width."px;height:".$height."px;\"" : "";

										$result .= "<div class=\"mt5\">";
											$result .= $this->view_banner($query['no'], $query['type'], $query['position'], false, false, $width, $height);
										$result .= "</div>\n";

									}

								}

							break;

							case 'etc_bottom':		## 하단 공통 제휴 배너
							case 'etc_pop_login':	## 팝업 로그인 창

								$result = "";

								$get_group = $this->_group( $position );
								$group_list = $get_group['list'];

								foreach($group_list as $group){	// 그룹 전체

									$ids = $utility->getOrderNumber(6);

									$p_no = $group['p_no'];
									$banner_list = $this->banner_list( " where `p_no` = '".$p_no."' and `view` = 1 " );

									if(!$banner_list['total_count']) continue;

									$banner_Pno = $this->banner_Pno($p_no);
									$roll_type = $banner_Pno['roll_type'];
									$roll_direction = $this->roll_direction[$banner_Pno['roll_direction']];
									$roll_time = $banner_Pno['roll_time'];
									$roll_turn = $banner_Pno['roll_turn'];

									$max_size = $this->query_fetch(" select `width`, `height` from `".$this->banner_table."` where `p_no` = '".$p_no."' order by `width` desc, `height` desc limit 1");

									$width = $max_size['width'];
									$height = $max_size['height'];

									$sizes = ($width && $height) ? "width:".$width."px;height:".$height."px;" : "";

									if($roll_type){	// 롤링배너

										$result .= "<div id=\"".$ids."\" style=\"".$sizes."\">";

										foreach($banner_list['result'] as $key => $val){

											$result .= "<div id=\"".$page_name."_banner_".$val['no']."\">";
												$result .= $this->view_banner($val['no'], $val['type'], $val['position'], false, false, $width, $height);
											$result .= "</div>\n";

										}

										$result .= "</div>\n";

										$result .= "<script>";
										$result .= "$('#".$ids."').cycle({ ";
										$result .= "fx:'".$roll_direction."', ";
										//$result .= "easing: 'easeOutBounce', ";
										$result .= "delay:  ".$roll_time."000 ";
										$result .= "});";
										$result .= "</script>";

									} else {	 // 고정배너

										$query = $this->query_fetch(" select * from `".$this->banner_table."` where `view` = 1 and `p_no` = '".$p_no."' order by rand() " );

										$sizes = ($width && $height) ? "style=\"width:".$width."px;height:".$height."px;\"" : "";

										$result .= "<div>";
											$result .= $this->view_banner($query['no'], $query['type'], $query['position'], false, false, $width, $height);
										$result .= "</div>\n";

									}

								}

							break;

							## 로그인 페이지 배너
							case 'etc_login':

								$result = "";

								$get_group = $this->_group( $position );
								$group_list = $get_group['list'];

								foreach($group_list as $group){	// 그룹 전체

									$ids = $utility->getOrderNumber(6);

									$p_no = $group['p_no'];
									$banner_list = $this->banner_list( " where `p_no` = '".$p_no."' and `view` = 1 " );

									if(!$banner_list['total_count']) continue;

									$banner_Pno = $this->banner_Pno($p_no);
									$roll_type = $banner_Pno['roll_type'];
									$roll_direction = $this->roll_direction[$banner_Pno['roll_direction']];
									$roll_time = $banner_Pno['roll_time'];
									$roll_turn = $banner_Pno['roll_turn'];

									$max_size = $this->query_fetch(" select `width`, `height` from `".$this->banner_table."` where `p_no` = '".$p_no."' order by `width` desc, `height` desc limit 1");

									$width = $max_size['width'];
									$height = $max_size['height'];

									$sizes = ($width && $height) ? "width:".$width."px;height:".$height."px;" : "";

									if($roll_type){	// 롤링배너

										$result .= "<div id=\"".$ids."\" style=\"".$sizes."\">";

										foreach($banner_list['result'] as $key => $val){

											$result .= "<div id=\"".$page_name."_banner_".$val['no']."\">";
												$result .= $this->view_banner($val['no'], $val['type'], $val['position'], false, false, $width, $height);
											$result .= "</div>\n";

										}

										$result .= "</div>\n";

										$result .= "<script>";
										$result .= "$('#".$ids."').cycle({ ";
										$result .= "fx:'".$roll_direction."', ";
										//$result .= "easing: 'easeOutBounce', ";
										$result .= "delay:  ".$roll_time."000 ";
										$result .= "});";
										$result .= "</script>";

									} else {	 // 고정배너

										$query = $this->query_fetch(" select * from `".$this->banner_table."` where `view` = 1 and `p_no` = '".$p_no."' order by rand() " );

										$sizes = ($width && $height) ? "style=\"width:".$width."px;height:".$height."px;\"" : "";

										$result .= "<div>";
											$result .= $this->view_banner($query['no'], $query['type'], $query['position'], false, false, $width, $height);
										$result .= "</div>\n";

									}

								}

							break;

							## 팝업 로그인 페이지 배너
							case 'etc_pop_login':
							
								//echo "AAA";

							break;

							## 검색 페이지 중간 배너
							case 'search_middle_banner':

								$result = "";

								$get_group = $this->_group( $position );
								$group_list = $get_group['list'];

								foreach($group_list as $group){	// 그룹 전체

									$ids = $utility->getOrderNumber(6);

									$p_no = $group['p_no'];
									$banner_list = $this->banner_list( " where `p_no` = '".$p_no."' and `view` = 1 " );

									if(!$banner_list['total_count']) continue;

									$banner_Pno = $this->banner_Pno($p_no);
									$roll_type = $banner_Pno['roll_type'];
									$roll_direction = $this->roll_direction[$banner_Pno['roll_direction']];
									$roll_time = $banner_Pno['roll_time'];
									$roll_turn = $banner_Pno['roll_turn'];

									$max_size = $this->query_fetch(" select `width`, `height` from `".$this->banner_table."` where `p_no` = '".$p_no."' order by `width` desc, `height` desc limit 1");

									$width = $max_size['width'];
									$height = $max_size['height'];

									$sizes = ($width && $height) ? "width:".$width."px;height:".$height."px;" : "";

									if($roll_type){	// 롤링배너

										$result .= "<li class=\"ad pt5\">\n";
										$result .= "<div  id=\"".$ids."\" style=\"".$sizes."\">\n";

										foreach($banner_list['result'] as $key => $val){

											$result .= "<div id=\"".$page_name."_banner_".$val['no']."\">";
												$result .= $this->view_banner($val['no'], $val['type'], $val['position'], false, false, $width, $height);
											$result .= "</div>\n";

										}

										$result .= "</div>\n";
										$result .= "</li>\n";

										$result .= "<script>";
										$result .= "$('#".$ids."').cycle({ ";
										$result .= "fx:'".$roll_direction."', ";
										//$result .= "easing: 'easeOutBounce', ";
										$result .= "delay:  ".$roll_time."000 ";
										$result .= "});";
										$result .= "</script>";

									} else {	 // 고정배너

										$query = $this->query_fetch(" select * from `".$this->banner_table."` where `view` = 1 and `p_no` = '".$p_no."' order by rand() " );

										$sizes = ($width && $height) ? "style=\"width:".$width."px;height:".$height."px;\"" : "";

										$result .= "<div class=\"mt5\">";
											$result .= $this->view_banner($query['no'], $query['type'], $query['position'], false, false, $width, $height);
										$result .= "</div>\n";

									}

								}

							break;

							## 기타 위치 배너
							default:

							break;

						}	// switch end.

					
					return $result;

				}


				/**
				* 에러코드에 맞는 에러를 토해낸다.
				*/
				function _errors( $err_code ){

						$result = $this->fail_code[$err_code];

					return $result;

				}

				/**
				* 완료코드에 맞는 에러를 토해낸다.
				*/
				function _success( $success_code ){

						$result = $this->success_code[$success_code];

					return $result;

				}


		}	// class end.
?>