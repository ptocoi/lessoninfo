$(function(){
	
});
var sel_resume_delete = function( ){	// 선택 이력서 삭제
	var chk_length = $("input[name='no[]']:checked").length;
	if(chk_length==0){
		alert('삭제 할 열람 인재정보를 선택해 주세요.');
		return false;
	} else {
		var del_no = new Array();
		var i = 0;
		$("input[name='no[]']:checked").each(function(){
			del_no[i] = $(this).val();
		i++;
		});
		if(confirm('한번 삭제된 열람 인재정보는 복구가 안됩니다.\n\n선택하신 인재정보 '+chk_length+'건을 삭제하시겠습니까?')){
			$.post('./process/open.php', { mode:'sel_resume_delete', no:del_no, mb_id:mb_id }, function(result){
				if(result){
					location.reload();
				} else {
					alert("열람 인재정보 삭제중 오류가 발생하였습니다.\n\n사이트 관리자에게 문의하세요.");
				}
			});
		}
	}
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
					alert("스크랩 되었습니다.");
					location.reload();
				} else {
					alert("열람 인재정보 스크랩중 오류가 발생하였습니다.\n\n사이트 관리자에게 문의하세요.");
				}
			});
		}
	}

}

var OpenResumeFrm_submit = function(){
	
	$('#OpenResumeFrm').submit();

}

var list_rows = function( vals ){	// 출력건수
	var sel = vals.value;
	location.href = "./alba_resume_info.php?"+send_url+"&page_rows=" + sel;
}

var is_delete = function(){
	alert("삭제된 이력서 입니다\n\n해당 이력서를 작성한 개인회원이 삭제하여 상세 내용 확인이 불가능 합니다.");
}