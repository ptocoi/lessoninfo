<?php
		/*
		* /application/alba/views/_load/area.php
		* @author Harimao
		* @since 2013/11/20
		* @last update 2015/05/07
		* @Module v3.5 ( Alice )
		* @Brief :: Resume search area load
		* @Comment :: 이력서 검색시 지역정보
		*/

		$alice_path = "../../../";
		
		$cat_path = "../../../";

		include_once $alice_path . "_core.php";

		$mode = $_POST['mode'];
		$type = $_POST['type'];

		$first_area = $_POST['first_area'];	// 넘어온 1차 지역값
		$second_area = $_POST['second_area'];	// 넘어온 2차 지역값
		
		switch($mode){

			## 기본 지역 검색
			case 'default':

				switch($type){

				## 지역 2차값 출력
				case 'second_area':
				$pcode_list = $category_control->category_pcodeList('area',$first_area,""," and `view` = 'yes' ");
				$first_name = $category_control->get_categoryCodeName($first_area);
?>
				<div class="mt5 middleArea border_blue clearfix" id="area_second_<?php echo $first_area;?>">
					<ul class="listArea">
					<?php
					foreach($pcode_list as $p_val){
					$name = $utility->remove_quoted($p_val['name']);	 // (쌍)따옴표 등록시 필터링
					?>
						<li id="area_middle_<?php echo $p_val['code'];?>" class="area_middle_<?php echo $first_area;?>"><span><input type="checkbox" name="wr_area_1[<?php echo $first_area;?>][]" id="wr_area_1_<?php echo $p_val['code'];?>" value="<?php echo $p_val['code'];?>" onclick="area_seconds(this,'<?php echo $first_area?>');" class="<?php echo $first_area;?>"/><label for="wr_area_1_<?php echo $p_val['code'];?>"><?php echo $name;?></label></span></li>
					<?php
					}	// pcode_list foreach end.
					?>
					</ul>
				</div>
				<div id="area_third_<?php echo $first_area;?>"></div>
<?php
				break;

				## 지역 3차값 출력
				case 'third_area':
				$pcode_list = $category_control->category_pcodeList('area',$second_area,""," and `view` = 'yes' ");
				$first_name = $category_control->get_categoryCodeName($first_area);
				$second_name = $category_control->get_categoryCodeName($second_area);
?>
				<div class="mt5 smallArea border_color1 bg_color2 clearfix area_third_<?php echo $first_area;?>" id="area_third_<?php echo $second_area;?>">
					<ul class="listArea">
					<?php
					foreach($pcode_list as $p_val){
					$name = $utility->remove_quoted($p_val['name']);	 // (쌍)따옴표 등록시 필터링
					?>
						<li id="area_sub_<?php echo $p_val['code'];?>"><span><input type="checkbox" name="wr_area_2[<?php echo $first_area;?>][<?php echo $second_area;?>][]" id="wr_area_2_<?php echo $p_val['code'];?>" value="<?php echo $p_val['code'];?>" onclick="area_thirds(this,'<?php echo $second_area;?>','<?php echo $first_area;?>');" class="<?php echo $first_area;?>_<?php echo $second_area;?> <?php echo $first_area;?>"/><label for="wr_area_2_<?php echo $p_val['code'];?>"><?php echo $name;?></label></span></li>
					<?php
					}	// pcode_list foreach end.
					?>
					</ul>
				</div>
<?php
				break;

				}	// type switch end.

			break;

			## 상세 지역 검색 (시도별)
			case 'detail':

			break;

		}	// mode switch end.

?>