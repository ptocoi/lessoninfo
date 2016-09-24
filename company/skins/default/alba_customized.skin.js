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
	if(job_blocks > 2){
		alert("직종은 최대 3가지 까지 추가 가능합니다.");
		return false;
	} else {
		if( $('#wr_job_type1_block').css('display') == 'none' ){
			$('#wr_job_type1_block').show();
		} else if( $('#wr_job_type2_block').css('display') == 'none' ){
			$('#wr_job_type2_block').show();
		}
		//$('#wr_job_type'+job_blocks+'_block').show();
	}
	job_blocks++;
}
var job_type_remove = function( no ){	// 직종 삭제
	if(no==1){
		$('#wr_job_type1_block .ipSelect :eq(0)').attr('selected',true);
		$('#wr_job_type4 :eq(0)').attr('selected',true);
		$('#wr_job_type5 :eq(0)').attr('selected',true);
	} else if(no==2){
		$('#wr_job_type6 :eq(0)').attr('selected',true);
		$('#wr_job_type7 :eq(0)').attr('selected',true);
		$('#wr_job_type8 :eq(0)').attr('selected',true);
	}
	//$('#wr_job_type'+no+'_block span.ipSelect :eq(0)').attr('selected',true);
	$('#wr_job_type'+no+'_block').hide();
	job_blocks--;
}

var area_blocks = 0;
var area_sel_first = function( vals, target ){	// 첫번째 지역값 선택
	var sel = vals.value;
	$('#'+target+'_display').load('../individual/views/_load/alba_resume_regist.php', { mode:'second_area', type:'area', p_code:sel, target:target }, function(result){
		//alert(result);
	});
}
var area_add = function(){	// 지역 추가
	if(area_blocks > 2){
		alert("근무지는 최대 3군데 까지 추가 가능합니다.");
		return false;
	} else {
		if( $('#wr_area1_block').css('display') == 'none' ){
			$('#wr_area1_block').show();
		} else if( $('#wr_area2_block').css('display') == 'none' ){
			$('#wr_area2_block').show();
		}
		//$('#wr_area'+area_blocks+'_block').show();
	}
	area_blocks++;
}
var area_remove = function( no ){	// 지역 삭제
	if(no==1){
		$('#wr_area1_block .ipSelect :eq(0)').attr('selected',true);
		$('#wr_area3 :eq(0)').attr('selected',true);
	} else if(no==2){
		$('#wr_area4 :eq(0)').attr('selected',true);
		$('#wr_area5 :eq(0)').attr('selected',true);
	}
	//$('#wr_job_type'+no+'_block span.ipSelect :eq(0)').attr('selected',true);
	$('#wr_area'+no+'_block').hide();
	area_blocks--;
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

var sel_resume_scrap = function( ){	 // 선택 이력서 스크랩

	if(mb_type=='individual'){
		alert("이력서 스크랩은 기업회원만 가능합니다.");
		return;
	}

	var chk_length = $("input[name='no[]']:checked").length;
	if(chk_length==0){
		alert('스크랩 할 열람 인재정보를 선택해 주세요.');
		return false;
	} else {
		var scrap_no = new Array();
		var i = 0;
		$("input[name='no[]']:checked").each(function(){
			scrap_no[i] = $(this).attr('resume_no');
		i++;
		});
		if(confirm('선택하신 인재정보 '+chk_length+'건을 스크랩 하시겠습니까?')){
			$.post('./process/open.php', { mode:'sel_resume_scrap', no:scrap_no, mb_id:mb_id }, function(result){
				if(result){
					location.reload();
				} else {
					alert("열람 인재정보 스크랩중 오류가 발생하였습니다.\n\n사이트 관리자에게 문의하세요.");
				}
			});
		}
	}

}

var customDelete = function( no ){	// 조건 삭제
	if(confirm('지금 보고 계신 맞춤 인재정보 조건을 삭제하시겠습니까?')){

		$.post('./process/custom.php', { mode:'custom_delete', no:no }, function(result){
			if(result){
				alert("맞춤 인재정보 조건이 삭제되었습니다.");
				location.href = "./alba_customized.php";
			} else {
				alert("맞춤 인재정보 조건 삭제중 오류가 발생하였습니다.\n\n운영자에게 문의하세요.");
			}
		});

	}
}

var is_delete = function(){
	alert("삭제된 이력서 입니다\n\n해당 이력서를 작성한 개인회원이 삭제하여 상세 내용 확인이 불가능 합니다.");
}