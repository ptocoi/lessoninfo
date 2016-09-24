<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 
$width = $options['img_width'];
$height = $options['img_height'];
$thumb_path = $alice['data_board_path'].'/'.$bo_table.'/thumb/';
if(!is_dir($thumb_path)){	// 썸네일 디렉토리가 없다면 생성한다.
	@mkdir($thumb_path, 0707);
	@chmod($thumb_path, 0707);
}
?>

<li class="list mt25">
	<div class="comBoard list1 positionR" style="height:140px;">
		<h3 class=""><img width="13" height="13" alt="" src="../images/icon/icon_arrow_4.png" class="mr5 vm bg_color4"><?php echo stripslashes($board['bo_subject']);?></h3>
		<em style="top:10px; right:10px;" class="positionA">
			<a href=""><img width="42" height="15" alt="" src="../images/icon/icon_more1.gif" class="vb bg_color4"></a>
		</em>
		<div class="webzinType positionR clearfix">
			<?php 
				for($i=0;$i<$rows;$i++){ 
				preg_match("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", stripslashes($list[$i]['wr_content']), $content_image);	// 내용상 이미지가 존재하는 경우
				
				if($content_image){
					$image_pathinfo = pathinfo($content_image[1]);	// 이미지 경로 확인
					if(stristr($image_pathinfo['dirname'],$_SERVER['HTTP_HOST'])){	// 현 서버에 있는 이미지라면
						$dir_name = $image_pathinfo['dirname'];
						$file_name = $image_pathinfo['basename'];
						$image_path = strtr($dir_name,array("http://".$host_name=>"","https://".$host_name=>""));
						$_file = ".." . $image_path . "/" . $file_name;
						if(is_file($_file)){	// 파일이 존재한다면 썸네일 한다.
							$thumb_image = $thumb_path . $file_name;
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
				$wr_datetime = strtr(substr($list[$i]['wr_datetime'],5,11),'-','.');
			?>
			<dl style="overflow:hidden;" class="positionR mb5">
				<dt style="top:7px;left:100px;" class="positionA"><a href="<?php echo $alice['board_path']."/".$list[$i]['href_link'];?>"> <?php echo $list[$i]['subject'];?></a></dt>
				<dd style="left:100px; top:25px;" class="content positionA">
					<a style="color:#999;" href="<?php echo $alice['board_path']."/".$list[$i]['href_link'];?>"> <?php echo strip_tags(stripslashes($list[$i]['content']));?></a>
				</dd>
				<dd class="image pl15"><a href="<?php echo $alice['board_path']."/".$list[$i]['href_link'];?>"><img class="vm" src="<?php echo $thumb_image;?>" alt="" style="width:<?php echo $width;?>px;height:<?php echo $height;?>px;"></a></dd>
			</dl>
			<?php } ?>
		</div>
	</div>   
</li>
