<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
$(function(){
	$('#noticeSearchFrm > #search_keyword').keydown(function(event){
		if(event.keyCode==13){	
			notice_search();
		}
	});
});
var notice_search = function(){
	$('#noticeSearchFrm').submit();
}
var notice_page_rows = function( vals ){	// 출력 갯수
	var sel = vals.value, send_url = "<?php echo $notice_list['send_url'];?>";
	location.href = "./notice_list.php?"+send_url+"&page_rows=" + sel;
}
</script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['board_path'] . "/views/_include/left_navi.php"; ?>
		<div id="rightContent"> 
			<?php /* navigation */ ?>
			<div class="NowLocation mt35 clearfix">
				<p> <a href="/">HOME</a> > <strong>공지사항</strong> </p>
			</div>
			<?php /* //navigation */ ?>

			<div class="rightWrap mt20 mb30">
				<h2 class="skip">공지사항</h2>
				<div class="community positionR">
					<h3 class="pb5 pl5 h3"><img class="" src="../images/icon/icon_star1.gif" width="18" height="17" alt=""> <strong>공지사항</strong></h3>
					<div class="mainTopBorder positionR mt20 clearfix" id="listForm">
						<div style="top:-30px; right:0;" class="positionA">
						<form name="noticeSearchFrm" method="get" action="<?php echo $_SERVER['PHP_SELF'];?>" id="noticeSearchFrm">
						<input type="hidden" name="mode" value="search"/>
							<span class="pl10">
								<select name="search_field" class="ipSelect2" id="search_field" style="width:80px;" title="검색선택">
								<option value="wr_subject||wr_content" <?php echo ($_GET['search_field']=='wr_subject||wr_content')?'selected':'';?>>제목+내용</option>
								<option value="wr_subject" <?php echo ($_GET['search_field']=='wr_subject')?'selected':'';?>>제목</option>
								<option value="wr_content" <?php echo ($_GET['search_field']=='wr_content')?'selected':'';?>>내용</option>
								</select>      
								<input type="text" class="ipText2" style="margin-top:-2px;width:100px;" value="<?php echo stripslashes($_GET['search_keyword']);?>" name="search_keyword" id="search_keyword">
								<a class="button" onclick="notice_search();"><span>검색</span></a>
							</span>
							<span class="pl10">      
								<select name="page_rows" onchange="notice_page_rows(this);" class="ipSelect2" style="width:100px;" title="출력수설정">
								<option value='20' <?php echo ($page_rows==20)?'selected':'';?>>20개 출력</option>
								<option value='40' <?php echo ($page_rows==40)?'selected':'';?>>40개 출력</option>
								<option value='60' <?php echo ($page_rows==60)?'selected':'';?>>60개 출력</option>
								<option value='80' <?php echo ($page_rows==80)?'selected':'';?>>80개 출력</option>
								<option value='100' <?php echo ($page_rows==100)?'selected':'';?>>100개 출력</option>
								</select>
							</span>   
						</form>
						</div>
						<table cellspacing="0" >
						<colgroup><col width="110px"><col width="*"><col width="100px"></colgroup>
						<thead>
						<tr>
							<th scope="col" class="tl pl15">등록일</th>
							<th scope="col">제목</th>
							<th scope="col" class="tr pr15">조회수</th>
						</tr>
						</thead>
						<tbody>
						<?php 
							foreach($notice_list['result'] as $val){ 
							$wr_date = strtr(substr($val['wr_date'],0,11),'-','.');
							$notice_cate = $category_control->get_categoryCodeName($val['wr_type']);
							$wr_type = ($notice_cate) ? "[".$notice_cate."] " : "";
						?>
						<tr>
							<td class="tl pl10"><span><?php echo $wr_date;?></span></td>
							<td class="tl">
								<span><a href="./notice_view.php?no=<?php echo $val['no'];?>"><?php echo $wr_type;?><?php echo stripslashes($val['wr_subject']);?></a></span>
							</td>
							<td class="tr pr15"><span><?php echo number_format($val['wr_hit']);?></span></td>
						</tr>
						<?php } ?>

						</tbody>
						</table>
					</div>
					<?php include_once $alice['include_path']."/paging.php";?>
				</div>

			</div>
		</div>
	</div>
</section>