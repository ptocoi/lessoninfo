$(function(){
	$('#pop_login_passwd').keydown(function(event){
		if(event.keyCode==13){	 // 엔터키 이벤트
			popup_login();
		}
	});

});
var popup_login = function(){	// 로그인

	$('#PopLoginFrm').submit();

}
var find_id = function(){	// 아이디 찾기
	opener.location.href = "../member/find_id.php";
	self.close();
}
var find_password = function(){	// 비번찾기
	opener.location.href = "../member/find_pw.php";
	self.close();
}
var popup_regist = function(){	// 회원가입
	opener.location.href = "../member/register.php";
	self.close();
}