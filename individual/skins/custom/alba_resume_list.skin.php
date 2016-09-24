<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script type="text/javascript" src="<?php echo $alice['js_plugin'];?>/jquery.form.js"></script>
<script>
var resume_copy = function( no ){	// 이력서 복사

	if(confirm("이력서를 복사하시겠습니까?")){
		$.post('./process/alba_resume.php', { mode:'sel_copy', no:no, mb_id:mb_id }, function(result){
			if(result){
				location.reload();
			} else {
				alert("<?php echo $alba_individual_control->_errors('0003');?>");
			}
		});
	}

}
var resume_is_open = function( vals, no ){
	var is_open = (vals.checked == true) ? 1 : 0;

	$.post('./process/alba_resume.php', { mode:'is_oepn', no:no, is_open:is_open, mb_id:mb_id }, function(result){
		if(result){
			location.reload();
		} else {
			alert("<?php echo $alba_individual_control->_errors('0009');?>");
		}
	});
	
}
var resume_sel_delete = function(){	// 이력서 선택 삭제
	var chk_length = $("input[name='no[]']:checked").length;
	if(chk_length==0){
		alert('삭제 할 이력서를 선택해 주세요.');
		return false;
	} else {
		var del_no = new Array();
		var i = 0;
		$("input[name='no[]']:checked").each(function(){
			del_no[i] = $(this).val();
		i++;
		});
		if(confirm('한번 삭제된 이력서는 복구가 안됩니다.\n\n선택하신 이력서 '+chk_length+'건을 삭제하시겠습니까?')){
			$.post('./process/alba_resume.php', { mode:'sel_delete', no:del_no, mb_id:mb_id }, function(result){
				if(result){
					location.reload();
				} else {
					alert("<?php echo $alba_individual_control->_errors('0002');?>");
				}
			});
		}
	}
}
var resume_sel_is_open = function( is_open ){	// 이력서 선택 공개/비공개

	var msg = (is_open) ? "공개" : "비공개";

	var chk_length = $("input[name='no[]']:checked").length;
	if(chk_length==0){
		alert(msg+'할 이력서를 선택해 주세요.');
		return false;
	} else {
		var open_no = new Array();
		var i = 0;
		$("input[name='no[]']:checked").each(function(){
			open_no[i] = $(this).val();
		i++;
		});

		if(confirm('선택하신 이력서 '+chk_length+'건을 ['+msg+']로 변경 하시겠습니까?')){
			$.post('./process/alba_resume.php', { mode:'sel_open', no:open_no, mb_id:mb_id, is_open:is_open }, function(result){
				if(result){
					location.reload();
				} else {
					alert("<?php echo $alba_individual_control->_errors('0009');?>");
				}
			});
		}

	}
}
var resume_print = function(){	// 인쇄하기
	var chk_length = $("input[name='no[]']:checked").length;
	if(chk_length == 0){
		alert("인쇄 할 이력서를 1개 선택해 주세요.");
	} else if(chk_length > 1){
		alert("인쇄 할 이력서를 1개만 선택해 주세요.");
	} else {
		var sel_check = $("input[name='no[]']:checked").val();
		window.open("<?php echo $alice['popup_path'];?>/print_alba_resume.php?no="+sel_check,'topprintwin','toolbar=no,location=no,directories=no,status=no,scrollbars=yes,menubar=no,width=670,height=800');
	}

}
var resume_email = function(){	// 이메일 전송
	var chk_length = $("input[name='no[]']:checked").length;
	if(chk_length == 0){
		alert("e-메일 전송할 이력서를 1개 선택해 주세요.");
	} else if(chk_length > 1){
		alert("e-메일 전송할 이력서를 1개만 선택해 주세요.");
	} else {
		var sel_check = $("input[name='no[]']:checked").val();
		$('#popup_layer').load("<?php echo $alice['popup_path'];?>/views/_load/email.php", { mode:'alba_resume', no:sel_check, mb_id:mb_id }, function(result){
			$('#popup').draggable({ handle: "#popupHandle" });
			$('.closeBtn').click(function(){
				$('#popup').hide();
			});
			$('#receive_email').focus();
		});
	}
}
var email_send = function(){
	var send_option = { beforeSubmit: email_showRequest, success: email_showResponse }	// email ajax options
	$('#albaResumeEmailFrm').ajaxSubmit(send_option);
}
var email_showRequest = function(formData, jqForm, send_options){
	var queryString = $.param(formData); 
	//alert(queryString);
	return true;
}
var email_showResponse = function(responseText, statusText, xhr, $form){
	alert("메일이 발송되었습니다.\n\n메일 주소 유효성과 관계없이 무조건 발송 됩니다.");
	$('#popup').hide();
}
</script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent"> 
		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['individual_path'];?>/">개인서비스</a> > <a href="<?php echo $alice['individual_path'];?>/alba_resume_list.php">이력서관리</a> > <strong>이력서 관리·수정</strong></p>
		</div>
		<?php /* //navigation */ ?>

			<div id="popup_layer" style="z-index: 9999; display: block; left: 50%; top: 50%; margin-left: -250px; margin-top: -250px;" class="positionF content_wrap clearfix"></div>

			<div class="listWrap positionR mt20">
				<h2 class="pb5"><img src="../images/tit/person_tit_11.gif" width="176" height="25" alt="이력서 관리·수정"></h2>
			<h3 style="padding:10px;" class="font11 fongrb">맞춤 인재 정보를 설정하시면  원하는 형태의 인재정보를 이메일이나 SMS 문자를 통해 수신하실 수 있습니다.<a target="_blank" href="/individual/alba_customized.php"><img class="vm positionR" style="left:115px;"src="/images/tit/more_job.gif"></a></h3>
			<em style="border:0px;padding:10px 0px 0px 3px !important" class="titEm mb20">
					<ul>
						<li>공개된 이력서는 기업에서 열람 가능합니다.</li>
					</ul>
				</em>

				<div class="personContentWrap">
					<!--  이력서관리수정   --> 
					<div id="listForm" class="mainTopBorder positionR mt40 clearfix">
						<h2 class="skip">이력서관리수정</h2>

						<div class="customList1 mb30">
							<em style="top:-25px; right:0;" class="positionA"><a class="button" href="<?php echo $alice['individual_path'];?>/alba_resume_regist.php"><span>새이력서 작성<img width="7" height="9" class="pl5" src="../images/icon/icon_arrow_6.gif" alt="arrow" style="vertical-align:middle;"></span></a></em>      
							<table cellspacing="0">
							<caption class="skip">이력서관리수정</caption>
							<colgroup>
							<col width="10px"><col width="30px"><col width=""><col width="80px"><col width="110px"><col width="170px"><col width="50px"></colgroup>
							<thead>
							<tr>
								<th scope="col"><input name="check_all" type="checkbox"></th>
								<th scope="col">공개</th>
								<th scope="col">이력서 제목</th>
								<th scope="col">최종수정일</th>
								<th scope="col">이력서관리</th>
								<th scope="col">유료서비스</th>
								<th scope="col">열람수</th>
							</tr>
							</thead>

							<tbody id="alba_resume_list">
							<?php if(!$resume_list['total_count']){ ?>
							<tr><td class="tc no_listText" colspan="7"><span>등록된 이력서가 없습니다.</span></td></tr>
							<?php } else { 
								foreach($resume_list['result'] as $val){
								$wr_subject_str = $utility->remove_quoted(stripslashes($val['wr_subject']));
								$wr_subject = $utility->str_cut($wr_subject_str,66);
								$wr_udate = strtr(substr($val['wr_udate'],0,11),'-','.');
								$wr_job_type = $alba_individual_control->get_job_type($val['no']);	// 직종 간단 출력

								$service_valid = $alba_individual_control->service_valid($val['no']);
								$service_main_focus = strtr($service_valid['service_main_focus'],'-','.');	// 메인 포커스
								$service_sub_focus = strtr($service_valid['service_sub_focus'],'-','.');	// 인재정보 포커스
								$service_basic = strtr($service_valid['service_basic'],'-','.');	// 메인 일반
								$service_basic_sub = strtr($service_valid['service_basic_sub'],'-','.');	// 서브 일반

								$service_days = false;
								if($service_main_focus) $service_days = true;
								if($service_sub_focus) $service_days = true;
								if($service_basic) $service_days = true;
								if($service_basic_sub) $service_days = true;
								$service_msg = ($service_days) ? "연장" : "신청";

								$main_rbasic_check = $service_control->service_check('main_rbasic');	// 메인 일반리스트
								$resume_basic_check = $service_control->service_check('alba_resume_basic');	// 서브 일반리스트
							?>
							<tr>
								<td class="tc"><input type="checkbox" name='no[]' class='check_all' value="<?php echo $val['no'];?>"></td>
								<td class="tc"><input type="checkbox" name='wr_open[]' value="1" <?php echo ($val['wr_open']) ?'checked':'';?> onclick="resume_is_open(this,'<?php echo $val['no'];?>');"></td>
								<td class="tl">
									<div class="pl10 pt5"><span><strong><a target="_blank" href="<?php echo $alice['resume_path'];?>/alba_resume_detail.php?no=<?php echo $val['no'];?>"><?php echo $wr_subject;?></a></strong></span></div>
									<div style="width:320px;" class="pl10 text_gray">직종 : <?php echo @implode($wr_job_type,'·');?></div>
								</td>            
								<td class="tc"><span><?php echo $wr_udate;?></span></td>
								<td class="tc">
									<span>
									<a class="url" href="<?php echo $alice['individual_path'];?>/alba_resume_detail.php?no=<?php echo $val['no'];?>">보기</a> 
									<a class="url" href="<?php echo $alice['individual_path'];?>/alba_resume_regist.php?no=<?php echo $val['no'];?>&page_rows=<?php echo $page_rows;?>&page=<?php echo $page;?>">수정</a> 
									<a class="url" href="javascript:resume_copy('<?php echo $val['no'];?>');">복사</a></span>
								</td>
								<td class="tl pl10">
									<!-- <a href="<?php echo $alice['individual_path'];?>/alba_resume_service.php?no=<?php echo $val['no'];?>">신청</a> -->
									<ul class="lineH5 font11 tl">
									<?php if($service_valid['service_main_focus']){ ?><li><?php echo $service_valid['service_main_focus_text'];?> (~ <?php echo $service_main_focus;?>)</li><?php } ?>
									<?php if($service_valid['service_basic']){ ?><li><?php echo $service_valid['service_basic_text'];?> (~ <?php echo $service_basic;?>)</li><?php } ?>
									<?php if($service_valid['service_sub_focus']){ ?><li><?php echo $service_valid['service_sub_focus_text'];?> (~ <?php echo $service_sub_focus;?>)</li><?php } ?>
									<?php if($service_valid['service_basic_sub']){ ?><li><?php echo $service_valid['service_basic_sub_text'];?> (~ <?php echo $service_basic_sub;?>)</li><?php } ?>
									</ul> 
									<ul class="lineH5 font11">
										<li class="tc"><a href="<?php echo $alice['individual_path'];?>/alba_resume_service.php?no=<?php echo $val['no'];?>" class="text_red url ">서비스<?php echo $service_msg;?></a></li>
										<!-- <li class="tc"><?php if($service_days){ ?><a href="javascript:service_options('<?php echo $val['no'];?>');" class="text_red url ">강조옵션신청</a><?php } ?></li> -->
									</ul>
								</td>
								<td class="tc">
									<span class="text"><strong class="text_blue"><?php echo number_format($val['wr_hit']);?></strong> 건</span>
								</td>
							</tr>
							<?php 
								}	// foreach end.
							} // if end.
							?>
							</tbody>

							</table>

							<div class="btnBottom mt10 clearfix">
								<span style="float:left;">
									<a class="button white" onclick="selAll();"><span>전체선택</span></a>
									<a class="button white" onclick="resume_sel_delete();"><span>선택 삭제</span></a>
									<a class="button white" onclick="resume_sel_is_open(1);"><span>선택 공개</span></a>
									<a class="button white" onclick="resume_sel_is_open(0);"><span>선택 비공개</span></a>
								</span>
								<span style="float:right;">
									<a class="button white" onclick="resume_print();"><span>인쇄하기</span></a>
									<a class="button white" onclick="resume_email();"><span>e-메일 전송</span></a>
									<!-- <a class="button white"><span>워드파일로 저장</span></a>  -->
								</span>
							</div>     

							<?php include_once $alice['include_path']."/paging.php";?>
							<!-- <div class="paging">
								<span class="page ">
									<a class="prev" href="#">&lt;</a>
									<a class="page now" href="#">1</a><a class="page" href="#">2</a>
									<a class="next" href="#">&gt;</a>
									<span class="location">[<strong>11</strong>/136]</span>
								</span>
							</div> -->
						</div>

					</div>
					<!--  //이력서관리수정 --> 
				</div>

			</div>
		</div>
	</div>
</section>
