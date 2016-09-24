<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
var deletes = function( no ){
	if(confirm('삭제 하시겠습니까?')){
		$.post('./process/file.php', { mode:'delete', no:no }, function(result){
			if(result){
				alert("<?php echo $alba_file_control->_success('0001');?>");
				location.href = "./file.php";
			} else {
				alert("<?php echo $alba_file_control->_errors('0002');?>");
			}
		});
	}
}
var sel_delete = function(){
	var chk_length = $("input[name='no[]']:checked").length;
	if(chk_length==0){
		alert('삭제 할 파일을 선택해 주세요.');
		return false;
	} else {
		var del_no = new Array();
		var i = 0;
		$("input[name='no[]']:checked").each(function(){
			del_no[i] = $(this).val();
		i++;
		});

		if(confirm('선택하신 파일 '+chk_length+'건을 삭제 하시겠습니까?')){
			$.post('./process/file.php', { mode:'sel_delete', no:del_no }, function(result){
				if(result){
					alert("<?php echo $alba_file_control->_success('0001');?>");
					location.href = "./file.php";
				} else {
					alert("<?php echo $alba_file_control->_errors('0002');?>");
				}
			});
		}
	}

}
</script>

<script type="text/javascript" src="<?php echo $alice['individual_path'];?>/skins/default/file.skin.js"></script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent"> 
		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['individual_path'];?>/">개인서비스</a> > <a href="<?php echo $alice['individual_path'];?>/alba_resume.php">이력서관리</a> > <strong>파일 관리</strong> </p>
		</div>
		<?php /* //navigation */ ?>

		<!--  이력서사진 설정   -->
		<div class="rightWrap mt30">
			<h2 class="pb5"><img src="../images/tit/person_nav_tit_131.gif" alt="입사지원 파일관리"></h2>
			<em class="titEm mb20">
				<ul>
					<li>입사지원시 필요한 파일들을 관리 하세요.</li>
				</ul>
			</em>

			<div class="personContentWrap">
				<!--  이력서관리수정   --> 
				<div id="listForm" class="mainTopBorder positionR mt40 clearfix">
					<h2 class="skip">이력서관리수정</h2>

					<div class="customList1 mb30">
						<em style="top:-25px; right:0;" class="positionA"><a class="button" href="<?php echo $alice['individual_path'];?>/alba_file_regist.php"><span>첨부파일 등록<img width="7" height="9" class="pl5" src="../images/icon/icon_arrow_6.gif" alt="arrow" style="vertical-align:middle;"></span></a></em>      
						<table cellspacing="0">
						<caption class="skip">이력서관리수정</caption>
						<colgroup><col width="10px"><col><col width="150px"><col width="50px"></colgroup>
						<thead>
						<tr>
							<th scope="col"><input name="check_all" type="checkbox"></th>
							<th scope="col">파일명</th>
							<th scope="col">등록일</th>
							<th scope="col">삭제</th>
						</tr>
						</thead>

						<tbody id="alba_resume_list">
						<?php if(!$list['total_count']){ ?>
						<tr><td class="tc no_listText" colspan="4"><span>등록된 파일이 없습니다.</span></td></tr>
						<?php } else { 
							foreach($list['result'] as $val){
						?>
						<tr>
							<td class="tc"><input type="checkbox" name='no[]' class='check_all' value="<?php echo $val['no'];?>"></td>
							<td class="tl pl5"><span><a href="javascript:file_download('../alba/file_download.php?no=<?php echo $val['no'];?>','<?php echo $val['wr_content'];?>');"><?php echo stripslashes($val['wr_source']);?></a></span></td>            
							<td class="tc"><span><?php echo substr(strtr($val['wr_wdate'],'-','.'),0,11);?></span></td>
							<td class="tc"><span class="text"><a href="javascript:deletes('<?php echo $val['no'];?>');">삭제</a></span></td>
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
								<a class="button white" onclick="sel_delete();"><span>선택 삭제</span></a>
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
</section>

