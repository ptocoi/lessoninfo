<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>


<script>
var form_submit = function(){
	$('#AlbaFileFrm').submit();
}
</script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent"> 
		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['individual_path'];?>/">개인서비스</a> > <a href="<?php echo $alice['individual_path'];?>/alba_resume_list.php">이력서관리</a> > <strong>첨부파일 등록</strong> </p>
		</div>
		<?php /* //navigation */ ?>

		<form method="post" name="AlbaFileFrm" action="<?php echo $alice['individual_path'];?>/process/file.php" id="AlbaFileFrm" enctype="multipart/form-data" onsubmit="return validate(this);">
		<input type="hidden" name="mode" value="insert" id="mode"/>
		<input type="hidden" name="mb_type" value="<?php echo $mb_type;?>"/>
		<input type="hidden" name="mb_id" value="<?php echo $member['mb_id'];?>"/>
		<input type="hidden" name="mb_no" value="<?php echo $member['no'];?>"/>
		<input type="hidden" name="wr_type" value="alba_resume"/>

		<!--  희망근무조건 -->
		<div class="listWrap mt30">
			<h2 class="pb5"><img src="../images/tit/person_nav_tit_021.gif"  alt="입사지원 첨부파일 등록"></h2>
			<div class="registWrap">
			<table>
			<caption><span class="skip">희망근무조건입력</span></caption>
			<colgroup><col width="159px"><col width="*"></colgroup>
			<tbody>
			<tr>
				<th scope="row"><label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >첨부파일</label></th>
				<td>
					<input type="file" name="wr_content" class="txt" style="width:400px;"/>
				</td>
			</tr>

			</tbody>
			</table>
			</div>
		</div>
		<!--  //희망근무조건  --> 



		<!--  button -->
		<div class="joinbtn clearfix" style="margin:30px auto;">
			<ul> 
				<li><div class="btn font_white bg_blueBlack"><a onclick="form_submit();">저장<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right2.png" class="pb5"></a></div></li>
				<li><div class="btn font_gray bg_white"><a href="./file.php">취소<img width="30" height="9" class="pb5" src="../images/icon/icon_arrow_right3.png" alt="arrow"></a></div></li>
			</ul>
		</div>
		<!--  //button  -->

		</form>

		</div>



	</div>
</section>
