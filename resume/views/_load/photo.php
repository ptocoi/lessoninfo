<?php
		/*
		* /application/resume/views/_load/photo.php
		* @author Harimao
		* @since 2013/11/13
		* @last update 2015/05/07
		* @Module v3.5 ( Alice )
		* @Brief :: Individual photo view
		* @Comment :: 이력서 사진 보기
		*/

		$alice_path = "../../../";
		
		$cat_path = "../../../";

		include_once $alice_path . "_core.php";


		$mb_id = $_POST['mb_id'];
		$photo_no = $_POST['photo_no'];
		
		$member_photo = $user_control->get_member_photo($mb_id,$photo_no);
		$photo_list = $user_control->member_photo_list($mb_id," and `data_no` = 0 "," order by `no` asc ");
		$get_size = @getimagesize("../../../data/member/" . $mb_id . "/photos/" . $member_photo);
?>
<div class="layerPop  border_blue" style="display:block; width:554px; margin:0 auto; text-align:left; ">              
	<dl class="photoView">
		<dt style="padding:20px 15px;" class="bg_blue2 font18">
			<strong>포토 상세보기</strong>
			<em class="closeBtn" onclick="photo_close();"><img width="11" height="11" alt="arrow" src="../images/icon/icon_close2.gif" class="pb5"></em>
		</dt>
		<dd class="photoWrap clearfix">                
			<div class="photoViewBox">
				<a href="javascript:void(0);" id="target_photo"><img src="../data/member/<?php echo $mb_id;?>/photos/<?php echo $member_photo;?>" onclick="image_window_view(this,<?php echo $get_size[0];?>,<?php echo $get_size[1];?>);"/></a>
				<em class="help text_help displayB icon mt10"><strong>상단 이미지를</strong> 클릭하면 원본크기로 확인할 수 있습니다.</em>    
			</div>
			<!--  이력서선택 //   -->
			<!--  첨부파일선택   -->                 
			<div class="photoThumbnail">
				<ul>
				<?php 
				$i = 0;
				foreach($photo_list as $val){ 
					if($val['photo_source']){
					$get_sizes = @getimagesize("../../../data/member/" . $mb_id . "/photos/" . $val['photo_name']);
				?>
					<li>
						<em></em>
						<div class="picture" style="cursor:pointer;" onmouseover="photo_on('<?php echo $i;?>',<?php echo $get_sizes[0];?>,<?php echo $get_sizes[1];?>);"><img src="../data/member/<?php echo $mb_id;?>/photos/<?php echo $val['photo_name'];?>" alt="포토<?php echo $i+1;?>" id="photo_<?php echo $i;?>"></div>
					</li>
				<?php 
					} // if end.
				$i++;
				}	// forach end.
				?>
				</ul>
			</div>
		</dd>
	</dl>
	<div style="margin:30px auto;" class="singleBtn clearfix">
		<ul> 
			<li><div class="btn font_gray bg_white"><a href="javascript:photo_close();">닫기<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right3.png" class="pb5"></a></div></li>
		</ul>
	</div>
</div>