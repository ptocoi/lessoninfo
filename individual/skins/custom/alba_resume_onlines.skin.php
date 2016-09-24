<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
var type = "<?php echo $type;?>";
</script>

<script type="text/javascript" src="<?php echo $alice['individual_path'];?>/skins/default/alba_resume_online.skin.js"></script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent"> 
		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['individual_path'];?>/">개인서비스</a> > <a href="<?php echo $alice['individual_path'];?>/alba_resume_onlines.php">입사지원 관리</a> > <strong>온라인 지원 현황</strong> </p>
		</div>
		<?php /* //navigation */ ?>
		<div class="listWrap positionR mt20">
			<h2 class="pb5"><img src="../images/tit/person_tit_02.gif" width="145" height="25" alt="입사지원현황"></h2>
			<h3 style="padding:10px;" class="font11 fongrb">맞춤 인재 정보를 설정하시면  원하는 형태의 인재정보를 이메일이나 SMS 문자를 통해 수신하실 수 있습니다.<a target="_blank" href="/company/alba_customized.php"><img class="vm positionR" style="left:115px;"src="/images/tit/more_job.gif"></a></h3>
			<em style="border:0px;padding:10px 0px 0px 3px !important" class="titEm mb20">
					<ul>						
						<li>온라인, 이메일입사지원 현황을 관리하실수 있습니다.</li>
						<li>기업회원이 지원내역을 삭제한 경우 목록에 출력되지 않습니다</li>
						<li>또한, 기업회원이 지원내역을 열람한 경우 지원취소하거나 삭제가 불가능 합니다. (열람전엔 취소, 삭제 가능합니다)</li>
					</ul>
				</em>
				<div class="personContentWrap"><!--  컨텐츠  -->
					
					<!--  온라인 지원 현황   --> 
					<div id="listForm" class="positionR mt30 clearfix">
						
						<form method="get" name="OnlinesSearchFrm" action="<?php echo $_SERVER['PHP_SELF'];?>" id="OnlinesSearchFrm">
						<input type="hidden" name="mode" value="alba_search"/>
						<!-- <input type="hidden" name="type" value="<?//php echo $type;?>"/> -->

						<h2 class="skip">온라인 지원 현황</h2>
						<div class="positionA" style="top:15px; right:0;">
							<select title="pagesize" name="page_rows" style="width:100px;" class="ipSelect2" onchange="list_rows(this);">
							<option value="20" <?php echo ($page_rows=='20')?'selected':'';?>>20개씩 보기</option>
							<option value="30" <?php echo ($page_rows=='30')?'selected':'';?>>30개씩 보기</option>
							<option value="50" <?php echo ($page_rows=='50')?'selected':'';?>>50개씩 보기</option>
							</select>
						</div>      
						<ul class="tabMenu clearfix">
							<li class="tab1 <?php echo ($type=='become_online')?'on':'';?>"><a href="./alba_resume_onlines.php"><strong>온라인 지원 현황</strong> [<?php echo number_format($online_cnt['total_count']);?>건]</a></li>
							<li class="tab2 <?php echo ($type=='become_email')?'on':'';?>"><a href="./alba_resume_onlines.php?type=become_email"><strong>이메일 지원 현황</strong> [<?php echo number_format($email_cnt['total_count']);?>건]</a></li>
						</ul>
						<!-- <div class="corpStypeA tc pt5 pb5">
							<span class="pr5">
								<input type="radio" name="search_field" value="wr_company_name" id="wr_company_name" checked> 
								<label for="wr_company_name"><strong>회사명</strong></label>
								<input type="radio" name="search_field" value="wr_subject" id="wr_subject"> 
								<label for="wr_subject"><strong>채용공고 제목</strong></label>
							</span>
							<span>
								<input type="text" class="ipText" style="width:200px;" value="<?php echo $search_keyword;?>" name="search_keyword"> 
								<a class="button" onclick="searchFrmSubmit();"><span>검색</span></a>
							</span>
						</div> -->

						</form>
						
						<table cellspacing="0">
						<caption class="skip">온라인지원현황</caption>
						<colgroup><col width="10px"><col width="90px"><col width="100px"><col width="*"> <col width="100px"><col width="120px"></colgroup>
						<thead>
						<tr>
							<th scope="col"><input name="check_all" type="checkbox"></th>
							<th scope="col">지원일</th>
							<th scope="col">회사명</th>
							<th scope="col">지원내역</th>
							<th scope="col">열람여부</th>
							<th scope="col">모집마감일</th>
						</tr>
						</thead>
						<tbody>
						<?php if(!$list['total_count']){?>
						<tr><td class="tc no_listText" colspan="6"><span>입사지원한 기업이 없습니다.</span></td></tr>
						<?php } else { ?>
						
						<?php 
							foreach($list['result'] as $val){ 
							$wdate = strtr(substr($val['wdate'],0,10),'-','.');
							$get_alba = $alba_company_control->get_alba_no($val['wr_to']);
							$get_resume = $alba_resume_user_control->get_resume_no($val['wr_from']);
							if($val['etc_4']){
								$open_date = "<div class=\"text_red\">열람</div> <div>" . strtr(substr($val['etc_4'],0,11),'-','.') . "</div>";
							} else {
								if($type=='become_email'){
									if(stristr($val['etc_1'],'email')){	// 이메일의 경우 이메일 확인
										$open_date = "이메일 확인";
									} else {
										$open_date = "열람전";
									}
								} else {
									$open_date = "열람전";
								}
							}
							if($get_alba['wr_volume_always']){	 // 상시모집이라면
								$end_date = "<div>상시모집</div>";
							} else {
								$end_date = "<div>" . strtr($get_alba['wr_volume_date'],'-','.') . "</div>";
							}
							if($get_alba['wr_volume_end']){	// 채용시까지라면
								$volume_date = "<div>(모집시마감)</div>";
							} else {
								if($utility->valid_day($get_alba['wr_volume_date'])){
									$wr_volume_date = $utility->date_diff( $get_alba['wr_volume_date'], date('Y-m-d') );
									$volume_date = "<div class=\"text_red\">(".$wr_volume_date."일후마감)</div>";
								} else {
									$volume_date = "<div>마감됨</div>";
								}
							}
							if($get_alba['is_delete']){	// 삭제된 공고
								$alba_href = "javascript:is_delete();";
								$target_href = "";
							} else {
								$alba_href = $alice['alba_path'] . "/alba_detail.php?no=" . $val['wr_to'];
								$target_href = "target=\"_blank\"";
							}
							$get_company = $user_control->get_member_company($val['wr_to_id']);
							if($get_company['mb_left']){	// 탈퇴한 기업회원
								$company_href = "javascript:is_left();";
								$company_target = "";
							} else {
								$company_href = $alice['alba_path'] . "/company_info.php?mb_id=" . $val['wr_to_id'];
								$company_target = "target=\"_blank\"";
							}

						?>
						<tr>
							<td class="tc"><?php if($val['etc_4']==''){ ?><input type="checkbox" name='no[]' class='check_all' value="<?php echo $val['no'];?>"><?php } ?></td>
							<td class="tc"><span><?php echo $wdate;?></span></td>
							<td class="tl pl10"><span><a href="<?php echo $company_href;?>" <?php echo $company_target;?>><?php echo stripslashes($get_alba['wr_company_name']);?></a></span></td>
							<td class="title" >
								<div class="pl10 pt5"><span><strong><a href="<?php echo $alba_href;?>" <?php echo $target_href;?>><?php echo stripslashes($get_alba['wr_subject']);?></a></strong></span></div>
								<?php if($val['type']!='become_email'){ // 이메일 일땐 출력 안됨?>
								<div class="pl10 text_blue" style="width:320px;">지원이력서 : <a href="<?php echo $alice['resume_path'];?>/alba_resume_detail.php?no=<?php echo $val['wr_from'];?>" class="url" target="_blank"><?php echo stripslashes($get_resume['wr_subject']);?></a></div>
								<?php } ?>
							</td>
							<td class="tc"><?php echo $open_date;?></td>
							<td class="tc">
								<?php echo $end_date;?>
								<?php echo $volume_date;?>
							</td>
						</tr>
						<?php } // foreach end. ?>

						<?php } // if end.?>
						</tbody>
						</table>
						<div class="btnBottom mt10">
							<?php if($type!='become_email'){?>
							<a class="button white" onclick="sel_become_cancel();"><span>지원취소</span></a> 
							<?php } ?>
							<a class="button white" onclick="sel_become_delete();"><span>삭제</span></a> 
						</div>        
						
						<?php include_once $alice['include_path']."/paging.php";?>

					</div> 
					<!--  온라인 지원 현황 end   --> 

				</div><!--  컨텐츠 end   --> 

			</div>
		</div>
	</div>
</section>