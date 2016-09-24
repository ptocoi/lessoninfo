<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
var resume_print = function( no ){	// 이력서 인쇄
	
	alert(no+" @@ 이력서 인쇄");

}
</script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent"> 
		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['individual_path'];?>/">개인서비스</a> > <strong>이력서 상세보기</strong> </p>
		</div>
		<?php /* //navigation */ ?>
		<!--  회원정보  -->
		<div class="listWrap positionR mt30">
			<h2 class="skip">이력서상세보기 </h2>
			<div class="readBtn clearfix">
				<ul>
				<li class="pb5 pr5">
					<em class="print_1"><a href="javascript:resume_print('<?php echo $no;?>');"><img  src="../images/icon/icon_print1.gif" width="43" height="18" alt="인쇄" /></a></em>
				</li>
				<li class="pt3"><p>수정일 : <?php echo $wr_udate;?></p></li>
				</ul>
			</div>
			<div class="resumeDetail positionR">
				<!--  이력서수정 버튼// --><em class="positionA" style="top:-27px; right:0; display:block;"><a class="button" href="<?php echo $alice['individual_path'];?>/alba_resume_regist.php?no=<?php echo $no;?>"><span>이력서 전체 수정<img width="7" height="9" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_6.gif" class="pl5"></span></a></em>
				<!--  기타정보  -->
				<table>
				<caption><span class="skip">개인정보출력</span></caption>
				<colgroup><col width="159px"><col width="126px"><col width="*"></colgroup>
				<tbody>
				<tr>
					<th class="brend" colspan="3">
						<div class="positionR"> 
							<p class="title"><?php echo $wr_subject;?></p>
							<?php if($get_resume['wr_work_direct']){ // 즉시출근가능 유무?>
							<em class="positionA" style="right:0; top:15px;">
								<img class="bg_blue4" src="../images/icon/icon_atOnce.png" width="116" height="23" alt="즉시출근가능" />
							</em>
							<?php } ?>
						</div>
					</th>
				</tr>              
				<tr>
					<td class="first" rowspan="6">
						<div class="personphoto">
							<img src="<?php echo $mb_photo;?>" width="100" height="130" alt="photo" />                
						</div>
					</td>
					<th scope="row"> <p>이름</p></th>
					<td>
						<strong><?php echo $get_member['mb_name'];?></strong> (<?php echo $mb_gender_txt;?>, <?php echo $mb_birth[0]?>년생) / <?php echo $get_member['mb_id'];?> <em class="ml10 calltime displayIB">통화가능시간: <span class="text_blue"><?php echo $wr_calltime[0];?>:00~<?php echo $wr_calltime[1];?>:00</span></em>
					</td>
				</tr>
				<tr>
					<th scope="row"> <p>전화번호</p></th>
					<td>
						<p><?php echo $get_member['mb_phone'];?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"> <p>휴대폰</p></th>
					<td>
						<p><?php echo $get_member['mb_hphone'];?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"> <p>이메일</p></th>
					<td>
						<p><?php echo $get_member['mb_email'];?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"> <p>홈페이지</p></th>
					<td><a href="<?php echo $mb_homepage;?>" target="_blank"><?php echo $mb_homepage;?></a></td>
				</tr>
				<tr>
					<th class="vt" scope="row"><p>주소</p></th>
					<td>[<?php echo $get_member['mb_zipcode'];?>] <?php echo $get_member['mb_address0']." ".$get_member['mb_address1'];?></td>
				</tr>
				<tr>
					<td colspan="3" class="etcWrap bbend vt" scope="row" style="padding:0; ">
					<!--  기타정보  -->
					<table style="width:100%">
					<colgroup><col width="159px"><col width="159px"><col width="159px"><col width="159px"><col width="159px"></colgroup>
					<tbody>
					<tr>
						<th>최종학력</th>
						<th>경력사항</th>
						<th>희망급여</th>
						<th>자격증</th>
						<th class="brend">외국어능력</th>
					</tr>
					<tr>
						<td><?php echo stripslashes($wr_school_ability['name']);?></td>
						<td><?php echo $career_periods;?></td>
						<td><?php echo $pay_type;?></td>
						<td><?php echo $license;?></td>
						<td class="brend"><?php echo $language;?></td>
					</tr>
					</tbody>
					</table>    
					<!--  //기타정보 -->
					</td>
				</tr>
				</tbody>
				</table>
				</div>
			</div>
			<!-- //회원정보  --> 

			<!--  희망근무조건 -->
			<div class="listWrap mt30">
				<h2 class="pb5"><img src="../images/tit/person_nav_tit_02.gif"   alt="희망근무조건"></h2>
				<div class="resumeDetail jobtype">
					<em class="positionA" style="top:-27px; right:0;">
						<a class="button" href="<?php echo $alice['individual_path'];?>/alba_resume_regist.php?no=<?php echo $no;?>"><span>이력서 전체 수정<img width="7" height="9" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_6.gif" class="pl5"></span></a>
					</em>
					<table>
					<caption><span class="skip">희망근무조건출력</span></caption>
					<colgroup><col width="159px"><col width="*"></colgroup>
					<tbody>
					<tr>
						<th scope="row"><label>희망근무지</label></th>
						<td>
							<ul>
								<?php echo $wr_area_0;?>
								<?php echo $wr_area_1;?>
								<?php echo $wr_area_2;?>
							</ul>
						</td>
					</tr>
					<tr>
						<th scope="row"><label>희망직종</label></th>
						<td>
							<ul>
								<?php echo $wr_job_type_0;?>
								<?php echo $wr_job_type_1;?>
								<?php echo $wr_job_type_2;?>
							</ul>
						</td>
					</tr>
					<tr>
						<th scope="row"><label>근무일시</label></th>
						<td>
							<ul>
								<li><?php echo $wr_date;?></li>,
								<li><?php echo $wr_week;?></li>,
								<li><?php echo $wr_time;?></li>
								<?php echo $wr_work_direct;?>
							</ul>
						</td>
					</tr>
					<tr>
						<th scope="row"><label>희망급여</label></th>
						<td><?php echo $pay_type;?></td>
					</tr>
					<tr>
						<th scope="row" class="bbend"><label>근무형태</label></th>
						<td  class="bbend">
							<ul><?php echo $work_type;?></ul>
						</td>
					</tr>
					</tbody>
					</table>
				</div>
			</div>
			<!--  //희망근무조건 --> 

			<!--  학력사항  -->
			<div class="listWrap mt30">
				<h2 class="pb5">
					<img src="../images/tit/person_nav_tit_03.gif"   alt="학력사항">
					<em class="resumeText pb5"><strong><span class="text_blue"><?php echo $school_ability[0];?></span> <?php echo $school_ability[1];?></strong></em>
				</h2>
				<div class="resumeDetail table">
				<table>
				<caption><span class="skip">학력사항출력</span></caption>
				<colgroup><col width="245px"><col width="200px"><!-- <col width="80px"> --><col width="*"></colgroup>
				<tbody>
				<tr>
					<th scope="col"> <label>재학기간</label></th>
					<th scope="col"> <label>학교명</label></th>
					<!-- <th scope="col"> <label>소재지</label></th> -->
					<th scope="col" class="brend"> <label>전공</label></th>
				</tr>

				<?php
				if($wr_school_type) {
					foreach($wr_school_type as $key => $val){
						// 고등학교
						if($val=='high_school'){	// 고등학교
							$school_syear = $get_resume['wr_high_school_syear'] . "년 입학 ";	// 입학년도
							$school_eyear = "~ " . $get_resume['wr_high_school_eyear'] ."년 ";		// 졸업년도
							$high_school_graduation = $get_resume['wr_high_school_graduation'];	// 졸업여부
							$school_graduation = ($high_school_graduation) ? "재학" : "졸업";
							$school_name = $get_resume['wr_high_school_name'];
				?>
							<tr>
								<td><?php echo $school_syear;?><?php echo $school_eyear;?><?php echo $school_graduation;?></td>
								<td><strong><?php echo $school_name;?></strong></td>
								<!-- <td>경기</td> -->
								<td class="brend"></td>
							</tr>
				<?php
						} else if($val=='half_college'){	// 대학 (2,3년)
							if($wr_half_college){
								for($j=0;$j<$wr_half_college_cnt;$j++){
									$school_syear = $wr_half_college['college_syear'][$j] . "년 입학 ";	// 입학년도
									$school_eyear = "~ " . $wr_half_college['college_eyear'][$j] . "년 ";	// 졸업년도
									$half_college_school_graduation = $wr_half_college['college_graduation'][$j];
									$school_graduation_arr = array( 0 => "졸업", 1 => "재학", 2 => "중퇴");
									$school_graduation = $school_graduation_arr[$half_college_school_graduation];
									$school_name = $wr_half_college['college'][$j];
									$school_specialize = $wr_half_college['college_specialize'][$j];
				?>
							<tr>
								<td>
									<?php echo $school_syear;?><?php echo $school_eyear;?><?php echo $school_graduation;?>
									<?php if( ($j+1) ==$wr_half_college_cnt ) echo ($get_resume['wr_school_absence']) ? "휴학중" : "";?>
								</td>
								<td><strong><?php echo $school_name;?></strong></td>
								<!-- <td>경기</td> -->
								<td class="brend"><?php echo $school_specialize;?></td>
							</tr>
				<?php
								}	// half_college for end.
							}	// wr_half_college if end.

						} else if($val=='college'){	// 대학 (4년)
							if($wr_college){
								for($j=0;$j<$wr_college_cnt;$j++){
									$school_syear = $wr_college['college_syear'][$j] . "년 입학 ";	// 입학년도
									$school_eyear = "~ " . $wr_college['college_eyear'][$j] . "년 ";	// 졸업년도
									$college_school_graduation = $wr_college['college_graduation'][$j];
									$school_graduation_arr = array( 0 => "졸업", 1 => "재학", 2 => "중퇴");
									$school_graduation = $school_graduation_arr[$college_school_graduation];
									$school_name = $wr_college['college'][$j];
									$school_specialize = $wr_college['college_specialize'][$j];
				?>
							<tr>
								<td>
									<?php echo $school_syear;?><?php echo $school_eyear;?><?php echo $school_graduation;?>
									<?php if( ($j+1) ==$wr_college_cnt ) echo ($get_resume['wr_school_absence']) ? "휴학중" : "";?>
								</td>
								<td><strong><?php echo $school_name;?></strong></td>
								<!-- <td>경기</td> -->
								<td class="brend"><?php echo $school_specialize;?></td>
							</tr>
				<?php
								}	// college for end.
							}	// college if end.

						} else if($val=='graduate'){	// 대학원
							if($wr_graduate){
								for($j=0;$j<$wr_graduate_cnt;$j++){
									$school_syear = $wr_graduate['graduate_syear'][$j] . "년 입학 ";	// 입학년도
									$school_eyear = "~ " . $wr_graduate['graduate_eyear'][$j] . "년 ";	// 졸업년도
									$graduate_school_graduation = $wr_graduate['graduate_graduation'][$j];
									$school_graduation_arr = array( 0 => "졸업", 1 => "수료", 2 => "재학", 3 => "중퇴");
									$school_graduation = $school_graduation_arr[$graduate_school_graduation];
									$school_name = $wr_graduate['graduate'][$j];
									$school_specialize = $wr_graduate['graduate_specialize'][$j];
				?>
							<tr>
								<td>
									<?php echo $school_syear;?><?php echo $school_eyear;?><?php echo $school_graduation;?>
									<?php if( ($j+1) ==$wr_graduate_cnt ) echo ($get_resume['wr_school_absence']) ? "휴학중" : "";?>
								</td>
								<td><strong><?php echo $school_name;?></strong></td>
								<!-- <td>경기</td> -->
								<td class="brend"><?php echo $school_specialize;?></td>
							</tr>
				<?php
								}	// college for end.
							}	// college if end.

						} else if($val=='success'){	// 대학원 이상
							if($wr_success){
								for($j=0;$j<$wr_success_cnt;$j++){
									$school_syear = $wr_success['success_syear'][$j] . "년 입학 ";	// 입학년도
									$school_eyear = "~ " . $wr_success['success_eyear'][$j] . "년 ";	// 졸업년도
									$success_school_graduation = $wr_success['success_graduation'][$j];
									$school_graduation_arr = array( 0 => "졸업", 1 => "수료", 2 => "재학", 3 => "중퇴");
									$school_graduation = $school_graduation_arr[$success_school_graduation];
									$school_name = $wr_success['success'][$j];
									$school_specialize = $wr_success['success_specialize'][$j];
				?>
							<tr>
								<td>
									<?php echo $school_syear;?><?php echo $school_eyear;?><?php echo $school_graduation;?>
									<?php if( ($j+1) ==$wr_success_cnt ) echo ($get_resume['wr_school_absence']) ? "휴학중" : "";?>
								</td>
								<td><strong><?php echo $school_name;?></strong></td>
								<!-- <td>경기</td> -->
								<td class="brend"><?php echo $school_specialize;?></td>
							</tr>
				<?php
								}	// college for end.
							}	// college if end.
						}	// if end.
				
					} // foreach end. 
				} // foreach if end.
				?>
				<!-- <tr>
					<td class="bbend">2004년 입학 ~ 2011년 졸업</td>
					<td class="bbend"><strong>○○○○ 대학교</strong></td>
					<td class="bbend">경기</td>
					<td class="bbend brend">예/체능학 > 프로덕트 디자인 학과</td>
				</tr> -->
				</tbody>
				</table>
				</div>
			</div>
			<!--  //학력사항 -->

			<!--  경력사항  -->
			<?php if($wr_career_use){ ?>
			<div class="listWrap mt30">
				<h2 class="pb5">
					<img src="../images/tit/person_nav_tit_04.gif"  alt="경력사항">
					<em class="resumeText pb5"><strong>총 경력<span class="text_blue"> <?php echo $career_periods;?></span></strong></em>
				</h2>
				<div class="resumeDetail table">
				<table>
				<caption><span class="skip">경력사항출력</span></caption>
				<colgroup><col width="100px"><col width="150px"><col width="150px"><col width="*"></colgroup>
				<tbody>
				<tr>
					<th scope="col"> <label>근무기간</label></th>
					<th scope="col"> <label>회사명</label></th>
					<th scope="col"> <label>담당업무</label></th>
					<th scope="col" class="brend"> <label>상세업무</label></th>
				</tr>
				<?php
				if($wr_career){
					foreach($wr_career as $key => $val){
						$date_val = "";
						$sdate = ($val['sdate']) ? explode('-',$val['sdate']) : "";
						$date_val = $sdate[0]."년 " . $sdate[1] . "월 ~<br/>";
						$edate = ($val['edate']) ? explode('-',$val['edate']) : "";
						$date_val .= $edate[0]."년 " . $edate[1] . "월";
						$career_type = $val['type'];
						$career_type_cnt = count($val['type']);
				?>
				<tr>
					<td class="tl"><p><?php echo $date_val;?></p></td>
					<td class="tl">
						<strong><?php echo $val['company'];?></strong>
						<ul>
							<?php for($k=0;$k<$career_type_cnt;$k++){ ?>
							<li><img src="../images/icon/ico_job_category1.gif" width="27" height="14" alt="업종" /> <?php echo $category_control->get_categoryCodeName($career_type[$k]);?></li>
							<?php } ?>
							<!-- <li><img src="../images/icon/ico_job_category2.gif" width="27" height="14" alt="직종" /> 웹디자인</li> -->
						</ul>
					</td>
					<td class="tl"><?php echo $val['job'];?></td>
					<td class="tl brend"><?php echo nl2br(stripslashes($val['content']));?></td>
				</tr>
				<?php 
					}	// foreach end.
				}	// wr_career if end.
				?>
				<!-- <tr>
					<td class="tl bbend"><p>2004년 3월 ~<br/>2011년 5월</p></td>
					<td class="tl bbend">
						<strong>넷퓨정규직</strong>
						<ul>
							<li><img src="../images/icon/ico_job_category1.gif" width="27" height="14" alt="업종" /> 구인구직</li>
							<li><img src="../images/icon/ico_job_category2.gif" width="27" height="14" alt="직종" /> 웹디자인</li>
						</ul>
					</td>
					<td class="tl bbend">편집디자인</td>
					<td class="tl bbend brend"><p>넷퓨정규직 홍보실에서 편집디자인 작업</p></td>
				</tr> -->
				</tbody>
				</table>
				</div>
			</div>
			<?php } ?>
			<!--  //경력사항  -->

			<!--  보유자격증  -->
			<?php if($wr_license){ ?>
			<div class="listWrap mt30">
				<h2 class="pb5"><img src="../images/tit/person_nav_tit_05.gif"   alt="보유자격증"></h2>
				<div class="resumeDetail table">
				<table>
				<caption><span class="skip">학력사항출력</span></caption>
				<colgroup><col width="245px"><col width="*"><col width="200px"></colgroup>
				<tbody>
				<tr>
					<th scope="col"> <label>취득일</label></th>
					<th scope="col"> <label>자격증명</label></th>
					<th scope="col" class="brend"> <label>발행처</label></th>
				</tr>
				<?php
				if($wr_license){
					foreach($wr_license as $key => $val){
				?>
				<tr>
					<td><?php echo $val['year'];?>년</td>
					<td><strong><?php echo $val['name'];?></strong></td>
					<td class="brend"><?php echo $val['public'];?></td>
				</tr>
				<!-- <tr>
					<td class="bbend">2006년</td>
					<td class="bbend"><strong>웹디자인 1급</strong></td>
					<td class="bbend brend">산업인력공단</td>
				</tr> -->
				<?php 
					} // foreach end.
				}	// foreach if end.
				?>
				</tbody>
				</table>
				</div>
			</div>
			<?php } ?>
			<!--  //보유자격증 -->

			<!--  외국어능력   -->
			<?php if($wr_language){ ?>
			<div class="listWrap mt30">
				<h2 class="pb5"> <img src="../images/tit/person_nav_tit_06.gif"  alt="외국어능력"> </h2>
				<div class="resumeDetail table">
				<table>
				<caption><span class="skip">학력사항출력</span></caption>
				<colgroup><col width="200px"><col width="*"></colgroup>
				<tbody>
				<tr>
					<th scope="col"> <label>외국어명</label></th>
					<th scope="col" class="brend"> <label>구사능력 / 공인시험 / 어학연수</label></th>
				</tr>
				<?php
				if($wr_language){
					foreach($wr_language as $key => $val){
					$language_name = $category_control->get_categoryCodeName($val['language']);
					$level_name = $alba_individual_control->language_level[$val['level']]['name'];
					$level_icon = $alba_individual_control->language_level[$val['level']]['icon'];
					$level_text = $alba_individual_control->language_level[$val['level']]['text'];
					$study_date = $alba_resume_control->language_date[$val['study_date']];
				?>
				<tr>
					<td><?php echo $language_name;?></td>
					<td class="tl brend">
						<ul>
							<li>[구사능력] <strong><em><img class="vm pb3" width="17" height="14" alt="<?php echo $level_name;?>" src="../images/icon/<?php echo $level_icon;?>"></em>
							<?php echo $level_text;?></strong></li>
							<?php 
							if($val['license']){
								//foreach($val['license']['license'] as $lkey => $lval){
								$license = $val['license']['license'];
								$level = $val['license']['level'];
								$year = $val['license']['year'];
								$license_cnt = count($license);
								for($j=0;$j<$license_cnt;$j++){
								$license_name = $category_control->get_categoryCodeName($license[$j]);
								$license_level = $level[$j];
								$license_year = $year[$j];
							?>
							<li>[공인시험] <strong><?php echo $license_name;?> <?php echo $license_level;?>점 (취득년도:<?php echo $license_year;?>년)</strong></li>
							<?php 
								} 
							}
							if($val['study']){
							?>
							<li>[어학연수] <strong>어학연수 경험있음 (연수기간:<?php echo $study_date;?>)</strong></li>
							<?php } ?>
						</ul>
					</td>
				</tr>
				<?php
					}	// foreach end.
				}	// foreach if end.
				?>
				<!-- <tr>
					<td class="bbend">중국어</td>
					<td class="tl bbend brend">
						<ul>
							<li>[구사능력] <strong><em><img class="vm pb3" width="17" height="14" alt="중" src="../images/icon/icon_average.gif"></em>
							일상대화</strong></li>
							<li>[공인시험] <strong>HSK회화 초급 (취득년도:2005년)</strong></li>
							<li>[어학연수] <strong>어학연수 경험있음 (연수기간:1년)</strong></li>
						</ul>
					</td>
				</tr> -->
				</tbody>
				</table>
				</div>
			</div>
			<?php } ?>
			<!--  //외국어능력   -->

			<!--  OA능력및특기사항   -->
			<div class="listWrap mt30">
				<h2 class="pb5"><img src="../images/tit/person_nav_tit_07.gif"  alt="oa능력및특기사항"></h2>
				<div class="resumeDetail list">
				<table>
				<caption><span class="skip">OA능력및특기사항 출력</span></caption>
				<tbody>
				<tr>
					<th class="brend">
						<ul>
							<li>
							<label><em class="pr5"><img class="vm pb2" width="16" height="16" src="../images/icon/icon_word1.gif" alt="워드"></em>한글/ms워드</label>
							</li>
							<li>
							<label><em class="pr5"><img class="vm pb2" width="16" height="16" src="../images/icon/icon_power1.gif" alt="파워포인트"></em>파워포인트</label>
							</li>
							<li>
							<label><em class="pr5"><img class="vm pb2" width="16" height="16" src="../images/icon/icon_excel1.gif" alt="엑셀"></em>엑셀</label>
							</li>
							<li class="brend">
							<label><em class="pr5"><img class="vm pb2" width="16" height="16" src="../images/icon/icon_ie1.gif" alt="인터넷"></em>인터넷</label>
							</li>
						</ul>
					</th>
				</tr>

				<tr>
					<td>
						<ul>
							<li>
							<em class="pl5"><img class="vm pb3" width="17" height="14" alt="<?php echo $oa_word['name'];?>" src="../images/icon/<?php echo $oa_word['icon'];?>"></em>
							<?php echo $oa_word['text'];?>
							</li>
							<li>
							<em class="pl5"><img class="vm pb3" width="17" height="14" alt="<?php echo $oa_pt['name'];?>" src="../images/icon/<?php echo $oa_pt['icon'];?>"></em>
							<?php echo $oa_pt['text'];?>
							</li>
							<li>
							<em class="pl5"><img class="vm pb3" width="17" height="14" alt="<?php echo $oa_sheet['name'];?>" src="../images/icon/<?php echo $oa_sheet['icon'];?>"></em>
							<?php echo $oa_sheet['text'];?>
							</li>
							<li class="brend">
							<em class="pl5"><img class="vm pb3" width="17" height="14" alt="<?php echo $oa_internet['name'];?>" src="../images/icon/<?php echo $oa_internet['icon'];?>"></em>
							<?php echo $oa_internet['text'];?>
							</li>
						</ul>
					</td>
				</tr>
				<tr>
					<th class="brend"><label class="pl20">컴퓨터능력</label></th>
				</tr>
				<tr>
					<td class="brend"><p class="pl20"><?php echo @implode($computers,', ');?></p></td>
				</tr>
				<tr>
					<th class="brend"><label class="pl20">특기사항</label></th>
				</tr>
				<tr>
					<td class="brend"><p class="pl20"><?php echo @implode($specialty,', ');?></p></td>
				</tr>
				<tr>
					<th class="brend"><label class="pl20">수상·수료활동내역</label></th>
				</tr>
				<tr>
					<td class="brend bbend"><p class="pl20"><?php echo $wr_prime;?></p></td>
				</tr>
				</tbody>
				</table>
				</div>
			</div>
			<!--  //OA능력및특기사항  -->

			<!--  자기소개서  -->
			<div class="listWrap mt30">
				<h2 class="pb5"><img src="../images/tit/person_nav_tit_08.gif"  alt="자기소개서"></h2>
				<div class="resumeDetail clearfix">
					<div class="pt20 pl20 pr20 pb20"><?php echo $wr_introduce;?></div>
				</div>
			</div>
			<!--  //자기소개서  -->

			<!--  포토앨범   -->
			<div class="listWrap mt30">
				<h2 class="pb5"><img src="../images/tit/person_nav_tit_09.gif"  alt="포토앨범"></h2>
				<div class="resumeDetail clearfix" style="z-index:100;">
				<table>
				<caption><span class="skip">포토앨범 출력</span></caption>
				<colgroup><col width="159px"><col width="*"></colgroup>
				<tbody>
				<tr>
				<td class="bbend vt">
					<div class="pictureWrap positionR clearfix">
						<ul>
							<li>
								<div class="pt20 picture">
									<img width="150" height="100" alt="photo" src="<?php echo $photo_0;?>">
								</div>
								<em>&nbsp;</em>
							</li>
							<li>
								<div class="pt20 picture">
									<img width="150" height="100" alt="photo" src="<?php echo $photo_1;?>">
								</div>
								<em>&nbsp;</em>
							</li>
							<li>
								<div class="pt20 picture">
									<img width="150" height="100" alt="photo" src="<?php echo $photo_2;?>">
								</div>
								<em>&nbsp;</em>
							</li>
							<li>
								<div class="pt20 picture">
									<img width="150" height="100" alt="photo" src="<?php echo $photo_3;?>">
								</div>
								<em>&nbsp;</em>
							</li>
						</ul>
					</div>
				</td>
				</tr>
				</tbody>
				</table>
				</div>
			</div>
			<!--  //포토앨범  -->

			<!--  부가정보   -->
			<div class="listWrap mt30">
				<h2 class="pb5"><img src="../images/tit/person_nav_tit_10.gif"  alt="부가정보"></h2>
				<div class="resumeDetail table">
				<table>
				<caption><span class="skip">학력사항출력</span></caption>
				<colgroup><col width="25%"><col width="25%"><col width="25%"><col width="*"></colgroup>
				<tbody>
				<tr>
					<th scope="col"> <label>장애여부</label></th>
					<th scope="col"> <label>결혼여부</label></th>
					<th scope="col"> <label>병역여부</label></th>
					<th scope="col" class="brend"> <label>채용우대</label></th>
				</tr>
				<tr>
					<td class="bbend"><?php echo $impediment;?> </td>
					<td class="bbend"><?php echo $wr_marriage;?></td>
					<td class="bbend">[<?php echo $wr_military;?>] <?php echo $get_resume['wr_military_type']?> </td>
					<td class="bbend brend"><?php echo @implode($wr_preferential,', ');?> <?php echo $treatment;?> </td>
				</tr>
				</tbody>
				</table>
				</div>
			</div>
			<!--  //부가정보  -->

			<!--  주의사항   -->
			<div style="display:block;" class="Caution mt50 mb20">
			<h3 class="skip">주의사항</h3>
			<ul>
			<li>본 정보는 취업활동을 위해 등록한 이력서 정보이며 <?php echo $env['site_name'];?>는(은) 기재된 내용에 대한 오류와 사용자가 신뢰하여 취한 조치에 대한 책임을 지지 않습니다.</li> 
			<li>누구든 본 정보를 <?php echo $env['site_name'];?>의 동의없이 재배포할 수 없으며 본 정보를 출력 및 복사하더라도 채용목적 이외의 용도로 사용할 수 없습니다.</li> 
			<li>아울러 본 정보를 출력 및 복사한 경우의 개인정보보호에 대한 책임은 출력 및 복사한 당사자에게 있으며 정보통신부 고시 제2005-18호 (개인정보의 기술적·관리적 보호조치 기준)에 따라 개인정보가 담긴 이력서 등을 불법유출 및 배포하게 되면 법에 따라 책임지게 됨을 양지하시기 바랍니다. <저작권자 ⓒ <?php echo $env['site_name'];?>. 무단전재-재배포 금지></li>
			</ul>
			</div>
		<!--  주의사항 end   -->
		</div>

	</div>
</section>