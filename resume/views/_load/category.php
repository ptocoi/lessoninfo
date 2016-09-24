<?php
		/*
		* /application/resume/views/_load/category.php
		* @author Harimao
		* @since 2013/09/11
		* @last update 2015/05/07
		* @Module v3.5 ( Alice )
		* @Brief :: Category infomation
		* @Comment :: 카테고리 정보를 추출한다
		*/

		$alice_path = "../../../";
		
		$cat_path = "../../../";

		include_once $alice_path . "_core.php";

		/*
		$mode = $_POST['mode'];
		$type = $_POST['type'];
		$code = $_POST['code'];
		*/
		$mode = $_GET['mode'];
		$type = $_GET['type'];
		$code = $_GET['code'];	// 카테고리 code

		switch($mode){

			## 업직종
			case 'resume_type':
			$pcode_list = $category_control->category_pcodeList('job_type',$code,""," and `view` = 'yes' ");	// 2차 값 추출
			if($type=='second'){
?>
			<div class="listLocal clearfix category_middle" id="category_middle_<?php echo $code;?>">
				<div class="mt5 middlePartSet clearfix">
					<ul class="listArea">
					<?php
						foreach($pcode_list as $val){
						$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
						$category_count = $alba_user_control->get_category_count($val['code'],'wr_job_type1');
						//$checked = (@in_array($val['code'],$search_sel_1[$val['code']])) ? "checked" : "";
					?>
					<li id="category_middle_list_<?php echo $val['code'];?>">
						<span>
							<input type="checkbox" name="<?php echo $mode;?>_1[<?php echo $code;?>][]" id="<?php echo $mode;?>_1_<?php echo $val['code'];?>" class="<?php echo $mode;?>_1_<?php echo $code;?>" value="<?php echo $val['code'];?>" onclick="category_middles(this,'<?php echo $val['p_code'];?>');" <?php echo $checked;?>/>
							<label for="<?php echo $mode;?>_1_<?php echo $val['code'];?>"><?php echo $name;?></label>
						</span>
						<span class="sfont text_color1"> (<?php echo number_format($category_count);?>)</span>
					</li>
					<?php } // pcode_list foreach end. ?>
					</ul>
				</div>
				<div id="category_third_<?php echo $code;?>"></div>
<?php
			} else if($type=='third'){	// 3차
?>
			<div class="mt5 smallPartSet border_color1 bg_color2 clearfix category_sub" id="category_sub_<?php echo $code;?>">
				<ul class="listArea">
				<?php
					foreach($pcode_list as $val){
					$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
					$category_count = $alba_user_control->get_category_count($val['code'],'wr_job_type2');
					//$checked = (@in_array($val['code'],$search_sel_1[$val['code']])) ? "checked" : "";
					$middle_category = $category_control->get_categoryCode($code);
				?>
				<li id="category_sub_list_<?php echo $val['code'];?>">
					<span>
						<input type="checkbox" name="<?php echo $mode;?>_2[<?php echo $middle_category['p_code'];?>][<?php echo $val['p_code'];?>][]" id="<?php echo $mode;?>_2_<?php echo $val['code'];?>" class="<?php echo $mode;?>_2_<?php echo $code;?>" value="<?php echo $val['code'];?>" onclick="category_subs(this,'<?php echo $val['p_code'];?>','<?php echo $middle_category['p_code'];?>');" <?php echo $checked;?>/>
						<label for="<?php echo $mode;?>_2_<?php echo $val['code'];?>"><?php echo $name;?></label>
					</span>
					<span class="sfont text_color1"> (<?php echo number_format($category_count);?>)</span>
				</li>
				<?php } ?>
				</ul>
			</div>
<?php
			}	// if end.
			break;

			## 지역별
			case 'resume_area':
			$pcode_list = $category_control->category_pcodeList('area',$code,""," and `view` = 'yes' ");	// 2차 값 추출
			if($type=='second'){
?>
			<div class="listLocal clearfix category_middle" id="category_middle_<?php echo $code;?>">
				<div class="mt5 mediumArea clearfix">
					<ul class="listArea">
					<?php
						foreach($pcode_list as $val){
						$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
						$category_count = $alba_user_control->get_category_count_area($val['code']);
						//$checked = (@in_array($val['code'],$search_sel_1[$val['code']])) ? "checked" : "";
					?>
					<li id="category_middle_list_<?php echo $val['code'];?>">
						<span>
							<input type="checkbox" name="<?php echo $mode;?>_1[<?php echo $code;?>][]" id="<?php echo $mode;?>_1_<?php echo $val['code'];?>" class="<?php echo $mode;?>_1_<?php echo $code;?>" value="<?php echo $val['code'];?>" onclick="category_middles(this,'<?php echo $val['p_code'];?>');" <?php echo $checked;?>/>
							<label for="<?php echo $mode;?>_1_<?php echo $val['code'];?>"><?php echo $name;?></label>
						</span>
						<span class="sfont text_color1"> (<?php echo number_format($category_count);?>)</span>
					</li>
					<?php } // pcode_list foreach end. ?>
					</ul>
				</div>
				<div id="category_third_<?php echo $code;?>"></div>
<?php
			} else if($type=='third'){	// 3차
?>
			<div class="mt5 smallArea border_color1 bg_color2 clearfix category_sub" id="category_sub_<?php echo $code;?>">
				<ul class="listArea">
				<?php
					foreach($pcode_list as $val){
					$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
					$category_count = $alba_user_control->get_category_count_area($val['code']);
					//$checked = (@in_array($val['code'],$search_sel_1[$val['code']])) ? "checked" : "";
					$middle_category = $category_control->get_categoryCode($code);
				?>
				<li id="category_sub_list_<?php echo $val['code'];?>">
					<span>
						<input type="checkbox" name="<?php echo $mode;?>_2[<?php echo $middle_category['p_code'];?>][<?php echo $val['p_code'];?>][]" id="<?php echo $mode;?>_2_<?php echo $val['code'];?>" class="<?php echo $mode;?>_2_<?php echo $code;?>" value="<?php echo $val['code'];?>" onclick="category_subs(this,'<?php echo $val['p_code'];?>','<?php echo $middle_category['p_code'];?>');" <?php echo $checked;?>/>
						<label for="<?php echo $mode;?>_2_<?php echo $val['code'];?>"><?php echo $name;?></label>
					</span>
					<span class="sfont text_color1"> (<?php echo number_format($category_count);?>)</span>
				</li>
				<?php } ?>
				</ul>
			</div>
<?php
			}	// if end.
			break;

			## 역세권
			case 'alba_subway':
			$pcode_list = $category_control->category_pcodeList('subway',$code,""," and `view` = 'yes' ");	// 2차 값 추출
			if($type=='second'){
?>
			<div class="listLocal clearfix category_middle" id="category_middle_<?php echo $code;?>">
				<div class="mt5 middleSubway clearfix">
					<ul class="listArea">
					<?php
						foreach($pcode_list as $val){
						$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
						$category_count = $alba_user_control->get_category_count($val['code'],'wr_subway_line_0');
						//$checked = (@in_array($val['code'],$search_sel_1[$val['code']])) ? "checked" : "";
					?>
					<li id="category_middle_list_<?php echo $val['code'];?>">
						<span>
							<input type="checkbox" name="<?php echo $mode;?>_1[<?php echo $code;?>][]" id="<?php echo $mode;?>_1_<?php echo $val['code'];?>" class="<?php echo $mode;?>_1_<?php echo $code;?>" value="<?php echo $val['code'];?>" onclick="category_middles(this,'<?php echo $val['p_code'];?>');" <?php echo $checked;?>/>
							<label for="<?php echo $mode;?>_1_<?php echo $val['code'];?>"><?php echo $name;?></label>
						</span>
						<span class="sfont text_color1"> (<?php echo number_format($category_count);?>)</span>
					</li>
					<?php } // pcode_list foreach end. ?>
					</ul>
				</div>
				<div id="category_third_<?php echo $code;?>"></div>
<?php
			} else if($type=='third'){	// 3차
?>
			<div class="mt5 smallSubway border_color1 bg_color2 clearfix category_sub" id="category_sub_<?php echo $code;?>">
				<ul class="listArea">
				<?php
					foreach($pcode_list as $val){
					$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
					$category_count = $alba_user_control->get_category_count($val['code'],'wr_subway_station_0');
					//$checked = (@in_array($val['code'],$search_sel_1[$val['code']])) ? "checked" : "";
					$middle_category = $category_control->get_categoryCode($code);
				?>
				<li id="category_sub_list_<?php echo $val['code'];?>">
					<span>
						<input type="checkbox" name="<?php echo $mode;?>_2[<?php echo $middle_category['p_code'];?>][<?php echo $val['p_code'];?>][]" id="<?php echo $mode;?>_2_<?php echo $val['code'];?>" class="<?php echo $mode;?>_2_<?php echo $code;?>" value="<?php echo $val['code'];?>" onclick="category_subs(this,'<?php echo $val['p_code'];?>','<?php echo $middle_category['p_code'];?>');" <?php echo $checked;?>/>
						<label for="<?php echo $mode;?>_2_<?php echo $val['code'];?>"><?php echo $name;?></label>
					</span>
					<span class="sfont text_color1"> (<?php echo number_format($category_count);?>)</span>
				</li>
				<?php } ?>
				</ul>
			</div>
<?php
			}	// if end.
			break;

			## 대학가
			case 'alba_college':
			$pcode_list = $category_control->category_pcodeList('job_college',$code,""," and `view` = 'yes' ");	// 2차 값 추출
?>
			<div class="listLocal clearfix category_middle" id="category_middle_<?php echo $code;?>">
				<div class="mt5 mediumArea clearfix">
					<ul class="listArea">
					<?php
						foreach($pcode_list as $val){
						$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
						$category_count = $alba_user_control->get_category_count($val['code'],'wr_college_vicinity');
						//$checked = (@in_array($val['code'],$search_sel_1[$val['code']])) ? "checked" : "";
					?>
					<li id="category_middle_list_<?php echo $val['code'];?>">
						<span>
							<input type="checkbox" name="<?php echo $mode;?>_1[<?php echo $code;?>][]" id="<?php echo $mode;?>_1_<?php echo $val['code'];?>" class="<?php echo $mode;?>_1_<?php echo $code;?>" value="<?php echo $val['code'];?>" onclick="category_middles(this,'<?php echo $val['p_code'];?>');" <?php echo $checked;?>/>
							<label for="<?php echo $mode;?>_1_<?php echo $val['code'];?>"><?php echo $name;?></label>
						</span>
						<span class="sfont text_color1"> (<?php echo number_format($category_count);?>)</span>
					</li>
					<?php } // pcode_list foreach end. ?>
					</ul>
				</div>
				<div id="category_third_<?php echo $code;?>"></div>
<?php
			break;

		}	// switch end.
?>