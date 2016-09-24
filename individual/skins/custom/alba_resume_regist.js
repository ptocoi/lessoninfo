var search_target = "";
$(function(){
	$('#wr_subject').focus();	 // 제목에 포커싱
	$(":input[placeholder]").placeholder();
	$('#schoolSearchPop_close').click(function(){	// 학교 검색창 닫기
		//$('#schoolSearchPop').hide();
		school_search_pop_empty();
	});
	$('#schoolSearchPop').draggable({	 // 학교 검색창 드래그
		handle: '#profilePhotoPop_handle'
	});
	$('#school_search_keyword').keydown(function(event){	// 검색창 엔터키 이벤트
		if(event.keyCode==13){	
			school_search();
			return false;
		}
	});

	$('#profilePhotoPop').draggable({	 // 프로필 등록창 드래그
		handle: '#schoolSearchPop_handle'
	});
	$('#profilePhotoPop_close').click(function(){	// 프로필 등록창 닫기
		$('#profilePhotoPop').hide();
	});
});

var past_load = function( vals ){	 // 과거 공고 불러오기
	var sel = vals.value;
	location.href = "./alba_resume_regist.php?mode=load&no="+sel;
}

var area_blocks = 0;
var area_sel_first = function( vals, target ){	// 첫번째 지역값 선택
	var sel = vals.value;
	$('#'+target+'_display').load('./views/_load/alba_resume_regist.php', { mode:'second_area', type:'area', p_code:sel, target:target }, function(result){
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
var area_remove = function( area_block ){	// 지역 제거
	$('#wr_area'+area_block+'_block').hide();
	area_blocks--;
}
var job_blocks = 0;
var job_type_sel_first = function( vals, target ){	// 첫번째 직종값 선택
	var sel = vals.value;
	$('#'+target+'_display').load('./views/_load/alba_resume_regist.php', { mode:'second_job_type', type:'job_type', p_code:sel, target:target }, function(result){
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
var job_type_remove = function( job_block ){	// 직종 제거
	$('#wr_job_type'+job_block+'_block').hide();
	job_blocks--;
}
var pay_conference = function( vals){	// 급여 추후협의 체크
	var sel = vals.checked;
	if(sel==true){
		$('#wr_pay_type, #wr_pay').attr('disabled',true);
		$('#wr_pay_type, #wr_pay').removeAttr('required');
	} else {
		$('#wr_pay_type, #wr_pay').attr('disabled',false);
		$('#wr_pay_type, #wr_pay').attr('required',true);
	}
}

var form_submit = function(){	 // 이력서 폼 전송

	$("input[name='wr_school_type[]']").attr('disabled',false);	 // 선택학력 enabled

	// 출신학교 초기화
	$('.graduate').each(function(){
		var vals = $(this).val();
		if(vals=='출신학교 선택' || vals=='') {
			$(this).val('');
		}
	});

	// 전공입력 초기화
	$('.specialize').each(function(){
		var vals = $(this).val();
		if(vals=='전공입력' || vals=='') {
			$(this).val('');
		}
	});


	if (document.getElementById('tx_wr_introduce')) {
		if (!ed_wr_introduce.outputBodyText()) { 
			alert('자기소개서를 입력해 주세요.'); 
			ed_wr_introduce.returnFalse();
			return;
		}
    }

	$('#AlbaResumeFrm').submit();
}

/* 학력 사항 ===================================================== */
var school_ability = function( vals ){	 // 학력선택
	var sel = vals.value.split('/');
	var code = sel[0], rank = Number(sel[1]);

	// 입력할 학력선택 초기화
	$('#schoolSelect').hide();	// 입력할 학력선택
	$("input[name='wr_school_type[]']").attr('disabled',true);
	$("input[name='wr_school_type[]']").attr('checked',false);

	if(rank <=3 ){	// 중학교 까지 (휴학 불가능)

		$('#ability_high_school').hide();
		$('#ability_half_college').hide();
		$('#ability_college').hide();
		$('#ability_graduate').hide();
		$('#ability_success').hide();
		
		$('#wr_school_absence').attr('checked',false);	// 휴학중 체크
		$('#wr_school_absence').attr('disabled',true);

	} else {	 // 고등학교 이상 (휴학 가능)

		$('#wr_school_absence').attr('disabled',false);

		/* 고등학교 ======================================== */
		if(rank==4 || rank==5){

			$('#ability_high_school').show();
			$('#ability_half_college').hide();
			$('#ability_college').hide();
			$('#ability_graduate').hide();
			$('#ability_success').hide();

			if(rank==4){	// 고등학교 재학
				$('#high_school_eyear_block').hide();
				$('#high_school_eyear_now').show();
				$('#wr_high_school_graduation option[value=1]').attr('selected',true);
				$('#wr_high_school_graduation').attr('disabled',true);
			} else if(rank==5){	// 고등학교 졸업
				$('#high_school_eyear_block').show();
				$('#high_school_eyear_now').hide();
				$('#wr_high_school_graduation option[value=0]').attr('selected',true);
				$('#wr_high_school_graduation').attr('disabled',true);
			}

		/* //고등학교 ======================================== */

		/* 대학(2,3년) ======================================== */
		} else if(rank==6 || rank==7 || rank==8){

			$('#ability_high_school').hide();
			$('#ability_college').hide();
			$('#ability_half_college').show();
			$('#ability_graduate').hide();
			$('#ability_success').hide();

			$('#schoolSelect').show();	// 입력할 학력선택
			$('#school_type0').attr('disabled',false);
			$('#school_type1').attr('checked',true);
			
			if(rank==7){	// 대학(2,3년) 재학
				$('#half_college_eyear_block_0').hide();
				$('#half_college_eyear_now_0').show();
				$('#wr_half_college_graduation_0 option[value=1]').attr('selected',true);
				$('#wr_half_college_graduation_0').attr('disabled',true);
			} else if(rank==6) {	// 대학(2,3년) 중퇴
				$('#half_college_eyear_block_0').show();
				$('#half_college_eyear_now_0').hide();
				$('#wr_half_college_graduation_0 option[value=2]').attr('selected',true);
				$('#wr_half_college_graduation_0').attr('disabled',true);
			} else if(rank==8) {	// 대학(2,3년) 졸업
				$('#half_college_eyear_block_0').show();
				$('#half_college_eyear_now_0').hide();
				$('#wr_half_college_graduation_0 option[value=0]').attr('selected',true);
				$('#wr_half_college_graduation_0').attr('disabled',true);
			}

		/* //대학(2,3년) ======================================== */

		/* 대학(4년) ======================================== */
		} else if(rank==9 || rank==10 || rank==11){

			$('#ability_high_school').hide();
			$('#ability_half_college').hide();
			$('#ability_college').show();
			$('#ability_graduate').hide();
			$('#ability_success').hide();

			$('#schoolSelect').show();	// 입력할 학력선택
			$('#school_type0').attr('disabled',false);
			$('#school_type1').attr('disabled',false);
			$('#school_type2').attr('checked',true);

			if(rank==10){	// 대학(4년) 재학
				$('#college_eyear_block_0').hide();
				$('#college_eyear_now_0').show();
				$('#wr_college_graduation_0 option[value=1]').attr('selected',true);
				$('#wr_college_graduation_0').attr('disabled',true);
			} else if(rank==9) {	// 대학(4년) 중퇴
				$('#college_eyear_block_0').show();
				$('#college_eyear_now_0').hide();
				$('#wr_college_graduation_0 option[value=2]').attr('selected',true);
				$('#wr_college_graduation_0').attr('disabled',true);
			} else if(rank==11) {	// 대학(4년) 졸업
				$('#college_eyear_block_0').show();
				$('#college_eyear_now_0').hide();
				$('#wr_college_graduation_0 option[value=0]').attr('selected',true);
				$('#wr_college_graduation_0').attr('disabled',true);
			}

		/* //대학(4년) ======================================== */

		/* 대학원 =========================================== */
		} else if(rank==12 || rank==13 || rank==14){

			$('#ability_high_school').hide();
			$('#ability_half_college').hide();
			$('#ability_college').hide();
			$('#ability_graduate').show();
			$('#ability_success').hide();

			$('#schoolSelect').show();	// 입력할 학력선택
			$('#school_type0').attr('disabled',false);
			$('#school_type1').attr('disabled',false);
			$('#school_type2').attr('disabled',false);
			$('#school_type3').attr('checked',true);

			if(rank==13){	// 대학원 재학
				$('#graduate_eyear_block_0').hide();
				$('#graduate_eyear_now_0').show();
				$('#wr_graduate_graduation_0 option[value=2]').attr('selected',true);
				$('#wr_graduate_graduation_0').attr('disabled',true);
			} else if(rank==12) {	// 대학원 중퇴
				$('#graduate_eyear_block_0').show();
				$('#graduate_eyear_now_0').hide();
				$('#wr_graduate_graduation_0 option[value=3]').attr('selected',true);
				$('#wr_graduate_graduation_0').attr('disabled',true);
			} else if(rank==14) {	// 대학원 졸업
				$('#graduate_eyear_block_0').show();
				$('#graduate_eyear_now_0').hide();
				$('#wr_graduate_graduation_0 option[value=0]').attr('selected',true);
				$('#wr_graduate_graduation_0').attr('disabled',true);
			}

		/* //대학원 =========================================== */

		/* 대학원 이상 ========================================= */
		} else if(rank==15){

			$('#wr_school_absence').attr('checked',false);	// 휴학중 체크
			$('#wr_school_absence').attr('disabled',true);

			$('#ability_high_school').hide();
			$('#ability_half_college').hide();
			$('#ability_college').hide();
			$('#ability_graduate').hide();
			$('#ability_success').show();

			$('#schoolSelect').show();	// 입력할 학력선택
			$('#school_type0').attr('disabled',false);
			$('#school_type1').attr('disabled',false);
			$('#school_type2').attr('disabled',false);
			$('#school_type3').attr('checked',true);

		/* //대학원 이상 ========================================= */
		}

	}

}
var search_mode = "";
var school_search_pop = function( mode, target ){	// 학교 검색 (레이어창 띄우기)
	search_mode = mode;	
	switch(mode){
		case 'high_school':
			$('.search_title_txt').html("고등학교");
			search_target = target;
		break;
		case 'half_college':
			$('.search_title_txt').html("대학(2,3년)");
			//search_target = $('#wr_half_college_'+target);
			search_target = "wr_half_college_" + target;
		break;
		case 'college':
			$('.search_title_txt').html("대학(4년)");
			search_target = "wr_college_" + target;
		break;
		case 'graduate':
			$('.search_title_txt').html("대학원");
			search_target = "wr_graduate_" + target;
		break;
		case 'success':
			$('.search_title_txt').html("대학원");
			search_target = "wr_success_" + target;
		break;
	}
	//school_search_pop_empty();	// 초기화
	$('#schoolSearchPop').show();
	$('#school_search_keyword').focus();
}
var dt = new Date();
var year = dt.getFullYear();

// 대학(2,3년) 추가
var half_college_cnt = 1;
var half_college_limit = 1;
var half_college_add = function(){
	if(half_college_limit >= 5){
		alert("대학(2,3년)은 최대 5개 까지 추가 가능합니다.");
		return false;
	}

	half_college = "";
	half_college += "<li class=\"pb5 positionR\" id=\"half_college_"+half_college_cnt+"\">";
	//half_college += "<input class=\"ipText graduate\" type=\"text\" name=\"wr_half_college[]\" id=\"wr_half_college_"+half_college_cnt+"\" style=\"width:100px;\" readonly onclick=\"school_search_pop('half_college','"+half_college_cnt+"');\" value=\"출신학교 선택\">";
	half_college += "<input class=\"ipText graduate\" type=\"text\" name=\"wr_half_college[]\" id=\"wr_half_college_"+half_college_cnt+"\" style=\"width:100px;\" value=\"출신학교 입력\"> ";
	//half_college += "<em class=\"pr10\"> <a class=\"button\" onclick=\"school_search_pop('half_college','"+half_college_cnt+"');\"><span>선택</span></a> </em>";
	half_college += "<input class=\"ipText specialize\" type=\"text\" name=\"wr_half_college_specialize[]\" id=\"wr_half_college_specialize_"+half_college_cnt+"\" style=\"width:80px;\" value=\"전공입력\"> ";
	half_college += "<select name=\"wr_half_college_syear[]\" class=\"ipSelect\">";
	half_college += "<option value=\"\">년도</option>";
	for(i=year;i>=1900;--i){
		half_college += "<option value=\""+i+"\">"+i+"</option>";
	}
	half_college += "</select> ";
	half_college += "년 ~ ";
	half_college += "<span id=\"half_college_eyear_block_"+half_college_cnt+"\">";
	half_college += "<select name=\"wr_half_college_eyear[]\" class=\"ipSelect\">";
	half_college += "<option value=\"\">년도</option>";
	for(i=year;i>=1900;--i){
		half_college += "<option value=\""+i+"\">"+i+"</option>";
	}
	half_college += "</select> ";
	half_college += "년";
	half_college += "</span> ";
	half_college += "<select name=\"wr_half_college_graduation[]\" id=\"wr_half_college_graduation_"+half_college_cnt+"\" class=\"ipSelect\">";
	half_college += "<option value=\"\">졸업여부</option>";
	half_college += "<option value=\"0\">졸업</option>";
	half_college += "<option value=\"1\">재학</option>";
	half_college += "<option value=\"2\">중퇴</option>";
	half_college += "</select>";
	half_college += "<em style=\"right:0; top:2px;\" class=\"positionA insert\"> <a class=\"button white\" onclick=\"half_college_remove('"+half_college_cnt+"');\"><span>-제거</span></a></em>";
	half_college += "</li>";

	$('#half_college_block').append(half_college);
	$('#wr_half_college_graduation_0').attr('disabled',false);	// 졸업여부 활성화

	// 출신학교 포커스
	$('.graduate').focus(function(){
		var vals = $(this).val();
		if(vals=='출신학교 선택') $(this).val('');
	}).focusout(function(){
		var vals = $(this).val();
		if(vals=='출신학교 선택' || vals=='') $(this).val('출신학교 선택');
	});

	// 전공입력 포커스
	$('.specialize').focus(function(){
		var vals = $(this).val();
		if(vals=='전공입력') $(this).val('');
	}).focusout(function(){
		var vals = $(this).val();
		if(vals=='전공입력' || vals=='') $(this).val('전공입력');
	});

	//$('#wr_half_college_block_'+half_college_cnt).show();

half_college_cnt++;
half_college_limit++;
}

// 대학(2,3년) 제거	
var half_college_remove = function( cnt ){
half_college_limit--;
	$('#half_college_'+cnt).remove();
}

// 대학(4년) 추가
var college_cnt = 1;
var college_limit = 1;
var college_add = function(){
	if(college_limit >= 5){
		alert("대학(4년)은 최대 5개 까지 추가 가능합니다.");
		return false;
	}
	
	college = "";
	college += "<li class=\"pb5 positionR\" id=\"college_"+college_cnt+"\">";
	//college += "<input class=\"ipText graduate\" type=\"text\" name=\"wr_college[]\" id=\"wr_college_"+college_cnt+"\" style=\"width:100px;\" readonly onclick=\"school_search_pop('college','"+college_cnt+"');\" value=\"출신학교 선택\">";
	college += "<input class=\"ipText graduate\" type=\"text\" name=\"wr_college[]\" id=\"wr_college_"+college_cnt+"\" style=\"width:100px;\" value=\"출신학교 입력\"> ";
	//college += "<em class=\"pr10\"> <a class=\"button\" onclick=\"school_search_pop('college','"+college_cnt+"');\"><span>선택</span></a> </em>";
	college += "<input class=\"ipText specialize\" type=\"text\" name=\"wr_college_specialize[]\" id=\"wr_college_specialize_"+college_cnt+"\" style=\"width:80px;\" value=\"전공입력\"> ";
	college += "<select name=\"wr_college_syear[]\" class=\"ipSelect\">";
	college += "<option value=\"\">년도</option>";
	for(i=year;i>=1900;--i){
		college += "<option value=\""+i+"\">"+i+"</option>";
	}
	college += "</select> ";
	college += "년 ~ ";
	college += "<span id=\"college_eyear_block_"+college_cnt+"\">";
	college += "<select name=\"wr_college_eyear[]\" class=\"ipSelect\">";
	college += "<option value=\"\">년도</option>";
	for(i=year;i>=1900;--i){
		college += "<option value=\""+i+"\">"+i+"</option>";
	}
	college += "</select> ";
	college += "년 ";
	college += "</span>";
	college += "<select name=\"wr_college_graduation[]\" id=\"wr_college_graduation_"+college_cnt+"\" class=\"ipSelect\">";
	college += "<option value=\"\">졸업여부</option>";
	college += "<option value=\"0\">졸업</option>";
	college += "<option value=\"1\">재학</option>";
	college += "<option value=\"2\">중퇴</option>";
	college += "</select>";
	college += "<em style=\"right:0; top:2px;\" class=\"positionA insert\"> <a class=\"button white\" onclick=\"college_remove('"+college_cnt+"');\"><span>-제거</span></a></em>";
	college += "</li>";

	$('#college_block').append(college);
	$('#wr_college_graduation_0').attr('disabled',false);	// 졸업여부 활성화

	// 출신학교 포커스
	$('.graduate').focus(function(){
		var vals = $(this).val();
		if(vals=='출신학교 선택') $(this).val('');
	}).focusout(function(){
		var vals = $(this).val();
		if(vals=='출신학교 선택' || vals=='') $(this).val('출신학교 선택');
	});

	// 전공입력 포커스
	$('.specialize').focus(function(){
		var vals = $(this).val();
		if(vals=='전공입력') $(this).val('');
	}).focusout(function(){
		var vals = $(this).val();
		if(vals=='전공입력' || vals=='') $(this).val('전공입력');
	});

	//$('#wr_college_block_'+college_cnt).show();

college_cnt++;
college_limit++;
}

// 대학 (4년) 제거
var college_remove = function( cnt ){
college_limit--;
	$('#college_'+cnt).remove();
}

// 대학원 추가
var graduate_cnt = 1;
var graduate_limit = 1;
var graduate_add = function(){
	if(graduate_limit >= 5){
		alert("대학원은 최대 5개 까지 추가 가능합니다.");
		return false;
	}

	graduate = "";
	graduate += "<li class=\"pb5 positionR\" id=\"graduate_"+graduate_cnt+"\">";
	//graduate += "<input class=\"ipText graduate\" type=\"text\" name=\"wr_graduate[]\" id=\"wr_graduate_"+graduate_cnt+"\" style=\"width:100px;\" readonly onclick=\"school_search_pop('graduate','"+graduate_cnt+"');\" value=\"출신학교 선택\">";
	graduate += "<input class=\"ipText graduate\" type=\"text\" name=\"wr_graduate[]\" id=\"wr_graduate_"+graduate_cnt+"\" style=\"width:100px;\" value=\"출신학교 입력\"> ";
	//graduate += "<em class=\"pr10\"> <a class=\"button\" onclick=\"school_search_pop('graduate','"+graduate_cnt+"');\"><span>선택</span></a> </em>";
	graduate += "<input class=\"ipText specialize\" type=\"text\" name=\"wr_graduate_specialize[]\" id=\"wr_graduate_specialize_"+graduate_cnt+"\" style=\"width:80px;\" value=\"전공입력\"> ";
	graduate += "<select name=\"wr_graduate_grade[]\" class=\"ipSelect\">";
	graduate += "<option value=\"\">학위</option>";
	graduate += "<option value='0'>석사</option>";
	graduate += "<option value='1'>박사</option>";
	graduate += "</select> ";
	graduate += "<select name=\"wr_graduate_syear[]\" class=\"ipSelect\">";
	graduate += "<option value=\"\">년도</option>";
	for(i=year;i>=1900;--i){
		graduate += "<option value=\""+i+"\">"+i+"</option>";
	}
	graduate += "</select> ";
	graduate += "년 ~ ";
	graduate += "<span id=\"graduate_eyear_block_"+graduate_cnt+"\">";
	graduate += "<select name=\"wr_graduate_eyear[]\" class=\"ipSelect\">";
	graduate += "<option value=\"\">년도</option>";
	for(i=year;i>=1900;--i){
		graduate += "<option value=\""+i+"\">"+i+"</option>";
	}
	graduate += "</select> ";
	graduate += "년 ";
	graduate += "</span>";
	graduate += "<select name=\"wr_graduate_graduation[]\" id=\"wr_graduate_graduation_"+graduate_cnt+"\" class=\"ipSelect\">";
	graduate += "<option value=\"\">졸업여부</option>";
	graduate += "<option value=\"0\">졸업</option>";
	graduate += "<option value=\"1\">수료</option>";
	graduate += "<option value=\"2\">재학</option>";
	graduate += "<option value=\"3\">중퇴</option>";
	graduate += "</select>";
	graduate += "<em style=\"right:0; top:2px;\" class=\"positionA insert\"> <a class=\"button white\" onclick=\"graduate_remove('"+graduate_cnt+"');\"><span>-제거</span></a></em>";
	graduate += "</li>";

	$('#graduate_block').append(graduate);
	$('#wr_graduate_graduation_0').attr('disabled',false);	// 졸업여부 활성화

	// 출신학교 포커스
	$('.graduate').focus(function(){
		var vals = $(this).val();
		if(vals=='출신학교 선택') $(this).val('');
	}).focusout(function(){
		var vals = $(this).val();
		if(vals=='출신학교 선택' || vals=='') $(this).val('출신학교 선택');
	});

	// 전공입력 포커스
	$('.specialize').focus(function(){
		var vals = $(this).val();
		if(vals=='전공입력') $(this).val('');
	}).focusout(function(){
		var vals = $(this).val();
		if(vals=='전공입력' || vals=='') $(this).val('전공입력');
	});

	//$('#wr_graduate_block_'+graduate_cnt).show();

graduate_cnt++;
graduate_limit++;
}

// 대학원 제거
var graduate_remove = function(cnt){
graduate_limit--;
	$('#graduate_'+cnt).remove();
}

// 대학원 이상 추가
var success_cnt = 1;
var success_limit = 1;
var success_add = function(){	
	if(success_limit >= 5){
		alert("대학원은 최대 5개 까지 추가 가능합니다.");
		return false;
	}

	success = "";
	success += "<li class=\"pb5 positionR\" id=\"success_"+success_cnt+"\">";
	//success += "<input class=\"ipText graduate\" type=\"text\" name=\"wr_success[]\" id=\"wr_success_"+success_cnt+"\" style=\"width:100px;\" readonly onclick=\"school_search_pop('success','"+success_cnt+"');\" value=\"출신학교 선택\">";
	success += "<input class=\"ipText graduate\" type=\"text\" name=\"wr_success[]\" id=\"wr_success_"+success_cnt+"\" style=\"width:100px;\" value=\"출신학교 입력\"> ";
	//success += "<em class=\"pr10\"> <a class=\"button\" onclick=\"school_search_pop('success','"+success_cnt+"');\"><span>선택</span></a> </em>";
	success += "<input class=\"ipText specialize\" type=\"text\" name=\"wr_success_specialize[]\" id=\"wr_success_specialize_"+success_cnt+"\" style=\"width:80px;\" value=\"전공입력\"> ";
	success += "<select name=\"wr_success_grade[]\" class=\"ipSelect\">";
	success += "<option value=\"\">학위</option>";
	success += "<option value='0'>석사</option>";
	success += "<option value='1'>박사</option>";
	success += "</select> ";
	success += "<select name=\"wr_success_syear[]\" class=\"ipSelect\">";
	success += "<option value=\"\">년도</option>";
	for(i=year;i>=1900;--i){
		success += "<option value=\""+i+"\">"+i+"</option>";
	}
	success += "</select> ";
	success += "년 ~ ";
	success += "<span id=\"success_eyear_block_"+success_cnt+"\">";
	success += "<select name=\"wr_success_eyear[]\" class=\"ipSelect\">";
	success += "<option value=\"\">년도</option>";
	for(i=year;i>=1900;--i){
		success += "<option value=\""+i+"\">"+i+"</option>";
	}
	success += "</select> ";
	success += "년 ";
	success += "</span>";
	success += "<select name=\"wr_success_graduation[]\" id=\"wr_success_graduation_"+success_cnt+"\" class=\"ipSelect\">";
	success += "<option value=\"\">졸업여부</option>";
	success += "<option value=\"0\">졸업</option>";
	success += "<option value=\"1\">수료</option>";
	success += "<option value=\"2\">재학</option>";
	success += "<option value=\"3\">중퇴</option>";
	success += "</select>";
	success += "<em style=\"right:0; top:2px;\" class=\"positionA insert\"> <a class=\"button white\" onclick=\"success_remove("+success_cnt+");\"><span>-제거</span></a></em>";
	success += "</li>";


	$('#success_block').append(success);
	$('#wr_success_graduation_0').attr('disabled',false);	// 졸업여부 활성화

	// 출신학교 포커스
	$('.graduate').focus(function(){
		var vals = $(this).val();
		if(vals=='출신학교 선택') $(this).val('');
	}).focusout(function(){
		var vals = $(this).val();
		if(vals=='출신학교 선택' || vals=='') $(this).val('출신학교 선택');
	});

	// 전공입력 포커스
	$('.specialize').focus(function(){
		var vals = $(this).val();
		if(vals=='전공입력') $(this).val('');
	}).focusout(function(){
		var vals = $(this).val();
		if(vals=='전공입력' || vals=='') $(this).val('전공입력');
	});
	
	//$('#wr_success_block_'+success_cnt).show();

success_cnt++;
success_limit++;
}
var success_remove = function(cnt){
success_limit--;
	$('#success_'+cnt).remove();
}

var school_search_pop_empty = function(){	 // 학교 검색 초기화
	$('#school_search_keyword').val("");
	$('#school_search_result').html("<li style=\"padding:5px; border-bottom:1px solid #eee;height:30px;text-align:center;padding-top:33px;padding-bottom:33px;\">학교명을 검색해 주세요.</li>");
	$('#school_name').val("");
	$('#schoolSearchPop').hide();	// 최종 닫음.
}
var school_types = function( vals ){	 // 입력할 학력선택
	var sel = vals.value;
	var checked = vals.checked;
	if(checked==true){
		$('#ability_'+sel).show();
	} else {
		$('#ability_'+sel).hide();
	}
}
var school_search = function(){	// 학교 검색
	var search_keyword = $('#school_search_keyword').val();
	$('#school_search_result').load('./views/_load/alba_resume_regist.php', { mode:'school_search', type:search_mode, keyword:search_keyword, search_target:search_target }, function(result){
		//alert(result);
	});
}
var search_on = function( txt, type, target ){	// 검색 학교 적용
	switch(type){
		case 'high_school':
			$('#wr_high_school_name').val(txt);
		break;
		case 'half_college':
		case 'college':
		case 'graduate':
		case 'success':
			$('#'+target).val(txt);
		break;
	}
	school_search_pop_empty();
}

var insert_school = function(){	// 학교명 입력
	var school_name = $('#school_name').val();
	if(!school_name || school_name==''){
		alert("입력할 학교명을 입력해 주세요.");
		$('#school_name').focus();
		return;
	} else {
		$.post('./process/alba_resume.php', { mode:'insert_school', type:search_mode, name:school_name }, function(result){
			if(result){
				alert("등록이 완료 되었습니다.");
				$('#'+search_target).val(school_name);
				school_search_pop_empty();
				/*
				$('#school_search_result').append("<li style=\"cursor:pointer; padding:5px; border-bottom:1px solid #eee;\"><a href=\"javascript:search_on();\">"++"</a></li>");
				alert("등록이 완료 되었습니다.\n\n검색하여 등록해 주세요.");
				$('#school_name').val("");
				$('#school_search_keyword').focus();
				*/
			} else {
				alert("학교명 입력중 오류가 발생하였습니다.\n\n사이트 관리자에 문의하세요.");
				return;
			}
		});
	}
}
/* //학력 사항 ===================================================== */

/* 경력 사항 ===================================================== */
var career_blocks = 0;
var career_type_sel_first = function( vals, target ){	// 첫번째 직종값 선택
	var sel = vals.value;
	$('#'+target+'_display').load('./views/_load/alba_resume_regist.php', { mode:'career_second_job_type', type:'job_type', p_code:sel, target:target }, function(result){
		//alert(result);
	});
}
var use_career = function( vals ){	// 경력 있음
	var sel = vals.checked;
	if(sel==true){
		$('#career_add').show();
		$('#wr_career_block_0').show();
		$('.career_required').attr('required',true);
	} else {
		$('#career_add').hide();
		$('.wr_career_block').hide();
		$('.career_required').removeAttr('required');
	}
}
var career_cnt = (mode=='insert') ? 1 : $('.wr_career_block').length;
var career_limit = 1;
var career_add = function(){	// 경력 추가
	if(career_limit >= 10){
		alert("경력은 최대 10개 까지 추가 가능합니다.");
		return false;
	}

	career = "";
	career += "<tr class=\"wr_career_block\" id=\"wr_career_block_"+career_cnt+"\" style=\"display:none;\">";
	career += "<td scope=\"row\"  class=\"subline\"> <label><strong>경력사항</strong></label></td>";	// "+(career_cnt+1)+"
	career += "<td>";
	career += "<div class=\"career1 positionR\">";
	career += "<ul>";
	career += "<li class=\"pb5 positionR\">";
	career += "<em style=\"right:0; top:5px;\" class=\"positionA delete\"> <a class=\"button white\" onclick=\"career_remove('"+career_cnt+"');\"><span>-삭제</span></a></em>";
	career += "<table>";
	career += "<caption><span class=\"skip\">경력사항 정보입력</span></caption>";	// "+(career_cnt+1)+"
	career += "<colgroup><col width=\"200px\"><col width=\"*\"></colgroup>";
	career += "<tbody>";
	career += "<tr>";
	career += "<td>";
	career += "<span>";
	career += "<label>회사명<img alt=\"필수입력사항\" src=\"../images/icon/icon_b2.gif\" width=\"6\" height=\"6\"></label>";
	career += "<input class=\"ipText\" type=\"text\" name=\"wr_career_company[]\" id=\"wr_career_company_"+career_cnt+"\" style=\"width:120px;\" required hname=\"회사명\">";
	career += "</span>";
	career += "</td>";
	career += "</tr>";
	career += "<tr>";
	career += "<td>";
	career += "<span><label>근무직종<img alt=\"필수입력사항\" src=\"../images/icon/icon_b2.gif\" width=\"6\" height=\"6\"></label></span>";

	career += "<select class=\"ipSelect\" style=\"width:170px;\" name=\"wr_career_type_"+career_cnt+"[]\" id=\"wr_career_type_"+career_cnt+"_0\" title=\"1차직종선택\" onchange=\"career_type_sel_first(this,'wr_career_type_"+career_cnt+"_1');\" required hname=\"1차직종\">";
	career += "<option value=\"\">1차직종선택</option>";
	career += "</select> ";

	career += "<span id=\"wr_career_type_"+career_cnt+"_1_display\">";
	career += "<select class=\"ipSelect\" style=\"width:170px;\" name=\"wr_career_type_"+career_cnt+"[]\" id=\"wr_career_type_"+career_cnt+"_1\" title=\"2차직종선택\" onchange=\"career_type_sel_first(this,'wr_career_type_"+career_cnt+"_2');\">";
	career += "<option value=\"\">2차직종선택</option>";
	career += "<option value=\"\">1차 직종을 먼저 선택해 주세요</option>";
	career += "</select> ";

	career += "</span>";
	career += "<span id=\"wr_career_type_"+career_cnt+"_2_display\">";
	career += "<select class=\"ipSelect\" style=\"width:170px;\" name=\"wr_career_type_"+career_cnt+"[]\" id=\"wr_career_type_"+career_cnt+"_2\" title=\"3차직종선택\">";
	career += "<option value=\"\">3차직종선택</option>";
	career += "<option value=\"\">2차 직종을 먼저 선택해 주세요</option>";
	career += "</select>";
	career += "</span>";

	career += "</td>";
	career += "</tr>";
	career += "<tr>";
	career += "<td colspan=\"2\">";
	career += "<label>근무기간<img alt=\"필수입력사항\" src=\"../images/icon/icon_b2.gif\" width=\"6\" height=\"6\"></label>";
	career += "<select name=\"wr_career_syear[]\" class=\"ipSelect\" required hname=\"근무기간\">";
	career += "<option value=\"\">년</option>";
	for(i=year;i>=1900;--i){
		career += "<option value=\""+i+"\">"+i+"</option>";
	}
	career += "</select> ";
	career += "년 ";
	career += "<select name=\"wr_career_smonth[]\" class=\"ipSelect\" required hname=\"근무기간\">";
	career += "<option value=\"\">월</option>";
	for(j=1;j<=12;j++){
		career += "<option value=\""+j+"\">"+j+"</option>";
	}
	career += "</select> ";
	career += "월 ~ ";
	career += "<select name=\"wr_career_eyear[]\" class=\"ipSelect\" required hname=\"근무기간\">";
	career += "<option value=\"\">년</option>";
	for(i=year;i>=1900;--i){
		career += "<option value=\""+i+"\">"+i+"</option>";
	}
	career += "</select> ";
	career += "년 ";
	career += "<select name=\"wr_career_emonth[]\" class=\"ipSelect\" required hname=\"근무기간\">";
	career += "<option value=\"\">월</option>";
	for(j=1;j<=12;j++){
		career += "<option value=\""+j+"\">"+j+"</option>";
	}
	career += "</select> ";
	career += "월";
	career += "</td>";
	career += "</tr>";
	career += "<tr>";
	career += "<td  colspan=\"2\">";
	career += "<label>담당업무<img alt=\"필수입력사항\" src=\"../images/icon/icon_b2.gif\" width=\"6\" height=\"6\"></label>";
	career += "<input class=\"ipText\" type=\"text\" name=\"wr_career_job[]\" id=\"wr_career_job_"+career_cnt+"\" style=\"width:120px;\" required hname=\"담당업무\">";
	career += "</td>";
	career += "</tr>";
	career += "<tr>";
	career += "<td  colspan=\"2\">";
	career += "<label>상세업무</label>";
	career += "<textarea class=\"ipTextarea\" name=\"wr_career_content[]\" id=\"wr_career_content_"+career_cnt+"\" style=\"width:450px; height:50px; padding:10px;\" onKeyUp=\"CountCharText(this, 30, 'career_content_bytes_"+career_cnt+"');\"></textarea>";
	career += "(<span id=\"career_content_bytes_"+career_cnt+"\">0</span>/100자)";
	career += "</td>";
	career += "</tr>";
	career += "</tbody>";
	career += "</table>";
	career += "</li>";
	career += "</ul>";
	career += "</div>";
	career += "</td>";
	career += "</tr>";

	$('#career_block').append(career);

	var career_type = $("#wr_career_type_"+career_cnt+"_0");

	$.post('./views/_load/alba_resume_regist.php', { mode:'job_type_0_json' }, function(result){
		var data = eval("(" + result + ")");
		var types = "";
		if(data.list!=''){
			$.each(data.list, function(key, lists){
				types += "<option value=\""+lists.code+"\">"+lists.name+"</option>";
			});
		}
		career_type.append(types);
	});

	$('#wr_career_block_'+career_cnt).show();

career_cnt++;
career_limit++;
}
var career_remove = function( cnt ){	 // 경력 제거
career_limit--;
	$('#wr_career_block_'+cnt).remove();
}
/* //경력 사항 ===================================================== */


/* 자격증 ======================================================== */
var use_license = function( vals ){
	var sel = vals.checked;
	if(sel==true){
		$('#license_add').show();
		$('#wr_license_block_0').show();
		$('.license_required').attr('required',true);
	} else {
		$('#license_add').hide();
		$('.wr_license_block').hide();
		$('.license_required').removeAttr('required');
	}
}
var license_cnt = 1;
var license_limit = 1;
var license_add = function(){	// 경력 추가
	if(license_limit >= 10){
		alert("자격증은 최대 10개 까지 추가 가능합니다.");
		return false;
	}

	license = "";
	license += "<tr class=\"wr_license_block\" id=\"wr_license_block_"+license_cnt+"\">";
	license += "<td scope=\"row\"  class=\" subline\"> <label><strong>자격증</strong></label></td>";	 // "+(license_cnt+1)+"
	license += "<td class=\"\">";
	license += "<div class=\"career1 positionR\">";
	license += "<ul>";
	license += "<li class=\"pb5 positionR\">";
	license += "<em style=\"right:0; top:5px;\" class=\"positionA delete\"> <a class=\"button white\" onclick=\"license_remove('"+license_cnt+"');\"><span>-삭제</span></a></em>";
	license += "<table>";
	license += "<caption><span class=\"skip\">자격증사항 정보입력</span></caption>";
	license += "<colgroup><col width=\"250px\"><col width=\"*\"></colgroup>";
	license += "<tbody>";
	license += "<tr>";
	license += "<td>";
	license += "<span>";
	license += "<label>자격증명<img alt=\"필수입력사항\" src=\"../images/icon/icon_b2.gif\" width=\"6\" height=\"6\"></label>";
	license += "<input class=\"ipText license_required\" type=\"text\" name=\"wr_license_name[]\"  id=\"wr_license_name_"+license_cnt+"\" style=\"width:150px;\" required hname=\"자격증명\">";
	//license += "<em class=\"pr10\"><a class=\"button\" onclick=\"license_search_pop('"+license_cnt+"');\"><span>선택</span></a></em>";
	license += "</span>";
	license += "</td>";
	license += "<td>";
	license += "<span>";
	license += "<label>발행처<img alt=\"필수입력사항\" src=\"../images/icon/icon_b2.gif\" width=\"6\" height=\"6\"></label>";
	license += "<input class=\"ipText license_required\" type=\"text\" name=\"wr_license_public[]\" id=\"wr_license_public_"+license_cnt+"\" style=\"width:150px;\" required hname=\"발행처\">";
	license += "</span>";
	license += "</td>";
	license += "</tr>";
	license += "<tr>";
	license += "<td colspan=\"2\">";
	license += "<label>취득년도<img alt=\"필수입력사항\" src=\"../images/icon/icon_b2.gif\" width=\"6\" height=\"6\"></label>";
	license += "<select name=\"wr_license_year[]\" class=\"ipSelect license_required\" required hname=\"취득년도\">";
	license += "<option value=\"\">년</option>";
	for(i=year;i>=1900;--i){
		license += "<option value=\""+i+"\">"+i+"</option>";
	}
	license += "</select> 년 ";
	license += "</td>";
	license += "</tr>";
	license += "</tbody>";
	license += "</table>";
	license += "</li>";
	license += "</ul>";
	license += "</div>";
	license += "</td>";
	license += "</tr>";

	$('#license_block').append(license);

	$('#wr_license_block_'+license_cnt).show();

license_cnt++;
license_limit++;
}
var license_remove = function( cnt ){
license_limit--;
	$('#wr_license_block_'+cnt).remove();
}
var license_search_pop = function( target ){	// 자격증 검색
}
/* //자격증 ======================================================= */

/* 외국어능력 ====================================================== */
var language_cnt = (mode=='update'||mode=='load') ? wr_wr_language_cnt : 0;
var language_limit = 0;
var use_language = function( vals ){
	var sel = vals.checked;
	if(sel==true){
		$('#language_add').show();
		$('#wr_language_block_0').show();
		$('.language_required').attr('required',true);
		language_cnt = 1;
		language_limit = 1;
	} else {
		$('#language_add').hide();
		$('.wr_language_block').hide();
		$('.language_required').removeAttr('required');
		language_cnt = 0;
		language_limit = 0;
	}
}

var language_license_cnt = 0;	 // 공인시험
//var language_license_cnt = (mode=='update' || mode=='load') ? Number($('.language_license_block_'+language_cnt).length) : language_license_cnt;	 // 공인시험

var language_add = function(){	// 외국어 추가

	//alert( language_cnt+"@"+language_license_cnt );

	if(language_limit >= 5){
		alert("외국어는 최대 5개 까지 추가 가능합니다.");
		return false;
	}

	language = "";
	language += "<tr class=\"wr_language_block\" id=\"wr_language_block_"+language_cnt+"\" style=\"display:;\">";
	language += "<td scope=\"row\"  class=\"subline\"> <label><strong>외국어능력</strong></label></td>";	// "+(language_cnt+1)+"
	language += "<td class=\"\">";
	language += "<div class=\"language positionR\">";
	language += "<ul>";
	language += "<em style=\"right:0; top:5px; z-index:100\" class=\"positionA delete\"><a class=\"button white\" onclick=\"language_remove('"+language_cnt+"');\"><span>-삭제</span></a></em>";
	language += "<li class=\"positionR\">";
	language += "<span>";
	language += "<label class=\"pr5\">외국어<img alt=\"필수입력사항\" src=\"../images/icon/icon_b2.gif\" width=\"6\" height=\"6\"></label> ";
	language += "<select title=\"외국어 선택\" name=\"wr_language_name[]\" id=\"wr_language_name_"+language_cnt+"\" style=\"width:130px;\" class=\"ipSelect language_required\" hname=\"외국어\"> ";
	language += "<option value=\"\"> 외국어선택 </option>";
	language += "</select> ";
	language += "</span>";
	language += "<span>";
	language += "<input type=\"radio\" name=\"wr_language_level_"+language_cnt+"\" id=\"wr_language_level_"+language_cnt+"_0\" value=\"0\" checked>";
	language += "<label for=\"wr_language_level_"+language_cnt+"_0\">상(회화능숙)</label> ";
	language += "</span>";
	language += "<span>";
	language += "<input type=\"radio\" name=\"wr_language_level_"+language_cnt+"\" id=\"wr_language_level_"+language_cnt+"_1\" value=\"1\">";
	language += "<label for=\"wr_language_level_"+language_cnt+"_1\">중(일상대화)</label> ";
	language += "</span>";
	language += "<span>";
	language += "<input type=\"radio\" name=\"wr_language_level_"+language_cnt+"\" id=\"wr_language_level_"+language_cnt+"_2\" value=\"2\">";
	language += "<label for=\"wr_language_level_"+language_cnt+"_2\">하(간단대화)</label>";
	language += "</span>";
	language += "</li>";

	// 공인시험
	language += "<div id=\"language_license_block_"+language_cnt+"\">";
		language += "<li class=\"positionR\" id=\"language_license_test_"+language_cnt+"_"+language_license_cnt+"\">";
		language += "<ul>";
		language += "<li class=\"pb5 positionR\">";
		language += "<em style=\"right:0; top:0;\" class=\"positionA delete\"><a class=\"button white\" onclick=\"language_license_add('"+language_cnt+"');\"><span>시험추가</span></a></em>";
		language += "<span>";
		language += "<label>공인시험</label> ";
		language += "<select title=\"시험 선택\" name=\"language_license_"+language_cnt+"[]\" id=\"language_license_"+language_cnt+"_"+language_license_cnt+"\" style=\"width:130px;\" class=\"ipSelect\">";
		language += "<option value=\"\"> 시험선택 </option>";
		language += "</select>";
		language += "</span>";
		language += "<span> ";
		language += "<label class=\"pl10\">점수/등급</label> ";
		language += "<input type=\"text\" style=\"width:80px;\" name=\"language_license_level_"+language_cnt+"[]\" class=\"ipText\" id=\"language_license_level_"+language_cnt+"_"+language_license_cnt+"\">";
		language += "</span>";
		language += "<span> ";
		language += "<label class=\"pl10\">취득년도</label> ";
		language += "<select name=\"language_license_year_"+language_cnt+"[]\" class=\"ipSelect\">";
		language += "<option value=\"\">년</option>";
		for(i=year;i>=1900;--i){
			language += "<option value=\""+i+"\">"+i+"</option>";
		}
		language += "</select> 년";
		language += "</span> ";
		language += "</li>";
		language += "</ul>";
		language += "</li>";
	language += "</div>";
	// 공인시험

	language += "<li class=\"positionR\">";
	language += "<span>";
	language += "<input type=\"checkbox\" name=\"wr_language_study_"+language_cnt+"\" id=\"wr_language_study_"+language_cnt+"\" class=\"chk\" value=\"1\"> ";
	language += "<label class=\"pr5\" for=\"wr_language_study_"+language_cnt+"\">어학연수 경험있음</label> ";
	language += "<select title=\"연수기간 선택\" name=\"wr_language_study_date_"+language_cnt+"\" id=\"wr_language_study_date_"+language_cnt+"\" style=\"width:130px;\" class=\"ipSelect\">";
	language += "<option value=\"\">연수기간 선택</option>";
	language += "</select>";
	language += "</span>";
	language += "</li>";
	language += "</ul>";
	language += "</div>";
	language += "</td>";
	language += "</tr>";


	$('#language_block').append(language);

	/* 외국어 json return */
	var language_name = $("#wr_language_name_"+language_cnt);
	$.post('./views/_load/alba_resume_regist.php', { mode:'language_json' }, function(result){
		var data = eval("(" + result + ")");
		var languages = "";
		if(data.list!=''){
			$.each(data.list, function(key, lists){
				languages += "<option value=\""+lists.code+"\">"+lists.name+"</option>";
			});
		}
		language_name.append(languages);
	});
	/* //외국어 json return */

	/* 공인시험 json return */
	var license_name = $("#language_license_"+language_cnt+"_"+language_license_cnt);
	$.post('./views/_load/alba_resume_regist.php', { mode:'license_json' }, function(result){
		var data = eval("(" + result + ")");
		var licenses = "";
		if(data.list!=''){
			$.each(data.list, function(key, lists){
				licenses += "<option value=\""+lists.code+"\">"+lists.name+"</option>";
			});
		}
		license_name.append(licenses);
	});
	/* //공인시험 json return */

	/* 연수기간 json return */
	var study_name = $("#wr_language_study_date_"+language_cnt);
	$.post('./views/_load/alba_resume_regist.php', { mode:'study_json' }, function(result){
		var data = eval("(" + result + ")");
		var stydies = "";
		if(data.list!=''){
			$.each(data.list, function(key, lists){				
				stydies += "<option value=\""+key+"\">"+lists+"</option>";
			});
		}
		study_name.append(stydies);
	});
	/* //연수기간 json return */

language_cnt++;
language_limit++;
}
var language_remove = function( language_cnts ){
	$('#wr_language_block_'+language_cnts).remove();
language_limit--;
}

var language_license_add = function( language_cnt ){	// 시험추가
	
	if(mode=='update' || mode=='load'){
		language_license_cnt = Number($('.language_license_block_'+language_cnt).length);
	}
	
	language_license_cnt++;	// 공인시험 카운트 증가

	

	language_license = "<li class=\"positionR\" id=\"language_license_test_"+language_cnt+"_"+language_license_cnt+"\">";
	language_license += "<ul>";
	language_license += "<li class=\"pb5 positionR\">";
	language_license += "<em style=\"right:0; top:0;\" class=\"positionA delete\"><a class=\"button white\" onclick=\"language_license_remove('"+language_cnt+"','"+language_license_cnt+"');\"><span>시험삭제</span></a></em>";
	language_license += "<span>";
	language_license += "<label>공인시험</label> ";
	language_license += "<select title=\"시험 선택\" name=\"language_license_"+language_cnt+"[]\" id=\"language_license_"+language_cnt+"_"+language_license_cnt+"\" style=\"width:130px;\" class=\"ipSelect\">";
	language_license += "<option value=\"\"> 시험선택 </option>";
	language_license += "</select>";
	language_license += "</span>";
	language_license += "<span> ";
	language_license += "<label class=\"pl10\">점수/등급</label> ";
	language_license += "<input type=\"text\" style=\"width:80px;\" name=\"language_license_level_"+language_cnt+"[]\" class=\"ipText\" id=\"language_license_level_"+language_cnt+"_"+language_license_cnt+"\">";
	language_license += "</span>";
	language_license += "<span> ";
	language_license += "<label class=\"pl10\">취득년도</label> ";
	language_license += "<select name=\"language_license_year_"+language_cnt+"[]\" class=\"ipSelect\">";
	language_license += "<option value=\"\">년</option>";
	for(i=year;i>=1900;--i){
		language_license += "<option value=\""+i+"\">"+i+"</option>";
	}
	language_license += "</select> 년";
	language_license += "</span> ";
	language_license += "</li>";
	language_license += "</ul>";
	language_license += "</li>";

	$('#language_license_block_'+language_cnt).append(language_license);

	/* 공인시험 json return */
	var license_name = $("#language_license_"+language_cnt+"_"+language_license_cnt);
	$.post('./views/_load/alba_resume_regist.php', { mode:'license_json' }, function(result){
		var data = eval("(" + result + ")");
		var licenses = "";
		if(data.list!=''){
			$.each(data.list, function(key, lists){
				licenses += "<option value=\""+lists.code+"\">"+lists.name+"</option>";
			});
		}
		license_name.append(licenses);
	});
	/* //공인시험 json return */

}
var language_license_remove = function( language_cnts, language_license_cnts ){	// 시험 삭제
	$('#language_license_test_'+language_cnts+'_'+language_license_cnts).remove();
language_license_cnt--;	// 공인시험 카운트 감소
}
/* //외국어능력 ====================================================== */


var wr_specialty_etc_view = function( vals ){	// 특기사항 기타
	var sel = vals.checked;
	if(sel==true){
		$('#wr_specialty_view').show();
	} else {
		$('#wr_specialty_view').hide();
	}
}
var impediment_use = function( vals ){	// 장애여부
	var sel = vals.value;
	if(sel=='1'){
		$('#impediment_block').show();
	} else {
		$('#impediment_block').hide();
	}
}
var military_use = function( vals ){	// 병역여부
	var sel = vals.value;
	if(sel=='0' || sel=='2'){
		$('#wr_military_type').val('');
		$('#military_block').hide();
	} else {
		$('#military_block').show();
	}
}

var profile_photo_pop = function(){	 // 프로필 사진 등록창 띄우기
	$('#profilePhotoPop').show();
}
var profile_photo_remove = function(){	// 기존 프로필 사진 삭제
	var mb_photos = $('#personphoto').attr('src').split('/');
	var mb_photo = mb_photos[4];
	if(confirm('프로필 사진을 삭제하시겠습니까?\n\n한번 삭제된 데이터는 복구가 불가능합니다.')){
		$.post('../member/process/regist.php', { mode:'profile_photo_remove', mb_id:mb_id }, function(result){
			$('#personphoto').attr('src',result);
			$('#personphoto_status').html('등록');
			$('#photo_remove').hide();
		});
	}
}
var photo_submit = function(){
	var photo_file = $('#photo_file').val();
	if(!photo_file || photo_file==''){
		alert("프로필 사진을 첨부해 주세요.");
		return;
	}
	var photo_options = { beforeSubmit : photoRequest, success : photoResponse }
	$('#MemberUpdateFrm').ajaxSubmit(photo_options);
}
var photoRequest = function(formData, jqForm, photo_options){	 // 프로필 사진 전송 전
	//var queryString = $.param(formData);
	return true;
}
var photoResponse = function(responseText, statusText, xhr, $form){	// 프로필 사진 전송 후
	$('#personphoto').attr('src',responseText);
	$('#profilePhotoPop').hide();
	$('#photo_remove').show();
}

var mb_views = function( field, vals ){	 // 정보 공개 유무 체크
	var sel = vals.value;
	var fields = 'mb_' + field + '_view';

	$.post('../member/process/regist.php', { mode:'member_views', mb_id:mb_id, field:fields, sel:sel, value:field }, function(result){
		alert(result);
	});

}
var update_photos = function( mode, no ){	// 포토앨범 등록/삭제
	if(mode=='update'){	// 등록
		$('#individualPhotoPop').show();
		$('#mb_photos').val(no);
		$('#individualPhotoPop').draggable({
			handle: 'individualPhotoPop_handle'
		});
		$('.closeBtn').click(function(){
			$('#individualPhotoPop').hide();
		});
	} else if(mode=='delete'){	// 삭제
		if(confirm('포토앨범 사진을 삭제하시겠습니까?\n\n한번 삭제된 데이터는 복구가 불가능합니다.')){
			$.post('../member/process/regist.php', { mode:'photo_deletes', mb_id:mb_id, photo_no:no }, function(result){
				//$('#photo_'+no).html("<img src=\""+result+"\" width=\"155\" height=\"100\" alt=\"photo\">");
				$('#mb_photo_'+no).attr('src',result);
			});
		}
	}

}
var photos_submit = function(){	// 회사이미지 등록하기 버튼 클릭시
	var photo_files = $('#photo_files').val();
	if(!photo_files || photo_files==''){
		alert("등록할 사진을 첨부해 주세요.");
		return;
	}
	var photos_options = { beforeSubmit : photosRequest, success : photosResponse }
	$('#AlbaResumeFrm').attr('action','../member/process/regist.php');	// action 변경
	$('#AlbaResumeFrm #mode').val('photo_uploads');	// mode 변경
	$('#AlbaResumeFrm').ajaxSubmit(photos_options);
}

var photosRequest = function(formData, jqForm, photos_options){	 // 포토앨범 전송 전
	return true;
}
var photosResponse = function(responseText, statusText, xhr, $form){	// 포토앨범 전송 후
	$('#AlbaResumeFrm').attr('action','../individual/process/alba_resume.php');	// action 변경
	$('#AlbaResumeFrm #mode').val('insert');	// mode 변경
	var mb_photos = $('#mb_photos').val();
	$('#mb_photo_'+mb_photos).attr('src',responseText);
	$('#individualPhotoPop').hide();
}

var tabs = function( tab ){	// 채용공고 탭 출력 변경
	$('.tab1, .tab2').removeClass('on');
	$('.'+tab).addClass('on');
	$('.tabs').hide();
	$('#'+tab).show();
}
