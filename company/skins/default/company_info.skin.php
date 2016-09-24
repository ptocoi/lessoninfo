<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
var is_publics = function( no){	
	$.post('./process/company.php', { mode:'sel_company', no:no, mb_id:mb_id }, function(result){
		if(result){
			alert("<?php echo $user_control->_success('0002');?>");
			location.reload();
		} else {
			alert("<?php echo $user_control->_errors('0049');?>");
		}
	});
}
</script>

<script type="text/javascript" src="<?php echo $alice['company_path'];?>/skins/default/company_info.js"></script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent">
		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['company_path'];?>/">기업서비스</a> > <a href="<?php echo $alice['company_path'];?>/alba_list.php">채용공고 관리</a> > <strong>기업정보 관리</strong> </p>
		</div>
		<?php /* //navigation */ ?>
		<div class="listWrap positionR mt20">
			<h2 class="pb5"><img src="../images/tit/company_tit_13.gif" width="142" height="25" alt="기업정보 관리"></h2>
			<em class="titEm mb20">
				<ul>
				<li>기업정보를 등록하시면 채용공고 등록 시 기업정보를 입력하실 필요가 없어 채용공고 등록 시간을 단축하실 수 있습니다.</li>
				<li>기업정보별 채용공고를 구분하여 등록 하실 수 있습니다.</li>
				</ul>
			</em>
			<div class="companyContentWrap"><!--  컨텐츠  -->
				<div id="listForm" class="mainTopBorder positionR mt40 clearfix"> <!--  기업정보 관리   --> 
					<h2 class="skip">기업정보 관리</h2>
					<div class="customList1 mb30"><!--  담당자 관리   --> 
						<em class="positionA" style="top:-25px; right:0;"><a class="button" href="./company_insert.php"><span>기업정보 추가<img width="7" height="9" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_6.gif" class="pl5"></span></a></em>      
						
						<table cellspacing="0">
						<caption class="skip">기업정보 관리</caption>
						<!-- <colgroup><col width="10px"><col width="150px"><col width="*"><col width="150px"><col width="150px"><col width="150px"></colgroup> -->
						<colgroup><col width="10px"><col width="50px"><col><col><col><col><col><col width="150px"></colgroup>
						<thead>
						<tr>
							<th scope="col"><input type="checkbox" onclick="selAll();"></th>
							<th scope="col">대표</th>
							<th scope="col">회사명</th>
							<th scope="col">대표자명</th>
							<th scope="col">회사분류</th>
							<th scope="col">전화번호</th>
							<th scope="col">사업자번호</th>
							<th scope="col">기업정보관리</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if($list['result']){
							foreach($list['result'] as $val){
						?>
							<tr>
								<td class="tc"><?php if(!$val['is_public']){ ?><input type="checkbox" class="check_all" value="<?php echo $val['no'];?>" name="no[]"><?php } ?></td>
								<td class="tc"><input type="radio" value="<?php echo $val['no'];?>" name="is_public[]" <?php echo ($val['is_public'])?'checked':'';?> onclick="is_publics(<?php echo $val['no'];?>);"></td>
								<td class="tc"><span><?php echo $val['mb_company_name'];?></span></td>
								<td class="tc"><span><?php echo $val['mb_ceo_name'];?></span></td>
								<td class="tc"><span><?php echo $category_control->get_categoryCodeName($val['mb_biz_type']);?></span></td>
								<td class="tc"><span><?php echo $val['mb_biz_phone'];?></span></td>
								<td class="tc"><span><?php echo $val['mb_biz_no'];?></span></td>
								<td class="tc">
									<span>
										<a href="./company_insert.php?no=<?php echo $val['no'];?>" class="url">수정</a> 
										<?php if(!$val['is_public']){ ?><a href="javascript:company_delete('<?php echo $val['no']?>');" class="url">삭제</a><?php } ?>
									</span>
								</td>
							</tr>
						<?php 
							} // foreach end. 
						}	// if end.
						?>
						</tbody>
						</table>

						<div class="btnBottom mt10"><a class="button white" onclick="company_sel_delete();"><span>선택삭제</span></a> </div>
						<?php include_once $alice['include_path']."/paging.php";?>
					</div><!--  담당자 관리 end   --> 

					</div><!--  컨텐츠 end   --> 
				</div>
			</div>
		</div>
	</div>  
</section>