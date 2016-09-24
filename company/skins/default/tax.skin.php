<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
</script>

<script type="text/javascript" src="<?php echo $alice['company_path'];?>/skins/default/tax.skin.js"></script>

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
				<li><img class="vm"  src="../images/icon/icon_b.gif" alt="필수입력사항"> 표시는 필수 입력사항입니다.</li> 
			</ul>
			</em>
			<div class="companyContentWrap"><!--  컨텐츠  -->

				<div class="layerPop positionA border_color5" style="display:none; width:420px; top:238px; left:55%; text-align:left;" id="postSearchPop">
					<dl>
					<dt style="padding:20px 15px;cursor:pointer;" class="bg_gray1" id="postSearchPop_handle">
						<strong>우편번호 검색</strong>
						<em class="closeBtn"><img width="11" height="11" class="pb5" src="../images/icon/icon_close2.gif" alt="arrow"></em>
					</dt>
					<dd style="padding:20px 15px 30px;">
						<p style="padding-bottom:10px;padding-left:15px; background:url(../images/icon/icon_arrow_right1.gif) no-repeat 0 20%;">
							<strong>우편번호 검색</strong><br/>
						</p>
						<div class="box2" style="background:#F8F8F8; border:1px solid #ddd; padding:20px;">
							<ul>
								<li>
									<span>
										<label class="skip">검색어입력</label>
										<input type="text" style="width:280px;ime-mode:active;" name="postSearchKeyword" id="postSearchKeyword">
										<em class="pr10"><a class="button" onclick="postSearchs();"><span>검색</span></a></em>
									</span>
								</li>
								<li class="pt5"><em class="help text_help">※ 동명을 입력해주세요 (삼성동이면 '삼성동'만 입력).</em></li>
							</ul>
						</div>
						<!-- 결과 리스트 -->
						<div class="mt20 addressResult">
							<table width="100%" cellspacing="0" cellpadding="0" align="center" >		
							<colgroup><col width="20%"><col width="80%"></colgroup>
							<tr>
								<th><strong>우편 번호</strong></th>
								<th class=" brend"><strong>주소</strong></th>
							</tr>		
							<tbody id="post_List">
							<tr>
								<td colspan="2" style="text-align:center;height:165px;">우편번호를 검색해 주세요.</td>
							</tr>
							</tbody>
							</table>
						</div>
						<!-- 결과 리스트 -->
						</dd>
					</dl>
				</div>

				<form method="post" name="taxFrm" action="<?php echo $alice['company_path'];?>/process/tax.php" id="taxFrm">
				<input type="hidden" name="mode" value="insert"/>
				<input type="hidden" name="wr_id" value="<?php echo $member['mb_id'];?>"/>
				<input type="hidden" name="wr_name" value="<?php echo $member['mb_name'];?>"/>
				<input type="hidden" name="wr_type" value="company" id="wr_type"/>

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
									<label><img  src="../images/icon/icon_b.gif" alt="필수입력사항">사업자번호</label>
								</th> 
								<td>
									<input type="text" name="wr_biz_no[]" id="wr_biz_no_0" maxlength="3" title="사업자번호1" class="ipText" style="width:50px;" hname="사업자등록번호" required value="<?php echo $mb_biz_no[0];?>">
									<span class="delimiter">-</span>
									<input type="text" name="wr_biz_no[]" id="wr_biz_no_1" maxlength="2" title="사업자번호2" class="ipText" style="width:40px;" hname="사업자등록번호" required value="<?php echo $mb_biz_no[1];?>">
									<span class="delimiter">-</span>
									<input type="text" name="wr_biz_no[]" id="wr_biz_no_2" maxlength="5" title="사업자번호3" class="ipText" style="width:70px;" hname="사업자등록번호" required value="<?php echo $mb_biz_no[2];?>">
								</td>
							</tr>
							<tr>
								<th scope="row"> 
									<label><img  src="../images/icon/icon_b.gif" alt="필수입력사항">회사명</label>
								</th>
								<td><input type="text" name="wr_company_name" id="wr_company_name" style="width:200px;" class="ipText" maxlength="16" hname="회사명" required value="<?php echo stripslashes($company_member['mb_company_name']);?>"></td>
							</tr> 
							<tr>
								<th scope="row"> 
									<label><img  src="../images/icon/icon_b.gif" alt="필수입력사항">대표자명(ceo)</label>
								</th>
								<td><input type="text" name="wr_ceo_name" id="wr_ceo_name" style="width:200px;" class="ipText" maxlength="16" hname="대표자명" required value="<?php echo stripslashes($company_member['mb_ceo_name']);?>"></td>
							</tr>
							<tr>
								<th class="vt" scope="row"><label><img  src="../images/icon/icon_b.gif" alt="필수입력사항">사업장 주소</label></th>
								<td colspan="3" class="addres">
									<div class="addresWrap">
										<div class="adress1">
											<label class="skip">우편번호</label>
											<input type="text" style="width:55px;" class="ipText" title="우편번호 앞자리" maxlength="3" id="wr_zipcode0" name="wr_zipcode[]" readonly required hname="우편번호 앞자리" value="<?php echo $mb_zipcode[0];?>">
											<span class="delimiter">-</span>
											<input type="text" style="width:55px;" class="ipText" title="우편번호 뒷자리" maxlength="4" id="wr_zipcode1" name="wr_zipcode[]" readonly required hname="우편번호 뒷자리" value="<?php echo $mb_zipcode[1];?>">
											<a class="button" onclick="postSearchPops();"><span>우편번호 검색</span></a> </div>
											<div class="adress2 mt3">
											<label class="skip">주소</label>
											<input type="text" style="width:300px;" class="ipText" title="주소" id="wr_address0" name="wr_address0" required hname="주소" value="<?php echo $member['mb_address0'];?>">
											<input type="text" style="width:350px;" class="ipText" title="상세주소" id="wr_address1" name="wr_address1" required hname="상세주소" value="<?php echo $member['mb_address1'];?>">
										</div>
									</div>
								</td>
							</tr> 
							<tr>
								<th scope="row"> 
									<label><img  src="../images/icon/icon_b.gif" alt="필수입력사항">업태</label>
								</th>
								<td>
									<input type="text" name="wr_condition" id="wr_condition" style="width:400px;" class="ipText"  maxlength="16" required hname="업태"><em class="pl10 help">* 예: 서비스</em>
								</td>
							</tr>
							<tr>
								<th scope="row"><label class="pl10">종목</label></th>
								<td>
									<input type="text" name="wr_item" id="wr_item" style="width:400px;" class="ipText"  maxlength="16"><em class="pl10 help" hname="종목">* 예: 소프트웨어개발</em>
								</td>
							</tr>
							<tr>
								<th scope="row"> 
									<label><img  src="../images/icon/icon_b.gif" alt="필수입력사항">e-메일</label>
								</th>
								<td>
									<div class="emailWrap">
										<input type="text" class="ipText" style="width:150px;ime-mode:disabled;" maxlength="30" id="wr_email" name="wr_email[]" required hname="이메일" value="<?php echo $mb_email[0];?>">
										<span class="delimiter">@</span>
										<input type="text" style="width:185px" class="ipText" maxlength="25" title="이메일 서비스 제공자" id="wr_email_tail" name="wr_email[]" required hname="이메일 서비스 제공자" value="<?php echo $mb_email[1];?>">
										<select class="ipSelect" style="width:105px;" id="email_service" onchange="email_sel(this);">
										<option value="">직접입력</option>
										<?php echo $email_option; ?>
										</select>
									</div>
								</td>
							</tr>
							<tr>
								<th scope="row"> 
									<label><img  src="../images/icon/icon_b.gif" alt="필수입력사항">담당자명</label>
								</th>
								<td><input type="text" name="wr_manager" id="wr_manager" style="width:200px;" class="ipText"  maxlength="16" required hname="담당자명"></td>
							</tr>
							<tr>
								<th scope="row"> <label><img  src="../images/icon/icon_b.gif" alt="필수입력사항">담당자연락처</label>
								</th>
								<td>
									<div class="telWrap">
										<select title="지역번호 선택" name="wr_phone[]" id="wr_phone_0" style="width:111px;" class="ipSelect" hname="지역번호" required>
										<option value="">지역번호 선택</option>
										<?php echo $tel_num_option; ?>
										</select>
										<span class="delimiter">-</span>
										<input type="text" name="wr_phone[]" id="wr_phone_1" maxlength="4" title="전화번호 앞자리" class="ipText" hname="전화번호 앞자리" required value="<?php echo $mb_phone[1];?>">
										<span class="delimiter">-</span>
										<input type="text" name="wr_phone[]" id="wr_phone_2" maxlength="4" title="전화번호 뒷자리" class="ipText" hname="전화번호 뒷자리" required value="<?php echo $mb_phone[2];?>">
									</div>
								</td>
							</tr>
							<tr>
								<th scope="row"> 
									<label><img  src="../images/icon/icon_b.gif" alt="필수입력사항">결제일자</label>
								</th>
								<td>
									<select name="wr_pay_date[]" class="ipSelect">
										<option value="<?php echo date('Y');?>"><?php echo date('Y');?></option>
										<?php $j = 1; for($i = (date('Y')-3); $i < (date('Y')-1); $i++){ ?>
										<option value="<?php echo date('Y')-$j;?>"><?php echo date('Y')-$j;?></option>
										<?php $j++; } ?>
									</select> 
									년 
									<select name="wr_pay_date[]" class="ipSelect">
										<?php for($i=1;$i<=12;$i++){ ?>
										<option value="<?php echo sprintf('%02d',$i);?>"><?php echo sprintf('%02d',$i);?></option>
										<?php } ?>
									</select> 
									월
									<select name="wr_pay_date[]" class="ipSelect">
										<?php for($i=1;$i<=31;$i++){ ?>
										<option value="<?php echo sprintf('%02d',$i);?>"><?php echo sprintf('%02d',$i);?></option>
										<?php } ?>
									</select> 
									일
								</td>
							</tr>
							<tr>
								<th scope="row"> 
									<label><img  src="../images/icon/icon_b.gif" alt="필수입력사항">결제금액</label>
								</th>
								<td><input type="text" name="wr_price" id="wr_price" style="width:200px;" class="ipText"  maxlength="16"> 원</td>
							</tr>
							<tr>
								<th class="bbend" scope="row"> <label class="pl10">내용</label></th>
								<td class="bbend">
									<textarea name="wr_content" class="ipTextarea" id="wr_content" style="width:580px; height:100px; padding:10px;"></textarea>
								</td>
							</tr>
							</tbody>          
							</table>
						</div>
						<div style="margin:30px auto;" class="doubleBtn clearfix">
							<ul> 
								<li><div class="btn font_white bg_blueBlack"><a href="javascript:taxFrmSubmit();">신청하기<img width="30" height="9" class="pb5" src="../images/icon/icon_arrow_right2.png" alt="arrow"></a></div></li>
								<li><div class="btn font_gray bg_white"><a href="#">취소<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right3.png" class="pb5"></a></div></li>
							</ul>
						</div>        
						</div>
						</div> <!--  세금계산서발행신청 end   --> 
					
						</form>

					</div><!--  컨텐츠 end   --> 
				</div>
			</div>
		</div>
	</div>  
</section>