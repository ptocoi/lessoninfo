$(function(){

});

var list_rows = function( vals ){	// 출력건수
	var sel = vals.value;
	location.href = "./alba_resume_interview.php?type="+type+"&page_rows=" + sel;
}

var mail_view = function( no ){
	$('#layerPop').load('./views/_load/popup.php', { mode:'interview_mail', no:no, wr_id:mb_id }, function(result){
		$(this).show();
	});
}
var mail_close = function(){
	$('#layerPop').hide();
}

var is_delete = function(){
	alert("삭제된 채용공고 입니다.");
}
var is_left = function(){
	alert("탈퇴한 기업 회원 입니다.");
}