<?php
		/*
		* /application/alba/views/_load/search.php
		* @author Harimao
		* @since 2013/08/19
		* @last update 2015/03/11
		* @Module v3.5 ( Alice )
		* @Brief :: Alba area load 
		* @Comment :: 채용정보 검색시 근무지역/업직종 하위 카테고리등 ajax 로드
		*/

		$alice_path = "../../../";
		
		$cat_path = "../../../";

		include_once $alice_path . "_core.php";

		$mode = $_POST['mode'];
		$code = $_POST['code'];

		switch($mode){

			## 근무지역 2차 로드
			case 'second_area':

				$category_list = $category_control->category_pcodeList('area', $code,"", " and `view` = 'yes' ");
?>
				<div class="mt5 middleArea border_blue clearfix">
					<ul class="listArea">
						<?php 
							foreach($category_list as $val){ 
							$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링							
						?>
						<li><span><input type="checkbox" name="middel_area[]" id="middel_area_<?php echo $val['code'];?>" ><label for="middel_area_<?php echo $val['code'];?>"><?php echo $name;?></label></span></li>
						<?php } ?>
						<!-- <li><span ><input  type="checkbox"  name="middleArea" id="middleArea2" ><label for="middleArea2">강화군</label></span></li>
						<li><span class="checkOn"><input type="checkbox"  checked="checked" name="middleArea" id="middleArea3" ><label for="middleArea3">계양구</label></span></li>
						<li><span><input type="checkbox"  name="middleArea" id="middleArea4" ><label for="middleArea4">남구</label></span></li>
						<li><span><input type="checkbox"  name="middleArea" id="middleArea5" ><label for="middleArea5">남동구</label></span></li> -->
					</ul>
				</div>
<?php
			break;

			## 근무지역 3차 로드
			case 'third_area':

			break;

			## 대학가 검색
			case 'college_vicinity':
			
				$pcode_list = $category_control->category_pcodeList('job_college',$code,"", " and `view` = 'yes' ");	// 지역별 대학

				$result = "<select title=\"인근대학 선택\" name=\"wr_college_vicinity\" id=\"wr_college_vicinity\" style=\"width:305px;\" class=\"ipSelect2\">";
				$result .= "<option value=\"\">인근대학 선택</option>";

				foreach($pcode_list as $val){
					$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
					$result .= "<option value=\"".$val['code']."\">".$name."</option>";
				}

				$result .= "</select>";

				echo $result;

			break;

		}	// switch end.

?>