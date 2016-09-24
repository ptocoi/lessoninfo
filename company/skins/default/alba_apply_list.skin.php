<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
var type = "<?php echo $type;?>";
</script>

<script type="text/javascript" src="<?php echo $alice['company_path'];?>/skins/default/alba_apply_list.skin.js"></script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent">
		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['company_path'];?>/">기업서비스</a> > <a href="<?php echo $alice['company_path'];?>/alba_list.php">채용공고 관리</a> > <strong>지원자 관리</strong> </p>
		</div>
		<?php /* //navigation */ ?>
		<div class="listWrap positionR mt20">
			<h2 class="pb5"><img src="../images/tit/company_tit_02.gif" width="119" height="25" alt="지원자 관리"></h2>
			<em class="titEm mb20">
				<ul>
				<li>채용공고 중 접수방법이 온라인지원과 e-메일 지원인 공고에 대해 지원자 현황을 확인하실 수 있습니다.</li>
				<li>온라인 지원자가 지원 취소하거나 이력서를 삭제할 경우 리스트에는 노출되나 이력서 내용은 확인하실 수 없습니다.</li>
				<li>지원취소, 삭제 및 사이트 내 e-메일 지원이 아닌 개별적인 e-메일 지원의 경우에는 지원자수에서 제외됩니다.</li>
				</ul>
			</em>
			<div class="companyContentWrap"><!--  컨텐츠  -->
				<div id="listForm" class="mainTab positionR mt30 clearfix"> <!--  지원자관리   --> 
				<h2 class="skip">지원자관리</h2>
				<ul class="tabMenu clearfix">
					<li class="tab1 <?php echo (!$type)?'on':'';?>"><a href="./alba_apply_list.php<?php echo ($sel_alba)?'?sel_alba='.$sel_alba:'';?>"><strong>진행중인 채용공고</strong> [<?php echo number_format($continue_cnt);?>건]</a></li>
					<li class="tab2 <?php echo ($type=='finish')?'on':'';?>"><a href="./alba_apply_list.php?type=finish<?php echo ($sel_alba)?'&sel_alba='.$sel_alba:'';?>"><strong>마감된 채용공고</strong> [<?php echo number_format($end_cnt);?>건]</a></li>
				</ul>
				<span style="top:5px; right:5px;" class="positionA">
					<select class="ipSelect" style="width:170px;" name="sort" title="<?php echo $type_msg;?> 채용공고 선택" onchange="list_sort(this);">
					<option value=""><?php echo $type_msg;?> 채용공고 선택</option>
					<?php foreach($select_list as $val){ ?>
					<option value="<?php echo $val['no'];?>" <?php echo ($val['no']==$sel_alba)?'selected':'';?>><?php echo stripslashes($val['wr_subject']);?></option>
					<?php } ?>
					</select>
				</span>
				<table cellspacing="0">
				<caption class="skip">최근 입사지원자</caption>
				<colgroup><col width="10px"><col width="*"><col width="160px"><col width="95px"><col width="95px"></colgroup>
				<thead>
				<tr>
					<th scope="col"><input type="checkbox" onclick="selAll();"></th>
					<th scope="col">지원자</th>
					<th scope="col">경력/자격증</th>
					<th scope="col">열람일</th>
					<th scope="col">지원일</th>
				</tr>
				</thead>
				<tbody>
				<?php 
				if($receive_list){
					foreach($receive_list['result'] as $val){ 

						if($type=='finish'){	 // 마감된 공고
							$end_cnt = $alba_company_control->alba_list_count($where_que . " and `no` = '".$val['wr_to']."' and ( `wr_volume_always` = '0' and `wr_volume_end` = '0' and `wr_volume_date` < curdate() ) ");	 // 종료된 공고 카운팅
							if(!$end_cnt) continue;
						} else {	 // 진행중인 공고
							$continue_cnt = $alba_company_control->alba_list_count($where_que . " and `no` = '".$val['wr_to']."' and ( `wr_volume_always` = '1' or `wr_volume_end` = '1' or `wr_volume_date` >= curdate() ) ");	// 진행중인 공고 카운팅
							if(!$continue_cnt) continue;
						}

						$get_member = $user_control->get_member($val['wr_id']);

						$mb_photo_file = $alice['data_member_path']."/".$get_member['mb_id']."/".$get_member['mb_photo'];
						$mb_photo = (is_file($mb_photo_file)) ? $mb_photo_file : '../images/basic/bg_noPhoto.gif';
						$mb_gender_txt = $user_control->mb_gender_txt[$get_member['mb_gender']];	// 성별
						$mb_birth = explode('-',$get_member['mb_birth']);
						$now_date = date('Y');
						$mb_age = $mb_birth[0] - $now_date + 1; // 우리나라 나이

						if($val['wr_from']){

							$get_resume = $alba_individual_control->get_resume_no($val['wr_from']);	// 이력서 정보

							$resume_href = $alice['resume_path'] . "/alba_resume_detail.php?no=".$val['wr_from']."&receive=".$val['no'];


							/* 경력사항 */
							$wr_career = unserialize($get_resume['wr_career']);
							if($wr_career){
								$period = "";
								foreach($wr_career as $key => $vals){
									$sdate = $vals['sdate'];
									$sdate_exp = explode('-',$sdate);
									$edate = $vals['edate'];
									$edate_exp = explode('-',$edate);
									$period =+ $utility->date_diff($sdate,$edate);
								}
								$periods = round(($period/30),1);
								$periods_exp = explode('.',$periods);
								if($periods_exp[0] >= 12){
									$career_period_year = round(($periods_exp[0] / 12),0);
									$career_period_month = round($periods_exp[1],0);
								}
								$career_periods = "약 " . $career_period_year . "년 " . $career_period_month . "개월";
							} else {
								$career_periods = "없음";
							}
							/* //경력사항 */

							/* 자격증 */
							$license = "";
							if($get_resume['wr_license']){
								$wr_license = unserialize($get_resume['wr_license']);
								$wr_license_cnt = count($wr_license);
								if($wr_license){
									foreach($wr_license as $key => $vals){
										if($key==0){
											$license .= $vals['name'];
										}
									}
									if($wr_license_cnt >= 2){
										$license .= " 외 " . ($wr_license_cnt-1) . "개";
									}
								} else {
									$license .= "없음";
								}
							} else {
								$license .= "없음";
							}
							/* //자격증 */

							$open_date = ($val['etc_4']) ? strtr(substr($val['etc_4'],0,11),'-','.') : "열람전";

						} else {

							$resume_href = "javascript:is_forms();";
							$career_periods = $license = "자사양식 참고";
							$open_date = "이메일 참고";

						}
						
						$wdate = strtr(substr($val['wdate'],0,11),'-','.');

						$mailto = ($get_resume['is_delete']) ? "javascript:is_delete();" : "mailto://".$get_member['mb_email'];

						$is_cancel = $val['is_cancel'];
						if($is_cancel){	// 취소된 경우
							$resume_href = "javascript:is_cancel();";	// 지원 취소된 이력서
							$href_target = "";
						} else {
							if($get_resume['is_delete']){	// 삭제된 이력서 체크
								$resume_href = "javascript:is_delete();";	// 삭제된 이력서
								$href_target = "";
							} else {
								$href_target = ($val['wr_from']) ? "target=\"_blank\"" : "";
							}
						}
				?>
				<tr>
					<td class="tc"><input type="checkbox" class="check_all" value="<?php echo $val['no'];?>" name="no[]"></td>
					<td class="applicant">
						<div class="photo"><a <?php echo $href_target;?> href="<?php echo $resume_href;?>"><img src="<?php echo $mb_photo;?>"></a></div>
						<div class="name pt5">
							<span>
								<strong><?php echo $get_member['mb_name'];?>(<?php echo $mb_gender_txt;?> <?php echo $mb_age;?>세)</strong>
							</span> 
							<span><?php echo $get_member['mb_address0'];?></span>
						</div>
						<div class="title">
							<a class="text_blue" href="<?php echo $resume_href;?>" <?php echo $href_target;?>><?php echo stripslashes($val['etc_0']);?></a>
						</div>
						<div class="mobileEmail">
							<span class="pr10"><?php echo $get_member['mb_hphone'];?></span>l
							<span class="pl10"><a class="url" href="<?php echo $mailto;?>"><?php echo $get_member['mb_email'];?></a></span>
						</div>
					</a>
					</td>
					<td class="tl">
						<div><img  class="vb"alt="경력" src="../images/icon/icon_career.gif" width="23" height="14"> 	<?php echo $career_periods;?></div>
						<div style="letter-spacing:-1px;"><img class="vb" alt="자격증" src="../images/icon/icon_license.gif" width="36" height="14"> <?php echo $license;?></div>
					</td>
					<td class="tc"><span><?php echo $open_date;?></span></td>
					<td class="tc"><span><?php echo $wdate;?></span></td>
				</tr>
				<?php 
					} // foreach end.
				}	// if end.
				?>
				</tbody>
				</table>
				<div class="btnBottom mt10"><a class="button white" onclick="sel_delete();"><span>삭제</span></a> </div>
				<?php include_once $alice['include_path']."/paging.php";?>
				</div> <!--  지원자관리 end   --> 
			</div><!--  컨텐츠 end   --> 

		</div>
		</div>
	</div>
</section>