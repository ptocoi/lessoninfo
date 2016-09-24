<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<div id="photo" class="style<?php echo $design['main_left'];?> mt30 clearfix">
	<h2 class="mb5 title clearfix">
		<div class="fl"><img src="../images/tit/tit_06.gif" width="52" height="19" alt="title">  </div>
		<div class="fl pr5 pt4" style="background-color:#fff;"><img style=" vertical-align:baseline;" src="../images/tit/tit_s_02.gif" width="55" height="15" alt="title">
		</div>
		<div class="fr pl5" style="background-color:#fff;"><a href="<?php echo $alice['service_path'];?>/?type=resume"><img src="../images/main/btn_info_1.gif" width="54" height="17" alt="상품안내"></a>
		</div>
	</h2>
	<ul class="clearfix">

		<!-- view layer -->
		<div class="quickView clearfix positionA" style="display:none; left:5px; z-index:2000;" id="focus_quickView"></div>
		<!-- // view layer -->

		<?php
			$i = 0;
			foreach($focus_list['result'] as $key => $val){
			$no = $val['no'];
			$list = $alba_resume_user_control->get_resume_service($no,"main_focus",44);
			if($list['is_photo']){	 // 이력서 사진이 있다면
				$src = $list['photo_path'];
				$get_img = @getimagesize($src); // 파일정보를 가져옴
				$thumb_path = $alice['data_member_path'] . "/" . $val['wr_id'];
				$img_step1 = explode("/",$src);
				$img_step2 = explode(".",$img_step1[4]);
				$new_imgname = $img_step2[0];
				$thumb_file_list = $thumb_path . "/50x65_".$new_imgname;
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
								$utility->createThumb_list(50,65,$src, $thumb_file_list); // list 페이지 썸네일
							}
						}
					}
				}
			} else {	 // 없다면
				$thumb_file_list = $alice['images_path'] . "/basic/bg_noPhoto.gif";
			}
		?>
		<li class="<?php echo ($i == ($focus_list_total-1))?'Rend':'';?> <?php echo $list['gold_service'];?>" id="focus_<?php echo $no;?>">
			<dl>
				<dt>
					<a href="<?php echo $alice['resume_path'];?>/alba_resume_detail.php?no=<?php echo $no;?>"><span class="photo"><img src="<?php echo $thumb_file_list;?>"/></span></a> 
				</dt>
				<dd class="name_wrap">
					<span class="name"><?php echo $list['wr_name'];?></span>
					<span>(<?php echo $list['wr_gender'];?><?php echo $list['wr_age'];?>)</span>
					<span><?php echo $list['wr_career'];?></span>
				</dd>
				<dd class="text1"><?php echo $list['service_icon'];?><a href="<?php echo $alice['resume_path'];?>/alba_resume_detail.php?no=<?php echo $no;?>"><?php echo $list['subject'];?></a></dd>
				<dd class="text2"><span class="school"style="color:#8f8f8f"><?php echo $list['school_ability'];?><?php echo ($list['specialize'])?": ".$list['specialize']:"";?></span></dd>
				<dd class="icons" >
					<div><a id="" class="star" href="javascript:resume_scrap('<?php echo $no;?>');"><img width="13" height="13" alt="공고스크랩" src="../images/icon/icon_star.png"></a></div>
					<div><a id="" class="plus" href="javascript:focus_open('<?php echo $no;?>');"><img width="13" height="13" alt="상세보기" src="../images/icon/icon_plus.png"></a></div>
				</dd>
			</dl>
		</li>
		<?php
		$i++;
		}	 // foreach end. 
		?>

		<?php 
		if($focus_rest != $focus_rows){
			for($i=0;$i<$focus_rest;$i++){ 
			$Rend = ($i == ($focus_rest-1)) ? 'Rend' : '';
		?>
			<li class="bg"><!--신규광고 신청 -->
				<a style="background:url(../images/basic/bg_service2.gif) no-repeat 50% 50%;" class="service" href="<?php echo $alice['service_path'];?>/?type=resume"></a>
			</li><!--신규광고 신청// -->
		<?php 
			} // for end.
		}	// if end.
		?>
	</ul>
</div>
<script>
var focus_open = function( no ){	// 포커스 이력서 상세보기
	var $focus = $('#focus_'+no);
	var position_top = $focus.position().top;
	$('#focus_quickView').hide();
	$('#focus_quickView').load('./main/views/_load/alba.php', { mode:'focus', no:no }, function(){
		position_tops = position_top - 2;
		$(this).css({
			"top" : position_tops+"px",
			"left" : "0px"
		});
		$(this).show();
	});

}
var focus_close = function(){	// 포커스 이력서 레이어 닫기
	$('#focus_quickView').hide();
}
</script>