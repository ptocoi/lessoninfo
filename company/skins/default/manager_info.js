$(function(){

});


var manager_insert = function(){

	$('#managerInput').load('./views/_load/company_manager.php', { mode:'manager_insert' }, function(result){
		$('#managerInput').toggle();
		scrollLink('managerTitle');
	});

}

var email_sel = function( vals ){	// 이메일 서비스 선택
	var sel = vals.value;
	$('#wr_email_tail').val(sel);
}

var manager_update = function( no ){	 // 담당자 수정

	$('#managerInput').load('./views/_load/company_manager.php', { mode:'manager_update', no:no }, function(result){
		$('#managerInput').show();
		scrollLink('managerTitle');
	});

}
var manager_delete = function( no ){	// 담당자 삭제 (단수)

	if(confirm('삭제하시겠습니까?')){
		$.post('./process/manager.php', { mode:'manager_delete', no:no }, function(result){
			if(result){
				location.reload();
			} else {
				alert("삭제중 오류가 발생하였습니다.\n\n사이트 담당자에게 문의하세요.");
			}
		});
	}

}
var manager_sel_delete = function(){	// 담당자 선택 삭제

	var chk_length = $("input[name='no[]']:checked").length;
	if(chk_length==0){

		alert('삭제 할 담당자 정보를 선택해 주세요.');
		return false;

	} else {

		var del_no = new Array();
		var i = 0;
		$("input[name='no[]']:checked").each(function(){
			del_no[i] = $(this).val();
		i++;
		});

		if(confirm('선택하신 담당자 정보를 삭제하시겠습니까?')){

			$.post('./process/manager.php', { mode:'manager_sel_delete', no:del_no }, function(result){
				if(result){
					location.reload();
				} else {
					alert("삭제중 오류가 발생하였습니다.");
				}
			});

		}

	}

}

var ManagerFrmSubmit = function(){ // 폼 전송
	var manager_options = { target : '', beforeSubmit : managerRequest, success : managerResponse }
	$('#managerFrm').ajaxSubmit(manager_options);
	//$('#managerFrm').submit();
}

var ManagerFrmCancel = function(){	// 취소
	$('#managerFrm').resetForm();
	$('#managerInput').hide();
}

var managerRequest = function(formData, jqForm, manager_options){	 // 전송 전
	var managerFrm = document.getElementById('managerFrm');
	var queryString = $.param(formData);
	return validate(managerFrm);
}
var managerResponse = function(responseText, statusText, xhr, $form){	// 전송 후
	if(responseText){
		location.reload();
	} else {
		alert("담당자 데이터 오류가 발생하였습니다.\n\n사이트 담당자에게 문의하세요.");
	}
}
