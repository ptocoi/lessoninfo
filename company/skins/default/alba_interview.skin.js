$(function(){
	
});

var list_rows = function( vals ){	// 출력건수
	var sel = vals.value;
	location.href = "./alba_interview.php?type="+type+"&page_rows=" + sel;
}

var is_delete = function(){
	alert("삭제된 이력서 입니다\n\n해당 이력서를 작성한 개인회원이 삭제하여 상세 내용 확인이 불가능 합니다.");
}