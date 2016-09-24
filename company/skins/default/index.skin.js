$(function(){


});

var tabs = function( tab ){	// 채용공고 탭 출력 변경
	$('.tab1, .tab2').removeClass('on');
	$('.'+tab).addClass('on');
	$('.tabs').hide();
	$('#'+tab).show();
}

var logo_pop = function(){	// 로고 등록창 띄우기
	$('#LogoPop').show();
}
var logo_close = function(){	// 로고 등록창 닫기
//	$('#upload_mode').val('photo_upload');	// 이미지 업로드 모드로 변경
	$('#LogoPop').hide();
}
var logo_submit = function(){	// 로고 등록
//	$('#upload_mode').val('logo_upload');	// 로고 등록 모드로 변경
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
var logo_remove = function( no ){	// 로고 삭제
	var mb_logos = $('#companylogo').attr('src').split('/');
	var mb_logo = mb_logos[4];
	if(confirm('회사 로고를 삭제하시겠습니까?\n\n한번 삭제된 데이터는 복구가 불가능합니다.')){
		$.post('../member/process/regist.php', { mode:'logo_delete', mb_id:mb_id, company_no:no }, function(result){
			$('#upload_mode').val('photo_upload');	// 이미지 업로드 모드로 변경
			$('#companylogo').attr('src',result);
			$('#companyphoto_status').html('등록');
			$('#logo_remove').hide();
		});
	}
}