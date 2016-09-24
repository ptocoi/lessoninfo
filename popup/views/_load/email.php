<?php
		/*
		* /application/popup/views/_load/email.php
		* @author Harimao
		* @since 2013/07/26
		* @last update 2013/08/05
		* @Module v3.5 ( Alice )
		* @Brief :: Email form ajax load
		* @Comment :: 이메일 전달  폼
		*/

		$alice_path = "../../../../";
		
		$cat_path = "../../../";

		include_once $alice_path . "_core.php";

		$mode = $_POST['mode'];
		$no = $_POST['no'];
		$mb_id = $_POST['mb_id'];

		$get_member = $user_control->get_member($mb_id);

		switch($mode){

			## 알바 이력서 이메일 전달
			case 'alba_resume':
?>
				<form method="post" name="albaResumeEmailFrm" action="../popup/process/email.php" id="albaResumeEmailFrm">
				<input type="hidden" name="mode" value="<?php echo $mode;?>"/>
				<input type="hidden" name="mb_id" value="<?php echo $mb_id;?>"/>
				<input type="hidden" name="no" value="<?php echo $no;?>"/>
				<div id="popup" class="content_wrap clearfix" style="position:absolute;z-index:1000;"><!-- top:500px;left:500px; -->
					<div class="layerPop border_blue" style="display:block; width:494px; margin:0 auto; text-align:left; ">
						<dl>
							<dt style="padding:20px 15px; cursor:pointer;" class="bg_blue2 font18" id="popupHandle"><strong>내 이력서 e-메일 전달</strong>
								<em class="closeBtn"><img width="11" height="11" alt="arrow" src="../images/icon/icon_close2.gif" class="pb5"></em> 
							</dt>
							<!--  이력서선택   -->                
							<dd style="padding:20px 15px 10px;">
								<p style="padding-bottom:5px; padding-left:15px; background:url(../images/icon/icon_arrow_right1.gif) no-repeat 0 20%;">
									<strong>내이력서 e-메일 전달</strong><br/>
								</p>
								<div class="bgBox2 clearfix" >
									<ul class="resume3" style="display:block;">
										<li><span>보내는 사람</span><?php echo $get_member['mb_name'];?></li>
										<li><span>보내는 사람 e-메일</span><?php echo $get_member['mb_email'];?></li>
										<li><span>받는 사람  e-메일</span><input type="text" name="receive_email" id="receive_email" class="ipText2" style="width:250px;"></li>
										<li><span>e-메일 제목</span><input type="text" name="email_subject" id="email_subject" class="ipText2" style="width:250px;"></li>
									</ul>
								</div>
							</dd>
							<dd style="padding:10px 15px 10px; display:block;">
								<p style="padding-bottom:5px; padding-left:15px; background:url(../images/icon/icon_arrow_right1.gif) no-repeat 0 20%;">
									<strong>전달메세지</strong><br/>
								</p>
								<div class="bgBox clearfix" >
									<textarea name="email_content" class="ipTextarea" id="email_content" style="width:420px; height:50px; padding:10px;"></textarea>
								</div>
							</dd>
						</dl>

						<div style="margin:30px auto;" class="doubleBtn clearfix">
							<ul> 
								<li><div class="btn font_white bg_blueBlack"><a href="javascript:email_send();">전송<img width="30" height="9" class="pb5" src="../images/icon/icon_arrow_right2.png" alt="arrow"></a></div></li>
								<li><div class="btn font_gray bg_white"><a onclick="$('#popup').hide();">취소<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right3.png" class="pb5"></a></div></li>
							</ul>
						</div>
					</div>
				</div>
				</form>
<?php
			break;
		}
?>