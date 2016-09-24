$(function(){
	$('#mb_id').focus();
	$('.closeBtn, .close').click(function(){	// 우편번호 검색창 닫기
		$('#postSearchPop').hide();
		$('#mb_address1').focus();
	});
});
var mbID_duplicateCheck = function(){	// 아이디 중복 확인
	var mb_id = $('#mb_id').val();
	$.post('./views/_ajax/member.php', { mode:'mb_id_duplicate', mb_id:mb_id }, function(result){
		if(!mb_id || mb_id==''){
			alert("아이디를 입력해 주세요.");
			$('#mb_id').focus();
			return false;
		}
		if(isValidBlank(mb_id)){
			alert("아이디에 공백은 입력할수 없습니다\n\n공백없이 입력해 주세요.");
			$('#mb_id').focus();
			return false;
		}
		if(result=='1'){
			alert("이미 가입된 아이디 입니다.\n\n다른 아이디로 가입해 주세요.");
			mb_id_duplicate = false;
		} else {
			alert("가입 할수 있는 아이디 입니다.");
			mb_id_duplicate = true;
		}
	});
}
var mbNICK_duplicateCheck = function(){	// 닉네임 중복 확인
	var mb_nick = $('#mb_nick').val();
	$.post('./views/_ajax/member.php', { mode:'mb_nick_duplicate', mb_nick:mb_nick }, function(result){
		if(!mb_nick || mb_nick==''){
			alert("닉네임을 입력해 주세요.");
			$('#mb_nick').focus();
			return false;
		}
		if(isValidBlank(mb_nick)){
			alert("닉네임에 공백은 입력할수 없습니다\n\n공백없이 입력해 주세요.");
			$('#mb_nick').focus();
			return false;
		}
		if(result=='1'){
			alert("이미 사용중인 닉네임 입니다.\n\n다른 닉네임으로 가입해 주세요.");
			mb_nick_duplicate = false;
		} else {
			alert("사용 할수 있는 닉네임 입니다.");
			mb_nick_duplicate = true;
		}
	});
}
var postSearchPops = function(){	// 우편번호 검색창 띄우기
	$('#postSearchPop').show();
	$('#postSearchKeyword').focus();
}
var email_sel = function( vals ){	// 이메일 서비스 선택
	var sel = vals.value;
	$('#mb_email_tail').val(sel);
}
//var memberFrm_submit = function(){	// 폼 전송
//	var member_options = { 
//		beforeSubmit: showRequest, 
//		success: showResponse 
//	};	// ajax options

	/*
	 * ajaxForm 은 폼의 속성을 미리 정의 내려 submit 버튼 클릭시 작동한다.
	 * 필요한 경우 대체하여 사용 가능하다.
	 * $('#MemberRegistFrm').ajaxForm(member_options);	
	 */
	//$('#MemberRegistFrm').ajaxSubmit(member_options);	// member ajax form submit
	//$('#MemberRegistFrm').submit();	// 폼 일반 전송
//}

var map_close = function(){
	$('#postSearchPop').hide();
	$('#mb_address1').focus();
}