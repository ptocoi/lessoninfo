<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
var type = "<?php echo $type;?>";
</script>

<script type="text/javascript" src="<?php echo $alice['individual_path'];?>/skins/default/alba_resume_interview.skin.js"></script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent"> 
		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['individual_path'];?>/">개인서비스</a> > <a href="<?php echo $alice['individual_path'];?>/alba_resume_onlines.php">입사지원 관리</a> > <strong>면접제의·입사요청 기업</strong> </p>
		</div>
		<?php /* //navigation */ ?>
		<div class="listWrap positionR mt20">
			<h2 class="pb5"><img src="../images/tit/person_tit_07.gif"  alt="면접제의·입사요청 기업"></h2>
			<h3 style="padding:10px;" class="font11 fongrb">맞춤 인재 정보를 설정하시면  원하는 형태의 인재정보를 이메일이나 SMS 문자를 통해 수신하실 수 있습니다.<a target="_blank" href="/individual/alba_customized.php"><img class="vm positionR" style="left:115px;"src="/images/tit/more_job.gif"></a></h3>
			<em style="border:0px;padding:10px 0px 0px 3px !important" class="titEm mb20">
			<ul>
				<li>이력서가 공개중인 경우에 기업으로부터 받은 면접제의·입사요청을 확인할 수 있습니다.</li>				
			</ul>
			</em>
			<div class="personContentWrap"><!--  컨텐츠  -->
				<div id="listForm" class="mainTab positionR mt30 clearfix"> <!--  면접제의기업   --> 
					<h2 class="skip">열람제한기업</h2>
					<div class="positionA" style="top:15px; right:0;">
						<select title="pagesize" name="page_rows" style="width:100px;" class="ipSelect2" onchange="list_rows(this);">
						<option value="20" <?php echo ($page_rows=='20')?'selected':'';?>>20개씩 보기</option>
						<option value="30" <?php echo ($page_rows=='30')?'selected':'';?>>30개씩 보기</option>
						<option value="50" <?php echo ($page_rows=='50')?'selected':'';?>>50개씩 보기</option>
						</select>
					</div>      
					<ul class="tabMenu clearfix">
						<li class="tab1 <?php echo ($type=='interview')?'on':'';?>"><a href="./alba_resume_interview.php"><strong>면접제의 기업</strong> [<?php echo number_format($interview_count);?>건]</a></li>
						<li class="tab2 <?php echo ($type=='become')?'on':'';?>"><a href="./alba_resume_interview.php?type=become"><strong>입사요청 기업</strong> [<?php echo number_format($become_count);?>건]</a></li>
					</ul>

					<div class="customList1 mb30">
						<!-- 레이어 면접제의메일보기-->      
						<div style="display:none; width:420px; top:50%; left:45%; margin-top:-200px; text-align:left;" class="layerPop positionF border_color5" id="layerPop"></div> 
						<!-- 레이어 면접제의메일보기//-->

					<table cellspacing="0">
					<caption class="skip">면접제의기업</caption>
					  <colgroup><col width="100px"><col width="150px"><col width="450px"><col width="100px">  </colgroup>
					<thead>
					<tr>
						<th  scope="col">발송일</th>
						<th  scope="col">회사명</th>
						<th  scope="col">채용정보</th>
						<th  scope="col">메일보기</th>
					</tr>
					</thead>
					<tbody>
					<?php if(!$list['total_count']){ ?>
						<?php if($type=='interview'){ ?>
						<tr><td class="tc no_listText" colspan="4"><span>면접제의 기업이 없습니다.</span></td></tr>            
						<?php } else if($type=='become'){ ?>
						<tr><td class="tc no_listText" colspan="4"><span>입사요청 기업이 없습니다.</span></td></tr>            
						<?php } ?>
					<?php } else { ?>
					<?php 
						foreach($list['result'] as $val ){ 
						$wdate = strtr(substr($val['wdate'],0,10),'-','.');
						$company_info = $user_control->get_member_company($val['mb_id']);
						$get_alba = $alba_company_control->get_alba_no($val['wr_employ']);
						if($get_alba['is_delete']){	// 삭제된 공고
							$alba_href = $mail_view = "javascript:is_delete();";
							$target_href = "";
						} else {
							$alba_href = $alice['alba_path'] . "/alba_detail.php?no=" . $val['wr_employ'];
							$target_href = "target=\"_blank\"";
							$mail_view = "javascript:mail_view('".$val['no']."');";
						}
						if($company_info['mb_left']){	// 탈퇴한 기업회원
							$company_href = "javascript:is_left();";
							$company_target = "";
						} else {
							$company_href = $alice['alba_path'] . "/company_info.php?mb_id=" . $val['mb_id'];
							$company_target = "target=\"_blank\"";
						}
					?>
					<tr>
						<td class="tc"><span><?php echo $wdate;?></span></td>
						<td class="tl pl10"><span><a target="_blank" href="<?php echo $company_href;?>" <?php echo $href_target;?>><?php echo stripslashes($company_info['mb_company_name']);?></a></span></td>
						<td class="tl"><span><a target="_blank" href="<?php echo $alba_href;?>" <?php echo $target_href;?>><?php echo stripslashes($get_alba['wr_subject']);?></a></span></td>
                        <td class="tc"><span><a href="<?php echo $mail_view;?>"><img src="../images/icon/icon_mail_on.gif" alt="메일보기"/></a></span></td>
					</tr>
					<?php } // foreach end.?>

					<?php } // if end.?>
					</tbody>
					</table>
					
					<?php include_once $alice['include_path']."/paging.php";?>

				</div>
			</div> <!--  면접제의기업 end   --> 
			</div>
		</div>
	</div>
</section>