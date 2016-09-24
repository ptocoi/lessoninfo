$(function(){
	$('.tabs').mouseover(function(){
		var tabs = $(this).attr('tabs');
		$('.tabs').removeClass('on');
		$('.ctBoard').hide();
		$(this).addClass('on');
		$('#'+tabs).show();
	});

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

var alba_scrap = function( no ){	// 알바 공고 스크랩

	if(mb_type=='company'){
		alert("채용정보 스크랩은 개인회원만 가능합니다.");
		return;
	}

	if(mb_id){
		$.post('../alba/process/scrap.php', { mb_id:mb_id, no:no }, function(result){
			alert(result);
		});
	} else {
		alert("회원만 스크랩 가능합니다.");
		win_open("../popup/login.php", "pop_login", 480, 200);
	}

}

var resume_scrap = function( no ){	 // 이력서 스크랩

	if(mb_type=='individual'){
		alert("이력서 스크랩은 기업회원만 가능합니다.");
		return;
	}

	if(mb_id){
		$.post('../resume/process/scrap.php', { mb_id:mb_id, no:no }, function(result){
			alert(result);
		});
	} else {
		alert("회원만 스크랩 가능합니다.");
		win_open("../popup/login.php", "pop_login", 480, 200);
	}

}
