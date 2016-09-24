<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
</script>

<script type="text/javascript" src="<?php echo $alice['service_path'];?>/skins/default/cs_center.skin.js"></script>

<section id="content" class="content_wrap clearfix">
	<div class="content1_wrap clearfix"> 
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<?php /* navigation */ ?>
	<div class="NowLocation mt20 clearfix">
		<p> <a href="/">HOME</a> >  <strong>고객센터</strong> </p>
	</div>
	<?php /* //navigation */ ?>

	<!--  content -->
		<div class="company mt30">
			<h2 class="pb5"><img src="../images/tit/etc_tit_05.gif" alt="고객센터"></h2>
			<em class="titEm mb20">
			<ul>
				<li>문의사항,불편사항 및 기타의견을 보내주시면 담당자 확인 후 이메일 혹은 연락처로 연락드리겠습니다.</li>
				<li>한번 등록한 상담내용은 수정이 불가능합니다.</li>
			</ul>
			</em>
			<p class="help" style="text-align:right;">
            <img src="../images/icon/icon_b.gif" alt="필수입력사항">표시는 필수 입력사항 입니다. 
            </p>

			<form method="post" name="serviceFrm" action="<?php echo $alice['service_path'];?>/process/regist.php" id="serviceFrm">
			<input type="hidden" name="mode" value="qna_insert"/>
			<input type="hidden" name="ajax" value="1"/>
			<input type="hidden" name="wr_id" value="<?php echo $member['mb_id'];?>"/>
			<input type="hidden" name="wr_type" value="0"/>

			<div class="registWrap mt10">
				<table>
				<colgroup><col width="214px"><col width="*"></colgroup>
				<tbody>
				<tr>
					<th scope="row"><label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >문의분류</label></th>
					<td>
						<?php 
							foreach($cs_category as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
						?>
							<input type="radio" class="chk" name="wr_cate" id="wr_cate_<?php echo $val['code'];?>" value="<?php echo $val['code'];?>" hname="문의분류" required option="radio" /> <label for="wr_cate_<?php echo $val['code'];?>"><?php echo $name;?></label>
						<?php } ?>
					</td>
				</tr>
				<?php if($is_member){ ?>
					<input type="hidden" name="wr_name" value="<?php echo $member['mb_name'];?>"/>
				<?php } else { ?>
				<tr>
					<th scope="row"> <label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >이름</label></th>
					<td><input type="text" maxlength="16" class="ipText" style="width:200px;" name="wr_name" id="wr_name" hname="이름" required></td>
				</tr>
				<?php } ?>
				<tr>
					<th scope="row"><label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >휴대폰</label></th>
					<td>
						<div class="mobile">
						<select class="ipSelect" style="width:110px;" name="wr_hphone[]" id="wr_hphone0" title="휴대폰 국번" hname="휴대폰 국번" required option="select">
						<option value="">국번</option>
						<?php echo $hp_num_option; ?>
						</select>
						</select>
						<span class="delimiter">-</span>
						<input type="text" class="ipText" style="width:120px;" title="휴대폰 앞자리" maxlength="4" name="wr_hphone[]" id="wr_hphone1" hname="휴대폰 앞자리" required value="<?php echo $hphone_num[1];?>">
						<span class="delimiter">-</span>
						<input type="text" class="ipText" style="width:120px;" title="휴대폰 뒷자리" maxlength="4" name="wr_hphone[]" id="wr_hphone2" hname="휴대폰 뒷자리" required value="<?php echo $hphone_num[2];?>">
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"><label>전화번호</label></th>
					<td>
						<div class="mobile">
						<select class="ipSelect" style="width:110px;" name="wr_phone[]" id="wr_phone0" title="전화번호 국번" hname="전화번호 국번">
						<option value="">국번</option>
						<?php echo $tel_num_option; ?>
						</select>
						</select>
						<span class="delimiter">-</span>
						<input type="text" class="ipText" style="width:120px;" title="전화번호 앞자리" maxlength="4" name="wr_phone[]" id="wr_phone1" hname="전화번호 앞자리" value="<?php echo $phone_num[1];?>">
						<span class="delimiter">-</span>
						<input type="text" class="ipText" style="width:120px;" title="전화번호 뒷자리" maxlength="4" name="wr_phone[]" id="wr_phone2" hname="전화번호 뒷자리" value="<?php echo $phone_num[2];?>">
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row" class="vt"><label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >e-mail</label></th>
					<td>
						<div class="mbrHelpWrap">
							<input type="text" class="ipText" style="width:150px;ime-mode:disabled;" maxlength="30" id="wr_email" name="wr_email[]" hname="이메일" required value="<?php echo $mb_email[0];?>">
							<span class="delimiter">@</span>
							<input type="text" style="width:185px;ime-mode:disabled;" class="ipText" maxlength="25" title="이메일 서비스 입력" id="wr_email_tail" name="wr_email[]" value="<?php echo $mb_email[1];?>">
							<select class="ipSelect" style="width:105px;" id="email_service" onchange="email_sel(this);">
							<option value="">직접입력</option>
							<?php echo $email_option; ?>
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"> <label>홈페이지주소</label></th>
					<td> http://
						<input type="text" style="width:490px;" class="ipText" title="홈페이지주소" id="wr_site" name="wr_site" value="<?php echo $utility->remove_http($member['mb_homepage']);?>">
					</td>
				</tr>
				<tr>
					<th scope="row"><label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >제목</label></th>
					<td><input type="text" class="ipText" style="width:530px;" id="wr_subject" name="wr_subject" hname="제목" required></td>
				</tr>
				<tr>
					<th scope="row"> <label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >내용</label></th>
					<td><?php echo $utility->make_cheditor('wr_content', "");	// 에디터 생성?></td>
				</tr>
				<?php
				if($is_guest){
					if($env['article_denied']=='1'){	// kcaptcha 이미지
				?>
				<tr>
					<th class="bbend" scope="row"> <label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >자동등록방지</label></th>
					<td class="bbend">
						<b class="fon13 red"><img id='kcaptcha_image' /></b>&nbsp;
						<input name='wr_key' type='input' class="ipText" size='15'  hname="자동등록방지" required id='wr_key'>
						<span class="st11">왼쪽에 보이는 문자대로 입력해주세요.</span>
						<script type="text/javascript" src="<?php echo $alice['js_plugin']."/jquery.kcaptcha.js"?>"></script>
					</td>
				</tr>
				<?php } else if($env['article_denied']=='2'){	// 임의 난수 ?>
				<tr>
					<th class="bbend" scope="row"> <label>자동등록방지<img alt="필수입력사항" src="../images/icon/icon_b.gif" ></label></th>
					<td class="bbend">
						
					</td>
				</tr>
				<?php
					}	// article_denied if end.
				}	// is_guest if end.
				?>
				</tbody>
				</table>
			</div>

			</form>

			</div>
			<div style="margin:30px auto;" class="doubleBtn clearfix">
			<ul> 
				<li><div class="btn font_white bg_blueBlack"><a href="javascript:csSubmit();">등록하기<img width="30" height="9" class="pb5" src="../images/icon/icon_arrow_right2.png" alt="arrow"></a></div></li>
				<li><div class="btn font_gray bg_white"><a href="/">돌아가기<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right3.png" class="pb5"></a></div></li>
			</ul>
		</div>    <!--  content end --> 
	</div>
</section>