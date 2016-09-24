<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
var mode = "<?php echo $mode;?>";
var use_map = "<?php echo $use_map;?>";
var daum_local_APIKEY = "<?php echo $daum_local_key;?>";
var naver_map_KEY = "<?php echo $naver_map_key;?>";
$(function(){
	$('#wr_person').focus();
	$('#AlbaFrm').submit(function(){
		<?php echo $utility->input_cheditor('wr_content');?>	// 에디터 내용 전달
	});
	$('#wr_pay').autoNumeric('init');
});
var mb_logo = "<?php echo $mb_logo;?>";
var mb_company_name = "<?php echo $company_member['mb_company_name'];?>";
var mb_ceo_name = "<?php echo $company_member['mb_ceo_name'];?>";
var mb_biz_no = "<?php echo $company_member['mb_biz_no'];?>";
var mb_biz_address = "[<?php echo $member['mb_zipcode'];?>] <?php echo $member['mb_address0']." ".$member['mb_address1'];?>";
var mb_photo_0 = "<?php echo $photo_0;?>";
var mb_photo_1 = "<?php echo $photo_1;?>";
var mb_photo_2 = "<?php echo $photo_2;?>";
var mb_photo_3 = "<?php echo $photo_3;?>";
</script>
<script type="text/javascript" src="<?php echo $alice['js_i18n'];?>/jquery.ui.datepicker-ko.js?t=<?php echo date('YmdH');?>"></script>
<script type="text/javascript" src="<?php echo $alice['company_path'];?>/skins/default/alba_regist.js"></script>
<?php echo $map_script;?>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent"> 
		<?php /* navigation */ ?>
		<div class="NowLocation mt20 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['company_path'];?>/">기업서비스</a> > <strong>채용공고 등록</strong> </p>
		</div>
		<?php /* //navigation */ ?>

		<form method="post" name="MemberUpdateFrm" action="<?php echo $alice['member_path'];?>/process/regist.php" id="MemberUpdateFrm" enctype="multipart/form-data">
		<input type="hidden" name="ajax" value="true"/>
		<input type="hidden" name="mode" value="photo_upload" id="upload_mode"/>
		<input type="hidden" name="mb_type" value="<?php echo $mb_type;?>"/>
		<input type="hidden" name="mb_id" value="<?php echo $member['mb_id'];?>"/>
		<input type="hidden" name="no" value="<?php echo $member['no'];?>"/>
		<input type="hidden" name="company_no" value="<?php echo $company_member['no'];?>" id="company_no"/>

		<input type="hidden" name="company_logo_info" id="company_logo_info"/>

		<!--  회사정보  -->
		<div class="listWrap positionR mt30">
			<h2 class="pb5"> <img src="../images/tit/company_nav_tit_01.gif" width="90" height="25" alt="회사정보"> <em class="positionA" style="top:10px; right:0;"><span class="pr10"><img class="vm" style="margin-top:-2px;" src="../images/icon/icon_b.gif" alt="필수입력사항">표시는 필수 입력사항 입니다.</span>
				<select title="기업정보 불러오기" name="company_list" id="company_list" style="padding-bottom:10px;" class="ipSelect" onchange="company_info_load(this);">
				<option value="">기업정보 선택</option>
				<?php foreach($company_list['result'] as $val){ ?>
				<option value="<?php echo $val['no'];?>" <?php echo ($val['no']==$company_member['no'])?'selected':'';?>><?php echo $val['mb_ceo_name']." / ".$val['mb_company_name'];?></option>
				<?php } ?>
				</select>
				<?php /* ?><!-- <a class="button" href="<?php echo $alice['member_path'];?>/update_form.php"><span>기업정보수정</span></a> --><?php */ ?>
			</em></h2>
			<div class="registWrap">
			<table>
    <caption><span class="skip">회사정보</span></caption>
    <colgroup><col width="210px"><col width="140px"><col width="*"></colgroup>
    <tbody>
    <tr>
        <td class="first" rowspan="4">

			<!-- width="200" height="100" -->
			<img src="<?php echo $alba_logo;?>" alt="<?php echo $company_member['mb_company_name'];?> 로고" id="companylogo" style="max-width:200px; max-height:100px;" />

			<!--  로고등록 창 layer -->
			<div style="text-align:left; left:25%; top:0; display:none;" class="layerPop positionA border_color5" id="LogoPop">
				<dl style="">
					<dt class="bg_gray1" id="LogoPop_handle" style="padding:20px 15px; cursor:pointer;">
						<strong>로고 등록</strong>
						<em class="closeBtn" onclick="logo_close();"><img width="11" height="11" alt="arrow" src="../images/icon/icon_close2.gif" class="pb5"></em>
					</dt>
					<dd style="padding:10px 15px;">
						<p style="padding-bottom:20px;">
							<strong>GIF,JPEG,JPG</strong> 파일형식으로,<br>
							<strong>200*100픽셀, 100KB</strong> 용량 이내의 파일만 등록 가능합니다.<br>
						</p>
						<div style="padding:10px; border-width:1px; border-color:rgb(208,208,208); border-style:solid;" class="box2">
							<input type="file" class="txtForm" style="height:20px;" size="32" id="mb_logo" name="mb_logo">
						</div>
						<div class="btn font_gray bg_white" style="margin-top:20px; margin-right:auto; margin-bottom:20px; margin-left:auto;">
							<a href="javascript:logo_submit();">등록하기<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right3.png" class="pb5"></a>
						</div>
					</dd>
				</dl>
			</div>
			<!--  //로고등록 창 layer -->

			<table class="mt10">
			<caption><span class="skip">회사정보</span></caption>
			<tr>
				<td class="bbend">
					<a class="button white" onclick="logo_pop();">
						<span id="companyphoto_status"><?php echo ($company_member['mb_logo'])?'수정':'등록';?><img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span>
					</a>
					<span id="logo_remove" style="display:<?php echo ($company_member['mb_logo']&&!$company_member['mb_logo_sel'])?'':'none';?>;">
						<a class="button white" onclick="logo_remove('<?php echo $company_member['no'];?>');"><span>삭제<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span></a>
					</span>
					<?//php if($member['mb_homepage']){ ?>
					<div class="url mt10" id="mb_homepage_display" style="display:<?php echo ($company_member['mb_homepage'])?'':'none';?>;"><a href="<?php echo $utility->add_http($company_member['mb_homepage']);?>" target="_blank" id="mb_homepage"><?php echo $utility->add_http($company_member['mb_homepage']);?></a></div>
					<?//php } ?>
				</td>
			</tr>
			</table>
        </td>
        <th class="companytitWrap" scope="row">  <label>회사/점포명</label></th>
        <td><strong id="company_name"><?php echo $company_member['mb_company_name'];?></strong></td>
    </tr>
    <tr>
        <th class="companytitWrap" scope="row">  <label>대표자명(ceo)</label></th>
        <td id="ceo_name"><?php echo $company_member['mb_ceo_name'];?></td>
    </tr>
    <tr>
        <th class="companytitWrap" scope="row"><label>사업자등록번호</label></th>
        <td id="biz_no"><?php echo $company_member['mb_biz_no'];?></td>
    </tr>
    <tr>
        <th class="companytitWrap" scope="row">  <label>회사/점포주소</label></th>
        <td id="biz_address">[<?php echo $member['mb_zipcode'];?>]  <?php echo $member['mb_address0']." ".$member['mb_address1'];?></td>
    </tr>
    <tr>
        <td class="bbend first" style="padding-top: 0px; padding-bottom: 0px;"colspan="3">
            <table>
                <caption><span class="skip">회사정보</span></caption>
                <tr>
                    <th class="pt10 companytitWrap bbend vt" style="background-color:#f9f9f9; font-weight:bold;border-right:1px solid #e7e7e9;width:209px;" scope="row"><label>회사이미지</label></th>
                    <td class="bbend">
                        <!--  사진등록 layer  -->
                        <div class="layerPop positionA border_color5" style="text-align:left; left:25%; top:30%; display:none;" id="companyPhotoPop">
						<input type="hidden" name="mb_photos" id="mb_photos" />
                            <dl style="">
                                <dt style="padding:20px 15px;cursor:pointer;" class="bg_gray1" id="companyPhotoPop_handle">
								<strong>회사이미지 등록</strong>
								<em class="closeBtn" onclick="close_company_photos()"><img width="11" height="11" class="pb5" src="../images/icon/icon_close2.gif" alt="arrow"></em>
							</dt>
                                <form name="form1">
                                    <dd style="padding:10px 15px;">
                                        <p style="padding-bottom:20px;">
											<strong>GIF,JPEG,JPG</strong> 파일형식으로,<br>
											<strong>500KB</strong> 용량 이내의 파일만 등록 가능합니다.<br>
										</p>
                                        <div class="box2" style="padding:10px; border-width:1px; border-color:rgb(208,208,208); border-style:solid;">
											<input type="file" name="photo_files" id="photo_files" size="32" style="height:20px;" class="txtForm">
                                        </div>
                                        <div style="margin-top:20px; margin-right:auto; margin-bottom:20px; margin-left:auto;" class="btn font_gray bg_white"><a href="javascript:photo_submit();">등록하기<img width="30" height="9" class="pb5" src="../images/icon/icon_arrow_right3.png" alt="arrow"></a></div>
                                    </dd>
                                </form>
                            </dl>
                        </div>
                        <!--  //사진등록 layer   -->

                        <div class="photoWrap clearfix pt5 pl15">
                            <ul>
                                <li>
                                    <div class="photo"><img src="<?php echo $photo_0;?>" width="155" height="100" alt="photo" id="mb_photo_0"> </div>
                                    <div class="buttonWrap">
								<a class="button white" onclick="update_company_photos('update', 0);" id="update_0"> <span>등록<img class="pl5" src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span> </a>
								<a  class="button white" onclick="update_company_photos('delete', 0, '<?php echo $company_member['no'];?>');" id="delete_0"> <span>삭제<img class="pl5" src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span> </a> 
                                    </div>
                                </li>
                                <li>
                                    <div class="photo"><img src="<?php echo $photo_1;?>" width="155" height="100" alt="photo" id="mb_photo_1"> </div>
                                    <div class="buttonWrap">
								<a class="button white" onclick="update_company_photos('update', 1);" id="update_1"> <span>등록<img class="pl5" src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span> </a>
								<a  class="button white" onclick="update_company_photos('delete', 1, '<?php echo $company_member['no'];?>');" id="delete_1"> <span>삭제<img class="pl5" src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span> </a> 
                                    </div>
                                </li>
                                <li>
                                    <div class="photo"><img src="<?php echo $photo_2;?>" width="155" height="100" alt="photo" id="mb_photo_2"> </div>
                                    <div class="buttonWrap">
								<a class="button white" onclick="update_company_photos('update', 2);" id="update_2"> <span>등록<img class="pl5" src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span> </a>
								<a  class="button white" onclick="update_company_photos('delete', 2, '<?php echo $company_member['no'];?>');" id="delete_2"> <span>삭제<img class="pl5" src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span> </a> 
                                    </div>
                                </li>
                                <li>
                                    <div class="photo"><img src="<?php echo $photo_3;?>" width="155" height="100" alt="photo" id="mb_photo_3"> </div>
                                    <div class="buttonWrap">
								<a class="button white" onclick="update_company_photos('update', 3);" id="update_3"> <span>등록<img class="pl5" src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span> </a>
								<a  class="button white" onclick="update_company_photos('delete', 3, '<?php echo $company_member['no'];?>');" id="delete_3"> <span>삭제<img class="pl5" src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span> </a> 
                                    </div>
                                </li>
                                <li>
                                    <div class="photo"><img src="<?php echo $photo_4;?>" width="155" height="100" alt="photo" id="mb_photo_4"> </div>
                                    <div class="buttonWrap">
								<a class="button white" onclick="update_company_photos('update', 4);" id="update_4"> <span>등록<img class="pl5" src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span> </a>
								<a  class="button white" onclick="update_company_photos('delete', 4, '<?php echo $company_member['no'];?>');" id="delete_4"> <span>삭제<img class="pl5" src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span> </a> 
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    </tbody>
</table>
			</div>
		</div>
		<!--  //회사정보  --> 

		</form>

		<form method="post" name="AlbaFrm" action="<?php echo $alice['company_path'];?>/process/alba.php" id="AlbaFrm" enctype="multipart/form-data" onsubmit="return validate(this);">
		<input type="hidden" name="mode" value="<?php echo $mode;?>" id="mode"/>
		<input type="hidden" name="mb_type" value="<?php echo $mb_type;?>"/>
		<input type="hidden" name="mb_id" value="<?php echo $member['mb_id'];?>"/>
		<input type="hidden" name="mb_no" value="<?php echo $member['no'];?>"/>
		<input type="hidden" name="page_rows" value="<?php echo $page_rows;?>"/>
		<input type="hidden" name="page" value="<?php echo $page;?>"/>
		<?php if($mode=='update' || $mode=='reinsert' || $mode=='load'){ // 수정/재등록/불러오기 일때 ?>
		<input type="hidden" name="no" value="<?php echo $get_alba['no'];?>"/>
		<?php } ?>
		<input type="hidden" name="type" value="<?php echo ($type)?$type:$mode;?>"/>
		<input type="hidden" name="company_info" id="company_info" value="<?php echo ($get_alba['company_no'])?$get_alba['company_no']:$company_member['no'];?>"/>
		<input type="hidden" name="wr_area_point" value="<?php echo ($mode=='insert')?"":$wr_area_point;?>" id="wr_area_point"/>

		<?php if($mode=='insert'||$mode=='load'){	// 등록/불러오기 일때만 ?>
		<div class="positionR mt20 clearfix" style="border:1px solid #ddd;padding:10px; background:#edf1fb;">
			<em>채용공고를 작성하실때 과거 채용공고의 저장된 내용을 불러와서 사용하실 수 있습니다.</em>
			<span class="positionA" style="top:5px; right:5px;">
			<select title="과거 채용공고 불러오기" name="past_list" id="past_list" style="width:170px;" class="ipSelect" onchange="past_load(this);">
				<option value="">과거 채용공고 불러오기</option>
				<?php foreach($past_list as $val){ ?>
				<option value="<?php echo $val['no'];?>"><?php echo stripslashes($val['wr_subject']);?></option>
				<?php } ?>
			</select>      
			</span> 
		</div>
		<?php } ?>

		<!--  담당자 정보  -->
		<div class="listWrap mt30">
			<h2 class="pb5"> <img src="../images/tit/company_nav_tit_02.gif" width="120" height="25"  alt="담당자정보"> </h2>
			<div class="registWrap">
			<table>
			<caption><span class="skip">담당자 정보 입력</span></caption>
			<colgroup><col width="159px"><col width="*"></colgroup>
			<tbody>
			<?php if($form_person['view']=='yes'){ ?>

			<tr id="manager_info" style="display:<?php echo ($manager_info['result'])?'':'none';?>;">
				<th scope="row">담당자 선택</td>
				<td>
					<?php 
					if($manager_info['result']){
						echo "<select name=\"manager_sel\" id=\"manager_sel\" onchange=\"manager_sels(this);\">";
						echo "<option value=\"\">담당자명</option>";
						foreach($manager_info['result'] as $val){
							$selected = ($val['wr_email']==$get_alba['wr_email'])?"selected":"";
							echo "<option value=\"".$val['no']."\" ".$selected.">".stripslashes($val['wr_name'])."</option>";
						}
						echo "</select>";
					}	// if end.
					?>
				</td>
			</tr>
			<tr>
				<th scope="row"> <label><?php if($form_person['etc_0']){ ?><img alt="필수입력사항" src="../images/icon/icon_b.gif" ><?php } ?>담당자명</label></th>
				<td><input type="text" maxlength="16" class="ipText" style="width:200px;ime-mode:active;" name="wr_person" id="wr_person" <?php echo ($form_person['etc_0'])?'required':'';?> hname="담당자명" value="<?php echo $get_alba['wr_person'];?>"></td>
			</tr>
			<?php } ?>
			<?php if($form_phone['view']=='yes'){ ?>
			<tr>
				<th scope="row"> <label><?php if($form_phone['etc_0']){ ?><img alt="필수입력사항" src="../images/icon/icon_b.gif" ><?php } ?>전화번호</label></th>
				<td>
					<div class="telWrap">
					<select class="ipSelect" style="width:111px;" id="wr_phone0" name="wr_phone[]" title="지역번호 선택" <?php echo ($form_phone['etc_0'])?'required':'';?> hname="지역번호">
					<option value="">지역번호 선택</option>
					<?php echo $tel_num_option; ?>
					</select>
					<span class="delimiter">-</span>
					<input type="text" class="ipText" title="전화번호 앞자리" maxlength="4" id="wr_phone1" name="wr_phone[]" value="<?php echo $wr_phone[1];?>" <?php echo ($form_phone['etc_0'])?'required':'';?> hname="전화번호 앞자리">
					<span class="delimiter">-</span>
					<input type="text" class="ipText" title="전화번호 뒷자리" maxlength="4" id="wr_phone2" name="wr_phone[]" value="<?php echo $wr_phone[2];?>" <?php echo ($form_phone['etc_0'])?'required':'';?> hname="전화번호 뒷자리">
					</div>
				</td>
			</tr>
			<?php } ?>
			<?php if($form_hphone['view']=='yes'){ ?>
			<tr>
				<th scope="row"> <label><?php if($form_hphone['etc_0']){ ?><img alt="필수입력사항" src="../images/icon/icon_b.gif" ><?php } ?>휴대폰</label></th>
				<td>
					<div class="telWrap">
					<select class="ipSelect" style="width:111px;" id="wr_hphone0" name="wr_hphone[]" title="휴대폰 국번" <?php echo ($form_hphone['etc_0'])?'required':'';?> hname="휴대폰 국번">
					<option value="">국번</option>
					<?php echo $hp_num_option; ?>
					</select>
					<span class="delimiter">-</span>
					<input type="text" class="ipText" title="휴대폰 앞자리" maxlength="4" id="wr_hphone1" name="wr_hphone[]" value="<?php echo $wr_hphone[1];?>" <?php echo ($form_hphone['etc_0'])?'required':'';?> hname="휴대폰 앞자리">
					<span class="delimiter">-</span>
					<input type="text" class="ipText" title="휴대폰 뒷자리" maxlength="4" id="wr_hphone2" name="wr_hphone[]" value="<?php echo $wr_hphone[2];?>" <?php echo ($form_hphone['etc_0'])?'required':'';?> hname="휴대폰 뒷자리">
					</div>
				</td>
			</tr>
			<?php } ?>
			<?php if($form_fax['view']=='yes'){ ?>
			<tr>
				<th scope="row"> <label><?php if($form_fax['etc_0']){ ?><img alt="필수입력사항" src="../images/icon/icon_b.gif" ><?php } ?>팩스번호</label></th>
				<td>
					<div class="telWrap">
					<select class="ipSelect" style="width:111px;" id="wr_fax0" name="wr_fax[]" title="지역번호 선택" <?php echo ($form_fax['etc_0'])?'required':'';?> hname="지역번호">
					<option value="">지역번호 선택</option>
					<?php echo $fax_num_option; ?>
					</select>
					<span class="delimiter">-</span>
					<input type="text" class="ipText" title="팩스번호 앞자리" maxlength="4" id="wr_fax1" name="wr_fax[]" value="<?php echo $wr_fax[1];?>" <?php echo ($form_fax['etc_0'])?'required':'';?> hname="팩스번호 앞자리">
					<span class="delimiter">-</span>
					<input type="text" class="ipText" title="팩스번호 뒷자리" maxlength="4" id="wr_fax2" name="wr_fax[]" value="<?php echo $wr_fax[2];?>" <?php echo ($form_fax['etc_0'])?'required':'';?> hname="팩스번호 뒷자리">
					</div>
				</td>
			</tr>
			<?php } ?>
			<?php if($form_email['view']=='yes'){ ?>
			<tr>
				<th scope="row"> <label><?php if($form_email['etc_0']){ ?><img alt="필수입력사항" src="../images/icon/icon_b.gif" ><?php } ?>e-메일</label></th>
				<td>
					<div class="emailWrap">
						<input type="text" class="ipText" style="width:150px;ime-mode:disabled;" maxlength="30" id="wr_email" name="wr_email[]" <?php echo ($form_email['etc_0'])?'required':'';?> hname="이메일" value="<?php echo $wr_email[0];?>">
						<span class="delimiter">@</span>
						<input type="text" style="width:185px;ime-mode:disabled;" class="ipText" maxlength="25" title="이메일 서비스 입력" id="wr_email_tail" name="wr_email[]" <?php echo ($form_email['etc_0'])?'required':'';?> hname="이메일 서비스 제공자" value="<?php echo $wr_email[1];?>">
						<select class="ipSelect" style="width:105px;" id="email_service" onchange="email_sel(this);">
						<option value="">직접입력</option>
						<?php echo $email_option; ?>
						</select>
					</div>
				</td>
			</tr>
			<?php } ?>
			<?php if($form_homepage['view']=='yes'){ ?>
			<tr>
				<th scope="row"  class="bbend"> <label><?php if($form_homepage['etc_0']){ ?><img alt="필수입력사항" src="../images/icon/icon_b.gif" ><?php } ?>홈페이지(블로그)</label></th>
				<td  class="bbend">
					<input type="text" class="ipText" style="width:410px;ime-mode:inactive;" id="wr_page" name="wr_page" <?php echo ($form_homepage['etc_0'])?'required':'';?> hname="홈페이지" value="<?php echo ($get_alba['form_homepage'])?$get_alba['form_homepage']:$company_member['mb_homepage'];?>" placeholder="http://">
				</td>
			</tr>
			<?php } ?>
			</tbody>
			</table>
			</div>
		</div>
		<!-- // 담당자 정보  --> 

		<!--  업무내용 및 근무지정보  -->
		<div class="listWrap mt30">
			<h2 class="pb5"> <img src="../images/tit/company_nav_tit_03.gif" width="240" height="25" alt="업무내용"> </h2>

			<div class="registWrap">
			<table>
			<caption><span class="skip">회사정보 입력</span></caption>
			<colgroup><col width="159px"><col width="*"></colgroup>
			<tbody>
			<?php /* ?>
			<tr id="company_info_block" style="display:<?php echo ($company_list['result'])?'':'none';?>;">
				<th scope="row"> <label>기업정보</label></th>
				<td>
					<span id="company_info_display">
						<select name="company_info" onchange="company_info_load(this);">
						<option value="">기업정보 선택</option>
						<?php foreach($company_list['result'] as $val){ ?>
						<option value="<?php echo $val['no'];?>"><?php echo $val['mb_ceo_name']." / ".$val['mb_company_name'];?></option>
						<?php } ?>
						</select>
					</span>
				</td>
			</tr>
			<?php */ ?>
			<tr>
				<th scope="row"> <label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >근무회사/점포명</label></th>
				<td><input type="text" maxlength="16" class="ipText" style="width:200px;" id="wr_company_name" name="wr_company_name" required hname="근무회사/점포명" value="<?php echo stripslashes($get_alba['wr_company_name']);?>"></td>
			</tr>
			<tr>
				<th scope="row"> <label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >채용제목</label></th>
				<td><input type="text" class="ipText" style="width:480px;" id="wr_subject" name="wr_subject" required hname="채용제목" value="<?php echo $wr_subject;?>"></td>
			</tr>


			<tr>
				<th scope="row"> <label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >업직종</label></th>
				<td>

					<div class="partWrap" id="wr_jobtype_block_0">

						<select class="ipSelect" style="width:180px;" id="wr_jobtype_00" name="wr_job_type0" title="1차 직종선택" onchange="job_type_sel_first(this,'wr_job_type1');" required hname="1차직종">
						<option value="">= 1차 직종선택 =</option>
						<?php 
						if($job_type_list){
							foreach($job_type_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$selected = ($wr_job_type0 == $val['code']) ? "selected" : "";
						?>
						<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php 
							}	// foreach end.
						} // if end.
						?>
						</select>

						<span id="wr_job_type1_display">
							<select class="ipSelect" style="width:180px;" id="wr_jobtype_01" name="wr_job_type1" title="2차직종선택" onchange="job_type_sel_first(this,'wr_job_type2');">
							<option value="">= 2차 직종선택 =</option>
							<?php
							if($wr_job_type1){
								$pcodeList = $category_control->category_pcodeList('job_type', $wr_job_type0);
								if($pcodeList){
									foreach($pcodeList as $val){ 
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									$selected = ($wr_job_type1 == $val['code']) ? "selected" : "";
							?>
									<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
							<?php 
									}	// foreach end.
								}	// if end.
							} else {
							?>
								<option value="">1차 직종을 먼저 선택해 주세요</option>
							<?php
							}	// if end.
							?>
							</select>
						</span>

						<span id="wr_job_type2_display">
							<select class="ipSelect" style="width:180px;" id="wr_jobtype_02" name="wr_job_type2" title="3차직종선택">
							<option value="">= 3차 직종선택 =</option>
							<?php
							if($wr_job_type2){
								$pcodeList = $category_control->category_pcodeList('job_type', $wr_job_type1);
								if($pcodeList){
									foreach($pcodeList as $val){ 
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									$selected = ($wr_job_type2 == $val['code']) ? "selected" : "";
							?>
								<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
							<?php 
									}	// foreach end.
								}	// if end.
							} else {
							?>
								<option value="">2차 직종을 먼저 선택해 주세요</option>
							<?php
							}	// if end.
							?>
							</select>
						</span>

						<em style="right:0; top:5px;margin-left:5px;" class=""> <a class="button white" onclick="add_jobtype();"><span>+추가</span></a> </em> 
					</div>

					<div class="partWrap" style="display:<?php echo ($wr_job_type3!='')?'':'none';?>;margin-top:5px;" id="wr_jobtype_block_1">

						<select class="ipSelect" style="width:180px;" id="wr_jobtype_10" name="wr_job_type3" title="1차 직종선택" onchange="job_type_sel_first(this,'wr_job_type4');" hname="1차직종">
						<option value="">= 1차 직종선택 =</option>
						<?php 
						if($job_type_list){
							foreach($job_type_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$selected = ($wr_job_type3 == $val['code']) ? "selected" : "";
						?>
						<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php 
							}	// foreach end.
						} // if end.
						?>
						</select>

						<span id="wr_job_type4_display">
							<select class="ipSelect" style="width:180px;" id="wr_jobtype_11" name="wr_job_type4" title="2차직종선택" onchange="job_type_sel_first(this,'wr_job_type5');">
							<option value="">= 2차 직종선택 =</option>
							<?php
							if($wr_job_type4){
								$pcodeList = $category_control->category_pcodeList('job_type', $wr_job_type3);
								if($pcodeList){
									foreach($pcodeList as $val){ 
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									$selected = ($wr_job_type4 == $val['code']) ? "selected" : "";
							?>
									<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
							<?php 
									}	// foreach end.
								}	// if end.
							} else {
							?>
								<option value="">1차 직종을 먼저 선택해 주세요</option>
							<?php
							}	// if end.
							?>
							</select>
						</span>

						<span id="wr_job_type5_display">
							<select class="ipSelect" style="width:180px;" id="wr_jobtype_12" name="wr_job_type5" title="3차직종선택">
							<option value="">= 3차 직종선택 =</option>
							<?php
							if($wr_job_type5){
								$pcodeList = $category_control->category_pcodeList('job_type', $wr_job_type4);
								if($pcodeList){
									foreach($pcodeList as $val){ 
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									$selected = ($wr_job_type5 == $val['code']) ? "selected" : "";
							?>
								<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
							<?php 
									}	// foreach end.
								}	// if end.
							} else {
							?>
								<option value="">2차 직종을 먼저 선택해 주세요</option>
							<?php
							}	// if end.
							?>
							</select>
						</span>

						<em style="right:0; top:5px;margin-left:5px;" class=""> <a class="button white" onclick="remove_jobtype('1');"><span>-삭제</span></a></em>

					</div>

					<div class="partWrap" style="display:<?php echo ($wr_job_type6!='')?'':'none';?>;margin-top:5px;" id="wr_jobtype_block_2">

						<select class="ipSelect" style="width:180px;" id="wr_jobtype_20" name="wr_job_type6" title="1차 직종선택" onchange="job_type_sel_first(this,'wr_job_type7');" hname="1차직종">
						<option value="">= 1차 직종선택 =</option>
						<?php 
						if($job_type_list){
							foreach($job_type_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$selected = ($wr_job_type6 == $val['code']) ? "selected" : "";
						?>
						<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php 
							}	// foreach end.
						} // if end.
						?>
						</select>

						<span id="wr_job_type7_display">
							<select class="ipSelect" style="width:180px;" id="wr_jobtype_21" name="wr_job_type7" title="2차직종선택" onchange="job_type_sel_first(this,'wr_job_type8');">
							<option value="">= 2차 직종선택 =</option>
							<?php
							if($wr_job_type7){
								$pcodeList = $category_control->category_pcodeList('job_type', $wr_job_type6);
								if($pcodeList){
									foreach($pcodeList as $val){ 
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									$selected = ($wr_job_type7 == $val['code']) ? "selected" : "";
							?>
									<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
							<?php 
									}	// foreach end.
								}	// if end.
							} else {
							?>
								<option value="">1차 직종을 먼저 선택해 주세요</option>
							<?php
							}	// if end.
							?>
							</select>
						</span>

						<span id="wr_job_type8_display">
							<select class="ipSelect" style="width:180px;" id="wr_jobtype_22" name="wr_job_type8" title="3차직종선택">
							<option value="">= 3차 직종선택 =</option>
							<?php
							if($wr_job_type8){
								$pcodeList = $category_control->category_pcodeList('job_type', $wr_job_type7);
								if($pcodeList){
									foreach($pcodeList as $val){ 
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									$selected = ($wr_job_type8 == $val['code']) ? "selected" : "";
							?>
								<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
							<?php 
									}	// foreach end.
								}	// if end.
							} else {
							?>
								<option value="">2차 직종을 먼저 선택해 주세요</option>
							<?php
							}	// if end.
							?>
							</select>
						</span>

						<em style="right:0; top:5px;margin-left:5px;" class=""> <a class="button white" onclick="remove_jobtype('2');"><span>-삭제</span></a></em>

					</div>

					<em>
						<input type="checkbox" class="typeCheckbox" id="wr_beginner" name="wr_beginner" value="1" <?php echo ($get_alba['wr_beginner'])?'checked':'';?>>
						<label class="help" for="wr_beginner">초보가능</label>
					</em> 

				</td>
			</tr>

			<tr>
				<th scope="row" class="vt"> <label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >근무지 주소</label></th>
				<td>
					<div class="addressWrap pb5 positionR">
						
						<div class="addressWrap pb5 positionR" id="wr_area_block_0">

							<select class="ipSelect" style="width:70px;" id="wr_area_00" name="wr_area_0[]" title="시·도 선택" onchange="area_sel_first(this,'wr_area_01');" required hname="근무지 시·도">
							<option value="">시·도</option>
							<?php 
							if($area_list){
								foreach($area_list as $val){ 
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$selected = ($wr_area_0[0] == $val['code']) ? "selected" : "";
							?>
							<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
							<?php 
								}	// foreach end.
							}	// if end.
							?>
							</select>
							<span id="wr_area_01_display">
								<select class="ipSelect" style="width:70px;" id="wr_area_01" name="wr_area_0[]" title="시군구 선택">
									<option value="">시군구</option>
									<?php
									if($wr_area_0[1]){
										$pcodeList = $category_control->category_pcodeList('area', $wr_area_0[0]);
										if($pcodeList){
											foreach($pcodeList as $val){ 
											$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
											$selected = ($wr_area_0[1] == $val['code']) ? "selected" : "";
									?>
											<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
									<?php 
											}	// foreach end.
										}	// if end.
									}	// if end.
									?>
								</select>
							</span>
							<span id="wr_area_02_display">
								<select class="ipSelect" style="width:70px;" id="wr_area_02" name="wr_area_0[]" title="읍면동 선택">
									<option value="">읍면동</option>
									<?php
									if($wr_area_0[2]){
										$pcodeList = $category_control->category_pcodeList('area', $wr_area_0[1]);
										if($pcodeList){
											foreach($pcodeList as $val){ 
											$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
											$selected = ($wr_area_0[2] == $val['code']) ? "selected" : "";
									?>
											<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
									<?php 
											}	// foreach end.
										}	// if end.
									}	// if end.
									?>
								</select>
							</span>

							<input type="text" maxlength="16" class="ipText" style="width:160px;" id="wr_area_03" name="wr_area_0[]" value="<?php echo $wr_area_03_val;?>">
							<em style="right:0; top:5px;" class="positionA insert"> <a class="button white" onclick="add_area();"><span>+추가</span></a> </em> 

						</div>

						<div class="addressWrap pb5 positionR" style="display:<?php echo ($wr_area_1[0]!='')?'':'none';?>;" id="wr_area_block_1">

							<select class="ipSelect" style="width:70px;" id="wr_area_10" name="wr_area_1[]" title="시·도 선택" onchange="area_sel_first(this,'wr_area_11');" hname="근무지 시·도">
							<option value="">시·도</option>
							<?php 
							if($area_list){
								foreach($area_list as $val){ 
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$selected = ($wr_area_1[0] == $val['code']) ? "selected" : "";
							?>
							<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
							<?php 
								}	// foreach end.
							}	// if end.
							?>
							</select>
							<span id="wr_area_11_display">
								<select class="ipSelect" style="width:70px;" id="wr_area_11" name="wr_area_1[]" title="시군구 선택">
									<option value="">시군구</option>
									<?php
									if($wr_area_1[1]){
										$pcodeList = $category_control->category_pcodeList('area', $wr_area_1[0]);
										if($pcodeList){
											foreach($pcodeList as $val){ 
											$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
											$selected = ($wr_area_1[1] == $val['code']) ? "selected" : "";
									?>
											<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
									<?php 
											}	// foreach end.
										}	// if end.
									}	// if end.
									?>
								</select>
							</span>
							<span id="wr_area_12_display">
								<select class="ipSelect" style="width:70px;" id="wr_area_12" name="wr_area_1[]" title="읍면동 선택">
									<option value="0">읍면동</option>
									<?php
									if($wr_area_1[2]){
										$pcodeList = $category_control->category_pcodeList('area', $wr_area_1[1]);
										if($pcodeList){
											foreach($pcodeList as $val){ 
											$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
											$selected = ($wr_area_1[2] == $val['code']) ? "selected" : "";
									?>
											<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
									<?php 
											}	// foreach end.
										}	// if end.
									}	// if end.
									?>
								</select>
							</span>

							<input type="text" maxlength="16" class="ipText" style="width:160px;" id="wr_area_13" name="wr_area_1[]" value="<?php echo $wr_area_13_val;?>">
							<input type="hidden" name="wr_area_1_point" id="wr_area_1_point" value="<?php echo $get_alba['wr_area_1_point'];?>">
							<em style="right:0; top:5px;" class="positionA delete"> <a class="button white" onclick="remove_area('1');"><span>-삭제</span></a></em>

						</div>

						<div class="addressWrap pb5 positionR" style="display:<?php echo ($wr_area_2[0]!='')?'':'none';?>;" id="wr_area_block_2">

							<select class="ipSelect" style="width:70px;" id="wr_area_20" name="wr_area_2[]" title="시·도 선택" onchange="area_sel_first(this,'wr_area_21');" hname="근무지 시·도">
							<option value="">시·도</option>
							<?php 
							if($area_list){
								foreach($area_list as $val){ 
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$selected = ($wr_area_2[0] == $val['code']) ? "selected" : "";
							?>
							<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
							<?php 
								}	// foreach end.
							}	// if end.
							?>
							</select>
							<span id="wr_area_21_display">
								<select class="ipSelect" style="width:70px;" id="wr_area_21" name="wr_area_2[]" title="시군구 선택">
									<option value="">시군구</option>
									<?php
									if($wr_area_2[1]){
										$pcodeList = $category_control->category_pcodeList('area', $wr_area_2[0]);
										if($pcodeList){
											foreach($pcodeList as $val){ 
											$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
											$selected = ($wr_area_2[1] == $val['code']) ? "selected" : "";
									?>
											<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
									<?php 
											}	// foreach end.
										}	// if end.
									}	// if end.
									?>
								</select>
							</span>
							<span id="wr_area_22_display">
								<select class="ipSelect" style="width:70px;" id="wr_area_22" name="wr_area_2[]" title="읍면동 선택">
									<option value="0">읍면동</option>
									<?php
									if($wr_area_2[2]){
										$pcodeList = $category_control->category_pcodeList('area', $wr_area_2[1]);
										if($pcodeList){
											foreach($pcodeList as $val){ 
											$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
											$selected = ($wr_area_2[2] == $val['code']) ? "selected" : "";
									?>
											<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
									<?php 
											}	// foreach end.
										}	// if end.
									}	// if end.
									?>
								</select>
							</span>

							<input type="text" class="ipText" style="width:160px;" id="wr_area_23" name="wr_area_2[]" value="<?php echo $wr_area_23_val;?>">
							<input type="hidden" name="wr_area_2_point" id="wr_area_2_point" value="<?php echo $get_alba['wr_area_2_point'];?>">
							<em style="right:0; top:5px;" class="positionA delete"> <a class="button white" onclick="remove_area('2');"><span>-삭제</span></a></em>

						</div>

					</div>
				</td>
			</tr>
			<tr>
				<th scope="row"> <label>근무지 지도위치</label></th>
				<td>
					<input type="radio" class="chk" name="wr_area_company" value="0" id="wr_area_company_0" checked onclick="wr_areas(this);"><label for="wr_area_company_0"> 직접입력</label>&nbsp;
					<input type="radio" class="chk" name="wr_area_company" value="1" id="wr_area_company_1" <?php echo ($get_alba['wr_area_company'])?'checked':'';?> onclick="wr_areas(this);"><label for="wr_area_company_1"> 기업정보위치와 동일</label>
				</td>
			</tr>
			<tr id="wr_area_block" style="display:<?php echo ($get_alba['wr_area_company'])?'none':'';?>;">
				<th scope="row"> <label>지도검색</label></th>
				<td>
					<input type="text" class="ipText" style="width:480px;" id="wr_area" name="wr_area" value="<?php echo $wr_area;?>" placeholder="주소" onclick="execDaumPostcode();">
					<em><a class="button" onclick="execDaumPostcode();"><span>주소검색</span></a></em> 
					<div id="map" style="margin-top:5px;width:490px;height:250px;"></div>
				</td>
			</tr>
			<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
			<?php echo $map_script;?>
			<script>
			var wr_areas = function( vals ){
				var sel = vals.value;
				if(sel=='1'){
					$('#wr_area_block').hide();
				} else {
					$('#wr_area_block').show();
					<?php if($use_map=='naver'){ ?>
					var area_point_length = Number(<?php echo $area_point_length;?>);
					if(area_point_length <= 24){
						map_api.map_use("map", "", true);	// 지도 띄우기
						map_api.map_location_move(<?php echo $wr_area_point;?>);
						map_api.marker_false();
						map_api.addMark();
						map_api.click_event('','',<?php echo $wr_area_point;?>,'wr_area_point');
					} else {
						var search_addr = "<?php echo $wr_areas[0].$wr_areas[1].$wr_areas[2].$wr_areas[3];?>";
						$.post('../member/views/_ajax/post_search.php', { mode:'naver_map_search', search_addr:search_addr }, function(result){
							var data = eval("(" + result + ")");
							var point_y = data.mapy;
							var point_x = data.mapx;
							map_api.map_use("map", "", true);	// 지도 띄우기
							map_api.map_location_move(point_x,point_y);
							map_api.marker_false();
							map_api.addMark();
							map_api.click_event('','',point_x,point_y,'wr_area_point');
						});
					}
					<?php } ?>
				}
			}

			<?php if($use_map=='daum'){ ?>
				var mapContainer = document.getElementById('map'), // 지도를 표시할 div
					mapOption = {
						center: new daum.maps.LatLng(<?php echo $wr_area_point;?>), // 지도의 중심좌표
						level: 5 // 지도의 확대 레벨
					};
				//지도를 미리 생성
				var map = new daum.maps.Map(mapContainer, mapOption);
				// 일반 지도와 스카이뷰로 지도 타입을 전환할 수 있는 지도타입 컨트롤을 생성합니다
				var mapTypeControl = new daum.maps.MapTypeControl();
				// 지도에 컨트롤을 추가해야 지도위에 표시됩니다
				// daum.maps.ControlPosition은 컨트롤이 표시될 위치를 정의하는데 TOPRIGHT는 오른쪽 위를 의미합니다
				map.addControl(mapTypeControl, daum.maps.ControlPosition.TOPRIGHT);
				// 지도 확대 축소를 제어할 수 있는  줌 컨트롤을 생성합니다
				var zoomControl = new daum.maps.ZoomControl();
				map.addControl(zoomControl, daum.maps.ControlPosition.RIGHT);
				//주소-좌표 변환 객체를 생성
				var geocoder = new daum.maps.services.Geocoder();
				//마커를 미리 생성
				var marker = new daum.maps.Marker({
					position: new daum.maps.LatLng(<?php echo $wr_area_point;?>),
					map: map
				});
			<?php } else if($use_map=='naver'){ ?>
				var area_point_length = Number(<?php echo $area_point_length;?>);
				if(area_point_length <= 24){
					map_api.map_use("map", "", true);	// 지도 띄우기
					map_api.map_location_move(<?php echo $wr_area_point;?>);
					map_api.marker_false();
					map_api.addMark();
					map_api.click_event('','',<?php echo $wr_area_point;?>,'wr_area_point');
				} else {
					var search_addr = "<?php echo $wr_areas[0].$wr_areas[1].$wr_areas[2].$wr_areas[3];?>";
					$.post('../member/views/_ajax/post_search.php', { mode:'naver_map_search', search_addr:search_addr }, function(result){
						var data = eval("(" + result + ")");
						var point_y = data.mapy;
						var point_x = data.mapx;
						map_api.map_use("map", "", true);	// 지도 띄우기
						map_api.map_location_move(point_x,point_y);
						map_api.marker_false();
						map_api.addMark();
						map_api.click_event('','',point_x,point_y,'wr_area_point');
					});
				}
			<?php } else if($use_map=='google'){ ?>
				map_api.map_point = [<?php echo $wr_area_point;?>,'18'];
				map_api.map_use("map", "", true);
				map_api.click_event('','',<?php echo $wr_area_point;?>,'wr_area_point');
				map_api.addMark();
			<?php } ?>

			// 우편번호 찾기 화면을 넣을 element
			function execDaumPostcode() {
				new daum.Postcode({
					oncomplete: function(data) {
						// 각 주소의 노출 규칙에 따라 주소를 조합한다.
						// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
						var fullAddr = data.address; // 최종 주소 변수
						var extraAddr = ''; // 조합형 주소 변수

						// 기본 주소가 도로명 타입일때 조합한다.
						if(data.addressType === 'R'){
							//법정동명이 있을 경우 추가한다.
							if(data.bname !== ''){
								extraAddr += data.bname;
							}
							// 건물명이 있을 경우 추가한다.
							if(data.buildingName !== ''){
								extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
							}
							// 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
							fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
						}

						// 주소 정보를 해당 필드에 넣는다.
						document.getElementById("wr_area").value = fullAddr;

						<?php if($use_map=='daum'){ ?>

							// 주소로 좌표를 검색
							geocoder.addr2coord(data.address, function(status, result) {
								// 정상적으로 검색이 완료됐으면
								if (status === daum.maps.services.Status.OK) {
									// 해당 주소에 대한 좌표를 받아서
									var coords = new daum.maps.LatLng(result.addr[0].lat, result.addr[0].lng);
									// 지도를 보여준다.
									mapContainer.style.display = "block";
									map.relayout();
									// 지도 중심을 변경한다.
									map.setCenter(coords);
									// 마커를 결과값으로 받은 위치로 옮긴다.
									marker.setPosition(coords);
									$('#wr_area_point').val(result.addr[0].lat+","+result.addr[0].lng);
								}
							});
							daum.maps.event.addListener(map, 'click', function(mouseEvent) {
								// 클릭한 위도, 경도 정보를 가져옵니다 
								var latlng = mouseEvent.latLng; 
								// 마커 위치를 클릭한 위치로 옮깁니다
								marker.setPosition(latlng);
								var message = '클릭한 위치의 위도는 ' + latlng.getLat() + ' 이고, ';
								message += '경도는 ' + latlng.getLng() + ' 입니다';
								$('#wr_area_point').val( latlng.getLat() +","+latlng.getLng() );
							});

						<?php } else if($use_map=='naver'){ ?>
							var search_addr = fullAddr;
							$.post('../member/views/_ajax/post_search.php', { mode:'naver_map_search', search_addr:search_addr }, function(result){
								$('#map').html("");
								var data = eval("(" + result + ")");
								var point_y = data.mapy;
								var point_x = data.mapx;
								map_api.map_use("map", "", true);	// 지도 띄우기
								map_api.map_location_move(point_x,point_y);
								map_api.marker_false();
								map_api.addMark();
								map_api.click_event();
								$('#wr_area_point').val( point_x+","+point_y );
							});
						<?php } else if($use_map=='google'){ ?>
							var search_addr = fullAddr;
							$.post('../member/views/_ajax/post_search.php', { mode:'google_map_search', search_addr:search_addr }, function(result){
								point = result.split('/');
								var point_x = point[0];
								var point_y = point[1];
								map_api.map_point = [point_x,point_y,'18'];
								map_api.map_use("map", "", true);
								map_api.click_event('','',point_x,point_y,'wr_area_point');
								map_api.addMark();
								$('#wr_area_point').val( point_x+","+point_y );
							});
						<?php } ?>

					}
				}).open();
			}
			</script>

			<?php if($form_subway['view']=='yes'){ ?>
			<tr>
				<th scope="row"> <label><?php if($form_subway['etc_0']){ ?><img alt="필수입력사항" src="../images/icon/icon_b.gif" ><?php } ?>인근지하철</label></th>
				<td>

					<div class="pb5 positionR" id="wr_subway_block_0">
						<select class="ipSelect vm" style="width:95px;" id="wr_subway_area_0" name="wr_subway_area_0" title="지역 선택" onchange="subway_sel_area(this,'wr_subway_line_0');" <?php echo ($form_subway['etc_0'])?'required':'';?> hname="지하철 지역">
						<option value="">지역</option>
						<?php 
						if($subway_list){
							foreach($subway_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$selected = ($wr_subway_area_0 == $val['code']) ? "selected" : "";
						?>
						<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php 
							}	// foreach end.
						}	// if end.
						?>
						</select>
						<select class="ipSelect vm" style="width:75px;" id="wr_subway_line_0" name="wr_subway_line_0" title="호선 선택" onchange="subway_sel_line(this,'wr_subway_station_0');" <?php echo ($form_subway['etc_0'])?'required':'';?> hname="지하철 호선">
						<option value="">호선</option>
						<?php
						if($wr_subway_line_0){
							$pcodeList = $category_control->category_pcodeList('subway', $wr_subway_area_0);
							if($pcodeList){
								foreach($pcodeList as $val){ 
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$selected = ($wr_subway_line_0 == $val['code']) ? "selected" : "";
						?>
								<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php 
								}	// foreach end.
							}	// if end.
						}	// if end.
						?>
						</select>
						<select class="ipSelect vm" style="width:100px;" id="wr_subway_station_0" name="wr_subway_station_0" title="지하철역 선택" <?php echo ($form_subway['etc_0'])?'required':'';?> hname="지하철역">
						<option value="">지하철역</option>
						<?php
						if($wr_subway_station_0){
							$pcodeList = $category_control->category_pcodeList('subway', $wr_subway_line_0);
							if($pcodeList){
								foreach($pcodeList as $val){ 
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$selected = ($wr_subway_station_0 == $val['code']) ? "selected" : "";
						?>
								<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php 
								}	// foreach end.
							}	// if end.
						}	// if end.
						?>
						</select>
						<input type="text" maxlength="16" class="ipText" style="width:200px;" id="wr_subway_content_0" name="wr_subway_content_0" value="<?php echo $wr_subway_content_0_val;?>">
						<em style="right:0; top:5px;" class="positionA insert"> <a class="button white" onclick="add_subway();"><span>+추가</span></a> </em> 
					</div>

					<div class="pb5 positionR" id="wr_subway_block_1" style="display:<?php echo ($wr_subway_area_1)?'':'none';?>;">
						<select class="ipSelect" style="width:95px;" id="wr_subway_area_1" name="wr_subway_area_1" title="지역 선택" onchange="subway_sel_area(this,'wr_subway_line_1');" hname="지하철 지역">
						<option value="">지역</option>
						<?php 
						if($subway_list){
							foreach($subway_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$selected = ($wr_subway_area_1 == $val['code']) ? "selected" : "";
						?>
						<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php 
							}	// foreach end.
						}	// if end.
						?>
						</select>
						<select class="ipSelect" style="width:75px;" id="wr_subway_line_1" name="wr_subway_line_1" title="호선 선택" onchange="subway_sel_line(this,'wr_subway_station_1');" hname="지하철 호선">
						<option value="">호선</option>
						<?php
						if($wr_subway_line_1){
							$pcodeList = $category_control->category_pcodeList('subway', $wr_subway_area_1);
							if($pcodeList){
								foreach($pcodeList as $val){ 
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$selected = ($wr_subway_line_1 == $val['code']) ? "selected" : "";
						?>
								<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php 
								}	// foreach end.
							}	// if end.
						}	// if end.
						?>
						</select>
						<select class="ipSelect" style="width:100px;" id="wr_subway_station_1" name="wr_subway_station_1" title="지하철역 선택">
						<option value="">지하철역</option>
						<?php
						if($wr_subway_station_1){
							$pcodeList = $category_control->category_pcodeList('subway', $wr_subway_line_1);
							if($pcodeList){
								foreach($pcodeList as $val){ 
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$selected = ($wr_subway_station_1 == $val['code']) ? "selected" : "";
						?>
								<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php 
								}	// foreach end.
							}	// if end.
						}	// if end.
						?>
						</select>
						<input type="text" maxlength="16" class="ipText" style="width:200px;" id="wr_subway_content_1" name="wr_subway_content_1" value="<?php echo $wr_subway_content_1_val;?>">
						<em style="right:0; top:5px;" class="positionA insert"> <a class="button white" onclick="remove_subway('1');"><span>-제거</span></a> </em> 
					</div>

					<div class="pb5 positionR" id="wr_subway_block_2" style="display:<?php echo ($wr_subway_area_2)?'':'none';?>;;">
						<select class="ipSelect" style="width:95px;" id="wr_subway_area_2" name="wr_subway_area_2" title="지역 선택" onchange="subway_sel_area(this,'wr_subway_line_2');" hname="지하철 지역">
						<option value="">지역</option>
						<?php 
						if($subway_list){
							foreach($subway_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$selected = ($wr_subway_area_2 == $val['code']) ? "selected" : "";
						?>
						<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php 
							}	// foreach end.
						}	// if end.
						?>
						</select>
						<select class="ipSelect" style="width:75px;" id="wr_subway_line_2" name="wr_subway_line_2" title="호선 선택" onchange="subway_sel_line(this,'wr_subway_station_2');" hname="지하철 호선">
						<option value="">호선</option>
						<?php
						if($wr_subway_line_2){
							$pcodeList = $category_control->category_pcodeList('subway', $wr_subway_area_2);
							if($pcodeList){
								foreach($pcodeList as $val){ 
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$selected = ($wr_subway_line_2 == $val['code']) ? "selected" : "";
						?>
								<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php 
								}	// foreach end.
							}	// if end.
						}	// if end.
						?>
						</select>
						<select class="ipSelect" style="width:100px;" id="wr_subway_station_2" name="wr_subway_station_2" title="지하철역 선택">
						<option value="">지하철역</option>
						<?php
						if($wr_subway_station_2){
							$pcodeList = $category_control->category_pcodeList('subway', $wr_subway_line_2);
							if($pcodeList){
								foreach($pcodeList as $val){ 
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$selected = ($wr_subway_station_2 == $val['code']) ? "selected" : "";
						?>
								<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php 
								}	// foreach end.
							}	// if end.
						}	// if end.
						?>
						</select>
						<input type="text" maxlength="16" class="ipText" style="width:200px;" id="wr_subway_content_2" name="wr_subway_content_2" value="<?php echo $wr_subway_content_2_val;?>">
						<em style="right:0; top:5px;" class="positionA insert"> <a class="button white" onclick="remove_subway('2');"><span>-제거</span></a> </em> 
					</div>

				</td>
			</tr>
			<?php } ?>
			<?php if($form_college['view']=='yes'){ ?>
			<tr>
				<th scope="row"> <label><?php if($form_college['etc_0']){ ?><img alt="필수입력사항" src="../images/icon/icon_b.gif" ><?php } ?>인근대학</label></th>
				<td>
					<div class="schoolWrap pb5 positionR">
						<select class="ipSelect" style="width:75px;" id="wr_college_area" name="wr_college_area" title="지역 선택" onchange="college_area(this,'wr_college_vicinity');" <?php echo ($form_college['etc_0'])?'required':'';?> hname="인근대학 지역">
						<option value="">지역</option>
						<?php 
						if($area_list){
							foreach($area_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$selected = ($wr_college_area == $val['code']) ? "selected" : "";
						?>
						<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php 
							}	// foreach end.
						}	// if end.
						?>
						</select>
						<select class="ipSelect" style="width:305px;" id="wr_college_vicinity" name="wr_college_vicinity" title="인근대학 선택" <?php echo ($form_college['etc_0'])?'required':'';?> hname="인근대학">
						<option value="">인근대학 선택</option>
						<?php
						if($wr_college_vicinity){
							$pcodeList = $category_control->category_pcodeList('job_college', $wr_college_area);
							if($pcodeList){
								foreach($pcodeList as $val){ 
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$selected = ($wr_college_vicinity == $val['code']) ? "selected" : "";
						?>
								<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
						<?php 
								}	// foreach end.
							}	// if end.
						}	// if end.
						?>
						</select>
					</div>
				</td>
			</tr>
			<?php } ?>
			<tr>
				<th scope="row"  class="bbend vt" style="min-height:110px;"> <label>근무회사 이미지</label></th>
				<td  class="bbend">

					<!--  사진등록 layer  -->
					<div class="layerPop positionA border_color5" style="display:none; width:420px; top:30%; left:25%; text-align:left;" id="albaPhotoPop">
						<input type="hidden" name="alba_photos" id="alba_photos"/>
						<dl style="">
							<dt style="padding:20px 15px;cursor:pointer;" class="bg_gray1" id="albaPhotoPop_handle">
								<strong>근무회사 이미지 등록</strong>
								<em class="closeBtn" onclick="close_alba_photos()"><img width="11" height="11" class="pb5" src="../images/icon/icon_close2.gif" alt="arrow"></em>
							</dt>
							<dd style="padding:10px 15px;">
								<p style="padding-bottom:20px;"><strong>GIF,JPEG,JPG</strong> 파일형식으로,<br>
								<strong>500KB</strong> 용량 이내의 파일만 등록 가능합니다.<br></p>
								<div class="box2" style="border:1px solid #ddd; padding:10px;">
									<input type="file" name="alba_photo_files" id="alba_photo_files" size="32" style="height:20px;" class="txtForm">
								</div>
								<div style="margin:20px auto;" class="btn font_gray bg_white"><a href="javascript:alba_photo_submit();">등록하기<img width="30" height="9" class="pb5" src="../images/icon/icon_arrow_right3.png" alt="arrow"></a></div>
							</dd>
						</dl>
					</div>
					<!--  //사진등록 layer   -->

					<div class="photoWrap positionR clearfix">
						<ul>
							<li style="padding-right:10px;">
								<div class="photo"> <img src="<?php echo $wr_photo_0;?>" width="155" height="100" alt="photo" id="alba_photo_0"> </div>
								<input type="hidden" name="wr_photo_0" id="wr_photo_0"/>
								<div class="buttonWrap photo_button" style="display:<?php echo ($get_alba['wr_use_photo'])?'none':'';?>;"> 
									<a class="button white" onclick="update_alba_photos('update', 0);" id="alba_update_0"> <span>등록<img class="pl5"src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span> </a> 
									<span>&nbsp;</span>
									<!-- <a  class="button white" onclick="update_alba_photos('delete', 0);" id="alba_delete_0"> <span>삭제<img class="pl5"src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span> </a> --> 
								</div>
							</li>
							<li style="padding-right:10px;">
								<div class="photo"> <img src="<?php echo $wr_photo_1;?>" width="155" height="100" alt="photo" id="alba_photo_1"> </div>
								<input type="hidden" name="wr_photo_1" id="wr_photo_1"/>
								<div class="buttonWrap photo_button" style="display:<?php echo ($get_alba['wr_use_photo'])?'none':'';?>;"> 
									<a class="button white" onclick="update_alba_photos('update', 1);" id="alba_update_1"> <span>등록<img class="pl5"src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span> </a> 
									<!-- <a  class="button white" onclick="update_alba_photos('delete', 1);" id="alba_delete_1"> <span>삭제<img class="pl5"src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span> </a>  -->
								</div>
							</li>
							<li style="padding-right:10px;">
								<div class="photo"> <img src="<?php echo $wr_photo_2;?>" width="155" height="100" alt="photo" id="alba_photo_2"> </div>
								<input type="hidden" name="wr_photo_2" id="wr_photo_2"/>
								<div class="buttonWrap photo_button" style="display:<?php echo ($get_alba['wr_use_photo'])?'none':'';?>;"> 
									<a class="button white" onclick="update_alba_photos('update', 2);" id="alba_update_2"> <span>등록<img class="pl5"src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span> </a> 
									<!-- <a  class="button white" onclick="update_alba_photos('delete', 2);" id="alba_delete_2"> <span>삭제<img class="pl5"src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span> </a>  -->
								</div>
							</li>
							<li style="padding-right:10px;">
								<div class="photo"> <img src="<?php echo $wr_photo_3;?>" width="155" height="100" alt="photo" id="alba_photo_3"> </div>
								<input type="hidden" name="wr_photo_3" id="wr_photo_3"/>
								<div class="buttonWrap photo_button" style="display:<?php echo ($get_alba['wr_use_photo'])?'none':'';?>;"> 
									<a class="button white" onclick="update_alba_photos('update', 3);" id="alba_update_3"> <span>등록<img class="pl5"src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span> </a> 
									<!-- <a  class="button white" onclick="update_alba_photos('delete', 3);" id="alba_delete_3"> <span>삭제<img class="pl5"src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span> </a>  -->
								</div>
							</li>
							<li>
								<div class="photo"> <img src="<?php echo $wr_photo_4;?>" width="155" height="100" alt="photo" id="alba_photo_4"> </div>
								<input type="hidden" name="wr_photo_4" id="wr_photo_4"/>
								<div class="buttonWrap photo_button" style="display:<?php echo ($get_alba['wr_use_photo'])?'none':'';?>;"> 
									<a class="button white" onclick="update_alba_photos('update', 4);" id="alba_update_4"> <span>등록<img class="pl5"src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span> </a> 
									<!-- <a  class="button white" onclick="update_alba_photos('delete', 4);" id="alba_delete_4"> <span>삭제<img class="pl5"src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span> </a>  -->
								</div>
							</li>
						</ul>
						<em class="positionA" style="right:5px; top:30px;">
							<input type="checkbox"  class="typeCheckbox" id="wr_use_photo" name="wr_use_photo" value="1" onclick="use_photo(this);" <?php echo ($get_alba['wr_use_photo'])?'checked':'';?>>
							<label class="help" for="wr_use_photo">회사이미지 사용</label>
						</em> 
					</div>
				</td>
			</tr>
			</tbody>
			</table>
			</div>
		</div>
		<!--  //업무내용 및 근무지정보  --> 

		<!--  지원조건  -->
		<div class="listWrap mt30">
			<h2 class="pb5"> <img src="../images/tit/company_nav_tit_05.gif"  width="90" height="25" alt="지원조건"> </h2>
			<div class="registWrap" style="z-index:500">
				<table>
				<caption><span class="skip">근무조건 출력</span></caption>
				<colgroup><col width="159px"><col width="*"></colgroup>
				<tbody>
				<tr>
					<th scope="row"> <label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >근무기간</label></th>
					<td>
						<div class="dutytermWrap positionR">
							<?php 
							if($alba_date_list){
								foreach($alba_date_list as $val){ 
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$checked = ($get_alba['wr_date'] == $val['code']) ? "checked" : "";
							?>
							<input type="radio" class="chk" id="wr_date_<?php echo $val['code'];?>" name="wr_date" value="<?php echo $val['code'];?>" required hname="근무기간" option="radio" <?php echo $checked;?>>
							<label for="wr_date_<?php echo $val['code'];?>"><?php echo $name;?></label>
							<?php 
								}	// foreach end.
							}	// if end.
							?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"> <label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >근무요일</label></th>
					<td>
						<div class="dutyweekWrap positionR">
							<?php 
							if($alba_week_list){
								foreach($alba_week_list as $val){ 
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$checked = ($get_alba['wr_week'] == $val['code']) ? "checked" : "";
							?>
							<input type="radio" title="<?php echo $name;?>" class="chk" id="wr_week_<?php echo $val['code'];?>" name="wr_week" value="<?php echo $val['code'];?>" required hname="근무요일" option="radio" <?php echo $checked;?>>
							<label for="wr_week_<?php echo $val['code'];?>"><?php echo $name;?></label>
							<?php 
								}	// foreach end.
							}	// if end.
							?>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row"> <label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >근무시간</label></th>
					<td>
						<div class="workstarWrap">
							<select class="ipSelect wr_time" name="wr_stime[]" id="wr_stime" <?php echo ($wr_time_conference)?'':'required';?> hname="근무시간" option="select" <?php echo ($wr_time_conference)?'disabled':'';?>>
							<option value="">선택</option>
							<?php for($i=0;$i<=23;$i++){ ?>
							<option value="<?php echo sprintf('%02d',$i);?>" <?php echo ($wr_stime[0]&&$wr_stime[0]==$i)?'selected':'';?>><?php echo sprintf('%02d',$i);?>시</option>
							<?php } ?>
							</select>
							<select class="ipSelect wr_time" name="wr_stime[]" id="wr_smin" <?php echo ($wr_time_conference)?'':'required';?> hname="근무시간" option="select" <?php echo ($wr_time_conference)?'disabled':'';?>>
							<option value="">선택</option>
							<?php for($i=0;$i<=5;$i++){?>
							<option value="<?php echo $i;?>0" <?php echo ($wr_stime[1]==$i.'0')?'selected':'';?>><?php echo $i;?>0분</option>
							<?php } ?>
							</select>
							<span id="nextworktime">~</span>
							<select class="ipSelect wr_time" name="wr_etime[]" id="wr_etime" <?php echo ($wr_time_conference)?'':'required';?> hname="근무시간" option="select" <?php echo ($wr_time_conference)?'disabled':'';?>>
							<option value="">선택</option>
							<?php for($i=0;$i<=23;$i++){ ?>
							<option value="<?php echo sprintf('%02d',$i);?>" <?php echo ($wr_etime[0]&&$wr_etime[0]==$i)?'selected':'';?>><?php echo sprintf('%02d',$i);?>시</option>
							<?php } ?>
							</select>
							<select class="ipSelect wr_time" name="wr_etime[]" id="wr_emin" <?php echo ($wr_time_conference)?'':'required';?> hname="근무시간" option="select" <?php echo ($wr_time_conference)?'disabled':'';?>>
							<option value="">선택</option>
							<?php for($i=0;$i<=5;$i++){?>
							<option value="<?php echo $i;?>0" <?php echo ($wr_etime[1]==$i.'0')?'selected':'';?>><?php echo $i;?>0분</option>
							<?php } ?>
							</select>
							<input type="checkbox" class="typeCheckbox" id="wr_time_conference" name="wr_time_conference" value="1" onclick="time_conference(this);"  <?php echo ($wr_time_conference)?'checked':'';?>>
							<label for="wr_time_conference">시간협의</label>
						</div>
					</td>
				</tr>
				<script>
				var pay_conferences = function( vals ){
					var sel = vals.checked;
					if(sel=='1'){
						$('#wr_pay_type, #wr_pay').attr('disabled','disabled');
						$('#wr_pay_type, #wr_pay').removeAttr('required');
					} else {
						$('#wr_pay_type, #wr_pay').removeAttr('disabled');
						$('#wr_pay_type, #wr_pay').attr('required','required');
					}
				}
				</script>
				<tr>
					<th scope="row" class="vt"><label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >급여</label></th>
					<td>
						<div class="positionR">
							<select class="ipSelect" name="wr_pay_type" id="wr_pay_type" <?php echo ($get_alba['wr_pay_conference'])?'':'required';?> hname="급여조건" option="select" onchange="pay_types(this,'type');">
							<option value="">= 급여 =</option>
							<?php 
							if($alba_pay_list){
								foreach($alba_pay_list as $val){ 
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$selected = ($get_alba['wr_pay_type'] == $val['code']) ? "selected" : "";
							?>
							<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
							<?php 
								}	// foreach end.
							}	// if end.
							?>
							</select>
							<input type="text" maxlength="10" class="ipText" name="wr_pay" id="wr_pay" style="ime-mode:inactive;" <?php echo ($get_alba['wr_pay_conference'])?'disabled':'required';?> hname="급여금액" value="<?php echo $get_alba['wr_pay'];?>" placeholder="0" data-v-min="0" data-v-max="10000000000">
							<label for="wr_pay">원</label>
							<?php if($env['pay_view']){?><em class="help text_help"> 최저임금 : 시급 <strong class="txtEng"><?php echo number_format($env['time_pay']);?>원</strong></em><?php } ?>
							<p class="pt10 pb3"> 
								<span class="lowpay">
									<input type="radio" class="chk" name="wr_pay_conference" value="1" id="wr_pay_conference_1" <?php echo ($get_alba['wr_pay_conference']=='1')?'checked':'';?> onclick="pay_types(this,'conference');"/>
									<label for="wr_pay_conference_1">추후협의</label>
									<input type="radio" class="chk" name="wr_pay_conference" value="2" id="wr_pay_conference_2" <?php echo ($get_alba['wr_pay_conference']=='2')?'checked':'';?> onclick="pay_types(this,'conference');"/>
									<label for="wr_pay_conference_2">면접후결정</label>
									<!-- <input type="checkbox" class="chk" id="wr_pay_conference" name="wr_pay_conference" value="1" <?php echo ($get_alba['wr_pay_conference'])?'checked':'';?> onclick="pay_conferences(this);">
									<label for="wr_pay_conference">협의가능</label> -->
									<?php if($env['pay_view']){?><em class="help text_help"> (당사는 본 채용건과 관련하여 '최저임금법'을 준수합니다.)</em> <?php } ?>
								</span> 
							</p>
							<p class="pb3">
								<?php
								if($alba_pay_type_list){
									foreach($alba_pay_type_list as $val){
									$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
									$checked = (@in_array($val['code'],$wr_pay_support)) ? "checked" : "";
								?>
								<input type="checkbox" class="chk" id="wr_pay_support_<?php echo $val['code'];?>" name="wr_pay_support[]" value="<?php echo $val['code'];?>" <?php echo (@in_array($val['code'],$wr_pay_support))?'checked':'';?>>
								<label for="wr_pay_support_<?php echo $val['code'];?>"><?php echo $name;?></label>
								<?php 
									}	// foreach end.
								}	// if end.
								?>
							</p>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row" class="vt"><label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >근무형태</label></th>
					<td>
					<div class="jobtypeWrap positionR">
						<ul>
							<?php 
							if($work_type_list){ 
								foreach($work_type_list as $val){
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$checked = (@in_array($val['code'],$wr_work_type)) ? 'checked' : '';
							?>
							<li>
								<input type="checkbox" class="chk" name="wr_work_type[]" value="<?php echo $val['code'];?>" id="wr_work_type_<?php echo $val['code'];?>" required hname="근무형태" option="checkbox" <?php echo $checked;?>>
								<label for="wr_work_type_<?php echo $val['code'];?>"><?php echo $name;?></label>
							</li>
							<?php
								}	// foreach end.
							}	// if end.
							?>
							</ul>
					</div>
					</td>
				</tr>
				<?php if($form_welfare['view']=='yes'){ ?>
				<tr>
					<th scope="row" class="bbend"> <label><?php if($form_welfare['etc_0']){ ?><img alt="필수입력사항" src="../images/icon/icon_b.gif" ><?php } ?>복리후생</label></th>
					<td class="bbend">
						<div class="welfareWrap positionR">
							<input type="text" style="width:250px;" class="ipText" id="welfare_read" name="welfare_read" readonly onfocus="welfare_open();" value="<?php echo $get_alba['wr_welfare_read'];?>" <?php echo ($form_welfare['etc_0'])?'required':'';?> hname="복리후생">
							<em class="pr10"><a class="button" onclick="welfare_open();"><span>선택</span></a></em>
						</div>
					</td>
				</tr>
				<?php } ?>
				</tbody>
				</table>

				<!-- 복리후생 선택 -->          
				<div style="z-index:3000; display:none; position:absolute; top:100%; right:12px; background:#fff;"  class="dev_lywel" id="welfareLayer"> 
					<div id="welfar" class="layerGireg border_color5">
					<dl>
						<dt class="positionL bg_color4">복리후생 선택</dt>
						<dd class="lgBody">
							<table summary="복리후생을 선택할 수 있습니다.">
							<colgroup><col width="100px"><col width="*"></colgroup>
							<tbody>
							<?php
							if($job_welfare){
								$i = 1;
								foreach($job_welfare as $val){
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$tbg = ($i%2==0)?"class='tbg'":"";
								$bbend = ($i==$job_welfare_cnt) ? "class='bbend'" : "";
								$wrlfare = $wr_welfare[$val['code']];
							?>
							<tr <?php echo $tbg;?>>
								<th scope="row" <?php echo $bbend;?>><?php echo $name;?></th>
								<td <?php echo $bbend;?>>
									<ul>
										<?php
											$pcodeList = $category_control->category_pcodeList('job_welfare', $val['code']);
											foreach($pcodeList as $pval){
											$p_name = $utility->remove_quoted($pval['name']);	 // (쌍)따옴표 등록시 필터링
											$checked = (@in_array($pval['code'],$wrlfare)) ? "checked" : "";
										?>
										<li>
											<input type="checkbox" value="<?php echo $pval['code'];?>" id="wr_welfare_<?php echo $pval['code'];?>" name="wr_welfare[<?php echo $val['code'];?>][]" onclick="welfare_sel(this);" class="welfare_check" <?php echo $checked;?>>
											<label for="wr_welfare_<?php echo $pval['code'];?>" id="label_welfare_<?php echo $pval['code'];?>"><?php echo $p_name;?></label>
										</li>
										<?php } ?>
									</ul>
								</td>
							</tr>
							<?php 
								$i++;
								}	// foreach end.
							}	// if end.
							?>
							</tbody>
							</table>
						</dd>
					</dl>
					<span class="closeBtn">
						<img class="onclick" alt="닫기" src="../images/icon/icon_close3.gif" width="11" height="11" onclick="welfare_close();">
					</span> 
					</div>
				</div>
				<!-- 복리후생 선택 -->   
			</div>
		</div>
		<!--  //근무조건 -->

		<!--  지원조건   -->
		<div class="listWrap mt30">
			<h2 class="pb5"> <img src="../images/tit/company_nav_tit_06.gif"  width="90" height="25" alt="지원조건"> </h2>
			<div class="registWrap">
			<table>
			<caption><span class="skip">지원조건 출력</span></caption>
			<colgroup><col width="159px"><col width="*"></colgroup>
			<tbody>
			<?php if($form_gender['view']=='yes'){?>
			<tr>
				<th scope="row"> <label><?php if($form_gender['etc_0']){ ?><img alt="필수입력사항" src="../images/icon/icon_b.gif" ><?php } ?>성별</label></th>
				<td>
					<div class="genderWrap">
						<input type="radio" class="chk" value="0" id="wr_gender_0" name="wr_gender" <?php echo ($form_gender['etc_0'])?'required':'';?> hname="성별" option="radio" <?php echo ($get_alba['wr_gender']=='0')?'checked':'';?>>
						<label for="wr_gender_0">성별무관</label>
						<input type="radio" class="chk" value="1" id="wr_gender_1" name="wr_gender" <?php echo ($form_gender['etc_0'])?'required':'';?> hname="성별" option="radio" <?php echo ($get_alba['wr_gender']=='1')?'checked':'';?>> <label for="wr_gender_1">남자</label>
						<input type="radio" class="chk" value="2" id="wr_gender_2" name="wr_gender" <?php echo ($form_gender['etc_0'])?'required':'';?> hname="성별" option="radio" <?php echo ($get_alba['wr_gender']=='2')?'checked':'';?>> <label for="wr_gender_2">여자</label>
					</div>
					<em class="mt5 help icon text_help displayB">채용에서 남녀를 차별하거나, 여성근로자를 채용할 때 직무수행에 불필요한 용모, 키, 체중 등의 신체조건, 미혼조건을 제시 또는 요구하는 경우  <strong>남녀고용평등법 위반</strong> 에 따른 500만원이하의 벌금이 부과될 수 있습니다.</em>
				</td>
			</tr>
			<?php } ?>
			<?php if($form_age['view']=='yes'){?>
			<tr>
				<th scope="row" class="vt"> <label><?php if($form_age['etc_0']){ ?><img alt="필수입력사항" src="../images/icon/icon_b.gif" ><?php } ?>연령</label></th>
				<td>
					<div class="ageWrap positionR">
						<input type="radio" class="chk" id="wr_age_limit_0" name="wr_age_limit" value="0" onclick="age_sel(this);" <?php echo ($form_age['etc_0'])?'required':'';?> hname="연령" option="radio" <?php echo ($wr_age_limit=='0')?'checked':'';?>>
						<label for="wr_age_limit_0">연령무관</label>
						<input type="radio"  class="chk" id="wr_age_limit_1" name="wr_age_limit" value="1" onclick="age_sel(this);" <?php echo ($form_age['etc_0'])?'required':'';?> hname="연령" option="radio" <?php echo ($wr_age_limit=='1')?'checked':'';?>>
						<label for="wr_age_limit_1">연령제한 있음</label>

						<span id="wr_age_display" style="display: <?php echo ($wr_age_limit)?'':'none';?>;">
							<input type="text"  maxlength="2" style="width:30px;text-align:center;" class="ipText wr_age" id="wr_sage" name="wr_sage" value="<?php echo $wr_age[0];?>" <?php echo ($wr_age_limit)?'required':'';?> hname="제한연령">
							<label>세 이상~</label>
							<input type="text"  maxlength="2" style="width:30px;text-align:center;" class="ipText wr_age" id="wr_eage" name="wr_eage" value="<?php echo $wr_age[1];?>" <?php echo ($wr_age_limit)?'required':'';?> hname="제한연령">
							<label>세 이하</label>
							<!-- <span class="age">(<strong class="selectCnt" name="YearConv1" id="YearConv1"></strong>년생 이상~<strong class="selectCnt" name="YearConv2" id="YearConv2"></strong>년생 이하)
							</span> -->
						</span>
						<span class="addCnt">
							<?php
							if($job_age) {
								foreach($job_age as $val){
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$checked = (@in_array($val['code'],$wr_age_etc)) ? "checked" : "";
							?>
							<input type="checkbox" id="wr_age_etc_<?php echo $val['code'];?>" name="wr_age_etc[]" value="<?php echo $val['code'];?>" <?php echo $checked;?>>
							<label for="wr_age_etc_<?php echo $val['code'];?>"><?php echo $name;?></label>
							<?php 
								} // foreach end.
							}	// if end.
							?>
						</span>
						<em class="mt5 help icon text_help displayB">채용 시 합리적인 이유 없이 연령제한을 하는 경우 <strong>연령차별금지법</strong> 위반에 해당되어 500만원 이하의 벌금이 부과될 수 있습니다.</em>
							
					
					</div>
				</td>
			</tr>
			<?php } ?>
			<tr>
				<th scope="row"> <label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >학력조건</label></th>
				<td>
					<div class="eduWrap positionR">
						<?php
						if($job_ability_list) {
							foreach($job_ability_list as $val){
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
							$checked = ($get_alba['wr_ability']==$val['code']) ? "checked" : "";
						?>
						<input type="radio" id="wr_ability_<?php echo $val['code'];?>" name="wr_ability" value="<?php echo $val['code'];?>" required hname="학력조건" option="radio" <?php echo $checked;?>>
						<label for="wr_ability_<?php echo $val['code'];?>"><?php echo $name;?></label>
						<?php 
							} // foreach end.
						}	// if end.
						?>
					</div>      
				</td>
			</tr>
			<tr>
				<th scope="row"> <label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >경력사항</label></th>
				<td>
					<div class="careerWrap pb5 positionR">
						<input type="radio" id="wr_career_type_0" name="wr_career_type" value="0" onclick="career_sel(this);" required hname="경력사항" option="radio" <?php echo ($wr_career_type=='0')?'checked':'';?>>
						<label for="wr_career_type_0">경력무관</label>
						<input type="radio" id="wr_career_type_1" name="wr_career_type" value="1" onclick="career_sel(this);" required hname="경력사항" option="radio" <?php echo ($wr_career_type=='1')?'checked':'';?>>
						<label for="wr_career_type_1">신입</label>
						<input type="radio" id="wr_career_type_2" name="wr_career_type" value="2" onclick="career_sel(this);" required hname="경력사항" option="radio" <?php echo ($wr_career_type=='2')?'checked':'';?>>
						<label for="wr_career_type_2">경력</label>

						<span id="wr_career_display" style="display: <?php echo ($wr_career_type=='2')?'':'none';?>;">
							<select class="ipSelect" name="wr_career" id="wr_career" <?php echo ($get_alba['wr_career_type']=='2')?'required':'';?> hname="경력" option="select">
							<option value="">= 경력선택 =</option>
							<?php
							if($job_career_list) {
								foreach($job_career_list as $val){
								$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
								$selected = ($get_alba['wr_career']==$val['code']) ? "selected" : "";
							?>
							<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
							<?php 
								} // foreach end.
							}	// if end.
							?>
							</select>
							이상
						</span>
					</div>
				</td>
			</tr>
			<tr>
				<th scope="row" class="bbend vt"><label>우대조건</label></th>
				<td class="bbend">
					<ul class="preferenceTerms">
					<?php
					if($preferential_list) {
						$i = 0;
						foreach($preferential_list as $val){
						$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
						$end = ($i==$preferential_list_cnt)?"class='end'":"";
						$checked = (@in_array($val['code'],$wr_preferential)) ? "checked" : "";
					?>
						<li <?php echo $end;?>>
							<input type="checkbox" class="chk" id="wr_preferential_<?php echo $val['code'];?>" name="wr_preferential[]" value="<?php echo $val['code'];?>" <?php echo $checked;?>>
							<label for="wr_preferential_<?php echo $val['code'];?>"><?php echo $name;?></label>
						</li>
					<?php 
						$i++;
						} // foreach end.
					}	// if end.
					?>
					</ul>
				</td>
			</tr>
			</tbody>
			</table>
			</div>
		</div>
		<!--  //지원조건  -->

		<!--  모집내용   -->
		<div class="listWrap mt30">
			<h2 class="pb5"> <img src="../images/tit/company_nav_tit_07.gif" width="90"  height="25" alt="모집내용"> </h2>
			<div class="registWrap">
			<table>
			<caption><span class="skip">모집내용 출력</span></caption>
			<colgroup><col width="159px"><col width="*"></colgroup>
			<tbody>
			<tr>
				<th scope="row"> <label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >모집인원</label></th>
				<td>
					<div class="staffWrap pb5 positionR">
						<input type="text" maxlength="5" style="width:50px;text-align:center;" class="ipText" id="wr_volume" name="wr_volume" value="<?php echo $get_alba['wr_volume'];?>" <?php echo (@in_array('0',$wr_volumes)||@in_array('00',$wr_volumes))?'':'required';?> hname="모집인원">
						<label>명</label>
						<input type="checkbox" class="chk" id="volume_0" name="wr_volumes[]" value="0" onclick="volume_sel(this);" <?php echo (@in_array('0',$wr_volumes))?'checked':'';?>>
						<label for="volume_0">0명</label>
						<input type="checkbox" class="chk" id="volume_00" name="wr_volumes[]" value="00" onclick="volume_sel(this);" <?php echo (@in_array('00',$wr_volumes))?'checked':'';?>>
						<label for="volume_00">00명</label>
					</div>
				</td>
			</tr>
			<tr>
				<th scope="row"> <label>모집대상</label></th>
				<td>
					<div class="staffWrap pb5 positionR">
						<?php
							foreach($job_target as $val){
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
						?>
						<input type="checkbox" class="chk" name="wr_target[]" value="<?php echo $val['code'];?>" id="wr_target_<?php echo $val['code'];?>"/>
						<label for="wr_target_<?php echo $val['code'];?>"><?php echo $name;?></label>
						<?php } ?>
					</div>
				</td>
			</tr>
			<tr>
				<th scope="row"> <label><img alt="필수입력사항" src="../images/icon/icon_b.gif" >모집종료일</label></th>
				<td>
					<div class="enddateWrap pb5 positionR">
						<input type="radio" name="volume_check" class="chk" value="wr_volume_dates" checked  onclick="wr_volume_checks(this);"/>
						<input type="text" style="width:165px;" class="ipText" id="wr_volume_date" name="wr_volume_date" hname="모집종료일" value="<?php echo $get_alba['wr_volume_date'];?>" <?php echo (!$get_alba['wr_volume_always']&&!$get_alba['wr_volume_end'])?'required':'';?>>
						<em class="pr10"><a class="button" id="volume_date_sel"><span>날짜선택</span></a></em>
						<input type="radio" name="volume_check" class="chk" value="wr_volume_always" <?php echo ($get_alba['wr_volume_always'])?'checked':'';?> id="wr_volume_always" onclick="wr_volume_checks(this);"/>
						<label for="wr_volume_always">상시모집</label>
						<input type="radio" name="volume_check" class="chk" value="wr_volume_end" <?php echo ($get_alba['wr_volume_end'])?'checked':'';?> id="wr_volume_end" onclick="wr_volume_checks(this);"/>
						<label for="wr_volume_end">채용시까지</label>

					</div>
				</td>
			</tr>
			<?php if($form_requisition['view']=='yes'){ ?>
			<tr>
				<th class="vt" scope="row"> <label><?php if($form_requisition['etc_0']){ ?><img alt="필수입력사항" src="../images/icon/icon_b.gif" ><?php } ?>접수방법</label></th>
				<td>
					<div class="passtypeWrap pb5 clearfix">
						<ul>
							<li>
								<input type="checkbox" class="chk requisition_chk" id="wr_requisition_online" name="wr_requisition[]" value="online" onclick="requisition_sel(this);" <?php echo ($form_requisition['etc_0'])?'required':'';?> hname="접수방법" option="checkbox" <?php echo (@in_array('online',$wr_requisition))?'checked':'';?>>
								<label for="wr_requisition_online"><strong class="text_orange">온라인지원</strong></label>
							</li>
							<li>
								<input type="checkbox" class="chk requisition_chk" id="wr_requisition_email" name="wr_requisition[]" value="email" onclick="requisition_sel(this);" <?php echo ($form_requisition['etc_0'])?'required':'';?> hname="접수방법" option="checkbox" <?php echo (@in_array('email',$wr_requisition))?'checked':'';?>>
								<label for="wr_requisition_email"><strong class="text_orange">e-메일지원</strong></label>
							</li>
							<li>
								<input type="checkbox" class="chk" id="wr_requisition_phone" name="wr_requisition[]" value="phone" onclick="requisition_sel(this);" <?php echo ($form_requisition['etc_0'])?'required':'';?> hname="접수방법" option="checkbox" <?php echo (@in_array('phone',$wr_requisition))?'checked':'';?>>
								<label for="wr_requisition_phone">전화연락</label>
							</li>
							<li>
								<input type="checkbox" class="chk" id="wr_requisition_meet" name="wr_requisition[]" value="meet" onclick="requisition_sel(this);" <?php echo ($form_requisition['etc_0'])?'required':'';?> hname="접수방법" option="checkbox" <?php echo (@in_array('meet',$wr_requisition))?'checked':'';?>>
								<label for="wr_requisition_meet">방문접수</label>
							</li>
							<li>
								<input type="checkbox" class="chk" id="wr_requisition_post" name="wr_requisition[]" value="post" onclick="requisition_sel(this);" <?php echo ($form_requisition['etc_0'])?'required':'';?> hname="접수방법" option="checkbox" <?php echo (@in_array('post',$wr_requisition))?'checked':'';?>>
								<label for="wr_requisition_post">우편</label>
							</li>                
							<li>
								<input type="checkbox" class="chk" id="wr_requisition_fax" name="wr_requisition[]" value="fax" onclick="requisition_sel(this);" <?php echo ($form_requisition['etc_0'])?'required':'';?> hname="접수방법" option="checkbox" <?php echo (@in_array('fax',$wr_requisition))?'checked':'';?>>
								<label for="wr_requisition_fax">팩스</label>
							</li>
							<li>
								<input type="checkbox" class="chk" id="wr_requisition_homepage" name="wr_requisition[]" value="homepage" onclick="requisition_sel(this);" <?php echo ($form_requisition['etc_0'])?'required':'';?> hname="접수방법" option="checkbox" <?php echo (@in_array('homepage',$wr_requisition))?'checked':'';?>>
								<label for="wr_requisition_homepage">홈페이지</label>
							</li>
						</ul>
					</div>

					<div class="homepage requisition" id="homepage_input" style="display: <?php echo (@in_array('homepage',$wr_requisition))?'':'none';?>;">
						http:// <input type="text" style="width:400px;" class="ipText" id="wr_homepage" name="wr_homepage" value="<?php echo $get_alba['wr_homepage'];?>">
					</div>
					<div class="emailLayer requisition" id="form_input" style="display: <?php echo (@in_array('online',$wr_requisition)||@in_array('email',$wr_requisition))?'':'none';?>;">
						<input type="checkbox" class="chk" id="wr_form" name="wr_form" value="1" <?php echo ($get_alba['wr_form'])?'checked':'';?> onclick="attach_view(this);"> 
						<label for="wr_form">자사양식지원</label>
							<span id="acceptmethod2AttachChoice">
							(
							<input type="radio" id="wr_form_required_1" class="chk" name="wr_form_required" value="1" checked> 
							<label for="wr_form_required_1">필수</label>,
							<input type="radio" id="wr_form_required_0" class="chk" name="wr_form_required" value="0" <?php echo (!$get_alba['wr_form_required'])?'checked':'';?>> 
							<label for="wr_form_required_0">선택</label>
							)
							<input type="file" class="txtForm" style="width:200px; height:20px;display:none;" size="32" id="wr_form_attach" name="wr_form_attach" value="<?php echo $get_alba['wr_form_attach'];?>">
							<?php if($get_alba['wr_form_attach']){ // 등록된 양식 파일이 있다면?>
							<div style="padding-top:5px;">등록된 파일 :: <a href="javascript:file_download('<?php echo $alice['alba_path'];?>/download.php?no=<?php echo $no;?>','<?php echo $get_alba['wr_form_attach'];?>');"><?php echo $wr_form_attach[1];?></a></div>
							<?php } ?>
						</span>
					</div>
				</td>
			</tr>
			<?php } ?>
			<?php if($form_paper['view']=='yes'){ ?>
			<tr>
				<th scope="row"> <label><?php if($form_paper['etc_0']){ ?><img alt="필수입력사항" src="../images/icon/icon_b.gif" ><?php } ?>제출서류</label></th>
				<td>
					<div class="documentWrap pb5 clearfix">
					<ul>
					<?php 
						foreach($pt_papers as $val){ 
						$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
					?>
						<li>
							<input type="checkbox" class="chk" id="wr_papers_<?php echo $val['code'];?>" name="wr_papers[]" value="<?php echo $name;?>" <?php echo (@in_array($name,$wr_papers))?'checked':'';?> <?php echo ($form_paper['etc_0'])?'required':'';?> hname="제출서류" option="checkbox">
							<label for="wr_papers_<?php echo $val['code'];?>"><?php echo $name;?></label>
						</li>
					<?php } ?>
					</ul>
					</div>
				</td>
			</tr>
			<?php } ?>
			<?php if($form_question['view']=='yes'){ ?>
			<tr>
				<th scope="row" class="bbend vt"> <label><?php if($form_question['etc_0']){ ?><img alt="필수입력사항" src="../images/icon/icon_b.gif" ><?php } ?>사전질문</label></th>
				<td class="bbend">
					<div class="testKeyword">
						<em class="help text_help">사전인터뷰 질문을 등록하시면 온라인 입사지원시 지원자가 이력서와 함께 질문에 대한 답변을 작성해서 보냅니다.</em>
						<textarea style="width:580px; height:100px; padding:10px;" id="wr_pre_question" class="ipTextarea" name="wr_pre_question" <?php echo ($form_question['etc_0'])?'required':'';?> hname="사전질문"><?php echo stripslashes($get_alba['wr_pre_question']);?></textarea>
					</div>
				</td>
			</tr>
			<?php } ?>
			</tbody>
			</table>
			</div>
		</div>
		<!--  //모집내용 -->

		<!--  상세모집요강   -->
		<div class="listWrap mt30">
			<h2 class="pb5"> <img src="../images/tit/company_nav_tit_08.gif" width="137" height="25" alt="모집내용"> </h2>
			<div class="registWrap clearfix">
			<table>
			<caption><span class="skip">상세모집요강 입력</span></caption>
			<colgroup><col width="159px"><col width="*"></colgroup>
			<tbody>
			<tr>
				<td scope="row" class="bbend vt"> 
					<div class="detailboxWrap pt5 clearfix">
					<ul>
						<li>
							<input type="checkbox" class="chk" id="wr_content_all" name="wr_content_all" value="1" onclick="ed_wr_content.content_all(this);">
							<label for="wr_content_all"><strong>전체선택</strong></label>
						</li>
						<?php
						if($alba_content_list){
							foreach($alba_content_list as $val){
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
						?>
						<li>
							<input type="checkbox" class="chk" name="wr_content_check" id="<?php echo $val['code'];?>" value="<?php echo $name;?>" onclick="ed_wr_content.content_checks(this,'<?php echo $val['code'];?>');">
							<label for="<?php echo $val['code'];?>"><?php echo $name;?></label>
						</li>
						<?php 
							} // foreach end.
						}	// if end.
						?>
					</ul>
					</div>
				</td>
				<td class="bbend vt" style="width:720px;">
					<div class="detailbox">
						<?php echo $utility->make_cheditor("wr_content", stripslashes($get_alba['wr_content']));	// 에디터 생성?>
						<!-- <textarea style="width:580px; height:100px; padding:10px;" id="wr_content" class="ipTextarea" name="wr_content">
						＊ 업무내용
						- 
						</textarea> -->
					</div>
				</td>
			</tr>
			</tbody>
			</table>
			</div>
		</div>
		<!--  상세모집요강 end   -->

		<!--  button   -->
		<div class="doubleBtn clearfix" style="margin:30px auto;">
			<ul> 
				<li><div class="btn font_white bg_blueBlack"><a href="javascript:alba_submit();">다음 단계로<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right2.png" class="pb5"></a></div></li>
				<li><div class="btn font_gray bg_white"><a href="./alba_list.php">취소<img width="30" height="9" class="pb5" src="../images/icon/icon_arrow_right3.png" alt="arrow"></a></div></li>
			</ul>
		</div>
		<!--  //button end  -->

		</form>

		</div>


	</div>
</section>
