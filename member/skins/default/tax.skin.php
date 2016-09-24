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
		<p> <a href="/">HOME</a> > <a href="<?php echo $alice['company_path'];?>/">기업서비스</a> > <a href="<?php echo $alice['member_path'];?>/update_form.php">기업정보 관리</a> > <strong>세금계산서 발행신청</strong> </p>
		</div>
		<?php /* //navigation */ ?>
		<div class="listWrap positionR mt20">
			<h2 class="pb5"><img src="../images/tit/company_tit_08.gif" width="210" height="25" alt="세금계산서 발행신청"></h2>
			<em class="titEm mb20">
			<ul>
				<li>유료서비스 신청후 세금계산서 발행신청시 발행해드리고 있습니다. 단, 결제완료 후 세금계산서가 발행되오니 이 점 숙지하시기 바랍니다.</li>
				<li><img class="vm" width="6" height="6" src="../images/icon/icon_b.gif" alt="필수입력사항"> 표시는 필수 입력사항입니다.</li> 
			</ul>
			</em>
			<div class="companyContentWrap"><!--  컨텐츠  -->
				<div id="listForm" class="positionR mt30 clearfix" style="display:block;"> <!--  세금계산서발행신청   --> 
					<h2 class="skip">세금계산서 발행신청</h2>
					<div class="customList2 mb30">
						<div class="companyRegistWrap">
							<table>
							<caption><span class="skip">세금계산서발행신청</span></caption>
							<colgroup><col width="159px"><col width="*"></colgroup>
							<tbody>
							<tr>
								<th scope="row"> 
									<label>사업자번호<img width="6" height="6" src="../images/icon/icon_b.gif" alt="필수입력사항"></label>
								</th> 
								<td>
									<input type="text" name="" id="" maxlength="3" title="사업자번호1" class="ipText" style="width:50px;">
									<span class="delimiter">-</span>
									<input type="text" name="" id="" maxlength="2" title="사업자번호2" class="ipText" style="width:40px;">
									<span class="delimiter">-</span>
									<input type="text" name="" id="" maxlength="5" title="사업자번호3" class="ipText" style="width:70px;">
								</td>
							</tr>
							<tr>
								<th scope="row"> 
									<label>회사명<img width="6" height="6" src="../images/icon/icon_b.gif" alt="필수입력사항"></label>
								</th>
								<td><input type="text" name="" id="" style="width:200px;" class="ipText" maxlength="16"></td>
							</tr> 
							<tr>
								<th scope="row"> 
									<label>대표자명(ceo)<img width="6" height="6" src="../images/icon/icon_b.gif" alt="필수입력사항"></label>
								</th>
								<td><input type="text" name="" id="" style="width:200px;" class="ipText" maxlength="16"></td>
							</tr>
							<tr>
								<th class="vt" scope="row"><label>사업장 주소<img width="6" height="6" src="../images/icon/icon_b.gif" alt="필수입력사항"></label></th>
								<td colspan="3" class="addres">
									<div class="addresWrap">
										<div class="adress1">
											<label class="skip">우편번호</label>
											<input type="text" name="" id="" maxlength="3" title="우편번호 앞자리" class="ipText" style="width:55px;">
											<span class="delimiter">-</span>
											<input type="text" name="" id="" value="" maxlength="4" title="우편번호 뒷자리" class="ipText" style="width:55px;">
											<a class="button"><span>우편번호 검색</span></a> </div>
											<div class="adress2 mt3">
											<label class="skip">주소</label>
											<input type="text" name="" id="" maxlength="4" title="주소1" class="ipText" style="width:260px;">
											<input type="text" name="" id="" maxlength="4" title="주소2" class="ipText" style="width:260px;">
										</div>
									</div>
								</td>
							</tr> 
							<tr>
								<th scope="row"> 
									<label>업태<img width="6" height="6" src="../images/icon/icon_b.gif" alt="필수입력사항"></label>
								</th>
								<td>
									<input type="text" name="" id="" style="width:400px;" class="ipText"  maxlength="16"><em class="pl10 help">* 예: 서비스</em>
								</td>
							</tr>
							<tr>
								<th scope="row"> <label>종목</label></th>
								<td>
									<input type="text" name="" id="" style="width:400px;" class="ipText"  maxlength="16"><em class="pl10 help">* 예: 소프트웨어개발</em>
								</td>
							</tr>
							<tr>
								<th scope="row"> 
									<label>e-메일<img width="6" height="6" src="../images/icon/icon_b.gif" alt="필수입력사항"></label>
								</th>
								<td>
									<div class="emailWrap">
									<input type="hidden" name="M_Email" id="M_Email">
									<input type="text" name="" id="" maxlength="30"  style="width:150px;" class="ipText">
									<span class="delimiter">@</span>
									<input type="text" name="" id="" title="이메일 서비스 입력" maxlength="25"  class="ipText" style="width:185px">
									<select name="" id="" style="width:105px" class="ipSelect">
									<option value="etc">직접입력</option>
									<option value="naver.com">naver.com</option>
									<option value="hanmail.net">hanmail.net</option>
									<option value="nate.com">nate.com</option>
									<option value="daum.net">daum.net</option>
									<option value="gmail.com">gmail.com</option>
									<option value="dreamwiz.com">dreamwiz.com</option>
									</select>
									</div>
								</td>
							</tr>
							<tr>
								<th scope="row"> 
									<label>담당자명<img width="6" height="6" src="../images/icon/icon_b.gif" alt="필수입력사항"></label>
								</th>
								<td><input type="text" name="" id="" style="width:200px;" class="ipText"  maxlength="16"></td>
							</tr>
							<tr>
								<th scope="row"> <label>담당자연락처<img width="6" height="6" src="../images/icon/icon_b.gif" alt="필수입력사항"></label>
								</th>
								<td>
									<div class="telWrap">
										<select title="지역번호 선택" name="" id="" style="width:111px;" class="ipSelect">
										<option value="">지역번호 선택</option>
										<option value="02">02</option>
										<option value="031">031</option>
										<option value="032">032</option>
										<option value="033">033</option>
										<option value="041">041</option>
										<option value="042">042</option>
										<option value="043">043</option>
										<option value="044">044</option>
										<option value="051">051</option>
										<option value="052">052</option>
										<option value="053">053</option>
										<option value="054">054</option>
										<option value="055">055</option>
										<option value="061">061</option>
										<option value="062">062</option>
										<option value="063">063</option>
										<option value="064">064</option>
										<option value="070">070</option>
										</select>
										<span class="delimiter">-</span>
										<input type="text" name="" id="" maxlength="4" title="전화번호 앞자리" class="ipText">
										<span class="delimiter">-</span>
										<input type="text" name="" id="" value="" maxlength="4" title="전화번호 뒷자리" class="ipText">
									</div>
								</td>
							</tr>
							<tr>
								<th scope="row"> 
									<label>결제일자<img width="6" height="6" src="../images/icon/icon_b.gif" alt="필수입력사항"></label>
								</th>
								<td>
									<select name="workstartmi" class="ipSelect">
									<option value="1">2013</option>
									<option value="2">00</option>
									</select> 
									년 
									<select name="workstartmi" class="ipSelect">
									<option value="1">10</option>
									<option value="2">00</option>
									</select> 
									월
									<select name="workstartmi" class="ipSelect">
									<option value="1">21</option>
									<option value="2">00</option>
									</select> 
									일
								</td>
							</tr>
							<tr>
								<th scope="row"> 
									<label>결제금액<img width="6" height="6" src="../images/icon/icon_b.gif" alt="필수입력사항"></label>
								</th>
								<td><input type="text" name="" id="" style="width:200px;" class="ipText"  maxlength="16"> 원</td>
							</tr>
							<tr>
								<th class="bbend" scope="row"> <label>내용</label></th>
								<td class="bbend">
									<textarea name="" class="ipTextarea" id="" style="width:580px; height:100px; padding:10px;"></textarea>
								</td>
							</tr>
							</tbody>          
							</table>
						</div>
						<div style="margin:30px auto;" class="doubleBtn clearfix">
							<ul> 
								<li><div class="btn font_white bg_blueBlack"><a href="#">신청하기<img width="30" height="9" class="pb5" src="../images/icon/icon_arrow_right2.png" alt="arrow"></a></div></li>
								<li><div class="btn font_gray bg_white"><a href="#">취소<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right3.png" class="pb5"></a></div></li>
							</ul>
						</div>        
						</div>
						</div> <!--  세금계산서발행신청 end   --> 

					</div><!--  컨텐츠 end   --> 
				</div>
			</div>
		</div>
	</div>  
</section>