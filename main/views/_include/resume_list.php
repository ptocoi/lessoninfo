			<!--  일반인재   --> 
			<div id="listForm" class="positionR mt30 clearfix" style="clear:both;padding-top:40px">
				<a name="result"></a>
				<h2 class="clearfix">
					<strong><img width="13" height="13" alt="" src="../images/icon/icon_arrow_4.png" class="vb bg_color4"> 최근인재정보</strong>
				</h2>
				<table cellspacing="0" summary="최근인재 정보입니다">
				<caption class="skip">최근 인재</caption>
				<colgroup><col width="105px"><col width="*"><col width="50px"><col width="100px"><col width="90px"><col width="70px"></colgroup>
				<thead>
				<tr>
					<th class="name" scope="col">이름</th>
					<th class="title" scope="col">이력서정보</th>
					<th scope="col"></th>
					<th class="pay" scope="col">희망급여</th>
					<th class="local" scope="col">희망지역</th>
					<th class="modDate" scope="col">수정일</th>
				</tr>
				</thead>
				<tbody>
				<?php 
				if($latest_resume_list['total_count']){
					foreach($latest_resume_list['result'] as $val){
					$no = $val['no'];
					$list = $alba_resume_user_control->get_resume_service($no,"",120);
				?>
				<tr id="latest_resume_list_<?php echo $no;?>">
					<td class="name">
						<span><?php echo $list['name'];?>
							<?php if($list['is_photo']){?>
							<em class="photo"><img class="vb pb2" src="../images/icon/icon_photo1.gif" width="16" height="16"></em>
							<?php } ?>
						</span>
						<span class="block">(<?php echo $list['wr_gender'];?> <span><?php echo $list['wr_age'];?></span>세)</span>
					</td>
					<td class="title">
						<a href="<?php echo $alice['resume_path'];?>/alba_resume_detail.php?no=<?php echo $no;?>">
						<?php echo $list['service_busy'];?>
						<?php echo $list['service_icon'];?>
						<span class="title"><?php echo $list['subject'];?></span>
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
						</a>
					</td>
					<td class="icons">
						<div><a target="_blank" href="<?php echo $alice['resume_path'];?>/alba_resume_detail.php?no=<?php echo $no;?>" class="window" id=""><img class="bg_orang" width="13" height="13" src="../images/icon/icon_newWindow.png" alt="새창으로 열기"></a></div>
						<div><a href="javascript:resume_scrap('<?php echo $no;?>');" class="star" id=""><img class="bg_orang" width="13" height="13" src="../images/icon/icon_star.png" alt="공고스크랩"></a></div>
						<div><a href="javascript:latest_resume_open('<?php echo $no;?>');" class="plus" id=""><img class="bg_orang" width="13" height="13" src="../images/icon/icon_plus.png" alt="상세보기"></a></div>
					</td>
					<td class="pay">
						<span class="pay">
							<em class="number"><?php echo $list['wr_pay'];?></em> 
							<em class="icon"><?php echo $list['wr_pay_type'];?></em>
						</span>
					</td>
					<td class="local"><?php echo $utility->str_cut($list['wr_area'],18,"");?> </td>
					<td class="modDate"><span><?php echo $list['last2'];?></span></td>
				</tr>
				<?php 
					}	// foreach end.
				} else {
				?>
				<tr><td colspan="6" class="tc no_listText"><span>인재정보가 없습니다.</span></td></tr>
				<?php } // if end.?>
				</tbody>
				</table>

				<!-- view layer -->
				<div class="quickView clearfix positionA" style="display:none; left:5px; z-index:2000;" id="latest_resume_list_quickView"></div>
				<!-- // view layer -->

			</div>
			<!--  // 일반인재  --> 
<script>
var latest_resume_open = function( no ){	// 공고 상세보기
	var $sub_list = $('#latest_resume_list_'+no);
	var position_top = $sub_list.position().top;
	$('#latest_resume_list_quickView').hide();
	$('#latest_resume_list_quickView').load('../resume/views/_load/alba_resume.php', { mode:'basic_list', no:no }, function(){
		position_tops = position_top - 2;
		$(this).css({
			"top" : position_tops+"px",
			"left" : "0px"
		});
		$(this).show();
	});
}
var resume_list_close = function(){	// 플래티넘 레이어 닫기
	$('#latest_resume_list_quickView').hide();
}
</script>