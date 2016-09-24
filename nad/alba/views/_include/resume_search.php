<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
$(function(){

	// 쿠키로 저장된 값 불러오기
	if($.cookie('pdsrch') == 'true'){
		$("input[name='alwaysDsrch']").attr('checked',true);
		$('#searchBtn').val('간편검색');
		$('#dsrch').show();
		$('#dsrchType').attr('enum','no');
	} else {
		$('#searchBtn').val('상세검색');
		$('#dsrch').hide();
		$('#dsrchType').attr('enum','yes');
	}
	// 상세/간편검색 버튼 클릭
	$('#searchBtn').click(function(){
		var dsrchType = $('#dsrchType').attr('enum');
		if(dsrchType=='yes'){
			$(this).val('간편검색');
			$('#dsrch').show();
			$('#dsrchType').attr('enum','no');
		} else {
			$(this).val('상세검색');
			$('#dsrch').hide();
			$('#dsrchType').attr('enum','yes');
			searchFrmInit();
		}

	});
	// 항상 상세검색 체크
	$("input[name='alwaysDsrch']").click(function(){
		var sel = $(this).is(':checked');
		$.cookie('pdsrch',sel, { expires:1, domain:domain, path:'/', secure:0});	// 쿠키 저장
		if(sel==true){
			$('#searchBtn').val('간편검색');
			$('#dsrch').show();
			$('#dsrchType').attr('enum','no');
		} else {
			$('#searchBtn').val('상세검색');
			$('#dsrch').hide();
			$('#dsrchType').attr('enum','yes');
			searchFrmInit();
		}
	});
	// 등록기간 전체 체크
	$('#start_dayAll').click(function(){
		var checked_trues = $(this).is(':checked');
		if(checked_trues==true){
			$('#start_day').val('');
			$('#end_day').val('');
		}
		$('#start_day').attr('disabled',checked_trues);
		$('#end_day').attr('disabled',checked_trues);
	});

	$('#wr_volume_date').datepicker({dateFormat: 'yy-mm-dd'});

});
// 검색폼 초기화
var searchFrmInit = function(){
	$('#start_dayAll').attr('checked',false);
	$('#start_day, #end_day').attr('disabled',false);
	$('#start_day, #end_day').val('');
	$("input[name='mb_group']").filter("input[value='all']").attr('checked',true);
	$("input[name='pin_writer']").filter("input[value='all']").attr('checked',true);
	$('#pin_category :eq(0)').attr('selected',true);
	$("input[name='pin_type']").filter("input[value='all']").attr('checked',true);
	$('#search_field :eq(0)').attr('selected',true);
	$('#search_keyword').val('');
}
var job_type_sel_first = function( vals, target ){	// 첫번째 직종값 선택
	var sel = vals.value;	
	$('#'+target+'_display').load('./views/_load/alba.php', { mode:'second_job_type', type:'job_type', p_code:sel, target:target }, function(result){
		//alert(result);
	});
}
var area_blocks = 0;
var area_sel_first = function( vals, target ){	// 첫번째 지역값 선택
	var sel = vals.value;
	$('#'+target+'_display').load('./views/_load/alba.php', { mode:'second_area', type:'area', p_code:sel, target:target }, function(result){
		//alert(result);
	});
}
var career_sel = function( vals ){	// 경력사항 선택
	var sel = vals.value;
	if(sel=='2'){
		$('#wr_career').attr('required',true);
		$('#wr_career_display').show();
	} else {
		$('#wr_career').attr('required',false);
		$('#wr_career :eq(0)').attr('selected',true);
		$('#wr_career_display').hide();
	}
}
</script>

<dl class="srchb lnb4_col bg2_col">

