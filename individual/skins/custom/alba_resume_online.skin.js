$(function(){

});

var searchFrmSubmit = function(){
	
	$('#OnlinesSearchFrm').submit();

}

var list_rows = function( vals ){	// 출력건수
	var sel = vals.value;
	location.href = "./alba_resume_onlines.php?type=" + type + "&page_rows=" + sel;
}

var sel_become_cancel = function(){	// 지원 취소
	var chk_length = $("input[name='no[]']:checked").length;
	if(chk_length==0){
		alert('취소 할 입사지원 정보를 선택해 주세요.');
		return false;
	} else {
		var cancel_no = new Array();
		var i = 0;
		$("input[name='no[]']:checked").each(function(){
			cancel_no[i] = $(this).val();
		i++;
		});

		if(confirm('선택하신 입사지원 정보 '+chk_length+'건을 [지원취소] 하시겠습니까?')){
			$.post('./process/open.php', { mode:'sel_become_cancel', no:cancel_no, mb_id:mb_id }, function(result){
				if(result){
					location.reload();
				} else {
					alert("입사지원 취소중 오류가 발생하였습니다.\n\n사이트 관리자에게 문의하세요.");
				}
			});
		}
	}
}

var sel_become_delete = function(){	// 지원 정보 삭제
	var chk_length = $("input[name='no[]']:checked").length;
	if(chk_length==0){
		alert('삭제 할 입사지원 정보를 선택해 주세요.');
		return false;
	} else {
		var del_no = new Array();
		var i = 0;
		$("input[name='no[]']:checked").each(function(){
			del_no[i] = $(this).val();
		i++;
		});

		if(confirm('선택하신 입사지원 정보 '+chk_length+'건을 삭제 하시겠습니까?')){
			$.post('./process/open.php', { mode:'sel_become_delete', no:del_no, mb_id:mb_id }, function(result){
				if(result){
					location.reload();
				} else {
					alert("입사지원 삭제중 오류가 발생하였습니다.\n\n사이트 관리자에게 문의하세요.");
				}
			});
		}
	}

}

var is_delete = function(){
	alert("삭제된 채용공고 입니다.");
}
var is_left = function(){
	alert("탈퇴한 기업 회원 입니다.");
}