<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
</script>

<script type="text/javascript" src="<?php echo $alice['individual_path'];?>/skins/default/alba_resume_open.skin.js"></script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent"> 
		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['individual_path'];?>/">개인서비스</a> > <a href="<?php echo $alice['individual_path'];?>/alba_resume_onlines.php">입사지원 관리</a> > <strong>내 이력서 열람기업</strong> </p>
		</div>
		<?php /* //navigation */ ?>
		<div class="listWrap positionR mt20">
			<h2 class="pb5"><img src="../images/tit/person_tit_06.gif" width="194" height="25" alt="이력서열람기업"></h2>
			<h3 style="padding:10px;" class="font11 fongrb">맞춤 인재 정보를 설정하시면  원하는 형태의 인재정보를 이메일이나 SMS 문자를 통해 수신하실 수 있습니다.<a target="_blank" href="/individual/alba_customized.php"><img class="vm positionR" style="left:115px;"src="/images/tit/more_job.gif"></a></h3>
			<em style="border:0px;padding:10px 0px 0px 3px !important" class="titEm mb20">
				<ul>
					<li>공개된 이력서를 열람한 회사명과 업종을 확인할 수 있습니다.</li>
					<li>열람기업 중 이력서를 공개하고 싶지 않은 경우, 열람제한 설정을 통해 제한할 수 있습니다.</li>
				</ul>
			</em>
			<div class="personContentWrap"><!--  컨텐츠  -->
				<div id="listForm" class="mainTopBorder positionR mt30 clearfix"> <!--  이력서열람기업   --> 
					<h2 class="skip">이력서열람기업</h2>
					<div class="positionA" style="top:-5px; right:0;">
						<select title="pagesize" name="page_rows" style="width:100px;" class="ipSelect2" onchange="list_rows(this);">
						<option value="20" <?php echo ($page_rows=='20')?'selected':'';?>>20개씩 보기</option>
						<option value="30" <?php echo ($page_rows=='30')?'selected':'';?>>30개씩 보기</option>
						<option value="50" <?php echo ($page_rows=='50')?'selected':'';?>>50개씩 보기</option>
						</select>
					</div>      
					<div class="customList1 mt20 mb30">      
						<table cellspacing="0">
						<caption class="skip">이력서열람기업</caption>
						<colgroup><col width="10px"><col width="100px"><col width="150px"><col width="100px"><col width="*"> <col width="120px"></colgroup>
						<thead>
						<tr>
							<th  scope="col"><input name="check_all" type="checkbox"></th>
							<th  scope="col">열람일</th>
							<th  scope="col" align="left">&nbsp;회사명</th>
							<th  scope="col">대표자명</th>
							<th  scope="col">회사분류</th>
							<th  scope="col">진행중인 채용정보</th>
						</tr>
						</thead>
						<tbody>
						<?php if(!$list['total_count']){?>
						<tr><td class="tc no_listText" colspan="6"><span >이력서를 열람한 기업이 없습니다.</span></td></tr>
						<?php } else { ?>

						<?php 
							foreach($list['result'] as $val){ 
							$wdate = strtr(substr($val['wdate'],0,10),'-','.');
							$company_info = $user_control->get_member_company($val['mb_id']);
							$biz_type = $category_control->get_categoryCodeName($company_info['mb_biz_type']);
							$continue_cnt = $alba_company_control->alba_list_count(" where `wr_id` = '".$val['mb_id']."' and ( `wr_volume_always` = '1' or `wr_volume_end` = '1' or `wr_volume_date` >= curdate() ) ");	// 진행중인 공고 카운팅
							if($company_info['mb_left']){	// 탈퇴한 기업회원
								$company_href = "javascript:is_left();";
								$href_target = "";
							} else {
								$company_href = $alice['alba_path'] . "/company_info.php?mb_id=" . $val['mb_id'];
								$href_target = "target=\"_blank\"";
							}
						?>
						<tr>
							<td class="tc"><input type="checkbox" name='no[]' class='check_all' value="<?php echo $val['no'];?>"></td>
							<td class="tc"><span><?php echo $wdate;?></span></td>
							<td class="tl pl10"><span><a href="<?php echo $company_href;?>" <?php echo $href_target;?>><?php echo stripslashes($company_info['mb_company_name']);?></a></span></td>
							<td align="center"><div class="pl10 pt5"><span><?php echo $company_info['mb_ceo_name'];?></span></div></td>
							<td class="tc"><div><?php echo $biz_type;?></div></td>
							<td class="tc"><span class="text"><a href="<?php echo $company_href;?>" class="url text_blue" target="_blank"><strong><?php echo number_format($continue_cnt);?></strong></a> 건</span></td>
						</tr>
						<?php } // foreach end. ?>

						<?php } // if end. ?>
						</tbody>
						</table>
						<div class="btnBottom mt10">
							<a class="button white" onclick="open_delete();"><span>삭제</span></a> 
							<a class="button white" onclick="sel_denied();"><span>이력서 열람제한 설정</span></a> 
						</div>        

						<?php include_once $alice['include_path']."/paging.php";?>

					</div>
					</div> <!--  이력서열람기업 end   --> 

				</div><!--  컨텐츠 end   --> 
			</div>
		</div>
	</div>
</section>