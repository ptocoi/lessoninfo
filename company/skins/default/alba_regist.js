$(function(){
	$('#LogoPop').draggable({	 // 학교 검색창 드래그
		handle: '#LogoPop_handle'
	});
	$(":input[placeholder]").placeholder();
	$('#wr_volume_date').datepicker({dateFormat: 'yy-mm-dd'});
	$('#volume_date_sel').click(function(){
		$('#wr_volume_date').datepicker('show');
	});

	$('#wr_area_03, #wr_area_13, #wr_area_23').focus(function(){
		var vals = $(this).val();
		if(vals=='번지수 입력') $(this).val('');
	}).focusout(function(){
		var vals = $(this).val();
		if(vals=='번지수 입력' || vals=='') $(this).val('번지수 입력');
	});

	$('#wr_subway_content_0, #wr_subway_content_1, #wr_subway_content_2').focus(function(){
		var vals = $(this).val();
		if(vals=='출구, 소요시간을 입력해주세요.') $(this).val('');
	}).focusout(function(){
		var vals = $(this).val();
		if(vals=='출구, 소요시간을 입력해주세요.' || vals=='') $(this).val('출구, 소요시간을 입력해주세요.');
	});

	$('#wr_volume_date').focus(function(){	// 날짜입력 필드 선택시
		$("input[name='volume_check']:eq(0)").attr('checked',true);
		$(this).attr('required',true);
	});

	$('#wr_area').keydown(function(event){	// 주소검색 엔터키 이벤트
		if(event.keyCode==13){	
			execDaumPostcode();
			return false;
		}
	});

});
var logo_pop = function(){	// 로고 등록창 띄우기
	$('#LogoPop').show();
}
var logo_close = function(){	// 로고 등록창 닫기
	$('#upload_mode').val('photo_upload');	// 이미지 업로드 모드로 변경
	$('#LogoPop').hide();
}
var logo_submit = function(){	// 로고 등록
	$('#upload_mode').val('logo_upload');	// 로고 등록 모드로 변경
	var mb_logo = $('#mb_logo').val();
	if(!mb_logo || mb_logo==''){
		alert("등록할 로고를 첨부해 주세요.");
		return;
	}
	var logo_options = { beforeSubmit : logoRequest, success : logoResponse }
	$('#MemberUpdateFrm').ajaxSubmit(logo_options);
}
var logoRequest = function(formData, jqForm, photos_options){	 // 로고 전송 전
	return true;
}
var logoResponse = function(responseText, statusText, xhr, $form){	// 로고 전송 후
	$('#companylogo').attr('src',responseText);
	$('#logo_remove').show();
	logo_close();
}
var logo_remove = function( company_no ){	// 로고 삭제
	var mb_logos = $('#companylogo').attr('src').split('/');
	var mb_logo = mb_logos[4];
	if(confirm('회사 로고를 삭제하시겠습니까?\n\n한번 삭제된 데이터는 복구가 불가능합니다.')){
		$.post('../member/process/regist.php', { mode:'logo_delete', mb_id:mb_id, company_no:company_no }, function(result){
			$('#upload_mode').val('photo_upload');	// 이미지 업로드 모드로 변경
			$('#companylogo').attr('src',result);
			$('#companyphoto_status').html('등록');
			$('#logo_remove').hide();
		});
	}
}
var past_load = function( vals ){	 // 과거 공고 불러오기
	var sel = vals.value;
	location.href = "./alba_regist.php?mode=load&no="+sel;
}
var update_company_photos = function( mode, no, company_no ){	// 회사이미지 등록/삭제
	if(mode=='update'){	// 등록
		$('#companyPhotoPop').show();
		$('#mb_photos').val(no);
		$('#companyPhotoPop').draggable({
			handle: '#companyPhotoPop_handle'
		});
	} else if(mode=='delete') {
		if(confirm('회사이미지를 삭제하시겠습니까?\n\n한번 삭제된 데이터는 복구가 불가능합니다.')){
			$.post('../member/process/regist.php', { mode:'photo_delete', mb_id:mb_id, photo_no:no, company_no:company_no }, function(result){
				$('#mb_photo_'+no).attr('src',result);
				close_company_photos();
			});
		}
	}
}
var close_company_photos = function(){	// 회사이미지 등록폼 닫기
	$('#companyPhotoPop').hide();
	$('#upload_mode').val('photo_upload');	// 이미지 업로드 모드로 변경
}
var photo_submit = function(){	// 회사이미지 등록하기 버튼 클릭시
	var photo_files = $('#photo_files').val();
	if(!photo_files || photo_files==''){
		alert("등록할 사진을 첨부해 주세요.");
		return;
	}
	var photo_options = { beforeSubmit : photoRequest, success : photoResponse }
	$('#upload_mode').val('photo_upload');
	$('#MemberUpdateFrm').ajaxSubmit(photo_options);
}
var photoRequest = function(formData, jqForm, photo_options){	 // 회사이미지 전송 전
	var queryString = $.param(formData); 
	return true;
}
var photoResponse = function(responseText, statusText, xhr, $form){	// 회사이미지 전송 후
	var mb_photos = $('#mb_photos').val();
	$('#mb_photo_'+mb_photos).attr('src',responseText);
	close_company_photos();
}
var email_sel = function( vals ){	// 이메일 서비스 선택
	var sel = vals.value;
	$('#wr_email_tail').val(sel);
}
var job_type_sel_first = function( vals, target ){	// 첫번째 직종값 선택
	var sel = vals.value;	
	$('#'+target+'_display').load('./views/_load/alba_regist.php', { mode:'second_job_type', type:'job_type', p_code:sel, target:target }, function(result){
		//alert(result);
	});
}
var area_sel_first = function( vals, target ){	// 첫번째 지역값 선택
	var sel = vals.value;
	$('#'+target+'_display').load('./views/_load/alba_regist.php', { mode:'second_area', type:'area', p_code:sel, target:target }, function(result){
		//alert(result);
	});
}

