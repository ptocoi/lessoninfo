<?php
		/*
		* /application/alba/views/_load/photo.php
		* @author Harimao
		* @since 2013/11/05
		* @last update 2015/06/16
		* @Module v3.5 ( Alice )
		* @Brief :: Company photo view
		* @Comment :: 기업정보 사진 보기
		*/

		$alice_path = "../../../";
		
		$cat_path = "../../../";

		include_once $alice_path . "_core.php";

		$mb_id = $_POST['mb_id'];
		$photo_no = $_POST['photo_no'];

		$company_no = $_POST['company_no'];
		$data_no = $_POST['data_no'];

		if($data_no){
			$con = " and `data_no` = '".$data_no."' ";
			$photo_path = "../data/alba";
		} else if($company_no){
			$con = " and `company_no` = '".$company_no."' ";
			$photo_path = "../data/member/" . $mb_id . "/photos";
		}

		$member_photo = $user_control->get_member_photo($mb_id,$photo_no,$con);
		if( !$member_photo ){
			$con = " and `company_no` = '".$company_no."' ";
			$photo_path = "../data/member/" . $mb_id . "/photos";
			$member_photo = $user_control->get_member_photo($mb_id,$photo_no,$con);
		}
		
		$photo_list = $user_control->member_photo_list($mb_id, $con, " order by `no` asc ");
		$get_size = getimagesize("../../".$photo_path."/".$member_photo);

?>
<div class="layerPop  border_blue" style="display:block; width:554px; margin:0 auto; text-align:left; ">              
	<dl class="photoView">
		<dt style="padding:20px 15px;" class="bg_blue2 font18">
			<strong>포토 상세보기</strong>
			<em class="closeBtn" onclick="photo_close();"><img width="11" height="11" alt="arrow" src="../images/icon/icon_close2.gif" class="pb5"></em>
		</dt>
		<dd class="photoWrap clearfix">                
			<div class="photoViewBox">
				<a href="javascript:void(0);" id="target_photo"><img src="<?php echo $photo_path."/".$member_photo;?>" onclick="image_window_view(this,<?php echo $get_size[0];?>,<?php echo $get_size[1];?>);"/></a>
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
						if($val['company_no']){
							$photo_path = "../data/member/" . $val['mb_id'] . "/photos";
						} else if($val['data_no']){
							$photo_path = "../data/alba";
						}
						$get_sizes = getimagesize("../../".$photo_path . "/" . $val['photo_name']);
				?>
					<li>
						<em></em>
						<div class="picture" style="cursor:pointer;" onmouseover="photo_on('<?php echo $i;?>',<?php echo $get_sizes[0];?>,<?php echo $get_sizes[1];?>);"><img src="<?php echo $photo_path . "/" . $val['photo_name'];?>" alt="포토<?php echo $i+1;?>" id="photo_<?php echo $i;?>" onclick="image_window_view(this,<?php echo $get_sizes[0];?>,<?php echo $get_sizes[1];?>);"></div>
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