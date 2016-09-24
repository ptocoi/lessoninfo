<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
var mode = "<?php echo $mode;?>";
var pay_sdate = [];
<?php if($pay_sdate){
	for($i=0;$i<$pay_sdate_cnt;$i++){
?>
pay_sdate.push("<?php echo $pay_sdate[$i];?>");
<?php 
	}
} else { 
?>
var pay_sdate = [];
<?php } ?>

var pay_edate = [];
<?php if($pay_edate){
	for($i=0;$i<$pay_edate_cnt;$i++){
?>
pay_edate.push("<?php echo $pay_edate[$i];?>");
<?php 
	}
} else { 
?>
var pay_edate = [];
<?php } ?>

var start_day = "<?php echo $start_day?>";
var end_day = "<?php echo $end_day?>";
</script>

<script type="text/javascript" src="<?php echo $alice['company_path'];?>/skins/default/alba_resume_applycert.skin.js"></script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent"> 
		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['company_path'];?>/">개인서비스</a> > <a href="<?php echo $alice['company_path'];?>/alba_resume_onlines.php">입사지원 관리</a> > <strong>SMS 문자발송 현황</strong> </p>
		</div>
		<?php /* //navigation */ ?>

		<div id="popup" class="positionF content_wrap clearfix" style="top:15%;left:5%;z-index:9999;display:none;"></div>

		<div class="listWrap positionR mt20">
			<h2 class="pb5"><img src="../images/tit/person_tit_14.gif" width="198" height="25" alt="SMS 문자발송 현황"></h2>
			<h3 style="padding:10px;" class="font11 fongrb">맞춤 인재 정보를 설정하시면  원하는 형태의 인재정보를 이메일이나 SMS 문자를 통해 수신하실 수 있습니다.<a target="_blank" href="/company/alba_customized.php"><img class="vm positionR" style="left:115px;"src="/images/tit/more_job.gif"></a></h3>
			<em style="border:0px;padding:10px 0px 0px 3px !important" class="titEm mb20">
					<ul>						
						<li>SMS문자를 충전하실수 있습니다.</li>
						<li>SMS 문자 충전하기 메뉴에서 문자발ㅅ</li>
						<li>또한, 기업회원이 지원내역을 열람한 경우 지원취소하거나 삭제가 불가능 합니다. (열람전엔 취소, 삭제 가능합니다)</li>
					</ul>
				</em>
			<div class="personContentWrap"><!--  컨텐츠  -->
				<div id="listForm" class="positionR mt20 clearfix"> <!--  충전   --> 
					<form method="get" name="serviceListFrm" action="<?php echo $_SERVER['PHP_SELF'];?>" id="serviceListFrm">
					<input type="hidden" name="mode" value="search"/>
					<h2 class="skip">취업활동증명서</h2>						
				<div class="customList1 mb30"> 					   
					<table cellspacing="0">
					<caption class="skip">SMS 발송현황</caption>
					<colgroup><col width="10"><col width="100"><col width="580"></colgroup>
					<thead>
					<tr>
						<th scope="col"><input name="check_all" type="checkbox"></th>
						<th scope="col">상품안내</th>
						<th scope="col">서비스내용</th>
						<th scope="col">가격안내</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td class="tc"><input name="no[]" class="check_all" type="checkbox" value="13"></td>
						<td class="tc"><span>라이트</span></td>
						<td class="tl pl15"><span><a href="../alba/company_info.php?mb_id=test_company" target="_blank">SMS 1,000건 /단문(SMS) 1건당 사용료 : 21원/장문(LMS) 1건당 사용료 : 63원</a></span></td>
						<td class="b tr pr24"><span><a class="tblu" href="../alba/alba_detail.php?no=27" target="_blank">21,000원</a></span></td>	
					</tr>
					<tr>
						<td class="tc"><input name="no[]" class="check_all" type="checkbox" value="13"></td>
						<td class="tc"><span>스탠다드</span></td>
						<td class="tl pl15"><span><a href="../alba/company_info.php?mb_id=test_company" target="_blank">SMS 3,000건 /단문(SMS) 1건당 사용료 : 20원/장문(LMS) 1건당 사용료 : 60원</a></span></td>
						<td class="b tr pr24"><span><a class="tblu" href="../alba/alba_detail.php?no=27" target="_blank">60,000원</a></span></td>	
					</tr>
					<tr>
						<td class="tc"><input name="no[]" class="check_all" type="checkbox" value="13"></td>
						<td class="tc"><span>비즈니스</span></td>
						<td class="tl pl15"><span><a href="../alba/company_info.php?mb_id=test_company" target="_blank">SMS 10,000건 /단문(SMS) 1건당 사용료 : 18원/장문(LMS) 1건당 사용료 : 54원</a></span></td>
						<td class="b tr pr24"><span><a class="tblu" href="../alba/alba_detail.php?no=27" target="_blank">21,000원</a></span></td>	
					</tr>
					<tr>
						<td class="tc"><input name="no[]" class="check_all" type="checkbox" value="13"></td>
						<td class="tc"><span>프리미엄</span></td>
						<td class="tl pl15"><span><a href="../alba/company_info.php?mb_id=test_company" target="_blank">SMS 30,000건 /단문(SMS) 1건당 사용료 : 16원/장문(LMS) 1건당 사용료 : 48원</a></span></td>
						<td class="b tr pr24"><span><a class="tblu" href="../alba/alba_detail.php?no=27" target="_blank">480,000원</a></span></td>	
					</tr>
					<tr>
						<td class="tc"><input name="no[]" class="check_all" type="checkbox" value="13"></td>
						<td class="tc"><span>플래티넘</span></td>
						<td class="tl pl15"><span><a href="../alba/company_info.php?mb_id=test_company" target="_blank">SMS 100,000건 /단문(SMS) 1건당 사용료 : 14원/장문(LMS) 1건당 사용료 : 42원</a></span></td>
						<td class="b tr pr24"><span><a class="tblu" href="../alba/alba_detail.php?no=27" target="_blank">1,400,000원</a></span></td>	
					</tr>					
										</tbody>
					</table>
					   <div class="pt20 tc">
						<span class="pr10"><img src="/images/tit/sms_time_icon.png"></span>
						<span class="pr10"><img src="/images/tit/sms_card_icon.png"></span>
						<span><img src="/images/tit/sms_pay_icon.png"></span>
					   </div>

					<?php include_once $alice['include_path']."/paging.php";?>

					</div>

					</form>

					</div> <!--  충전 end   --> 

				</div><!--  컨텐츠 end   --> 
			</div>
		</div>
	</div>
</section>