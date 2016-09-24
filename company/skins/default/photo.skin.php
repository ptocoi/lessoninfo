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
			<p> <a href="/">HOME</a> > <a href="<?php echo $alice['company_path'];?>/">기업서비스</a> > <a href="<?php echo $alice['member_path'];?>/update_form.php">기업정보 관리</a> > <strong>기업로고·사진관리</strong> </p>
		</div>
		<?php /* //navigation */ ?>

		<!--  기업로고·사진관리 설정   -->
		<div class="rightWrap mt30">
			<h2 class="pb5"><img src="../images/tit/company_tit_09.gif" width="185" height="25" alt="기업로고·사진관리"></h2>
			<em class="titEm mb20">
			<ul>
				<li>신뢰도 높은 채용공고를 위해 로고를 등록해주세요.</li>
			</ul>
			</em>
			<div class="logo1 positionR">
				<h3 class="pb5 h3">
					<img class="bg_blue4" src="../images/icon/icon_arrow_4.png" width="13" height="13" alt=""> <strong>기업 로고 관리</strong>
				</h3>
				<div class="contentWrap positionR clearfix">
					<!--  로고등록 창  -->                
					<div class="layerPop positionA border_blue" style="display:block; width:420px; top:0; left:50%; margin-left:-210px; ">
						<dl style="">
							<dt style="padding:20px 15px;" class="bg_blue2"><strong>로고 등록</strong>
							<em class="closeBtn"><img width="11" height="11" class="pb5" src="../images/icon/icon_close2.gif" alt="arrow"></em></dt>
							<dd style="padding:10px 15px;">
								<p style="padding-bottom:20px;"><strong>GIF,JPEG,JPG</strong> 파일형식으로,<br>
								<strong>200*100픽셀, 100KB</strong> 용량 이내의 파일만 등록 가능합니다.<br></p>
								<div class="box2" style="border:1px solid #ddd; padding:10px;">
								<input type="file" name="up_file" id="lbFile" size="32" style="height:20px;" class="txtForm"></div>
								<div style="margin:20px auto;" class="btn font_gray bg_white"><a href="#">등록하기<img width="30" height="9" class="pb5" src="../images/icon/icon_arrow_right3.png" alt="arrow"></a></div>
							</dd>
						</dl>
					</div> 
					<!--  로고등록 창 end -->                
					<ul class="clearfix" >
						<li class="bg positionR pr10">
						<div class="companyLogo">
						<img width="200" height="100" alt="logo" src="../images/basic/bg_noLogo200100.gif"><!--<img width="200" height="100" alt="logo" src="../images/logo/logo_netfu_200100.gif">-->
						<div class="mt20"> 
						<a class="button white"><span>수정<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span></a> 
						<a class="button white"><span>삭제<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span></a> 
						</div>
						</div>                    
						</li>
						<li class="positionR">
						<p>로고를 등록하시면 회사의 신뢰도가 상승합니다.<br></p>                    
						<p class="bbend">로고 사이즈 규격은 <strong>200 * 100 pixel</strong>로 해주세요.<br/>
						<strong>gif, jpeg, jpg</strong> 파일 형식으로, 용량은 1MB 이내의 파일만 등록 가능합니다.<br/>
						</p> 
						</li>
					</ul>
				</div> 
			</div>
	
					<div class="mt50 photo2 positionR">
						<!--  사진등록 창  -->           
						<div class="layerPop positionA border_blue" style="display:block; width:420px; bottom:0; left:50%; margin-left:-210px;" >
							<dl style="">
								<dt class="bg_blue2" style="padding:20px 15px;"><strong>사진 등록</strong><em class="closeBtn"><img width="11" height="11" alt="arrow" src="../images/icon/icon_close2.gif" class="pb5"></em></dt>
								<dd style="padding:10px 15px;">
									<p style="padding-bottom:20px;"><strong>GIF,JPEG,JPG</strong> 파일형식으로,<br>
									<strong>1MB</strong> 용량 이내의 파일만 등록 가능합니다.<br></p>
									<div style="border-top:2px solid #ddd; border-bottom:2px solid #ddd;" class="box2">
										<ul>
											<li style="border-bottom:1px solid #f1f1f1; background-color:#f8f8f8; height:40px; line-height:40px;"><strong style="display:inline-block; padding-left:10px; width:80px;">이미지</strong><input type="file" class="txtForm" style="height:20px;" size="32" id="lbFile" name="up_file"></li>
											<li style=" background-color:#f8f8f8;  height:40px; line-height:40px;"><strong style="display:inline-block; padding-left:10px; width:80px;">제목</strong><input type="text" style="width:255px;" maxlength="15"  class="ipText" id="" name="Title"></li>
										</ul>
									</div>
									<div class="btn font_gray bg_white" style="margin:20px auto;"><a href="#">등록하기<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right3.png" class="pb5"></a></div>
								</dd>
							</dl>
						</div> 
						<!--  사진등록 창 end -->                    
						<h3 class="pb5 h3">
							<img class="bg_blue4" src="../images/icon/icon_arrow_4.png" width="13" height="13" alt=""> <strong>기업 사진 관리</strong>
						</h3>
						<div class="contentWrap positionR clearfix">
							<ul>
							<li>
								<em>사진을 등록하세요</em>
								<div class="picture">
								<img width="150" height="100" alt="photo" src="../images/basic/img_photo.jpg">                
								<div class="mt10"> 
								<a class="button white"><span>등록<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span></a> 
								<a class="button white"><span>삭제<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span></a> 
								</div>
								</div>
							</li>
							<li>
								<em>사진을 등록하세요</em>
								<div class="picture">
									<img width="150" height="100" alt="photo" src="../images/basic/img_photo.jpg">                
									<div class="mt10"> 
									<a class="button white"><span>등록<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span></a> 
									<a class="button white"><span>삭제<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span></a> 
									</div>
								</div>
							</li>
							<li>
								<em>사진을 등록하세요</em>
								<div class="picture">
									<img width="150" height="100" alt="photo" src="../images/basic/img_photo.jpg">                
									<div class="mt10"> 
									<a class="button white"><span>등록<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span></a> 
									<a class="button white"><span>삭제<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span></a> 
									</div>
								</div>
							</li>
							<li>
								<em>사진을 등록하세요</em>
								<div class="picture">
									<img width="150" height="100" alt="photo" src="../images/basic/img_photo.jpg">                
									<div class="mt10"> 
									<a class="button white"><span>등록<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span></a> 
									<a class="button white"><span>삭제<img width="3" height="5" style="vertical-align:middle;" alt="arrow" src="../images/icon/icon_arrow_3.gif" class="pl5"></span></a> 
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div> 
			</div>

		</div>
	</div>
</section>