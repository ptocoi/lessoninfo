<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
</script>

<script type="text/javascript" src="<?php echo $alice['company_path'];?>/skins/default/alba_scrap.skin.js"></script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent"> 
		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['company_path'];?>/">기업서비스</a> > <a href="<?php echo $alice['company_path'];?>/alba_scrap.php">서비스 관리</a> > <strong>스크랩한 인재정보</strong> </p>
		</div>
		<?php /* //navigation */ ?>
		<div class="listWrap positionR mt20">
			<h2 class="pb5"><img src="../images/tit/company_tit_04.gif" width="186" height="25" alt="스크랩한인재정보"></h2>
			<h3 style="padding:10px;" class="font11 fongrb">맞춤 인재 정보를 설정하시면  원하는 형태의 인재정보를 이메일이나 SMS 문자를 통해 수신하실 수 있습니다.<a target="_blank" href="/company/alba_customized.php"><img class="vm positionR" style="left:115px;"src="/images/tit/more_job.gif"></a></h3>
			<em style="border:0px;padding:10px 0px 0px 3px !important" class="titEm mb20">
				<ul>
				<li>최근에 스크랩한 인재정보를 확인할 수 있습니다.</li>				
				<li>스크랩한 인재의 연락처를 확인하려면 이력서 열람 서비스를 이용하시기 바랍니다.</li>
				</ul>
			</em>
			<div class="companyContentWrap"><!--  컨텐츠  -->
				<div id="listForm" class="mainTopBorder positionR mt30 clearfix"> <!--  스크랩한인재정보   --> 
				<h2 class="skip">스크랩한인재정보</h2>
				<div class="positionA" style="top:-5px; right:0;">
					<!-- <em class=""><a class="button"><span>이력서열람 신청<img width="7" height="9" class="pl5" src="../images/icon/icon_arrow_6.gif" alt="arrow" style="vertical-align:middle;"></span></a></em> -->          
					<select title="pagesize" name="page_rows" style="width:100px;" class="ipSelect2" onchange="list_rows(this);">
					<option value="20" <?php echo ($page_rows=='20')?'selected':'';?>>20개씩 보기</option>
					<option value="30" <?php echo ($page_rows=='30')?'selected':'';?>>30개씩 보기</option>
					<option value="50" <?php echo ($page_rows=='50')?'selected':'';?>>50개씩 보기</option>
					</select>
				</div>      
				<div class="customList1 mt20 mb30">      
					<table cellspacing="0">
					<caption class="skip">스크랩한인재정보</caption>
					<colgroup><col width="10px"><col width="*"><col width="140px"><col width="100px"><col width="70px"></colgroup>
					<thead>
					<tr>
						<th  scope="col"><input name="check_all" type="checkbox"></th>
						<th  scope="col">이력서정보</th>
						<th  scope="col">경력/자격증</th>
						<th  scope="col">희망지역</th>
						<th  scope="col">스크랩일</th>
					</tr>
					</thead>
					<tbody>
					<?php if(!$scrap_list['total_count']){ ?>
					<tr><td colspan="6" class="tc no_listText"><span>스크랩한 인재정보가 없습니다.</span></td></tr>            
					<?php } else { ?>

					<?php 
						foreach($scrap_list['result'] as $val){ 
						$no = $val['scrap_rel_id'];
						$list = $alba_resume_user_control->get_resume_service($no,"",60);
						$scrap_date = strtr(substr($val['wdate'],0,10),'-','.');
						if($list['is_delete']){	// 삭제된 이력서 체크
							$resume_href = "javascript:is_delete();";
							$href_target = "";
						} else {
							$resume_href = $alice['resume_path'] . "/alba_resume_detail.php?no=" . $no;
							$href_target = "target=\"_blank\"";
						}
						$mailto = ($list['is_delete']) ? "javascript:is_delete();" : "mailto://".$list['mb_email'];
					?>
					<tr>
						<td class="tc"><input type="checkbox" name='no[]' class='check_all' value="<?php echo $val['no'];?>"></td>
						<td class="applicant">
							<div class="photo"><a <?php echo $href_target;?> href="<?php echo $resume_href;?>"><?php echo $list['wr_photo'];?></a></div>
							<div class="name pt5"><span><strong><?php echo $list['name'];?>(<?php echo $list['wr_gender'];?> <?php echo $list['wr_age'];?>세)</strong></span> <span style="letter-spacing:-1px;"><?php echo $list['mb_address'];?></span></div>
							<div class="title"><a <?php echo $href_target;?> href="<?php echo $resume_href;?>" class="text_blue"><?php echo $list['subject'];?></a></div>
							<div class="mobileEmail">
								<?php if($service_open){ ?><span class="pr10"><?php echo $list['mb_hphone'];?></span>l<?php } ?>
								<span class="pl10"><a href="<?php echo $mailto;?>" class="url"><?php echo $list['mb_email'];?></a></span>
							</div>
						</td>
						<td class="license">
							<div class="career">
								<img width="23" height="14" src="../images/icon/icon_career.gif" alt="경력" class="vb"> 	<?php echo $list['career'];?>
							</div>
							<?php if($list['license']){ ?>
							<div class="license"><img width="36" height="14" src="../images/icon/icon_license.gif" alt="자격증" class="vb"><span style="letter-spacing:-1px;"> <?php echo $list['license'];?></span></div>
							<?php } ?>
						</td>
						<td class="tc"><span><?php echo $list['wr_area'];?></span></td>
						<td class="tc"><span><?php echo $scrap_date;?></span></td>
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
				</div> <!--  스크랩한인재정보 end   --> 

				</div><!--  컨텐츠 end   --> 
			</div>
		</div>
	</div>
</section>