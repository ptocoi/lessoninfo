/*
$(function(){
	$('#login_passwd').keydown(function(event){
		if(event.keyCode==13){	 // 엔터키 이벤트
			member_login();
		}
	});
});
var member_login = function(){	// 회원 로그인
	$('#MemberLoginFrm').submit();
}
var member_logout = function(){	// 회원 로그 아웃
	if(mb_id){
		if(confirm('로그아웃 하시겠습니까?')){
			$.post(base_path + "/member/process/logout.php", { mb_id:mb_id }, function(result){
				if(result=='0015'){
					alert("회원만 접근 가능합니다.");
					location.href = base_path;
				} else {
					location.href = base_path;
				}
			});
		}
	} else {
		alert("회원만 접근 가능합니다.");
	}
}
*/
$(function(){
	$('.bgLayer').mouseenter(function(){
		$('.menu_layer').hide();
		var ids = $(this).attr('id');
		var is_this = $(this);
		is_this.addClass('on');	

		var position = $(this).position();
		var menu_position = $('#'+ids+'_position').position();
		//alert( menu_position.left );
		//$('#'+ids+'_position').css({ "left" : '0px' });

		$('.'+ids).show();
		$('.'+ids).mouseleave(function(){
			$(this).removeClass('on');
			$('.'+ids).hide();
			is_this.removeClass('on');
		});
	});

	if($('#ad_banner').length > 0 ){	// 최상단 배너 존재 유무
		var left_top_margin = Number( $('#ad_banner').height() ) + 115;
		var right_top_margin = Number( $('#ad_banner').height() ) + 120;
		$('.leftWing').css({
			"top" : left_top_margin+"px"
		});
		$('.RightWing').css({
			"top" : right_top_margin+"px"
		});
	}

});

var layer_close = function(){	// 메뉴 레이어 닫기
	$('.menu_layer').hide();
}
var devMores = function( classes ){	 // 최상단 mb_type 별 메뉴 출력/미출력
	$('.'+classes).toggle();
}
var scroll_top = function(){	 // 상단으로 이동
	$('html, body').animate({scrollTop:0}, 600); // 페이지 상단으로 이동
}

var serchFrm_submit = function(){	// 검색 시작~

	$('#SearchFrm').submit();

}