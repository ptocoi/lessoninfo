<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
var company_alba_searching = function(){	// 간단 검색
	$('#CompanyAlbaSearchFrm').submit();
}
var alba_finish = function( no ){	// 공고 강제 마감
	if(confirm('공고를 강제 마감 하시겠습니까?')){
		$.post('./process/alba.php', { mode:'volume_end', no:no }, function(result){
			if(result){
				location.reload();
			} else {
				alert("<?php echo $alba_company_control->_errors('0007');?>");
			}
		});
	}
}
var alba_delete = function( no ){
	if(confirm('채용공고를 삭제하시겠습니까?\n\n한번 삭제된 공고는 복구가 안됩니다.')){
		$.post('./process/alba.php', { mode:'delete', no:no, mb_id:mb_id }, function(result){
			if(result){
				location.reload();
			} else {
				alert("<?php echo $alba_company_control->_errors('0005');?>");
			}
		});
	}
}
var alba_sel_delete = function(){	 // 공고 선택 삭제
	var chk_length = $("input[name='no[]']:checked").length;
	if(chk_length==0){
		alert('삭제 할 채용공고를 선택해 주세요.');
		return false;
	} else {
		var del_no = new Array();
		var i = 0;
		$("input[name='no[]']:checked").each(function(){
			del_no[i] = $(this).val();
		i++;
		});
		if(confirm('한번 삭제된 공고는 복구가 안됩니다.\n\n선택하신 공고 '+chk_length+'건을 삭제하시겠습니까?')){
			$.post('./process/alba.php', { mode:'sel_delete', no:del_no, mb_id:mb_id }, function(result){
				if(result){
					location.reload();
				} else {
					alert("<?php echo $alba_company_control->_errors('0005');?>");
				}
			});
		}
	}
}
var service_options = function( no ){
	$('#pay_no').val(no);
	$('#ServiceFrm').submit();
}
</script>


