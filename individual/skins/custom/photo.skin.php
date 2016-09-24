<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
</script>

<script type="text/javascript" src="<?php echo $alice['individual_path'];?>/skins/default/photo.skin.js"></script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent"> 
		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['individual_path'];?>/">개인서비스</a> > <a href="<?php echo $alice['individual_path'];?>/alba_resume.php">이력서관리</a> > <strong>내 사진 관리</strong> </p>
		</div>
		<?php /* //navigation */ ?>

		<!--  이력서사진 설정   -->
		<div class="rightWrap mt30">
			<h2 class="pb5"><img src="../images/tit/person_nav_tit_13.gif" width="129" height="25" alt="이력서공개설정"></h2>
			<em class="titEm mb20">
				<ul>
					<li>성의있는 이력서를 만들기 위한 첫걸음! 이력서 사진을 등록해주세요.</li>
				</ul>
			</em>

			<form method="post" name="MemberUpdateFrm" action="<?php echo $alice['member_path'];?>/process/regist.php" id="MemberUpdateFrm" enctype="multipart/form-data">
			<input type="hidden" name="ajax" value="true"/>
			<input type="hidden" name="mode" value="profile_photo_upload"/>
			<input type="hidden" name="mb_type" value="<?php echo $mb_type;?>"/>
			<input type="hidden" name="mb_id" value="<?php echo $member['mb_id'];?>"/>
			<input type="hidden" name="no" value="<?php echo $member['no'];?>"/>

			<div class="photo1 positionR">
				<h3 class="pb5 h3"><img class="bg_color4" src="../images/icon/icon_arrow_4.png" width="13" height="13" alt=""> <strong>이력서 사진 관리</strong></h3>
				<div class="contentWrap positionR clearfix">
				<ul class="clearfix" >
					<li class="bg positionR pr10">
						<div class="personphoto">
							<img src="<?php echo $mb_photo;?>" width="100" height="130" alt="photo" id="personphoto"/>
							<div class="mt20"> 
								<a class="button white" onclick="profile_photo_pop();"><span id="personphoto_status"><?php echo ($member['mb_photo'])?'수정':'등록';?><img class="pl5"src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span></a>
								<span id="photo_remove" style="display:<?php echo ($member['mb_photo'])?'':'none';?>;">
								<a class="button white" onclick="profile_photo_remove();"><span>삭제<img class="pl5"src="../images/icon/icon_arrow_3.gif" width="3" height="5" alt="arrow" style="vertical-align:middle;"></span></a> 
								</span>
							</div>
						</div>
					</li>
					<li class="positionR ">
						<p>얼굴이 정면으로 보이는 사진을 등록해주세요.<br/>
						단체 사진 또는 지나친 수정으로 실물과 다른 사진은 등록을 피해주세요.</p>
						<p class="bbend">사진의 규격은 <strong>100 * 130 pixel</strong>이 적절합니다.<br/>
						<strong>GIF,JPG,PNG</strong> 파일 형식으로, 용량은 100KB 이내의 파일만 등록 가능합니다.<br/>
						</p> 
					</li>
				</ul>
				</div> 

				<!-- 이미지 등록 layer -->
				<div style="display:none; width:420px; top:0; left:25%; text-align:left;" class="layerPop positionA border_color5" id="profilePhotoPop">
					<dl style="">
						<dt class="bg_gray1"  id="profilePhotoPop_handle" style="padding:20px 15px; cursor:pointer;"><strong>프로필사진 수정</strong>
							<em class="closeBtn" id="profilePhotoPop_close"><img width="11" height="11" alt="arrow" src="../images/icon/icon_close2.gif" class="pb5"></em>
						</dt>
						<dd style="padding:10px 15px;">
							<p style="padding-bottom:20px;">
								<strong>GIF,JPG,PNG</strong> 파일형식으로,<br>
								<strong>100*130픽셀, 100KB</strong> 용량 이내의 파일만 등록 가능합니다.<br>
							</p>
							<div style="border:1px solid #ddd; padding:10px;" class="box2">
								<input type="file" class="txtForm" style="height:20px;" size="32" id="photo_file" name="photo_file">
							</div>
							<div class="btn font_gray bg_white" style="margin:20px auto;">
								<a href="javascript:photo_submit();">등록하기<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right3.png" class="pb5"></a>
							</div>
						</dd>
					</dl>
				</div>
				<!-- //이미지 등록 layer -->

			</div>

			</form>

			<form method="post" name="AlbaResumeFrm" action="<?php echo $alice['individual_path'];?>/process/alba_resume.php" id="AlbaResumeFrm" enctype="multipart/form-data" onsubmit="return validate(this);">
			<input type="hidden" name="mode" value="photo_uploads" id="mode"/>
			<input type="hidden" name="mb_type" value="<?php echo $mb_type;?>"/>
			<input type="hidden" name="mb_id" value="<?php echo $member['mb_id'];?>"/>
			<input type="hidden" name="mb_no" value="<?php echo $member['no'];?>"/>

			<!--  사진등록 layer  -->        
			<!-- <div class="layerPop positionA border_color5" style="display:none; width:420px; top:100%; left:40%; text-align:left;" id="individualPhotoPop"> -->
			<div style="z-index: 9999; display: none; left: 50%; top: 50%; margin-left: -250px; margin-top: -250px;width:420px;" class="layerPop border_color5 positionF content_wrap clearfix " id="individualPhotoPop">
				<input type="hidden" name="mb_photos" id="mb_photos"/>
				<dl style="">
					<dt style="padding:20px 15px;cursor:pointer;" class="bg_gray1" id="individualPhotoPop_handle">
						<strong>사진 등록</strong>
						<em class="closeBtn"><img width="11" height="11" class="pb5" src="../images/icon/icon_close2.gif" alt="arrow"></em>
					</dt>
					<dd style="padding:10px 15px;">
						<p style="padding-bottom:20px;"><strong>GIF,JPEG,JPG</strong> 파일형식으로,<br>
						<strong>500KB</strong> 용량 이내의 파일만 등록 가능합니다.<br></p>
						<div class="box2" style="border:1px solid #ddd; padding:10px;">
							<input type="file" name="photo_files" id="photo_files" size="32" style="height:20px;" class="txtForm">
						</div>
						<div style="margin:20px auto;" class="btn font_gray bg_white"><a href="javascript:photos_submit();">등록하기<img width="30" height="9" class="pb5" src="../images/icon/icon_arrow_right3.png" alt="arrow"></a></div>
					</dd>
				</dl>
			</div>
			<!--  //사진등록 layer   -->

			<div class="mt50 photo2 positionR">
				<h3 class="pb5 h3"><img class="bg_color4" src="../images/icon/icon_arrow_4.png" width="13" height="13" alt=""> <strong>포토앨범 관리</strong></h3>
				<div class="contentWrap positionR clearfix">
				<ul>
					<li>
						<em>사진을 등록하세요</em>
						<div class="picture">
							<img width="150" height="100" alt="photo" src="<?php echo $photo_0;?>" id="mb_photo_0">
							<div class="mt10"> 
								<a class="button white" onclick="update_photos('update', 0);" id="update_0"><span>등록<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span></a> 
								<a class="button white" onclick="update_photos('delete', 0);" id="delete_0"><span>삭제<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span></a> 
							</div>
						</div>
					</li>
					<li>
						<em>사진을 등록하세요</em>
						<div class="picture">
							<img width="150" height="100" alt="photo" src="<?php echo $photo_1;?>" id="mb_photo_1">
							<div class="mt10"> 
								<a class="button white" onclick="update_photos('update', 1);" id="update_1"><span>등록<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span></a> 
								<a class="button white" onclick="update_photos('delete', 1);" id="delete_1"><span>삭제<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span></a> 
							</div>
						</div>
					</li>
					<li>
						<em>사진을 등록하세요</em>
						<div class="picture">
							<img width="150" height="100" alt="photo" src="<?php echo $photo_2;?>" id="mb_photo_2">
							<div class="mt10"> 
								<a class="button white" onclick="update_photos('update', 2);" id="update_2"><span>등록<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span></a> 
								<a class="button white" onclick="update_photos('delete', 2);" id="delete_2"><span>삭제<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span></a> 
							</div>
						</div>
					</li>
					<li>
						<em>사진을 등록하세요</em>
						<div class="picture">
							<img width="150" height="100" alt="photo" src="<?php echo $photo_3;?>" id="mb_photo_3">
							<div class="mt10"> 
								<a class="button white" onclick="update_photos('update', 3);" id="update_3"><span>등록<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span></a> 
								<a class="button white" onclick="update_photos('delete', 3);" id="delete_3"><span>삭제<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span></a> 
							</div>
						</div>
					</li>
				</ul>
				</div> 
			</div>

			</form>

		</div>
	</div>
</section>
