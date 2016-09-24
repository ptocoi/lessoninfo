<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
</script>

<script type="text/javascript" src="<?php echo $alice['company_path'];?>/skins/default/manager_info.js"></script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent">
		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['company_path'];?>/">기업서비스</a> > <a href="<?php echo $alice['company_path'];?>/alba_list.php">채용공고 관리</a> > <strong>채용담당자 관리</strong> </p>
		</div>
		<?php /* //navigation */ ?>
		<div class="listWrap positionR mt20">
			<h2 class="pb5"><img src="../images/tit/company_tit_07.gif" width="162" height="25" alt="담당자 관리"></h2>
			<em class="titEm mb20">
				<ul>
				<li>채용담당자를 등록하시면 채용공고 등록 시 채용담당자를 입력하실 필요가 없어 채용공고 등록 시간을 단축하실 수 있습니다.</li>
				</ul>
			</em>
			<div class="companyContentWrap"><!--  컨텐츠  -->
				<div id="listForm" class="mainTopBorder positionR mt40 clearfix"> <!--  담당자 관리   --> 
					<h2 class="skip">담당자 관리</h2>
					<div class="customList1 mb30"><!--  담당자 관리   --> 
						<em class="positionA" style="top:-25px; right:0;"><a class="button" onclick="manager_insert();"><span>채용담당자 추가<img width="7" height="9" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_6.gif" class="pl5"></span></a></em>      <table cellspacing="0" summary="오늘 등록된 인재의  정보입니다">
						<caption class="skip">담당자 관리</caption>
						<colgroup><col width="10px"><col width="150px"><col width="*"><col width="150px"><col width="150px"><col width="150px"></colgroup>
						<thead>
						<tr>
							<th scope="col"><input type="checkbox" onclick="selAll();"></th>
							<th scope="col">담당자명</th>
							<th scope="col">e-메일</th>
							<th scope="col">전화번호</th>
							<th scope="col">팩스번호</th>
							<th scope="col">담당자관리</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach($list['result'] as $val){?>
						<tr>
							<td class="tc"><input type="checkbox" class="check_all" value="<?php echo $val['no'];?>" name="no[]"></td>
							<td class="tc"><span class="pl10"><?php echo stripslashes($val['wr_name']);?></span></td>
							<td class="tc"><span><?php echo stripslashes($val['wr_email']);?></span></td>
							<td class="tc"><span><?php echo $val['wr_phone'];?></span></td>
							<td class="tc"><span><?php echo $val['wr_hphone'];?></span></td>
							<td class="tc">
								<span>
									<a href="javascript:manager_update('<?php echo $val['no']?>');" class="url">수정</a> 
									<a href="javascript:manager_delete('<?php echo $val['no']?>');" class="url">삭제</a>
								</span>
							</td>
						</tr>
						<?php } // foreach end. ?>
						</tbody>
						</table>
						<div class="btnBottom mt10"><a class="button white" onclick="manager_sel_delete();"><span>삭제</span></a> </div>
						<?php include_once $alice['include_path']."/paging.php";?>
					</div><!--  담당자 관리 end   --> 

					<div id="managerInput" class="positionR mt30 clearfix" style="display:none;"></div>

					</div><!--  컨텐츠 end   --> 
				</div>
			</div>
		</div>
	</div>  
</section>