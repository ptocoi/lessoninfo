<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
var type = "<?php echo $type;?>";
</script>

<script type="text/javascript" src="<?php echo $alice['company_path'];?>/skins/default/alba_interview.skin.js"></script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent"> 
		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['company_path'];?>/">기업서비스</a> > <a href="<?php echo $alice['company_path'];?>/alba_list.php">채용공고 관리</a> > <strong>면접제의·입사지원 관리</strong> </p>
		</div>
		<?php /* //navigation */ ?>
		<div class="listWrap positionR mt20">
			<h2 class="pb5"><img src="../images/tit/company_tit_11.gif" alt="면접제의·입사요청 관리"></h2>
			<h3 style="padding:10px;" class="font11 fongrb">맞춤 인재 정보를 설정하시면  원하는 형태의 인재정보를 이메일이나 SMS 문자를 통해 수신하실 수 있습니다.<a target="_blank" href="/company/alba_customized.php"><img class="vm positionR" style="left:115px;"src="/images/tit/more_job.gif"></a></h3>
			<em style="border:0px;padding:10px 0px 0px 3px !important" class="titEm mb20">
				<ul>
				<li>인재정보를 통해 수집된 개인정보 및 이력서는 개인정보보호정책에 의거 인재채용의 목적으로만 이용하셔야 합니다. </li>
				<li>인재의 연락처를 열람하시려면 이력서 열람서비스를 이용하셔야 하며, 이력서의 상세정보는 열람서비스 이용기간에만 확인가능합니다.</li>
				</ul>
			</em>
			<div class="personContentWrap"><!--  컨텐츠  -->
				<div id="listForm" class="mainTab positionR mt30 clearfix"> <!--  면접제의기업   --> 
					<h2 class="skip">면접제의</h2>
					<div class="positionA" style="top:15px; right:0;">
						<select title="pagesize" name="page_rows" style="width:100px;" class="ipSelect2" onchange="list_rows(this);">
						<option value="20" <?php echo ($page_rows=='20')?'selected':'';?>>20개씩 보기</option>
						<option value="30" <?php echo ($page_rows=='30')?'selected':'';?>>30개씩 보기</option>
						<option value="50" <?php echo ($page_rows=='50')?'selected':'';?>>50개씩 보기</option>
						</select>
					</div>      
					<ul class="tabMenu clearfix">
						<li class="tab1 <?php echo ($type=='interview')?'on':'';?>"><a href="./alba_interview.php"><strong>면접제의 관리</strong> [<?php echo number_format($interview_count);?>건]</a></li>
						<li class="tab2 <?php echo ($type=='become')?'on':'';?>"><a href="./alba_interview.php?type=become"><strong>입사지원 요청 관리</strong> [<?php echo number_format($become_count);?>건]</a></li>
					</ul>
					<div class="customList1 mb30">
					<table cellspacing="0">
					<caption class="skip">입사지원</caption>
					<colgroup><col width="10px"><col width="*"><col width="140px"><col width="110px"><col width="70px"></colgroup>
					<thead>
					<tr>
						<th scope="col"><input name="check_all" type="checkbox"></th>
						<th scope="col">이력서정보</th>
						<th scope="col">경력/자격증</th>
						<th scope="col">희망지역</th>
						<th scope="col">요청일</th>
					</tr>
					</thead>
					<tbody>
					<?php if(!$list['total_count']){ ?>
						<?php if($type=='interview'){ ?>
						<tr><td class="tc no_listText" colspan="6"><span>면접제의 요청한 인재정보가 없습니다.</span></td></tr>            
						<?php } else if($type=='become'){ ?>
						<tr><td class="tc no_listText" colspan="6"><span>입사지원 요청한 인재정보가 없습니다.</span></td></tr>            
						<?php } ?>
					<?php } else { ?>

					<?php 
						foreach($list['result'] as $val ){ 
						$no = $val['wr_resume'];
						$list = $alba_resume_user_control->get_resume_service($no,"",60);
						$wdate = strtr(substr($val['wdate'],0,10),'-','.');
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
						<td class="tc"><span><?php echo $wdate;?></span></td>
					</tr>
					<?php } // foreach end.?>

					<?php } // if end.?>
					</tbody>
					</table>

					<?php include_once $alice['include_path']."/paging.php";?>

					</div>

				</div><!--  컨텐츠 end   --> 
			</div>
		</div>
	</div>
</section>