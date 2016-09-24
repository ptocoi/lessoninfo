<?php
		/*
		* /application/alba/views/_load/jobtype.php
		* @author Harimao
		* @since 2013/11/05
		* @last update 2015/07/01
		* @Module v3.5 ( Alice )
		* @Brief :: Alba search job type load
		* @Comment :: 채용정보 검색시 직종
		*/

		$alice_path = "../../../";
		
		$cat_path = "../../../";

		include_once $alice_path . "_core.php";

		$mode = $_POST['mode'];
		$type = $_POST['type'];

		$first_jobtype = $_POST['first_jobtype'];
		$second_jobtype = $_POST['second_jobtype'];

		switch($mode){

			## 기본 역세권 검색
			case 'default':

				switch($type){

				## 직종 2차값 출력
				case 'second_jobtype':
				$pcode_list = $category_control->category_pcodeList('job_type',$first_jobtype,""," and `view` = 'yes' ");
?>
				<div class="mt5 middlePartSet border_color1 clearfix" id="jobtype_second_<?php echo $first_jobtype;?>">
					<ul class="listArea">
					<?php
					foreach($pcode_list as $p_val){
					$name = $utility->remove_quoted($p_val['name']);	 // (쌍)따옴표 등록시 필터링
					?>
						<li id="jobtype_middle_<?php echo $p_val['code'];?>" class="jobtype_middle_<?php echo $first_jobtype;?>"><span><input type="checkbox" name="wr_jobtype_1[<?php echo $first_jobtype;?>][]" id="wr_jobtype_1_<?php echo $p_val['code'];?>" value="<?php echo $p_val['code'];?>" onclick="jobtype_seconds(this,'<?php echo $first_jobtype;?>');" class="<?php echo $first_jobtype;?>"/><label for="wr_jobtype_1_<?php echo $p_val['code'];?>"><?php echo $name;?></label></span></li>
					<?php 
					} // pcode_list foreach end. 
					?>
					</ul>
				</div>
				<div id="jobtype_third_<?php echo $first_jobtype;?>"></div>
<?php
				break;

				## 직종 3차값 출력
				case 'third_jobtype':
				$pcode_list = $category_control->category_pcodeList('job_type',$second_jobtype,""," and `view` = 'yes' ");

				if($pcode_list){
?>
					<div class="mt5 smallPartSet border_color1 bg_color2 clearfix jobtype_third_<?php echo $first_jobtype;?>" id="jobtype_third_<?php echo $second_jobtype;?>">
						<ul class="listArea">
						<?php
						foreach($pcode_list as $p_val){
						$name = $utility->remove_quoted($p_val['name']);	 // (쌍)따옴표 등록시 필터링
						?>
							<li id="jobtype_sub_<?php echo $p_val['code'];?>"><span><input type="checkbox" name="wr_jobtype_2[<?php echo $first_jobtype;?>][<?php echo $second_jobtype;?>][]" id="wr_jobtype_2_<?php echo $p_val['code'];?>" value="<?php echo $p_val['code'];?>" onclick="jobtype_thirds(this,'<?php echo $second_jobtype;?>','<?php echo $first_jobtype;?>');" class="<?php echo $first_jobtype;?>_<?php echo $second_jobtype;?> <?php echo $first_jobtype;?>"/><label for="wr_jobtype_2_<?php echo $p_val['code'];?>"><?php echo $name;?></label></span></li>
						<?php 
						} // pcode_list foreach end. 
						?>
						</ul>
					</div>
<?php
				}

				break;

				}	// type switch end.

			break;

			## 상세 직종 검색
			case 'detail':

			break;

		}	// mode switch end.

?>