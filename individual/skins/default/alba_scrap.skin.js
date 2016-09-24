$(function(){
	
});

var list_rows = function( vals){	// 출력건수
	var sel = vals.value;
	location.href = "./alba_scrap.php?page_rows=" + sel;
}

var sel_scrap_delete = function(){	// 스크랩 삭제
	var chk_length = $("input[name='no[]']:checked").length;
	if(chk_length==0){
		alert('삭제 할 스크랩 채용정보를 선택해 주세요.');
		return false;
	} else {
		var del_no = new Array();
		var i = 0;
		$("input[name='no[]']:checked").each(function(){
			del_no[i] = $(this).val();
		i++;
		});
		if(confirm('한번 삭제된 스크랩 채용정보는 복구가 안됩니다.\n\n선택하신 채용정보 '+chk_length+'건을 삭제하시겠습니까?')){
			$.post('./process/open.php', { mode:'sel_scrap_delete', no:del_no, mb_id:mb_id }, function(result){
				if(result){
					location.reload();
				} else {
					alert("스크랩 인재정보 채용정보 삭제중 오류가 발생하였습니다.\n\n사이트 관리자에게 문의하세요.");
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