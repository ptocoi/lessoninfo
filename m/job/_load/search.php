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

			if($target=='wr_area_01'){
				$title = "시/구/군";
				$option = "<option value=\"\">시/구/군</option>";
				$name = "wr_area_0[]";
				$targets = "wr_area_02";
			} else if($target=='wr_area_02'){
				$title = "읍/면/동";
				$option = "<option value=\"\">읍/면/동</option>";
				$name = "wr_area_0[]";
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

		## 지역별 채용정보
		case 'job_area':
		
			$pcodeList = $category_control->category_pcodeList($type, $p_code);

			if($target=='second'){

				foreach($pcodeList as $val){
				$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
				$category_count = $alba_user_control->get_category_count_area($val['code']);
				$codeList = $category_control->category_pcodeList($type, $val['code']);
				if(stristr($val['code'],'all')) continue;
?>
				<div class="positionR">
					<?php 
						if($codeList){
							$href = "<a onclick=\"area_sels('".$val['code']."','third');\">";
						} else {
							$href = "<a href=\"./list_local_detail.html?mode=search&search_mode=alba_local&code=".$val['code']."\">";
						}
						echo $href;
					?>	
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
				$category_count = $alba_user_control->get_category_count_area($val['code']);
?>
				<li class="clearfix">
					<div class="positionR">
						<a href="./list_local_detail.html?mode=search&search_mode=alba_local&code=<?php echo $val['code'];?>">
							<span class="local"><?php echo $name;?><em class="text_color1"><?php if($name != "전체") { echo "( ".number_format($category_count)." )"; } ?></em></span>
							<div class="localRightArrow"><img width="6" height="11" src="../images/btn/btn_rightArrow4.png" alt="click"></div>
						</a> 
					</div>
				</li>
<?php
				}	// foreach end.

			}	// if end.

		break;

		## 2,3차 직종 select 생성
		case 'second_type':

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

			$result  = "<select class=\"h30\" id=\"".$target."\" name=\"".$name."\" title=\"".$title."\" onchange=\"type_sel_first(this,'".$targets."');\">";
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

		## 업직종별 채용정보
		case 'job_type':

			$pcodeList = $category_control->category_pcodeList($type, $p_code);

			if($target=='second'){
				foreach($pcodeList as $val){
				$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
				$category_count = $alba_user_control->get_category_count($val['code'],'wr_job_type1');

				if($category_control->is_pcode($val['no']) > 0) $cate_link = "onclick=\"type_sels('". $val['code'] ."','third');\"";
				else $cate_link = "href=\"./list_part_detail.html??mode=search&search_mode=alba_part&code1=". $val['code'] ."\"";
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
				$category_count = $alba_user_control->get_category_count($val['code'],'wr_job_type2');
?>
				<ul class="thirdBox clearfix positionR" >
					<li class="clearfix">
						<div class="positionR">
							<a href="./list_part_detail.html??mode=search&search_mode=alba_part&code=<?php echo $val['code'];?>">
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

		## 성인직종 채용정보
		case 'adult_job_type':

			$pcodeList = $category_control->category_pcodeList($type, $p_code);

			if($target=='second'){
				foreach($pcodeList as $val){
				$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
				$category_count = $alba_user_control->get_category_count($val['code'],'wr_job_type1');
?>
				<div class="positionR">
					<!-- <a onclick="type_sels('<?php echo $val['code']?>','third');"> -->
						<a href="./list_part_adult_detail.html?mode=search&search_mode=alba_part&code=<?php echo $val['code'];?>">
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
				$category_count = $alba_user_control->get_category_count($val['code'],'wr_job_type2');
?>
				<ul class="thirdBox clearfix positionR" >
					<li class="clearfix">
						<div class="positionR">
							<a href="./list_part_detail.html?mode=search&search_mode=alba_part&code=<?php echo $val['code'];?>">
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

		## 역세권 채용정보
		case 'subway':

			$pcodeList = $category_control->category_pcodeList($type, $p_code);

			if($target=='second'){
				foreach($pcodeList as $val){
				$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
				$category_count = $alba_user_control->get_category_count($val['code'],'wr_subway_line_0');
?>
				<div class="positionR">
					<a onclick="subway_sels('<?php echo $val['code']?>','third');">
						<span class="local"><?php echo $name;?><em class="text_color1">(<?php echo number_format($category_count);?>)</em></span>
					</a>
					<div class="localRightArrow"><img width="6" height="11" src="../images/btn/btn_rightArrow4.png" alt="click"></div>
				</div>
				<ul class="thirdBox clearfix positionR" id="third_subway_<?php echo $val['code'];?>"></ul>
<?php
				}	// foreach end.

			} else if($target=='third'){

				foreach($pcodeList as $val){
				$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
				$category_count = $alba_user_control->get_category_count($val['code'],'wr_subway_station_0');
?>
				<ul class="thirdBox clearfix positionR" >
					<li class="clearfix">
						<div class="positionR">
							<a href="./list_subway_detail.html?mode=search&search_mode=alba_subway&code=<?php echo $val['code'];?>">
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

		## 2,3차 역세권 select 생성
		case 'second_subway':

			$pcodeList = $category_control->category_pcodeList($type, $p_code);

			if($target=='wr_subway1'){
				$title = "2차 역세권 선택";
				$option = "<option value=\"\">역세권2차</option>";
				$name = "wr_subway_1";
				$targets = "wr_subway_2";
			} else if($target=='wr_subway2'){
				$title = "2차 역세권 선택";
				$option = "<option value=\"\">역세권3차</option>";
				$name = "wr_subway_2";
				$targets = "";
			}

			$result  = "<select class=\"h30\" id=\"".$target."\" name=\"".$name."\" title=\"".$title."\" onchange=\"type_sel_first(this,'".$targets."');\">";
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

		## 대학가 채용정보
		case 'college':

			$pcodeList = $category_control->category_pcodeList($type, $p_code);

			foreach($pcodeList as $val){
			$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
			$category_count = $alba_user_control->get_category_count($val['code'],'wr_college_vicinity');
?>
			<div class="positionR">
				<a href="./list_college_detail.html?mode=search&search_mode=alba_college&code=<?php echo $val['code'];?>">
					<span class="local"><?php echo $name;?><em class="text_color1">(<?php echo number_format($category_count);?>)</em></span>
				</a>
				<div class="localRightArrow"><img width="6" height="11" src="../images/btn/btn_rightArrow4.png" alt="click"></div>
			</div>
<?php
				}	// foreach end.

		break;

		## 2,3차 대학가 select 생성
		case 'second_college':

			$pcodeList = $category_control->category_pcodeList($type, $p_code);

			if($target=='wr_college1'){
				$title = "대학 선택";
				$option = "<option value=\"\">대학선택</option>";
				$name = "wr_college_vicinity";
				$targets = "";
			}			
			$result  = "<select class=\"h30\" id=\"".$target."\" name=\"".$name."\" title=\"".$title."\">";
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

		## 급여별 채용정보
		case 'alba_pay':

			$pcodeList = $category_control->category_pcodeList($type, $p_code);

			foreach($pcodeList as $val){
			$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
			//$category_count = $alba_user_control->get_category_count($val['code'],'wr_pay_type');
?>
			<div class="positionR">
				<a href="./list_pay_detail.html?mode=search&search_mode=alba_pay&code=<?php echo $val['code'];?>">
					<span class="local"><?php echo $name;?></span>
				</a>
				<div class="localRightArrow"><img width="6" height="11" src="../images/btn/btn_rightArrow4.png" alt="click"></div>
			</div>
<?php
				}	// foreach end.

		break;

		## 2차 급여별 select 생성
		case 'second_pay':

			$pcodeList = $category_control->category_pcodeList($type, $p_code);

			$title = "금액 선택";
			$name = "wr_pay";
			$targets = "";
			
			$result  = "<select class=\"h30\" id=\"".$target."\" name=\"".$name."\" title=\"".$title."\" onchange=\"pay_sel_first(this,'".$targets."');\">";
			$result .= "<option value=\"\">금액선택</option>";
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

		## 상세검색 2/3차 지역 select 생성
		case 'search_second_area':

			$pcodeList = $category_control->category_pcodeList($type, $p_code);

			if($target=='wr_area_01'){
				$title = "시/구/군";
				$option = "<option value=\"\">시/구/군</option>";
				$name = "wr_area_0[]";
				$targets = "wr_area_02";
			} else if($target=='wr_area_02'){
				$title = "읍/면/동";
				$option = "<option value=\"\">읍/면/동</option>";
				$name = "wr_area_0[]";
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

		## 2,3차 역세권 select 생성
		case 'search_second_subway':

			$pcodeList = $category_control->category_pcodeList($type, $p_code);

			if($target=='wr_subway1'){
				$title = "2차 역세권 선택";
				$option = "<option value=\"\">역세권2차</option>";
				$name = "wr_subway_1";
				$targets = "wr_subway_2";
			} else if($target=='wr_subway2'){
				$title = "2차 역세권 선택";
				$option = "<option value=\"\">역세권3차</option>";
				$name = "wr_subway_2";
				$targets = "";
			}

			$result  = "<select id=\"".$target."\" name=\"".$name."\" title=\"".$title."\" onchange=\"type_sel_first(this,'".$targets."');\">";
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

		## 2,3차 대학가 select 생성
		case 'search_second_college':

			$pcodeList = $category_control->category_pcodeList($type, $p_code);

			if($target=='wr_college1'){
				$title = "대학 선택";
				$option = "<option value=\"\">대학선택</option>";
				$name = "wr_college_vicinity";
				$targets = "";
			}			
			$result  = "<select id=\"".$target."\" name=\"".$name."\" title=\"".$title."\">";
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

		## 2차 급여별 select 생성
		case 'search_second_pay':

			$pcodeList = $category_control->category_pcodeList($type, $p_code);

			$title = "금액 선택";
			$name = "wr_pay";
			$targets = "";
			
			$result  = "<select id=\"".$target."\" name=\"".$name."\" title=\"".$title."\" onchange=\"pay_sel_first(this,'".$targets."');\">";
			$result .= "<option value=\"\">금액선택</option>";
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

	}

?>