var remove_jobtype_no = [];
var add_jobtype_cnt = 0;
var add_jobtype = function(){	// 직종 추가
add_jobtype_cnt++;
	if(add_jobtype_cnt > 2){
		alert("직종은 최대 3가지 까지 등록 가능합니다.");
		return ;
	}
	var a = $.inArray(add_jobtype_cnt,remove_jobtype_no);
	if(a){
		$('#wr_jobtype_block_'+remove_jobtype_no).show();
	} else {
		$('#wr_jobtype_block_'+add_jobtype_cnt).show();
	}
	$('#wr_jobtype_block_'+add_jobtype_cnt).show();
}
var remove_jobtype = function( jobtype_id ){	// 직종 제거 (select 필드 초기화)
add_jobtype_cnt--;
	$('#wr_jobtype_block_'+jobtype_id).hide();	
	remove_jobtype_no.push(jobtype_id);
	$('#wr_jobtype_'+jobtype_id+'0 :eq(0)').attr('selected',true);
	$('#wr_jobtype_'+jobtype_id+'1').html("<option value=\"\">= 2차 직종선택 =</option>");
	$('#wr_jobtype_'+jobtype_id+'2').html("<option value=\"\">= 3차 직종선택 =</option>");
	//$('#wr_jobtype_'+jobtype_id+'3').val('');
	//$('#wr_jobtype_'+jobtype_id+'_point').val('');
}