<form name="SearchFrm" method="GET" id="SearchFrm" action="<?php echo $_SERVER['PHP_SELF'];?>">
<input type="hidden" name="mode" value="search" id="mode"/>
<input type="hidden" name="page_rows" value="<?php echo $page_rows;?>" id="page_rows"/>

	<table class="bg_col" id="dsrch" style="display:none;">
	<col width=85><col><col width=85><col>
	<tr>
		<td class="ctlt">등록일</td>
		<td class="pdlnb2" colspan="3">
			<label><input name="start_dayAll" type="checkbox" value="1" class="check" id='start_dayAll' <?php echo ($_GET['start_dayAll']=='1')?"checked":"";?>>전체</label> &nbsp;
			<input name="start_day" type="text" class="tday" id='start_day' <?php echo ($_GET['start_dayAll']=='1')?"disabled value=''":"value='".$_GET['start_day']."'";?>> ~
			<input name="end_day" type="text" class="tday" id='end_day' <?php echo ($_GET['start_dayAll']=='1')?"disabled value=''":"value='".$_GET['end_day']."'";?>>
			<a class="bbtn set_day" date='today'><h1 class="btn19">오늘</h1></a>
			<a class="bbtn set_day" date='week'><h1 class="btn19">이번주</h1></a>
			<a class="bbtn set_day" date='month'><h1 class="btn19">이번달</h1></a>
			<a class="bbtn set_day" date='7day'><h1 class="btn19">1주일</h1></a>
			<a class="bbtn set_day" date='15day'><h1 class="btn19">15일</h1></a>
			<a class="bbtn set_day" date='30day'><h1 class="btn19">1개월</h1></a>
			<a class="bbtn set_day" date='60day'><h1 class="btn19">3개월</h1></a>
			<a class="bbtn set_day" date='120day'><h1 class="btn19">6개월</h1></a>
		</td>
	</tr>
	<tr>
		<td class="ctlt">서비스</td>
		<td class="pdlnb2" colspan="3">
			<label><input name="wr_service[]" type="checkbox" value="main_focus" class="check" id="wr_service_main_focus" <?php echo (@in_array('main_focus',$wr_service))?'checked':'';?>/>메인 포커스</label>
			<label><input name="wr_service[]" type="checkbox" value="sub_focus" class="check" id="wr_service_sub_focus" <?php echo (@in_array('sub_focus',$wr_service))?'checked':'';?>/>인재정보 포커스</label>
			<label><input name="wr_service[]" type="checkbox" value="basic" class="check" id="wr_service_basic" <?php echo (@in_array('basic',$wr_service))?'checked':'';?>/>일반 리스트</label>
			<label><input name="wr_service[]" type="checkbox" value="busy" class="check" id="wr_service_busy" <?php echo (@in_array('busy',$wr_service))?'checked':'';?>/>급구상품</label>
			<label><input name="wr_service[]" type="checkbox" value="neon" class="check" id="wr_service_neon" <?php echo (@in_array('neon',$wr_service))?'checked':'';?>/>형광펜</label>
			<label><input name="wr_service[]" type="checkbox" value="bold" class="check" id="wr_service_bold" <?php echo (@in_array('bold',$wr_service))?'checked':'';?>/>굵은글자</label>
			<label><input name="wr_service[]" type="checkbox" value="icon" class="check" id="wr_service_icon" <?php echo (@in_array('icon',$wr_service))?'checked':'';?>/>아이콘</label>
			<label><input name="wr_service[]" type="checkbox" value="color" class="check" id="wr_service_color" <?php echo (@in_array('color',$wr_service))?'checked':'';?>/>글자색</label>
			<label><input name="wr_service[]" type="checkbox" value="jump" class="check" id="wr_service_jump" <?php echo (@in_array('jump',$wr_service))?'checked':'';?>/>점프</label>
		</td>
	</tr>
	<tr>
		<td class="ctlt">직종</td>
		<td class="pdlnb2">
			<select  style="width:150px;" id="wr_job_type_0" name="wr_job_type_0" title="1차 직종선택" onchange="job_type_sel_first(this,'wr_job_type_1');" hname="1차직종">
			<option value="">= 1차 직종선택 =</option>
			<?php 
			if($job_type_list){
				foreach($job_type_list as $val){ 
				$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
				$selected = ($wr_job_type_0 == $val['code']) ? "selected" : "";
			?>
			<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
			<?php 
				}	// foreach end.
			} // if end.
			?>
			</select>
			<span id="wr_job_type_1_display">
				<select  style="width:150px;" id="wr_job_type_1" name="wr_job_type_1" title="2차직종선택" onchange="job_type_sel_first(this,'wr_job_type_2');">
				<option value="">= 2차 직종선택 =</option>
				<?php
				if($wr_job_type_1){
					$pcodeList = $category_control->category_pcodeList('job_type', $wr_job_type_0);
					if($pcodeList){
						foreach($pcodeList as $val){ 
						$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
						$selected = ($wr_job_type_1 == $val['code']) ? "selected" : "";
				?>
						<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
				<?php 
						}	// foreach end.
					}	// if end.
				} else {
				?>
					<option value="">1차 직종을 먼저 선택해 주세요</option>
				<?php
				}	// if end.
				?>
				</select>
			</span>
			<span id="wr_job_type_2_display">
				<select  style="width:150px;" id="wr_job_type_2" name="wr_job_type_2" title="3차직종선택">
				<option value="">= 3차 직종선택 =</option>
				<?php
				if($wr_job_type_2){
					$pcodeList = $category_control->category_pcodeList('job_type', $wr_job_type_1);
					if($pcodeList){
						foreach($pcodeList as $val){ 
						$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
						$selected = ($wr_job_type_2 == $val['code']) ? "selected" : "";
				?>
					<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
				<?php 
						}	// foreach end.
					}	// if end.
				} else {
				?>
					<option value="">2차 직종을 먼저 선택해 주세요</option>
				<?php
				}	// if end.
				?>
				</select>
			</td>   
		<td class="ctlt">지역</td>
		<td class="pdlnb2">
			<select  style="width:180px;" id="wr_area0" name="wr_area0" title="시·도 선택" onchange="area_sel_first(this,'wr_area1');"  hname="근무지 시·도">
			<option value=""> -- 시·도 --</option>
			<?php 
				foreach($area_list as $val){ 
				$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
				$selected = ($wr_area0 == $val['code']) ? "selected" : "";
			?>
			<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
			<?php } ?>
			</select>
			<span id="wr_area1_display">
				<select  style="width:180px;" id="wr_area1" name="wr_area1" title="시·군·구 선택">
				<option value=""> -- 시·군·구 --</option>
				<?php
				if($wr_area1){
					$pcodeList = $category_control->category_pcodeList('area', $wr_area0);
					foreach($pcodeList as $val){ 
					$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
					$selected = ($wr_area1 == $val['code']) ? "selected" : "";
				?>
					<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
				<?php 
					}	// foreach end.
				} else {
				?>
					<option value="">시·도 를 먼저 선택해 주세요</option>
				<?php
				}	// if end.
				?>
				</select>
			</span>

		</td>
	</tr>
	<tr>
		<td class="ctlt">경력</td>
		<td class="pdlnb2">
			<label><input name="wr_career_type" type="radio" value="0" class="radio" onclick="career_sel(this);" <?php echo ($wr_career_type=='0')?'checked':'';?>>신입</label> &nbsp;
			<label><input name="wr_career_type" type="radio" value="1" class="radio" onclick="career_sel(this);" <?php echo ($wr_career_type=='1')?'checked':'';?>>경력</label> &nbsp;
		</td>   
		<td class="ctlt">성별</td>
		<td class="pdlnb2">
			<label><input name="wr_gender" type="radio" value="0" class="radio" <?php echo (!$wr_gender)?'checked':'';?>>무관</label> &nbsp;
			<label><input name="wr_gender" type="radio" value="1" class="radio" <?php echo ($wr_gender=='1')?'checked':'';?>>남</label> &nbsp;
			<label><input name="wr_gender" type="radio" value="2" class="radio" <?php echo ($wr_gender=='2')?'checked':'';?>>여</label> &nbsp;
		</td>
	</tr>
	<tr>
		<td class="ctlt">최종학력</td>
		<td class="pdlnb2" colspan="3">
			<?php
			if($indi_ability_list) {
				foreach($indi_ability_list as $val){
				$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
				$checked = (@in_array($val['code'],$wr_ability)) ? 'checked' : '';
			?>
			<label><input type="checkbox" name="wr_ability[]" value="<?php echo $val['code'];?>" <?php echo $checked;?>/> <?php echo $name;?></label>&nbsp;
			<?php
				}	// foreach end.
			}	// if end.
			?>
		</td>   
	</tr>
	</table>
	<dl class="tc pd7 wbg">
		<select name="search_field" class="s23" id="search_field">
			<option value="">통합검색</option>
			<option value="wr_name" <?php echo ($_GET['search_field']=='wr_name')?'selected':'';?>>회원이름</option>
			<option value="wr_id" <?php echo ($_GET['search_field']=='wr_id')?'selected':'';?>>회원ID</option>
			<option value="wr_subject" <?php echo ($_GET['search_field']=='wr_subject')?'selected':'';?>>이력서제목</option>
		</select>
		<input type="text" name="search_keyword" value="<?php echo stripslashes($_GET['search_keyword']);?>" class="txt i23 w50" id="search_keyword">
		<span class="cbtn grf_col lnb_col" style="width:40px"><input type='submit' class="btn23 b" onFocus="blur()" value='검색'></span>
		<span class="bbtn"><input type='button' class="btn23 b" onFocus="blur()" value='초기화' onclick="searchFrmInit();"></span>
		<span class="btn" id="dsrchType" enum="yes"><input type='button' class="btn23 b" onFocus="blur()" value='상세검색' id="searchBtn"></span>
		<!--<span onClick="MM_showHideLayers('dsrch','','hide')"  class="btn"><input type='submit' class="btn23 b" onFocus="blur()" value='간편검색'></span> -->
	</dl>

</form>

</dl>