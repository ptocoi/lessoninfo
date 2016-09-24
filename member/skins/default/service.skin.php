<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
</script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent"> 
		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['individual_path'];?>/">개인서비스</a> > <a href="<?php echo $alice['individual_path'];?>/update_form.php">개인정보 관리</a> > <strong>유료 이용내역</strong> </p>
		</div>
		<?php /* //navigation */ ?>
		<div class="listWrap positionR mt20">
			<h2 class="pb5"><img src="../images/tit/person_tit_10.gif" width="145" height="25" alt="유료이용내역"></h2>
			<em class="titEm mb20">
			<ul>
				<li>회원님께서 구매하신 모든 유료서비스 이용내역을 확인할 수 있습니다.</li>
				<li>최근 3개월 이내 조회만 확인할 수 있으며, 과거 이용내역은 고객센터로 문의해 주세요.</li>
			</ul>
			</em>
			<div class="personContentWrap"><!--  컨텐츠  -->
				<div id="listForm" class="positionR mt40 clearfix"> <!--  유료이용내역   --> 
					<h2 class="skip">유료이용내역</h2>
					<div class="positionA" style="top:-25px; right:0;">
						<select class="ipSelect2" style="width:100px;" id="" name="" title="출력수설정">
						<option value="01">20개씩 보기</option>
						<option value="02">40개씩 보기</option>
						</select>
					</div>
					<div class="customList1 mb30"> 
						<div class="selectList tl pt5 pb5">
							<dl>
								<dt class="pl10 pr10">조회기간</dt>
								<dd class="line">
									<a class="button small" href=""><span class="text_red">최근 1주일</span></a>
									<a class="button small" href=""><span>최근 1개월</span></a>
									<a class="button small" href=""><span>최근 3개월</span></a>
								</dd>
								<dd class="calendar">
									<select class="ipSelect" name="workstartmi">
									<option value="1">2013</option>
									<option value="2">00</option>
									</select> 
									년 
									<select class="ipSelect" name="workstartmi">
									<option value="1">10</option>
									<option value="2">00</option>
									</select> 
									월
									<select class="ipSelect" name="workstartmi">
									<option value="1">21</option>
									<option value="2">00</option>
									</select> 
									일 ~                      
									<select class="ipSelect" name="workstartmi">
									<option value="1">2013</option>
									<option value="2">00</option>
									</select> 
									년 
									<select class="ipSelect" name="workstartmi">
									<option value="1">10</option>
									<option value="2">00</option>
									</select> 
									월
									<select class="ipSelect" name="workstartmi">
									<option value="1">21</option>
									<option value="2">00</option>
									</select> 
									일
									<em class="pr10"><a class="button"><span>검색</span></a></em>
								</dd>
							</dl>
						</div>      
						<table cellspacing="0">
						<caption class="skip">유료이용내역</caption>
						<colgroup><col width="10px"><col width="80px"><col width="80px"><col width="*"><col width="80px"><col width="100px"><col width="80px"></colgroup>
						<thead>
						<tr>
							<th  scope="col"><input type="checkbox"  value="1" name="chkAll"></th>
							<th  scope="col">신청일</th>
							<th  scope="col">상품명</th>
							<th  scope="col">기간/건수</th>
							<th  scope="col">결제방법</th>
							<th  scope="col">결제금액</th>
							<th  scope="col">결제승인</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td class="tc no_listText" colspan="7"><span>서비스 이용내역이 없습니다.</span></td>
						</tr>
						<tr>
							<td class="tc"><input type="checkbox"  value="1" name="chkAll"></td>
							<td class="tc"><span>2013.08.15</span></td>
							<td class="tc"><span><strong>급구인재</strong></span></td>
							<td class="tl" ><span>오늘+7일(2013.04.15~2014.04.05)</span></td>
							<td class="tc"><span>무통장입금</span></td>
							<td class="tc"><span class="text_red"><strong>\1,555,000</strong></span></td>
							<td class="tc">
								<div><strong>2013.02.04</strong></div>
								<div>12:01</div>
							</td>
						</tr>
						</tbody>
						</table>
						<div class="btnBottom mt10"><a class="button white"><span>서비스연장</span></a> </div>
						<div class="paging"><!--  페이지번호  --> 
							<span class="page ">
								<a class="prev" href="#">&lt;</a>
								<a class="page now" href="#">1</a><a class="page" href="#">2</a>
								<a class="next" href="#">&gt;</a>
								<span class="location">[<strong>11</strong>/136]</span>
							</span>
						</div>
						<!--  // 페이지번호 --> 

						</div>
					</div> <!--  유료이용내역 end   --> 

				</div><!--  컨텐츠 end   --> 
			</div>
		</div>
	</div>
</section>