var remove_area_no = [];
var add_area_cnt = 0;
var add_area = function(){	// 근무지 추가
add_area_cnt++;
	if(add_area_cnt > 2){
		alert("근무지는 최대 3군데 까지 등록 가능합니다.");
		return ;
	}
	var a = $.inArray(add_area_cnt,remove_area_no);
	if(a){
		$('#wr_area_block_'+remove_area_no).show();
	} else {
		$('#wr_area_block_'+add_area_cnt).show();
	}
	$('#wr_area_block_'+add_area_cnt).show();
}
var remove_area = function( area_id ){	// 근무지 제거 (select 필드 초기화)
add_area_cnt--;
	$('#wr_area_block_'+area_id).hide();	
	remove_area_no.push(area_id);
	$('#wr_area_'+area_id+'0 :eq(0)').attr('selected',true);
	$('#wr_area_'+area_id+'1').html("<option value=\"\">시군구</option>");
	$('#wr_area_'+area_id+'2').html("<option value=\"\">읍면동</option>");
	$('#wr_area_'+area_id+'3').val('');
	$('#wr_area_'+area_id+'_point').val('');
}
// $('#search_field :eq(0)').attr('selected',true);


var google_addrSearch = function( search_addr ){	// 구글 지도 api 주소 검색 결과

	$.post('./views/_ajax/area_search.php', { mode:'google_map_search', search_addr:search_addr }, function(result){
		point = result.split('/');
		var point_x = point[0];
		var point_y = point[1];
		map_api.map_point = [point_x,point_y,'18'];
		map_api.map_use("mapContainer", "", true);
		map_api.click_event('','',point_x,point_y,target+'_point');
		map_api.addMark();
		$('#'+target+'_point').val(point_x+","+point_y);	// 좌표값 할당
	});

}
/* //지도 검색 ========================================================================================== */

var subway_sel_area = function( vals, target ){	// 지하철 지역값 선택
	var sel = vals.value;
	$.post('./views/_load/alba_regist.php', { mode:'subway_line', type:'subway', p_code:sel}, function(result){
		$('#'+target).html(result);
	});
}
var subway_sel_line = function( vals, target ){	// 지하철 호선 선택
	var sel = vals.value;
	$.post('./views/_load/alba_regist.php', { mode:'subway_station', type:'subway', p_code:sel}, function(result){
		$('#'+target).html(result);
	});
}

