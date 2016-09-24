<?php
		/*
		* /application/alba/views/_load/subway.php
		* @author Harimao
		* @since 2013/11/05
		* @last update 2015/03/11
		* @Module v3.5 ( Alice )
		* @Brief :: Alba search subway load
		* @Comment :: 채용정보 검색시 역세권
		*/

		$alice_path = "../../../";
		
		$cat_path = "../../../";

		include_once $alice_path . "_core.php";

		$mode = $_POST['mode'];
		$type = $_POST['type'];

		$first_subway = $_POST['first_subway'];
		$second_subway = $_POST['second_subway'];

		switch($mode){

			## 기본 역세권 검색
			case 'default':

				switch($type){

				## 역세권 2차값 출력
				case 'second_subway':
				$pcode_list = $category_control->category_pcodeList('subway',$first_subway,"", " and `view` = 'yes' ");
?>
				<div class="mt5 middleSubway border_color1 clearfix" id="subway_second_<?php echo $first_subway;?>">
					<ul class="listArea">
					<?php
					foreach($pcode_list as $p_val){
					$name = $utility->remove_quoted($p_val['name']);	 // (쌍)따옴표 등록시 필터링
					?>
						<li id="subway_middle_<?php echo $p_val['code'];?>" class="subway_middle_<?php echo $first_subway;?>"><span><input type="checkbox" name="wr_subway_1[<?php echo $first_subway;?>][]" id="wr_subway_1_<?php echo $p_val['code'];?>" value="<?php echo $p_val['code'];?>" onclick="subway_seconds(this,'<?php echo $first_subway;?>');" class="<?php echo $first_subway;?>"/><label for="wr_subway_1_<?php echo $p_val['code'];?>"><?php echo $name;?></label></span></li>
					<?php
					}	// pcode_list foreach end.
					?>
					</ul>
				</div>
				<div id="subway_third_<?php echo $first_subway;?>"></div>
<?php
				break;

				## 역세권 3차값 출력
				case 'third_subway':
				$pcode_list = $category_control->category_pcodeList('subway',$second_subway,"", " and `view` = 'yes' ");
?>
				<div class="mt5 smallSubway border_color1 bg_color2 clearfix subway_third_<?php echo $first_subway;?>" id="subway_third_<?php echo $second_subway;?>">
					<ul class="listArea">
					<?php
					foreach($pcode_list as $p_val){
					$name = $utility->remove_quoted($p_val['name']);	 // (쌍)따옴표 등록시 필터링
					?>
						<li id="subway_sub_<?php echo $p_val['code'];?>"><span><input type="checkbox" name="wr_subway_2[<?php echo $first_subway;?>][<?php echo $second_subway;?>][]" id="wr_subway_2_<?php echo $p_val['code'];?>" value="<?php echo $p_val['code'];?>" onclick="subway_thirds(this,'<?php echo $second_subway;?>','<?php echo $first_subway;?>');" class="<?php echo $first_subway;?>_<?php echo $second_subway;?> <?php echo $first_subway;?>"/><label for="wr_subway_2_<?php echo $p_val['code'];?>"><?php echo $name;?></label></span></li>
					<?php
					}	// pcode_list foreach end.
					?>
					</ul>
				</div>
<?php
				break;

				}	// type switch end.

			break;

			## 상세 역세권 검색
			case 'detail':

			break;
		}	// mode switch end.
?>