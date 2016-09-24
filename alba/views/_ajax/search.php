<?php
		/*
		* /application/alba/views/_ajax/search.php
		* @author Harimao
		* @since 2013/08/19
		* @last update 2013/08/23
		* @Module v3.5 ( Alice )
		* @Brief :: Alba area load 
		* @Comment :: 채용정보 검색시 근무지역/업직종 하위 카테고리등 ajax 로드
		*/

		$alice_path = "../../../../";
		
		$cat_path = "../../../";

		include_once $alice_path . "_core.php";

		$mode = $_POST['mode'];
		$code = $_POST['code'];
		$first_area = $_POST['first_area'];	// 1차 선택 지역
		$second_area = $_POST['second_area'];	// 2차 선택 지역

		$first_subway = $_POST['first_subway'];	// 1차 역세권
		$second_subway = $_POST['second_subway'];	// 2차 역세권

		$first_jobtype = $_POST['first_jobtype'];	// 1차 직종
		$second_jobtype = $_POST['second_jobtype'];	// 2차 직종


		switch($mode){

			## 근무지역 2차 로드
			case 'second_area':
				$category_list = $category_control->category_pcodeList('area', $code,"", " and `view` = 'yes' ");
				if($category_list){
?>
				<div class="mt5 middleArea border_blue clearfix" id="second_area_obj_<?php echo $code;?>">
					<ul class="listArea">
						<?php 
							foreach($category_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링							
						?>
						<li><span><input type="checkbox" name="second_area[]" id="second_area_<?php echo $val['code'];?>" value="<?php echo $val['code'];?>" p_code="<?php echo $code;?>" text="<?php echo $name;?>"><label for="second_area_<?php echo $val['code'];?>"><?php echo $name;?></label></span></li>
						<?php } ?>
					</ul>
				</div>
<?php
				}	// if end.
			break;

			## 근무지역 3차 로드
			case 'third_area':
				$category_list = $category_control->category_pcodeList('area', $code,"", " and `view` = 'yes' ");
				if($category_list){
?>
				<div class="mt5 smallArea border_blue bg_blue2 clearfix" id="third_area_obj_<?php echo $code;?>">
					<ul class="listArea">
						<?php 
							foreach($category_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링							
						?>
						<li><span><input type="checkbox" name="third_area[]" id="third_area_<?php echo $val['code'];?>" value="<?php echo $val['code'];?>" p_code="<?php echo $code;?>" text="<?php echo $name;?>" onclick="third_areas(this,'<?php echo $first_area;?>','<?php echo $second_area;?>');"><label for="third_area_<?php echo $val['code'];?>"><?php echo $name;?></label></span></li>
						<?php } ?>
					</ul>
				</div>

<?php
				}	// if end.
			break;

			## 역세권 2차 로드
			case 'second_subway':
				$category_list = $category_control->category_pcodeList('subway', $code,"", " and `view` = 'yes' ");
				if($category_list){
?>
				<div class="mt5 middleSubway border_blue clearfix" id="second_subway_obj_<?php echo $code;?>">
					<ul class="listArea">
						<?php 
							foreach($category_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링							
						?>
						<li><span><input type="checkbox" name="second_subway[]" id="second_subway_<?php echo $val['code'];?>" value="<?php echo $val['code'];?>" p_code="<?php echo $code;?>" text="<?php echo $name;?>"><label for="second_subway_<?php echo $val['code'];?>"><?php echo $name;?></label></span></li>
						<?php } ?>
					</ul>
				</div>
<?php
				}	// if end.
			break;
			
			## 역세권 3차 로드
			case 'third_subway':
				$category_list = $category_control->category_pcodeList('subway', $code,"", " and `view` = 'yes' ");
				if($category_list){
?>
				<div class="mt5 smallSubway border_blue bg_blue2 clearfix" id="third_subway_obj_<?php echo $code;?>">
					<ul class="listArea">
						<?php 
							foreach($category_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링							
						?>
						<li><span><input type="checkbox" name="third_subway[]" id="third_subway_<?php echo $val['code'];?>" value="<?php echo $val['code'];?>" p_code="<?php echo $code;?>" text="<?php echo $name;?>" onclick="third_subways(this,'<?php echo $first_subway;?>','<?php echo $second_subway;?>');"><label for="third_subway_<?php echo $val['code'];?>"><?php echo $name;?></label></span></li>
						<?php } ?>
					</ul>
				</div>
<?php
				}	// if end.
			break;
			
			## 2차 직종 로드
			case 'second_jobtype':
				$category_list = $category_control->category_pcodeList('job_type', $code,"", " and `view` = 'yes' ");
				if($category_list){
?>
				<div class="mt5 middlePartSet border_blue clearfix" id="second_jobtype_obj_<?php echo $code;?>">
					<ul class="listArea">
						<?php 
							foreach($category_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링							
						?>
						<li><span><input type="checkbox" name="second_jobtype[]" id="second_jobtype_<?php echo $val['code'];?>" value="<?php echo $val['code'];?>" p_code="<?php echo $code;?>" text="<?php echo $name;?>"><label for="second_jobtype_<?php echo $val['code'];?>"><?php echo $name;?></label></span></li>
						<?php } ?>
					</ul>
				</div>
<?php
				}	// if end.
			break;

			## 3차 직종 로드
			case 'third_jobtype':
				$category_list = $category_control->category_pcodeList('job_type', $code,"", " and `view` = 'yes' ");
				if($category_list){
?>
				<div class="mt5 middlePartSet border_blue bg_blue2 clearfix" id="third_jobtype_obj_<?php echo $code;?>">
					<ul class="listArea">
						<?php 
							foreach($category_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링							
						?>
						<li><span><input type="checkbox" name="third_jobtype[]" id="third_jobtype_<?php echo $val['code'];?>" value="<?php echo $val['code'];?>" p_code="<?php echo $code;?>" text="<?php echo $name;?>" onclick="third_jobtypes(this,'<?php echo $first_jobtype;?>','<?php echo $second_jobtype;?>');"><label for="third_jobtype_<?php echo $val['code'];?>"><?php echo $name;?></label></span></li>
						<?php } ?>
					</ul>
				</div>
<?php
				}	// if end.
			break;


		}	// switch end.

?>