var remove_subway_no = [];
var add_subway_cnt = 0;
var add_subway = function(){	// 지하철역 추가
add_subway_cnt++;
	if(add_subway_cnt > 2){
		alert("지하철역은 최대 3군데 까지 등록 가능합니다.");
		return ;
	}
	var a = $.inArray(add_subway_cnt,remove_subway_no);
	if(a){
		$('#wr_subway_block_'+remove_subway_no).show();
	} else {
		$('#wr_subway_block_'+add_subway_cnt).show();
	}
	$('#wr_subway_block_'+add_subway_cnt).show();
}
var remove_subway = function( subway_id ){	//  지하철역 제거 (select 필드 초기화)
add_subway_cnt--;
	$('#wr_subway_block_'+subway_id).hide();	
	remove_subway_no.push(subway_id);
	$('#wr_subway_area_'+subway_id+' :eq(0)').attr('selected',true);
	$('#wr_subway_line_'+subway_id).html("<option value=\"\">호선</option>");
	$('#wr_subway_station_'+subway_id).html("<option value=\"\">지하철역</option>");
	$('#wr_subway_content_'+subway_id).val('');
}
// $('#search_field :eq(0)').attr('selected',true);
var college_area = function( vals, target ){	 // 인근대학 지역 선택
	var sel = vals.value;
	$.post('./views/_load/alba_regist.php', { mode:'college_vicinity', type:'job_college', p_code:sel}, function(result){
		$('#'+target).html(result);
	});
}
var update_alba_photos = function( mode, no ){	// 근무회사 이미지 등록/삭제
	if(mode=='update'){	// 등록
		$('#albaPhotoPop').show();
		$('#alba_photos').val(no);
		$('#albaPhotoPop').draggable({
			handle: '#albaPhotoPop_handle'
		});
	} else if(mode=='delete') {
		if(confirm('근무회사 이미지를 삭제하시겠습니까?\n\n한번 삭제된 데이터는 복구가 불가능합니다.')){
			$.post('./process/alba.php', { mode:'alba_photo_delete', mb_id:mb_id, photo_no:no }, function(result){
				$('#alba_photo_'+no).attr('src',result);
				close_alba_photos();
			});
		}
	}
}
var alba_photo_submit = function(){	// 근무회사  이미지 등록하기 버튼 클릭시
	var alba_photo_files = $('#alba_photo_files').val();
	if(!alba_photo_files || alba_photo_files==''){
		alert("등록할 사진을 첨부해 주세요.");
		return;
	}
	var alba_photo_options = { beforeSubmit : alba_photoRequest, success : alba_photoResponse }
	$('#mode').val('alba_photo_upload');
	$('#AlbaFrm').ajaxSubmit(alba_photo_options);
	//$('#AlbaFrm').submit();

}
var close_alba_photos = function(){	// 근무회사 이미지 등록폼 닫기
	$('#albaPhotoPop').hide();
	$('#mode').val(mode);	// 이미지 업로드 모드로 변경
}
var alba_photoRequest = function(formData, jqForm, photo_options){	 // 근무회사 이미지 전송 전
	var queryString = $.param(formData); 
	return true;
}
var alba_photoResponse = function(responseText, statusText, xhr, $form){	// 근무회사 이미지 전송 후	
	var responseText = responseText.replace(' ','');

	if(responseText=='extension_error'){
		alert("GIF, JPEG, JPG 이미지만 업로드 가능합니다.\n\n업로드 이미지 확장자를 확인해 주세요.");
		return false;
	} else {
		var alba_photos = $('#alba_photos').val();
		$('#wr_photo_'+alba_photos).val(responseText);
		$('#alba_photo_'+alba_photos).attr('src',"../data/alba/"+responseText);
		close_alba_photos();
	}
}
var use_photo = function( vals ){	// 회사이미지 사용 유무
	var sel = vals.value;
	var checked = vals.checked;

	if(checked==true){
		var mb_photo_0 = $('#mb_photo_0').attr('src');
		var mb_photo_1 = $('#mb_photo_1').attr('src');
		var mb_photo_2 = $('#mb_photo_2').attr('src');
		var mb_photo_3 = $('#mb_photo_3').attr('src');
		var mb_photo_4 = $('#mb_photo_4').attr('src');
		$('.photo_button').hide();
	} else {
		var mb_photo_0 = ($('#wr_photo_0').val()!='') ? "../data/alba/" + $('#wr_photo_0').val() : "../images/comn/no_profileimg.gif";
		var mb_photo_1 = ($('#wr_photo_1').val()!='') ? "../data/alba/" + $('#wr_photo_1').val() : "../images/comn/no_profileimg.gif";
		var mb_photo_2 = ($('#wr_photo_2').val()!='') ? "../data/alba/" + $('#wr_photo_2').val() : "../images/comn/no_profileimg.gif";
		var mb_photo_3 = ($('#wr_photo_3').val()!='') ? "../data/alba/" + $('#wr_photo_3').val() : "../images/comn/no_profileimg.gif";
		var mb_photo_4 = ($('#wr_photo_4').val()!='') ? "../data/alba/" + $('#wr_photo_4').val() : "../images/comn/no_profileimg.gif";
		$('.photo_button').show();
	}

	$('#alba_photo_0').attr('src',mb_photo_0);
	$('#alba_photo_1').attr('src',mb_photo_1);
	$('#alba_photo_2').attr('src',mb_photo_2);
	$('#alba_photo_3').attr('src',mb_photo_3);
	$('#alba_photo_4').attr('src',mb_photo_4);

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
var welfare_open = function(){	// 복리후생 열기
	$('#welfareLayer').show();
}
var welfare_sel = function( vals ){	// 복리후생 선택
	var sel = vals.value;
	var welfare_txt = [];

	$('.welfare_check').each(function(){
		var welfare_check = $(this).is(':checked');
		var welfare_val = $(this).val();
		if(welfare_check==true){
			var label_txt = $('#label_welfare_'+welfare_val).text();
			welfare_txt.push(label_txt);
		}
	});

	$('#welfare_read').val(welfare_txt);

}
var welfare_close = function(){	// 복리후생 닫기
	$('#welfareLayer').hide();
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
var volume_sel = function( vals ){	// 모집인원 체크
	var sel = vals.value;
	var wr_volumes = $("input[name='wr_volumes[]']");
	var check_length = $("input[name='wr_volumes[]']:checked").length;

	if(check_length>=1){
		$('#wr_volume').attr('required',false);
		$('#wr_volume').attr('disabled',true);
	} else {
		$('#wr_volume').attr('required',true);
		$('#wr_volume').attr('disabled',false);
	}

}
var requisition_sel = function( vals ){	// 접수방법 체크
	var sel = vals.value;
	var check_length = $('.requisition_chk:checked').length;

	if(sel=='email'){	// 온라인/이메일 지원 sel=='online' || 
		if(check_length>=1){
			$('#form_input').show();
		} else {
			$('#form_input').hide();
		}
	} else if(sel=='homepage'){	// 홈페이지 지원
		var homepage_check = $('#wr_requisition_homepage').is(':checked');
		if(homepage_check==true)
			$('#homepage_input').show();
		else
			$('#homepage_input').hide();
	}

}
var attach_view = function( vals ){	// 자사양식지원 체크시
	var checked = vals.checked;

	if(checked == true){
		$('#wr_form_attach').show();
	} else {
		$('#wr_form_attach').val("");
		$('#wr_form_attach').hide();
	}

}
var wr_volume_checks = function( vals ){	// 상시/채용시 까지 체크
	var sel = vals.value;
	$('#wr_volume_date').removeAttr('required');
}
/*
var volume_date = function( vals ){	 // 상시/채용시 까지 체크
	var sel = vals.value;
	var checked = vals.checked;
	var check_length = $('.volume_check:checked').length;

	if(check_length>=1){
		$('#wr_volume_date').attr('required',false);
		$('#wr_volume_date').val('');
		$('#wr_volume_date').attr('disabled',true);
	} else {
		$('#wr_volume_date').attr('required',true);
		$('#wr_volume_date').attr('disabled',false);
		$('#wr_volume_date').removeAttr('disabled');
	}

}
*/
var alba_submit = function(){	// 알바 등록폼 전송

	if (document.getElementById('tx_wr_content')) {
		if (!ed_wr_content.outputBodyHTML()) { 
			alert('상세모집요강을 입력해 주세요.'); 
			ed_wr_content.returnFalse();
			return;
		}
    }

	$('#AlbaFrm').submit();
}

var manager_sels = function( vals ){	// 담당자 선택
	var sel = vals.value;

	$.post('./views/_load/alba_regist.php', { mode:'manager_info', no:sel }, function(result){
		var results = result.split("/");
		var is_manager = results[0];
		var data = eval("(" + results[1] + ")");

		if(is_manager){

			$('#wr_person').val(data.wr_name);
			var wr_phone = data.wr_phone.split('-');
			if(wr_phone[0]) $('#wr_phone0 > option[value='+wr_phone[0]+']').attr('selected',true);
			if(wr_phone[1]) $('#wr_phone1').val(wr_phone[1]);
			if(wr_phone[2]) $('#wr_phone2').val(wr_phone[2]);
			
			var wr_hphone = data.wr_hphone.split('-');
			if(wr_hphone[0]) $('#wr_hphone0 > option[value='+wr_hphone[0]+']').attr('selected',true);
			if(wr_hphone[1]) $('#wr_hphone1').val(wr_hphone[1]);
			if(wr_hphone[2]) $('#wr_hphone2').val(wr_hphone[2]);

			var wr_fax = data.wr_fax.split('-');
			if(wr_fax[0]) $('#wr_fax0 > option[value='+wr_fax[0]+']').attr('selected',true);
			if(wr_fax[1]) $('#wr_fax1').val(wr_fax[1]);
			if(wr_fax[2]) $('#wr_fax2').val(wr_fax[2]);

			var wr_email = data.wr_email.split('@');
			if(wr_email[0]) $('#wr_email').val(wr_email[0]);
			if(wr_email[1]) $('#wr_email_tail').val(wr_email[1]);

		} else {

			$('#wr_person').val("");
			$('#wr_phone0 :eq(0)').attr('selected',true);
			$('#wr_phone1').val("");
			$('#wr_phone2').val("");
			$('#wr_hphone0 :eq(0)').attr('selected',true);
			$('#wr_hphone1').val("");
			$('#wr_hphone2').val("");
			$('#wr_fax0 :eq(0)').attr('selected',true);
			$('#wr_fax1').val("");
			$('#wr_fax2').val("");
			$('#wr_email').val("");
			$('#wr_email_tail').val("");

		}

	});
}

// 기업정보 추출
var company_info_load = function( vals ){
	var sel = vals.value;
	if(sel){
		$.post('./views/_load/company.php', { mode:'get_company_info', no:sel }, function(result){
			var data = eval("(" + result + ")");
			//alert(data.photo_0+"\n\n"+data.photo_1+"\n\n"+data.photo_2+"\n\n"+data.photo_3);
			$('#company_name').html(data.company_name);
			$('#wr_company_name').val(data.company_name);
			$('#ceo_name').html(data.ceo_name);
			$('#biz_no').html(data.biz_no);
			$('#biz_address').html("["+data.biz_zipcode+"] "+data.mb_biz_address0+" "+data.mb_biz_address1);
			$('#companylogo').attr('src',data.mb_logo);

			if(data.is_logo){
				$('#companyphoto_status').html("수정<img width=\"3\" height=\"5\" style=\"vertical-align:middle;\" alt=\"arrow\" src=\"../images/icon/icon_arrow_3.gif\" class=\"pl5\">");
				$('#logo_remove').show();
			}

			if(data.mb_homepage){
				$('#mb_homepage_display').show();
				$('#mb_homepage').attr('src',data.mb_homepage);
			}

			$('#mb_photo_0').attr('src',data.photo_0);
			$('#mb_photo_1').attr('src',data.photo_1);
			$('#mb_photo_2').attr('src',data.photo_2);
			$('#mb_photo_3').attr('src',data.photo_3);
			$('#mb_photo_4').attr('src',data.photo_4);

			$('#company_info').val(sel);
			$('#company_logo_info').val(sel);
			$('#company_no').val(sel);
		});
	} else {
		$('#company_name').html(mb_company_name);
		$('#wr_company_name').val(mb_company_name);
		$('#ceo_name').html(mb_ceo_name);
		$('#biz_no').html(mb_biz_no);
		$('#biz_address').html(mb_biz_address);
		$('#companylogo').attr('src',mb_logo);

		$('#companyphoto_status').html("수정<img width=\"3\" height=\"5\" style=\"vertical-align:middle;\" alt=\"arrow\" src=\"../images/icon/icon_arrow_3.gif\" class=\"pl5\">");
		$('#logo_remove').show();

		$('#mb_photo_0').attr('src',mb_photo_0);
		$('#mb_photo_1').attr('src',mb_photo_1);
		$('#mb_photo_2').attr('src',mb_photo_2);
		$('#mb_photo_3').attr('src',mb_photo_3);
		$('#mb_photo_4').attr('src',mb_photo_4);

		$('#company_info').val('');
		$('#company_logo_info').val('');
		$('#company_no').val(0);
	}
}

var pay_types = function( vals, types ){
	var sel = vals.value;
	if(types=='type'){	// select 선택
		$('#wr_pay').removeAttr('disabled');
		$("input[name='wr_pay_conference']").removeAttr('checked');
		$('#wr_pay_type, #wr_pay').attr('required',true);
	} else {	 // radio 선택
		$('#wr_pay_type :eq(0)').attr('selected',true);
		$('#wr_pay').attr('disabled',true);
		$('#wr_pay').val('');
		$('#wr_pay_type, #wr_pay').removeAttr('required');
	}
}