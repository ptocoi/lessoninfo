<div id="mFocus">
	<h2><em class="icon"><img  class="bg_color1" src="../images/icon/icon_mFocus1.png"></em><span>포커스 인재정보</span></h2>
	<ul class="boxWrap clearfix positionR" id="sub_focus">
	<?php
	for($i=0;$i<$sub_focus_list_count;$i++){
		$no = $sub_focus_list['result'][$i]['no'];
		$wr_id = $sub_focus_list['result'][$i]['wr_id'];
		$list = $alba_resume_user_control->get_resume_service($no,"sub_focus",44);
		if($list['is_photo']){	 // 이력서 사진이 있다면
			$src = $list['photo_path'];
			$get_img = @getimagesize($src); // 파일정보를 가져옴
			$thumb_path = $alice['data_member_path'] . "/" . $wr_id;
			$img_step1 = explode("/",$src);
			$img_step2 = explode(".",$img_step1[4]);
			$new_imgname = $img_step2[0];
			$thumb_file_list = $thumb_path . "/70x91_".$new_imgname;
			if(!file_exists($thumb_file_list)){
				$gd = gd_info();		// gd lib 체크
				$gdversion = substr(preg_replace("/[^0-9]/", "", $gd['GD Version']), 0, 2); // gd 버전이 2.0 이상인지 체크
				if(!$gdversion){ 
					$thumb_file_list = $src; // gd 2.0 이하면 강제적으로 줄임
				}else{
					if($get_img[0] <= $re_img_width){
						$thumb_file_list = $src;
						$img_height = $re_img_height;
						$img_width = $re_img_width;
					}else{
						// 정비율
						if ($get_img[0] >= $re_img_width){
							$rate = $re_img_width / $get_img[0];
							$img_width = $re_img_width;
							$img_height = (int)($get_img[1] * $rate);
						}

						// 섬네일 파일 체크
						if(!file_exists($thumb_file_list)){
							$utility->createThumb_list(70,91,$src, $thumb_file_list); // list 페이지 썸네일
						}
					}
				}
			}
		} else {	 // 없다면
			$thumb_file_list = $alice['images_path'] . "/basic/bg_noPhoto.gif";
		}

	?>
		<li class="<?php echo $list['gold_service'];?>">
			<dl>
				<dt>
					<a href="./detail.html?no=<?php echo $no;?>"><span class="photo"><img src="<?php echo $thumb_file_list;?>" alt="사진"></span></a> 
				</dt>
				<dd class="name_wrap">
					<span class="name"><?php echo $list['wr_name'];?></span>
					<span>(<?php echo $list['wr_gender'];?><?php echo $list['wr_age'];?>)</span>
				</dd>
				<dd class="text1"><a href="./detail.html?no=<?php echo $no;?>" class=""><?php echo $list['subject'];?></a></dd>
			</dl>
		</li>
	<?php } // for end.?>
	</ul>
</div>
<div class="paging mt20 mb50">
	<span class="page">
	<span id="sub_focus_first"></span>
	<?php
		$sub_focus_pages = str_replace("처음", "<img src=\"../images/btn/btn_leftArrow2.png\" class=\"bg_color1\"><img src=\"../images/btn/btn_leftArrow2.png\" class=\"bg_color1\">", $sub_focus_pages);
		$sub_focus_pages = str_replace("이전", "<img src=\"../images/btn/btn_leftArrow2.png\" class=\"bg_color1\">", $sub_focus_pages);
		$sub_focus_pages = str_replace("다음", "<img src=\"../images/btn/btn_rightArrow2.png\" class=\"bg_color1\">", $sub_focus_pages);
		$sub_focus_pages = str_replace("맨끝", "<img src=\"../images/btn/btn_rightArrow2.png\" class=\"bg_color1\"><img src=\"../images/btn/btn_rightArrow2.png\" class=\"bg_color1\">", $sub_focus_pages);
		$sub_focus_pages = preg_replace("/<b>([0-9]*)<\/b>/", "$1", $sub_focus_pages);
		echo $sub_focus_pages;
	?>
	</span>
</div>