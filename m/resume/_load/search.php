<?php
	$alice_path = "../../../";

	$cat_path = "../../../";

	include_once $alice_path . "_core.php";

	$mode = $_POST['mode'];
	$type = $_POST['type'];

	$p_code = $_POST['p_code'];
	$target = $_POST['target'];

	switch($mode){

		## 2/3차 지역 select 생성
		case 'second_area':

			$pcodeList = $category_control->category_pcodeList($type, $p_code);

			if($target=='wr_area1'){
				$title = "시/구/군";
				$option = "<option value=\"\">시/구/군</option>";
				$name = "wr_area1";
				$targets = "wr_area2";
			} else if($target=='wr_area2'){
				$title = "읍/면/동";
				$option = "<option value=\"\">읍/면/동</option>";
				$name = "wr_area2";
				$targets = "";
			}

			$result  = "<select class=\"h30\" id=\"".$target."\" name=\"".$name."\" title=\"".$title."\" onchange=\"area_sel_first(this,'".$targets."');\">";
			$result .= $option;
			if($pcodeList){
				foreach($pcodeList as $val){
					if(stristr($val['code'],'all')) continue;
					$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
					$result .= "<option value=\"".$val['code']."\">".$name."</option>";
				}
			}
			$result .= "</select>";

			echo $result;

		break;

		## 2/3차 지역 select 생성
		case 'second_area_h30':

			$pcodeList = $category_control->category_pcodeList($type, $p_code);

			if($target=='wr_area1'){
				$title = "시/구/군";
				$option = "<option value=\"\">시/구/군</option>";
				$name = "wr_area1";
				$targets = "wr_area2";
			} else if($target=='wr_area2'){
				$title = "읍/면/동";
				$option = "<option value=\"\">읍/면/동</option>";
				$name = "wr_area2";
				$targets = "";
			}

			$result  = "<select id=\"".$target."\" name=\"".$name."\" title=\"".$title."\" onchange=\"area_sel_first(this,'".$targets."');\">";
			$result .= $option;
			if($pcodeList){
				foreach($pcodeList as $val){
					if(stristr($val['code'],'all')) continue;
					$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
					$result .= "<option value=\"".$val['code']."\">".$name."</option>";
				}
			}
			$result .= "</select>";

			echo $result;

		break;

		## 2/3차 지역 select 생성
		case 'search_second_area':

			$pcodeList = $category_control->category_pcodeList($type, $p_code);

			if($target=='wr_area1'){
				$title = "시/구/군";
				$option = "<option value=\"\">시/구/군</option>";
				$name = "wr_area1";
				$targets = "wr_area2";
			} else if($target=='wr_area2'){
				$title = "읍/면/동";
				$option = "<option value=\"\">읍/면/동</option>";
				$name = "wr_area2";
				$targets = "";
			}

			$result  = "<select id=\"".$target."\" name=\"".$name."\" title=\"".$title."\" onchange=\"area_sel_first(this,'".$targets."');\">";
			$result .= $option;
			if($pcodeList){
				foreach($pcodeList as $val){
					if(stristr($val['code'],'all')) continue;
					$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
					$result .= "<option value=\"".$val['code']."\">".$name."</option>";
				}
			}
			$result .= "</select>";

			echo $result;

		break;

		## 2/3차 직종 select 생성
		case 'second_jobtype':
			
			$pcodeList = $category_control->category_pcodeList($type, $p_code);

			if($target=='wr_job_type1'){
				$title = "업직종2차 분류선택";
				$option = "<option value=\"\">업직종2차</option>";
				$name = "wr_job_type1";
				$targets = "wr_job_type2";
			} else if($target=='wr_job_type2'){
				$title = "업직종3차 분류선택";
				$option = "<option value=\"\">업직종3차</option>";
				$name = "wr_job_type2";
				$targets = "";
			}

			$result  = "<select id=\"".$target."\" name=\"".$name."\" title=\"".$title."\" onchange=\"jobtype_sels(this,'".$targets."');\">";
			$result .= $option;
			if($pcodeList){
				foreach($pcodeList as $val){
					if(stristr($val['code'],'all')) continue;
					$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
					$result .= "<option value=\"".$val['code']."\">".$name."</option>";
				}
			}
			$result .= "</select>";

			echo $result;

		break;


		## 2/3차 직종 select 생성
		case 'second_jobtype_h30':
			
			$pcodeList = $category_control->category_pcodeList($type, $p_code);

			if($target=='wr_job_type1'){
				$title = "업직종2차 분류선택";
				$option = "<option value=\"\">업직종2차</option>";
				$name = "wr_job_type1";
				$targets = "wr_job_type2";
			} else if($target=='wr_job_type2'){
				$title = "업직종3차 분류선택";
				$option = "<option value=\"\">업직종3차</option>";
				$name = "wr_job_type2";
				$targets = "";
			}

			$result  = "<select class=\"h30\" id=\"".$target."\" name=\"".$name."\" title=\"".$title."\" onchange=\"jobtype_sels(this,'".$targets."');\">";
			$result .= $option;
			if($pcodeList){
				foreach($pcodeList as $val){
					if(stristr($val['code'],'all')) continue;
					$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
					$result .= "<option value=\"".$val['code']."\">".$name."</option>";
				}
			}
			$result .= "</select>";

			echo $result;

		break;

		## 지역별 인재정보
		case 'resume_area':
		
			$pcodeList = $category_control->category_pcodeList($type, $p_code);

			if($target=='second'){

				foreach($pcodeList as $val){
				$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
				$category_count = $alba_resume_user_control->get_category_count_area($val['code']);
?>
				<div class="positionR">
					<a href="./list_local_detail.html?mode=search&search_mode=alba_resume_local&code=<?php echo $val['code'];?>">
					<span class="local"><?php echo $name;?><em class="text_color1"><?php if($name != "전체") { echo "( ".number_format($category_count)." )"; } ?></em></span>
					<div class="localRightArrow">
						<img width="6" height="11" src="../images/btn/btn_rightArrow4.png" alt="click" id="third_arrow_<?php echo $val['code'];?>">
					</div>
					</a> 
				</div>
				<ul class="thirdBox clearfix positionR" id="third_area_<?php echo $val['code'];?>"></ul>
<?php
				}	// foreach end.

			} else if($target=='third'){

				foreach($pcodeList as $val){
				$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
				$category_count = $alba_resume_user_control->get_category_count_area($val['code']);
?>
				<li class="clearfix">
					<div class="positionR">
					<a href="./list_local_detail.html?mode=search&search_mode=alba_resume_list_local&code=<?php echo $val['code'];?>">
					<span class="local"><?php echo $name;?><em class="text_color1">(<?php echo number_format($category_count);?>)</em></span>
					<div class="localRightArrow"><img width="6" height="11" src="../images/btn/btn_rightArrow4.png" alt="click"></div>
					</a> 
					</div>
				</li>
<?php
				}	// foreach end.

			}	// if end.

		break;

		## 업직종별 채용정보
		case 'job_type':

			$pcodeList = $category_control->category_pcodeList($type, $p_code);

			if($target=='second'){
				foreach($pcodeList as $val){
				$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
				$category_count = $alba_resume_user_control->get_category_count($val['code'],"wr_job_type1");

				if($category_control->is_pcode($val['no']) > 0) $cate_link = "onclick=\"type_sels('". $val['code'] ."','third');\"";
				else $cate_link = "href=\"./list_part_detail.html?mode=search&search_mode=alba_resume_part&code1=". $val['code'] ."\"";
?>
				<div class="positionR">
					<a <?=$cate_link?>>
						<span class="local"><?php echo $name;?><em class="text_color1">(<?php echo number_format($category_count);?>)</em></span>
					</a>
					<div class="localRightArrow"><img width="6" height="11" src="../images/btn/btn_rightArrow4.png" alt="click"></div>
				</div>
				<ul class="thirdBox clearfix positionR" id="third_type_<?php echo $val['code'];?>"></ul>
<?php
				}	// foreach end.

			} else if($target=='third'){

				foreach($pcodeList as $val){
				$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
				$category_count = $alba_resume_user_control->get_category_count($val['code'],"wr_job_type2");
?>
				<ul class="thirdBox clearfix positionR" >
					<li class="clearfix">
						<div class="positionR">
							<a href="./list_part_detail.html?mode=search&search_mode=alba_resume_part&code=<?php echo $val['code'];?>">
							<span class="local"><?php echo $name;?><em class="text_color1">(<?php echo number_format($category_count);?>)</em></span>
							</a> 
							<div class="localRightArrow"><img width="6" height="11" src="../images/btn/btn_rightArrow4.png" alt="click"></div>
						</div>
					</li>	
				</ul>
<?php
				}	// foreach end.

			}

		break;
	}
?>