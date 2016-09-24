var leftFrm_submit = function(){

	var left_agreement = $('#left_agreement').is(':checked');

	if(!left_agreement){
		alert("회원탈퇴 유의사항에 동의해 주세요.");
		$('#left_agreement').focus();
		return;
	}
	if(confirm('탈퇴신청 하시겠습니까?')){
		$('#MemberLeftFrm').submit();
	}
}
