$(function(){

});

var sel_tabs = function( tabs ){	// 탭선택
	if(tabs == 'tab1'){
		$('.tab1').addClass('on');
		$('.tab2').removeClass('on');
		$('.customList1').show();
		$('.customList2').hide();
	} else if(tabs == 'tab2'){
		$('.tab1').removeClass('on');
		$('.tab2').addClass('on');
		$('.customList1').hide();
		$('.customList2').show();
	}
}

var job_blocks = 0;
var job_type_sel_first = function( vals, target ){	// 첫번째 직종값 선택
	var sel = vals.value;
	$('#'+target+'_display').load('../individual/views/_load/alba_resume_regist.php', { mode:'second_job_type', type:'job_type', p_code:sel, target:target }, function(result){
		//alert(result);
	});
}
var job_type_add = function(){	// 직종 추가
	job_blocks++;
	if(job_blocks > 2){
		alert("직종은 최대 3가지 까지 추가 가능합니다.");
		return false;
	} else {
		$('#wr_job_type'+job_blocks+'_block').show();
	}
}

var area_blocks = 0;
var area_sel_first = function( vals, target ){	// 첫번째 지역값 선택
	var sel = vals.value;
	$('#'+target+'_display').load('../individual/views/_load/alba_resume_regist.php', { mode:'second_area', type:'area', p_code:sel, target:target }, function(result){
		//alert(result);
	});
}
var area_add = function(){	// 지역 추가
	area_blocks++;
	if(area_blocks > 2){
		alert("근무지는 최대 3군데 까지 추가 가능합니다.");
		return false;
	} else {
		$('#wr_area'+area_blocks+'_block').show();
	}
}

var age_sel = function( vals ){	// 연령 제한 선택
	var sel = vals.value;
	if(sel=='1'){
		$('.wr_age').attr('required',true);
		$('#wr_age_display').show();
	} else {
		$('.wr_age').val('');
		$('.wr_age').attr('required',false);
		$('#wr_age_display').hide();
	}
}

var time_conference = function( vals ){	// 근무시간 협의
	var sel = vals.value;
	var checked = vals.checked;

	if(checked==true){
		$("#wr_stime :eq(0)").attr('selected',true);
		$("#wr_smin :eq(0)").attr('selected',true);
		$("#wr_etime :eq(0)").attr('selected',true);
		$("#wr_emin :eq(0)").attr('selected',true);
		$('.wr_time').attr('disabled',true);
		$('.wr_time').attr('required',false);
	} else {
		$('.wr_time').attr('disabled',false);
		$('.wr_time').attr('required',true);
	}

}

var customFrmSubmit = function(){
	
	$('#CustomSetFrm').submit();

}

var sel_customs = function( vals ){	// 맞춤 조건 선택
	var sel = vals.value;
	location.href = "./alba_customized.php?no=" + sel;
}

var CustomSearchFrmSubmit = function(){	// 맞춤 조건에 맞게 검색 시작

	$('#CustomSearchFrm').submit();

}

var customDelete = function( no ){	// 조건 삭제
	if(confirm('지금 보고 계신 맞춤 채용정보 조건을 삭제하시겠습니까?')){

		$.post('./process/custom.php', { mode:'custom_delete', no:no }, function(result){
			if(result){
				alert("맞춤 채용정보 조건이 삭제되었습니다.");
				location.href = "./alba_customized.php";
			} else {
				alert("맞춤 채용정보 조건 삭제중 오류가 발생하였습니다.\n\n운영자에게 문의하세요.");
			}
		});

	}
}
