$(function(){

});

var list_rows = function( vals ){	// 출력건수
	var sel = vals.value;
	location.href = "./alba_resume_denied.php?type="+type+"&page_rows=" + sel;
}

var DeniedSearchFrmSubmit = function(){

	$('#DeniedSearchFrm').submit();

}

var sel_denied = function(){	// 열람제한 설정
	var chk_length = $("input[name='no[]']:checked").length;
	if(chk_length==0){
		alert('열람제한 할 회사정보를 선택해 주세요.');
		return false;
	} else {
		var sel_no = new Array();
		var i = 0;
		$("input[name='no[]']:checked").each(function(){
			sel_no[i] = $(this).val();
		i++;
		});
		if(confirm('선택하신 회사정보 '+chk_length+'건을 열람제한 하시겠습니까?')){
			$.post('./process/open.php', { mode:'sel_denied', no:sel_no, wr_id:mb_id }, function(result){
				if(result){
					location.reload();
				} else {
					alert("열람제한 중 오류가 발생하였습니다.\n\n사이트 관리자에게 문의하세요.");
				}
			});
		}
	}

}

var sel_access = function(){	// 열람제한 해제 설정
	var chk_length = $("input[name='no[]']:checked").length;
	if(chk_length==0){
		alert('열람제한 해제 할 회사정보를 선택해 주세요.');
		return false;
	} else {
		var sel_no = new Array();
		var i = 0;
		$("input[name='no[]']:checked").each(function(){
			sel_no[i] = $(this).val();
		i++;
		});
		if(confirm('선택하신 회사정보 '+chk_length+'건을 열람제한 해제 하시겠습니까?')){
			$.post('./process/open.php', { mode:'sel_access', no:sel_no, wr_id:mb_id }, function(result){
				if(result){
					location.reload();
				} else {
					alert("열람제한 해제 중 오류가 발생하였습니다.\n\n사이트 관리자에게 문의하세요.");
				}
			});
		}
	}

}
var is_left = function(){
	alert("탈퇴한 기업 회원 입니다.");
}