<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent"> 
		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['company_path'];?>/">기업서비스</a> > <strong>채용공고 관리</strong> </p>
		</div>
		<?php /* //navigation */ ?>
		<div class="listWrap positionR mt20">
			<h2 class="pb5"><img src="../images/tit/company_tit_01.gif" width="141" height="25" alt="채용공고 관리"></h2>
			<h3 style="padding:10px;" class="font11 fongrb">맞춤 인재 정보를 설정하시면  원하는 형태의 인재정보를 이메일이나 SMS 문자를 통해 수신하실 수 있습니다.<a target="_blank" href="/company/alba_customized.php"><img class="vm positionR" style="left:115px;"src="/images/tit/more_job.gif"></a></h3>
			<!--  컨텐츠  -->
			<div class="companyContentWrap">
				<!--  채용공고   --> 
				<div id="listForm" class="positionR mt30 clearfix">
					<h2 class="skip">채용공고</h2>
					<ul class="tabMenu clearfix">
						<li class="tab1 <?php echo ($type!='finish')?'on':'';?>"><a href="<?php echo $alice['company_path'];?>/alba_list.php<?php echo $qstr;?>"><strong>진행중인 채용공고</strong> [<?php echo number_format($continue_cnt);?>건]</a></li>
						<li class="tab2 <?php echo ($type=='finish')?'on':'';?>"><a href="<?php echo $alice['company_path'];?>/alba_list.php?type=finish<?php echo $qstr;?>"><strong>마감된 채용공고</strong> [<?php echo number_format($end_cnt);?>건]</a></li>
					</ul>
					<em style="top:10px; right:0;" class="positionA"><a class="button white" href="<?php echo $alice['company_path'];?>/alba_regist.php<?php echo ($type=='finish')?'?type=finish':'';?>"><span>채용공고 등록</span></a></em>   

					<form method="get" name="CompanyAlbaSearchFrm" action="<?php $_SERVER['PHP_SELF'];?>" id="CompanyAlbaSearchFrm">
					<input type="hidden" name="mode" value="search"/>
					<div class="corpStypeA tc pt5 pb5">
						<span>
							<input type="radio" id="search_company_name" name="search_field" value="wr_company_name" checked> 
							<label for="search_company_name"><strong>근무회사</strong></label>
							<input type="radio" id="search_subject" name="search_field" value="wr_subject" <?php echo ($_GET['search_field']=='wr_subject')?'checked':'';?>> 
							<label for="search_subject"><strong>채용공고 제목</strong></label>
							<input type="radio" id="search_person" name="search_field" value="wr_person" <?php echo ($_GET['search_field']=='wr_person')?'checked':'';?>> 
							<label for="search_person"><strong>담당자명</strong></label>
						</span>
						<span>
							<input type="text" class="ipText" style="width:200px;" name="search_keyword" value="<?php echo $_GET['search_keyword'];?>"> 
							<a class="button" onclick="company_alba_searching();"><span>검색</span></a>
						</span>
					</div>
					</form>

					<table cellspacing="0">
					<caption class="skip">진행중인 채용공고</caption>
					<colgroup><col width="10px"><col width="90px"><col width="*"><col width="80px"><col width="110px"><col width="230px"><col width="70px"></colgroup>
					<thead>
					<tr>
						<th  scope="col"><input name="check_all" type="checkbox"></th>
						<th  scope="col">작성일</th>
						<th  scope="col">채용공고</th>
						<th  scope="col">지원자수</th>
						<th  scope="col">마감일</th>
						<th  scope="col">유료서비스</th>
						<th  scope="col">관리</th>
					</tr>
					</thead>
					<tbody>
					<?php
					if($alba_list['total_count']){
						foreach($alba_list['result'] as $val){
						$wdate = strtr(substr($val['wr_wdate'],0,11),'-','.');
						$job_type = @implode($alba_company_control->print_job_type($val),', ');
						$desire = number_format($val['wr_desire']);
						$end_day = $alba_company_control->print_end_day($val);

						$service_valid = $alba_company_control->service_valid($val['no']);
						$service_platinum = strtr($service_valid['service_platinum'],'-','.');	// 메인 플래티넘
						$service_platinum_sub = strtr($service_valid['service_platinum_sub'],'-','.');	// 채용정보 플래티넘
						$service_prime = strtr($service_valid['service_prime'],'-','.');	// 메인 프라임
						$service_grand = strtr($service_valid['service_grand'],'-','.');	// 메인 그랜드
						$service_banner = strtr($service_valid['service_banner'],'-','.');	// 메인 배너형
						$service_banner_sub = strtr($service_valid['service_banner_sub'],'-','.');	// 채용정보 배너형
						$service_list = strtr($service_valid['service_list'],'-','.');	// 메인 리스트형
						$service_list_sub = strtr($service_valid['service_list_sub'],'-','.');	// 채용정보 리스트형
						$service_basic = strtr($service_valid['service_basic'],'-','.');	// 메인 일반
						$service_basic_sub = strtr($service_valid['service_basic_sub'],'-','.');	// 채용정보 일반

						$service_days = false;
						if($service_platinum) $service_days = true;
						if($service_platinum_sub) $service_days = true;
						if($service_prime) $service_days = true;
						if($service_grand) $service_days = true;
						if($service_banner) $service_days = true;
						if($service_banner_sub) $service_days = true;
						if($service_list) $service_days = true;
						if($service_list_sub) $service_days = true;
						if($service_basic) $service_days = true;
						if($service_basic_sub) $service_days = true;
						$service_msg = ($service_days) ? "연장" : "신청";
					?>
					<tr>
						<td class="tc"><input type="checkbox" name='no[]' class='check_all' value="<?php echo $val['no'];?>"></td>
						<td class="tc"><span><?php echo $wdate;?></span></td>
						<td class="title" >
							<div class="pl10 pt5">
								<span><strong><a href="<?php echo $alice['alba_path'];?>/alba_detail.php?no=<?php echo $val['no'];?>" target="_blank"><?php echo stripslashes($val['wr_subject']);?></a></strong></span> 
								<!-- <span>(~2013.05.15)</span> -->
							</div>
							<div class="pl10 text_blue" style="width:320px;"><?php echo $job_type;?></div>
						</td>
						<td class="tc"><span><strong><a class="text_blue url" href="<?php echo $alice['company_path'];?>/alba_apply_list.php?no=<?php echo $val['no'];?>"><?php echo $desire;?></a></strong> 명</span></td>
						<td class="tc"><span><?php echo $end_day;?></span></td>
						<td class="tl pl10">
							<ul class="lineH5 font11 tl">
							<?php if($service_valid['service_platinum']){ ?><li><?php echo $service_valid['service_platinum_text'];?> (~ <?php echo $service_platinum;?>)</li><?php } ?>
							<?php if($service_valid['service_prime']){ ?><li><?php echo $service_valid['service_prime_text'];?> (~ <?php echo $service_prime;?>)</li><?php } ?>
							<?php if($service_valid['service_grand']){ ?><li><?php echo $service_valid['service_grand_text'];?> (~ <?php echo $service_grand;?>)</li><?php } ?>
							<?php if($service_valid['service_banner']){ ?><li><?php echo $service_valid['service_banner_text'];?> (~ <?php echo $service_banner;?>)</li><?php } ?>
							<?php if($service_valid['service_list']){ ?><li><?php echo $service_valid['service_list_text'];?> (~ <?php echo $service_list;?>)</li><?php } ?>
							<?php if($service_valid['service_basic']){ ?><li><?php echo $service_valid['service_basic_text'];?> (~ <?php echo $service_basic;?>)</li><?php } ?>
							<?php if($service_valid['service_platinum_sub']){ ?><li><?php echo $service_valid['service_platinum_sub_text'];?> (~ <?php echo $service_platinum_sub;?>)</li><?php } ?>
							<?php if($service_valid['service_banner_sub']){ ?><li><?php echo $service_valid['service_banner_sub_text'];?> (~ <?php echo $service_banner_sub;?>)</li><?php } ?>
							<?php if($service_valid['service_list_sub']){ ?><li><?php echo $service_valid['service_list_sub_text'];?> (~ <?php echo $service_list_sub;?>)</li><?php } ?>
							<?php if($service_valid['service_basic_sub']){ ?><li><?php echo $service_valid['service_basic_sub_text'];?> (~ <?php echo $service_basic_sub;?>)</li><?php } ?>
							</ul> 
							<ul class="lineH5 font11">
								<li class="tc"><a href="<?php echo $alice['company_path'];?>/alba_service.php?no=<?php echo $val['no'];?>" class="text_red url ">서비스<?php echo $service_msg;?></a></li>
								<!-- <li class="tc"><?php if($service_days){ ?><a href="javascript:service_options('<?php echo $val['no'];?>');" class="text_red url ">강조옵션신청</a><?php } ?></li> -->
								
							</ul>
						</td>
						<td class="tc">
							<ul class="lineH5 font11">
								<li><a href="<?php echo $alice['company_path'];?>/alba_regist.php?mode=update&no=<?php echo $val['no'];?>" class="url">수정</a></li>
								<li><a href="<?php echo $alice['company_path'];?>/alba_regist.php?mode=load&no=<?php echo $val['no'];?>" class="url">복사</a></li>
								<li><a href="javascript:alba_delete('<?php echo $val['no'];?>');" class="url">삭제</a></li>
								<?php if($type!='finish'){?>
								<li><a href="javascript:alba_finish('<?php echo $val['no'];?>');" class="url">마감</a></li>
								<?php } ?>								
								<li><a href="<?php echo $alice['company_path'];?>/alba_regist.php?mode=reinsert&no=<?php echo $val['no'];?>" class="url">재등록</a></li>								
							</ul>
						</td>
					</tr>
					<?php
						}	// foreach end.
					} else {
					?>
					<tr><td class="tc" colspan="7" height="100">등록된 공고가 없습니다.</td></tr>
					<?php } ?>
					</tbody>
					</table>
					<div class="btnBottom mt10"><a class="button white" onclick="alba_sel_delete();"><span>삭제</span></a> </div>
					<?php include_once $alice['include_path']."/paging.php";?>
				</div>
				<!--  //채용공고 --> 
			</div>
			<form method="post" name="ServiceFrm" action="<?php echo $alice['company_path'];?>/alba_service.php" id="ServiceFrm">
			<input type="hidden" name="mode" value="service_pay"/>
			<input type="hidden" name="sel_service" id="sel_service"/>
			<input type="hidden" name="no" id="pay_no"/>
			<input type="hidden" name="type" value="service_extend"/><!-- 서비스 연장 결제 -->
			</form>

			</div>
		</div>
	</div>
</section>