$(function(){

	fade_images('fade_image');	// 페이드 형태
	setInterval(function(){
		fade_images('fade_image');
	}, 3000);

	blink('blink_image',900000,1500);	// 깜빡임

	var $slide_image = $('.slide_image');
	if($slide_image.length > 0 ) {
		$slide_image.cycle({		// 슬라이드
			fx:     cycle_direction, 
			easing: 'easeInOutBack',
			delay:  -2000 
		});
	}

	var colour;
	setInterval(function(){
		colour = '#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6);	
		$('.jumble').animate({
			color: colour
		});
	}, 500);

});

var photo_view = function( mb_id, photo_no, company_no, data_no ){
	$('#popup').load('./views/_load/photo.php', { mb_id:mb_id, photo_no:photo_no, company_no:company_no, data_no:data_no }, function(){
		$(this).show();
	});
}

var photo_close = function(){
	$('#popup').hide();
}

var photo_on = function( no, width, height ){
	var photo_src = $('#photo_'+no).attr('src');
	$('#target_photo').html("<img src=\""+photo_src+"\" onclick=\"image_window_view(this,"+width+","+height+");\"/>");
}

var company_scrap = function( no ){	// 관심기업 등록

	if(is_member){
		if(mb_type=='company'){
			alert("관심기업 등록은 개인회원만 가능합니다.");
			return;
		}
	} else {
		alert("회원만 스크랩 가능합니다.");
		win_open("../popup/login.php", "pop_login", 480, 200);
		return;
	}

	$.post('./process/scrap.php', { mode:'sel_favorite', mb_id:mb_id, no:no }, function(result){
		
		if(result=='1'){
			alert("관심기업으로 등록 되었습니다.");
		} else {
			//alert("관심기업 등록중 오류가 발생했습니다.");
			alert(result);
			return false;
		}
		
		$('#scrap_icon').attr('src','../images/icon/icon_scrap3_on.gif');

	});

}

var is_scrap = function(){
	
	alert("이미 관심기업으로 등록 하셨습니다.");

}
