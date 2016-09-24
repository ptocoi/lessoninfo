<div id="mFocus">
	<h2><em class="icon"><img  class="bg_color1" src="../images/icon/icon_mFocus1.png"></em><span>포커스 인재정보</span></h2>
	<ul class="boxWrap clearfix positionR" id="main_focus">
	<?php 
		for($i=0;$i<$main_focus_count;$i++){ 
		$main_focus_no = $main_focus['result'][$i]['no'];
		$get_resume = $alba_resume_user_control->get_resume_no($main_focus_no);	// 이력서 정보
		$wr_id = $get_resume['wr_id'];
		$get_member = $user_control->get_member($wr_id);	// 작성 회원 정보
		$get_payment = $payment_control->get_payment_for_oid($get_resume['wr_oid']);	 // 결제정보

		/* 회원 사진 */
		$wr_photo = $get_member['mb_photo'];
		if($wr_photo){
			$photo_path = $alice['data_member_path'] . '/' . $wr_id;
			$wr_photo = "<img src=\"".$photo_path."/".$get_member['mb_photo']."\" width=\"70\" height=\"91\"/>";
		} else {
			$wr_photo = "<img src=\"".$alice['images_path']."/basic/bg_noPhoto.gif\"/>";
		}
		/* // 회원 사진 */

		/* 이력서 이름 */
		if($is_member){		// 회원일때
			if($member['mb_type']=='company'){	 // 기업회원의 경우 열람권 체크
				$get_service = $member_control->get_service_member($member['mb_id']);
				$open_service_valid = $utility->valid_day($get_service['mb_service_open']);
				$is_open_resume = $alba_resume_user_control->is_open_resume('alba',$member['mb_id'],$wr_id);
				if($is_open_resume){	 // 열람 기록이 있다면 보여준다
					$wr_name = $name = stripslashes($get_member['mb_name']);
				} else {	 // 없음 감추기
					$wr_name = trim( $utility->make_pass_00( stripslashes($get_member['mb_name']) ) );
					$name = trim( $utility->make_pass_○○( stripslashes($get_member['mb_name']) ) );
				}
			} else if($member['mb_type']=='individual'){	 // 개인회원의 경우 자신의 이력서 인지 체크
				if($wr_id==$member['mb_id']){	// 내 이력서 라면
					$wr_name = $name = stripslashes($get_member['mb_name']);
				} else {	 // 내 이력서가 아니라면
					$wr_name = trim( $utility->make_pass_00( stripslashes($get_member['mb_name']) ) );
					$name = trim( $utility->make_pass_○○( stripslashes($get_member['mb_name']) ) );
				}
			}
		} else {	 // 회원이 아닐때 (무조건 감춤)
			$wr_name = trim( $utility->make_pass_00( stripslashes($get_member['mb_name']) ) );
			$name = trim( $utility->make_pass_○○( stripslashes($get_member['mb_name']) ) );
		}
		/* // 이력서 이름 */
		$wr_gender = $alba_resume_user_control->gender_text[$get_member['mb_gender']];	// 성별
		$get_age = $member_control->get_age($get_member['mb_birth']);	// 나이 (내/외국인 구분)

		$list = $alba_resume_user_control->get_resume_service($main_focus_no,"main_focus",44);
	?>
		<li class="<?php echo $list['gold_service'];?>"><!-- class="gold" -->
			<dl>
				<dt>
					<a href="../resume/detail.html?no=<?php echo $get_resume['no'];?>" onclick=""> 
					<span class="photo"><?php echo $wr_photo;?></span></a> 
				</dt>
				<dd class="name_wrap">
					<span class="name"><?php echo $wr_name;?></span>
					<span>(<?php echo $wr_gender;?><?php echo $get_age;?>)</span>
				</dd>
				<dd class="text1"><a href="../resume/detail.html?no=<?php echo $get_resume['no'];?>" class=""><?php echo stripslashes($get_resume['wr_subject']);?></a></dd>
			</dl>
		</li>
	<?php } ?>
	</ul>
</div>
<div class="paging mt20 mb50">
	<span class="page">
	<span id="main_focus_first"></span>
	<?php
		$main_focus_pages = str_replace("처음", "<img src=\"../images/btn/btn_leftArrow2.png\" class=\"bg_color1\"><img src=\"../images/btn/btn_leftArrow2.png\" class=\"bg_color1\">", $main_focus_pages);
		$main_focus_pages = str_replace("이전", "<img src=\"../images/btn/btn_leftArrow2.png\" class=\"bg_color1\">", $main_focus_pages);
		$main_focus_pages = str_replace("다음", "<img src=\"../images/btn/btn_rightArrow2.png\" class=\"bg_color1\">", $main_focus_pages);
		$main_focus_pages = str_replace("맨끝", "<img src=\"../images/btn/btn_rightArrow2.png\" class=\"bg_color1\"><img src=\"../images/btn/btn_rightArrow2.png\" class=\"bg_color1\">", $main_focus_pages);
		$main_focus_pages = preg_replace("/<b>([0-9]*)<\/b>/", "$1", $main_focus_pages);
		echo $main_focus_pages;
	?>
	</span>
</div>