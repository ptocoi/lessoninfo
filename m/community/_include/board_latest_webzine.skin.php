<div class="mt50 comWrap">
	<h2>
		<em class="icon"><img  class="bg_color1" src="../images/icon/icon_mList1.png"></em>
		<span><?php echo $bo_subject;?><em class="text_color1">(<?php echo $bo_write_count;?>건)</em></span>
		<div class="titleBtn bg_color1  clearfix positionA" style="top:0; right:0;">
			<a href="./list.php?bo_table=<?php echo $bo_table;?>">더보기<img alt="" src="../images/btn/btn_rightArrow3.png"></a>	
		</div>
	</h2>
	<ul class="boxWrap clearfix positionR">
	<?php 
		$thumb_path = $alice['data_board_path'] . "/" . $bo_table . "/thumb";
		foreach($list_row['result'] as $list){ 
		$get_file = $board_control->get_file($board['bo_table'], $list['wr_no']);

		preg_match("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", $list['content'], $_img);

		if(!$_img){	 // 내용상 이미지가 없다면

			if($get_file[0]['view']){
				$src = $get_file[0]['path']."/".$get_file[0]['file'];
				$get_img = @getimagesize($src); // 파일정보를 가져옴

				// 관리자가 이미지 사이즈를 바꾸었을때를 대비하여 리사이징 크기를 이름에 포함과 이미지 재 첨부시 바뀜
				$img_step1 = explode("_",$get_file[0]['file']);
				$img_step2 = explode(".",$img_step1[1]);
				$new_imgname = $img_step2[0];
				$thumb_file_list = $thumb_path . "/80x47_".$new_imgname."_".$get_file['wr_no'];
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
								$utility->createThumb_list(80,47,$src, $thumb_file_list); // list 페이지 썸네일
							}
						}
					}
				}

				$img = $thumb_file_list;

			} else {

				$img = "../images/basic/img_01.gif";

			}

		} else {

			$img = ($_img[1]) ? $_img[1] : "../images/basic/img_01.gif";	// 169 x 100

		}
	?>
		<li class="webzineList positionR">
			<dl class="clearfix">
				<div style="position:absolute; left:0;top:0;">
					<a href="../community/view.html?bo_table=<?php echo $bo_table;?>&wr_no=<?php echo $list['wr_no'];?>"><img width="80" height="47" src="<?php echo $img;?>"></a>
				</div>
				<dt> 
					<a href="../community/view.html?bo_table=<?php echo $bo_table;?>&wr_no=<?php echo $list['wr_no'];?>" onclick="">
					<span class="tit"><?php echo stripslashes($list['wr_subject']);?></span></a>
				</dt>
				<dd class="text1 clearfix">
					<span class="id"><?php echo $list['wr_name'];?></span>
					<span class="date"><?php echo substr($list['wr_datetime'],0,11);?></span>
				</dd>
			</dl>
		</li>
	<?php } ?>
	</ul>
</div>
