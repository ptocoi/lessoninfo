<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
var mode = "<?php echo $mode;?>";
var send_url = "<?php echo $open_list['send_url'];?>";
</script>

<script type="text/javascript" src="<?php echo $alice['company_path'];?>/skins/default/alba_resume_info.skin.js"></script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent"> 
		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['company_path'];?>/">기업서비스</a> > <a href="<?php echo $alice['company_path'];?>/alba_scrap.php">서비스 관리</a> > <strong>열람한 인재정보</strong> </p>
		</div>
		<?php /* //navigation */ ?>
		<div class="listWrap positionR mt20">
			<h2 class="pb5"><img src="../images/tit/company_tit_05.gif" width="166" height="25" alt="열람한인재정보"></h2>
			<h3 style="padding:10px;" class="font11 fongrb">맞춤 인재 정보를 설정하시면  원하는 형태의 인재정보를 이메일이나 SMS 문자를 통해 수신하실 수 있습니다.<a target="_blank" href="/company/alba_customized.php"><img class="vm positionR" style="left:115px;"src="/images/tit/more_job.gif"></a></h3>
			<em style="border:0px;padding:10px 0px 0px 3px !important" class="titEm mb20">
				<ul>
				<li>최근에 열람하신 이력서를 확인하실 수 있습니다.</li>				
				</ul>
			</em>
			<div class="companyContentWrap"><!--  컨텐츠  -->
				<div id="listForm" class="positionR mt30 clearfix"> <!--  열람한인재정보   --> 
					<h2 class="skip">열람한인재정보</h2>
					<div class="positionA" style="top:-5px; right:0;">
					<select title="pagesize" name="page_rows" style="width:100px;" class="ipSelect2" onchange="list_rows(this);">
					<option value="20" <?php echo ($page_rows=='20')?'selected':'';?>>20개씩 보기</option>
					<option value="30" <?php echo ($page_rows=='30')?'selected':'';?>>30개씩 보기</option>
					<option value="50" <?php echo ($page_rows=='50')?'selected':'';?>>50개씩 보기</option>
					</select>
				</div>
				<div class="customList1 mt20 mb30">  

					<form method="get" name="OpenResumeFrm" action="<?php echo $_SERVER['PHP_SELF'];?>" id="OpenResumeFrm">
					<input type="hidden" name="mode" value="search"/>
					<div class="selectList  tl pt5 pb5">
						<span class="pr5">
							<input type="radio" name="search_field" id="wr_name" value="wr_name" checked> 
							<label for="wr_name"><strong>이름</strong></label>
							<input type="radio" name="search_field" id="wr_subject" value="wr_subject" <?php echo ($search_field=='wr_subject')?'checked':'';?>> 
							<label for="wr_subject"><strong>이력서 제목</strong></label>
						</span>
						<span><input type="text" name="search_keyword" value="<?php echo $search_keyword;?>" style="width:200px;" class="ipText"> <a class="button" onclick="OpenResumeFrm_submit();"><span>검색</span></a></span>
					</div>
					</form>

					<table cellspacing="0">
					<caption class="skip">열람한인재정보</caption>
					<colgroup><col width="10px"><col width="60px"><col width="80px"><col width="*"><col width="110px"><col width="130px"></colgroup>
					<thead>
					<tr>
						<th  scope="col"><input name="check_all" type="checkbox"></th>
						<th  scope="col">열람일</th>
						<th  scope="col">이름</th>
						<th  scope="col">이력서정보</th>
						<th  scope="col">희망급여</th>
						<th  scope="col">희망지역</th>
					</tr>
					</thead>
					<tbody>
					<?php if(!$open_list['total_count']){ ?>
					<tr><td colspan="6" class="tc no_listText"><span>열람한 인재정보가 없습니다.</span></td></tr>            
					<?php } else { ?>
					
					<?php 
						foreach($open_list['result'] as $val){ 
						$no = $val['p_no'];
						$list = $alba_resume_user_control->get_resume_service($no);
						$open_date = strtr(substr($val['wdate'],0,10),'-','.');
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
						<td class="tc"><input type="checkbox" name='no[]' class='check_all' value="<?php echo $val['no'];?>" resume_no="<?php echo $no;?>"></td>
						<td class="tc"><span><?php echo $open_date;?></span></td>            
						<td class="name" scope="row">
							<span><?php echo $list['name'];?>
								<?php if($list['is_photo']){?>
								<em class="photo"><img class="vb" src="../images/icon/icon_photo1.gif" width="16" height="16"></em>
								<?php } ?>
							</span>
							<span class="block">(<?php echo $list['wr_gender'];?> <span><?php echo $list['wr_age'];?></span>세)</span>
						</td>
						<td class="title">
							<a target="_blank" href="<?php echo $resume_href;?>">
							<span class="title"><?php echo $val['wr_subject'];?></span>
							</a>
							<span class="kind text_color1"><?php echo $list['job_type'];?></span>
							<span class="career">
								<img class="vb"alt="경력" src="../images/icon/icon_career.gif" width="23" height="14"> 	
								<?php echo $list['career'];?>
							</span>
							<?php if($list['license']){ ?>
							<span class="license">
								<img class="vb" alt="자격증" src="../images/icon/icon_license.gif" width="36" height="14"> <?php echo $list['license'];?>
							</span>
							<?php } ?>
							
						</td>
						<td class="pay">
							<span class="pay">
								<em class="number"><?php echo $list['wr_pay'];?></em> 
								<em class="icon"><?php echo $list['wr_pay_type'];?></em>
							</span>
						</td>
						<td class="local"><?php echo $list['wr_area'];?> </td>
					</tr>
					<?php } // foreach end.?>

					<?php } // if end.?>
					</tbody>        
					</table>
					<div class="btnBottom mt10">
						<a class="button white" onclick="sel_resume_delete();"><span>삭제</span></a><a class="pl5 button white" onclick="sel_resume_scrap();"><span>인재스크랩</span></a> 
					</div>
					
					<?php include_once $alice['include_path']."/paging.php";?>

					</div>
				</div> <!--  열람한인재정보 end   --> 

				</div><!--  컨텐츠 end   --> 
			</div>
		</div>
	</div>
</section>