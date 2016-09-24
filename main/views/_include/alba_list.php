		<!--  일반채용   --> 
		<div id="JobListForm2" class="positionR mt30 clearfix">
			
			<!-- view layer -->
			<div class="quickView clearfix positionA" style="display:none; left:5px; z-index:2000;" id="latest_alba_list_quickView"><div class="positionA" style="top:0;right:0;">close</div></div>
			<!-- // view layer -->

			<a name="result"></a>
			<h2 class="clearfix">
				<strong><img width="13" height="13" alt="" src="../images/icon/icon_arrow_4.png" class="vb bg_color4"> 최근채용정보</strong>
			</h2>

			<div id="list_view">
				<!--  일반보기  -->   
				<table cellspacing="0" summary="최근채용정보입니다">
				<caption class="skip">최근 채용</caption>
				<colgroup><col width="90px"><col width="50px"><col width="*"><col width="110px"><col width="60px"><col width="100px"><col width="55px"><col width="60px">  </colgroup>
				<thead>
				<tr>
					<th class="local" scope="col">근무지</th>
					<th class="icons" scope="col"></th>
					<th class="title" scope="col">채용제목</th>
					<th class="company" scope="col">기업명</th>
					<th class="gender" scope="col">성별</th>
					<th class="pay" scope="col">급여</th>
					<th class="date" scope="col">등록일</th>
					<th class="finish" scope="col" width="60px">마감일</th>
				</tr>
				</thead>
				<tbody>
				<?php 
				if($latest_alba_list['result']){
					foreach($latest_alba_list['result'] as $key => $val){ 
					$no = $val['no'];
					$lists = $alba_user_control->get_alba_service($no,"sub_list",100);
					$wdate = strtr($lists['datetime3'],"-","/");
				?>
				<tr id="latest_alba_list_<?php echo $no;?>" style="display:;">
					<td class="local"><?php echo $lists['wr_area_cut'];?></td>
					<td  class="icons">
						<div><a class="window" href="../alba/alba_detail.php?no=<?php echo $no;?>" target="_blank"><img width="13" height="13" alt="새창으로 열기" src="../images/icon/icon_newWindow.png" class="bg_orang"></a></div>
						<?php if($mb_type!='company'){ // 공고는 개인회원만 스크랩 ?>
						<div><a class="star" href="javascript:alba_scrap('<?php echo $no;?>');"><img width="13" height="13" alt="공고스크랩" src="../images/icon/icon_star.png" class="bg_orang"></a></div>
						<?php } ?>
						<div><a class="plus" href="javascript:latest_alba_open('<?php echo $no;?>');"><img width="13" height="13" alt="상세보기" src="../images/icon/icon_plus.png" class="bg_orang"></a></div>
					</td>        
					<td class="title"><?php echo $lists['service_busy'];?><?php echo $lists['service_icon'];?><a href="../alba/alba_detail.php?no=<?php echo $no;?>"><span><?php echo $lists['subject'];?> </span></a></td>
					<td class="company"><a href="../alba/alba_detail.php?no=<?php echo $no;?>"><span><?php echo $lists['company_name'];?> </span></a></td>
					<td class="gender"><?php echo $lists['wr_gender'];?>&nbsp;</td>
					<td class="pay">
						<?php
						if($lists['wr_pay_conference']){
							echo $alba_user_control->pay_conference[$lists['wr_pay_conference']];
						} else {
						?>
							<span class="number"><?php echo $lists['wr_pay'];?>원</span> <em class="icon"><?php echo $lists['wr_pay_type'];?></em>
						<?php } ?>
					</td>
					<td class="date"><?php echo $wdate;?></td>
					<td class="finish"><?php echo $lists['volume'];?></td>
				</tr>
				<?php 
					} // foreach end.
				} else {
				?>
				<tr><td colspan="8" class="tc no_listText"><span>채용정보가 없습니다.</span></td></tr>
				<?php } // if end.?>
				</tbody>
				</table>
				<!--  // 일반보기 --> 
			</div>
</div>
<script>
var latest_alba_open = function( no ){	// 공고 상세보기
	var $list = $('#latest_alba_list_'+no);
	var position_top = $list.position().top;

	$('#latest_alba_list_quickView').hide();
	$('#latest_alba_list_quickView').load('../alba/views/_load/alba.php', { mode:'basic_list', no:no }, function(result){
		position_tops = position_top - 2;
		$(this).css({
			"top" : position_tops+"px",
			"left" : "0px"
		});
		$(this).show();
	});
}
var sub_list_close = function(){	// 플래티넘 레이어 닫기
	$('#latest_alba_list_quickView').hide();
}
</script>