<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
</script>

<script type="text/javascript" src="<?php echo $alice['individual_path'];?>/skins/default/alba_scrap.skin.js"></script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent"> 
		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['individual_path'];?>/">개인서비스</a> > <a href="<?php echo $alice['individual_path'];?>/alba_scrap.php">맞춤서비스 관리</a> > <strong>스크랩한 채용정보</strong> </p>
		</div>
		<?php /* //navigation */ ?>
		<div class="listWrap positionR mt20">
			<h2 class="pb5"><img src="../images/tit/person_tit_08.gif" width="188" height="25" alt="스크랩한 채용정보"></h2>
			<h3 style="padding:10px;" class="font11 fongrb">맞춤 인재 정보를 설정하시면  원하는 형태의 인재정보를 이메일이나 SMS 문자를 통해 수신하실 수 있습니다.<a target="_blank" href="/individual/alba_customized.php"><img class="vm positionR" style="left:115px;"src="/images/tit/more_job.gif"></a></h3>
			<em style="border:0px;padding:10px 0px 0px 3px !important" class="titEm mb20">
			<ul>				
				<li>기업이 채용공고를 삭제한 경우, 스크랩한 채용정보도 동시에 삭제됩니다.</li>
			</ul>
			</em>
			<div class="personContentWrap"><!--  컨텐츠  -->
				<div id="listForm" class="mainTopBorder positionR mt30 clearfix"> <!--  스크랩한채용정보   --> 
					<h2 class="skip">스크랩한채용정보</h2>
					<div class="positionA" style="top:-5px; right:0;">
						<select title="pagesize" name="page_rows" style="width:100px;" class="ipSelect2" onchange="list_rows(this);">
						<option value="20" <?php echo ($page_rows=='20')?'selected':'';?>>20개씩 보기</option>
						<option value="30" <?php echo ($page_rows=='30')?'selected':'';?>>30개씩 보기</option>
						<option value="50" <?php echo ($page_rows=='50')?'selected':'';?>>50개씩 보기</option>
						</select>
					</div>      
					<div class="customList1 mt20 mb30">      
						<table cellspacing="0">
						<caption class="skip">스크랩한채용정보</caption>
						<colgroup><col width="10px"><col width="80px"><col width="120px"><col width="*"><col width="100px"><col width="95px"><col width="90px"></colgroup>
						<thead>
						<tr>
							<th  scope="col"><input name="check_all" type="checkbox"></th>
							<th  scope="col">스크랩일</th>
							<th  scope="col">회사명</th>
							<th  scope="col">채용제목</th>
							<th  scope="col">급여</th>
							<th  scope="col">근무지역</th>
							<th  scope="col">마감일</th>
						</tr>
						</thead>
						<tbody>
						<?php if(!$scrap_list['total_count']){ ?>
						<tr><td class="tc no_listText" colspan="7"><span >스크랩한 채용정보가 없습니다.</span></td></tr>
						<?php } else { ?>

						<?php 
							foreach($scrap_list['result'] as $val){ 
							$no = $val['scrap_rel_id'];
							$wdate = strtr(substr($val['wdate'],0,10),'-','.');
							$list = $alba_user_control->get_alba_service($no,"",65);
							if($list['is_delete']){	// 삭제된 공고
								$alba_href = $mail_view = "javascript:is_delete();";
								$target_href = "";
							} else {
								$alba_href = $alice['alba_path'] . "/alba_detail.php?no=" . $list['no'];
								$target_href = "target=\"_blank\"";
								$mail_view = "javascript:mail_view('".$val['no']."');";
							}
							$company_info = $user_control->get_member_company($list['wr_id']);
							if($company_info['mb_left']){	// 탈퇴한 기업회원
								$company_href = "javascript:is_left();";
								$company_target = "";
							} else {
								$company_href = $alice['alba_path'] . "/company_info.php?mb_id=" . $list['wr_id'];
								$company_target = "target=\"_blank\"";
							}
						?>
						<tr>
							<td class="tc"><input type="checkbox" name='no[]' class='check_all' value="<?php echo $val['no'];?>"></td>
							<td class="tc"><span><?php echo $wdate;?></span></td>
							<td class="tl pl10"><span><a href="<?php echo $company_href;?>" <?php echo $company_target;?>><?php echo $list['company_name'];?></a></span></td>
							<td class="tl" ><span><a href="<?php echo $alba_href;?>" <?php echo $target_href;?>><?php echo $list['subject'];?></a></span></td>
							<td class="tr pr10 pay">
								<span class="number"><?php echo $list['wr_pay'];?></span>
								<em class="icon"><?php echo $list['wr_pay_type'];?></em>
							</td>
							<td class="tl pl10"><span><?php echo $list['wr_area'];?></span></td>
							<td class="tc"><span><?php echo $list['volume'];?></span></td>
						</tr>
						<?php } // foreach end.?>
						
						<?php } // if end.?>
						</tbody>
						</table>
						<div class="btnBottom mt10">
							<a class="button white" onclick="sel_scrap_delete();"><span>삭제</span></a> 
						</div>        

						<?php include_once $alice['include_path']."/paging.php";?>

						</div>
					</div> <!--  스크랩한채용정보 end   --> 

				</div><!--  컨텐츠 end   --> 
			</div>
		</div>
	</div>
</section>