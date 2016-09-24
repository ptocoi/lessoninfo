<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 
	$get_board_main = $board_config_control->get_main(1);	 // 1번 정보 추출
	$use_print = $get_board_main['use_print'];

	$width = $options['img_width'];
	$height = $options['img_height'];
	$thumb_path = $alice['data_board_path'].'/'.$bo_table.'/thumb/';
	if(!is_dir($thumb_path)){	// 썸네일 디렉토리가 없다면 생성한다.
		@mkdir($thumb_path, 0707);
		@chmod($thumb_path, 0707);
	}

	if($use_print==1){ 
?>

	<div class="mt30 comBoard list2 positionR clearfix">
		<h3><img class="mr5 vm bg_color4" width="13" height="13"  src="../images/icon/icon_arrow_4.png" alt=""><?php echo stripslashes($board['bo_subject']);?></h3>
		<em class="positionA" style="top:10px; right:10px;"><a href="./board.php?board_code=<?php echo $board_code;?>&code=<?php echo $board['code'];?>&bo_table=<?php echo $board['bo_table'];?>"><img width="42" height="15" class="vb bg_color4" src="../images/icon/icon_more1.gif" alt=""></a></em>
		<div class="webzinType positionR">
		<?php 
			for($i=0;$i<$rows;$i++){ 
			preg_match("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", stripslashes($list[$i]['content']), $content_image);	// 내용상 이미지가 존재하는 경우
			if($content_image){
				$image_pathinfo = pathinfo($content_image[1]);	// 이미지 경로 확인
				if(stristr($image_pathinfo['dirname'],$_SERVER['HTTP_HOST'])){	// 현 서버에 있는 이미지라면
					$dir_name = $image_pathinfo['dirname'];
					$file_name = $image_pathinfo['basename'];
					$image_path = strtr($dir_name,array("http://".$host_name=>"","https://".$host_name=>""));
					$_file = ".." . $image_path . "/" . $file_name;
					if(is_file($_file)){	// 파일이 존재한다면 썸네일 한다.
						$thumb_image = $alice['data_board_path'].'/'.$bo_table.'/thumb/'.$file_name;
						$utility->_thumbnail($_file,$thumb_image,$width,$height);
					} else {	 // 존재하지 않는다면
						$thumb_image = $content_image[1];
					}
				} else {	 // 현 서버에 없는 이미지라면
					$thumb_image = $content_image[1];
				}
			} else {	 // 내용상 이미지가 없다면
				if($list[$i]['file'][0]['path']."/".$list[$i]['file'][0]['file']){
					$src = $list[$i]['file'][0]['path']."/".$list[$i]['file'][0]['file'];
					$get_img = @getimagesize($src); // 파일정보를 가져옴
					$img_step1 = explode("_",$list[$i]['file'][0]['file']);
					$img_step2 = explode(".",$img_step1[1]);
					$new_imgname = $img_step2[0];
					$thumb_file_list = $thumb_path . $width."x".$height."_".$new_imgname."_".$list[$i]['wr_no'];
					if(!file_exists($thumb_file_list)){
						$utility->createThumb_lists($get_img,$width,$height,$src, $thumb_file_list); // list 페이지 썸네일
					}
					$thumb_image = $thumb_file_list;
				} else {
					$thumb_image = "../images/basic/img_01.gif";
				}
			}
		?>
			<dl class="positionR mb5" style="overflow:hidden;">
				<dt class="positionA" style="top:7px;left:100px;"><a href="./board.php?board_code=<?php echo $board_code;?>&code=<?php echo $list[$i]['code'];?>&bo_table=<?php echo $board['bo_table'];?>&wr_no=<?php echo $list[$i]['wr_no'];?>"> <?php echo $list[$i]['subject'];?></a></dt>
				<dd class="content positionA" style="left:100px; top:25px;">
				<a href="./board.php?board_code=<?php echo $board_code;?>&code=<?php echo $list[$i]['code'];?>&bo_table=<?php echo $board['bo_table'];?>&wr_no=<?php echo $list[$i]['wr_no'];?>" style="color:#999;"><?php echo strip_tags(stripslashes($list[$i]['content']));?></a>
				</dd>
				<dd class="image pl15"><a href="./board.php?board_code=<?php echo $board_code;?>&code=<?php echo $list[$i]['code'];?>&bo_table=<?php echo $board['bo_table'];?>&wr_no=<?php echo $list[$i]['wr_no'];?>"><img  alt="" src="<?php echo $thumb_image;?>" class="vm" style="width:<?php echo $width;?>px;height:<?php echo $height;?>px;"></a></dd>
			</dl>
		<?php } // for end. ?>
		</div>
	</div>

<?php } else if($use_print==2){ ?>

	<div class="mt30 comBoard list1 positionR clearfix">
		<h3><img class="mr5 vm bg_color4" width="13" height="13"  src="../images/icon/icon_arrow_4.png" alt=""><?php echo stripslashes($board['bo_subject']);?></h3>
		<em class="positionA" style="top:10px; right:10px;"><a href="./board.php?board_code=<?php echo $board_code;?>&code=<?php echo $board['code'];?>&bo_table=<?php echo $board['bo_table'];?>"><img width="42" height="15" class="vb bg_color4" src="../images/icon/icon_more1.gif" alt=""></a></em>
		<div class="webzinType positionR ">		
		<?php 
			for($i=0;$i<$rows;$i++){ 
			preg_match("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", stripslashes($list[$i]['content']), $content_image);	// 내용상 이미지가 존재하는 경우
			if($content_image){
				$image_pathinfo = pathinfo($content_image[1]);	// 이미지 경로 확인
				if(stristr($image_pathinfo['dirname'],$_SERVER['HTTP_HOST'])){	// 현 서버에 있는 이미지라면
					$dir_name = $image_pathinfo['dirname'];
					$file_name = $image_pathinfo['basename'];
					$image_path = strtr($dir_name,array("http://".$host_name=>"","https://".$host_name=>""));
					$_file = ".." . $image_path . "/" . $file_name;
					if(is_file($_file)){	// 파일이 존재한다면 썸네일 한다.
						$thumb_image = $alice['data_board_path'].'/'.$bo_table.'/thumb/'.$file_name;
						$utility->_thumbnail($_file,$thumb_image,$width,$height);
					} else {	 // 존재하지 않는다면
						$thumb_image = $content_image[1];
					}
				} else {	 // 현 서버에 없는 이미지라면
					$thumb_image = $content_image[1];
				}
			} else {	 // 내용상 이미지가 없다면
				if($list[$i]['file'][0]['path']."/".$list[$i]['file'][0]['file']){
					$src = $list[$i]['file'][0]['path']."/".$list[$i]['file'][0]['file'];
					$get_img = @getimagesize($src); // 파일정보를 가져옴
					$img_step1 = explode("_",$list[$i]['file'][0]['file']);
					$img_step2 = explode(".",$img_step1[1]);
					$new_imgname = $img_step2[0];
					$thumb_file_list = $thumb_path . $width."x".$height."_".$new_imgname."_".$list[$i]['wr_no'];
					if(!file_exists($thumb_file_list)){
						$utility->createThumb_lists($get_img,$width,$height,$src, $thumb_file_list); // list 페이지 썸네일
					}
					$thumb_image = $thumb_file_list;
				} else {
					$thumb_image = "../images/basic/img_01.gif";
				}
			}
		?>
			<dl class="positionR mb5">
				<dt class="positionA" style="top:7px;left:100px;"><a href="./board.php?board_code=<?php echo $board_code;?>&code=<?php echo $list[$i]['code'];?>&bo_table=<?php echo $board['bo_table'];?>&wr_no=<?php echo $list[$i]['wr_no'];?>"> <?php echo $list[$i]['subject'];?></a></dt>
				<dd class="content positionA" style="left:100px; top:25px;">
				<a href="./board.php?board_code=<?php echo $board_code;?>&code=<?php echo $list[$i]['code'];?>&bo_table=<?php echo $board['bo_table'];?>&wr_no=<?php echo $list[$i]['wr_no'];?>" style="color:#999;"><?php echo strip_tags(stripslashes($list[$i]['content']));?></a>
				</dd>
				<dd class="image pl15"><a href="./board.php?board_code=<?php echo $board_code;?>&code=<?php echo $list[$i]['code'];?>&bo_table=<?php echo $board['bo_table'];?>&wr_no=<?php echo $list[$i]['wr_no'];?>"><img  alt="" src="<?php echo $thumb_image;?>" class="vm" style="width:<?php echo $width;?>px;height:<?php echo $height;?>px;"></a></dd>
			</dl>
		<?php } // for end. ?>
		</div>
	</div>

<?php } ?>
