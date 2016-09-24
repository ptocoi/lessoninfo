<?php
		/*
		* /application/include/popup.php
		* @author Harimao
		* @since 2013/06/17
		* @last update 2013/06/17
		* @Module v3.5 ( Alice )
		* @Brief :: Popup page
		* @Comment :: 레이어가 아닌 일반 팝업 으로 띄울경우 페이지
		*/
		
		$alice_path = "../../";

		$cat_path = "../";

		include_once $alice_path . "_core.php";
		
		$no = $_GET['no'];
		$popup = $popup_control->get_popup($no);
		$skin = $popup_control->get_popupSkin($popup['popup_skin']);
		$background = "";
		if($skin['bgimage_file']){
			$background .= "background:";
			$background .= "url('".$alice['data_popup_path']."/".$skin['bgimage_file']."') ".$skin['bgimage_pattern']." ".$skin['bgimage_position'];
			//$background .= " #".$skin['border_color'];
		} else {
			$background .= "background:#fff";
		}
?>
	<html>
	<head>
		<title><?php echo ($popup['popup_title_view']) ? stripslashes($popup['popup_title']) : "" ;?></title>
		<meta http-equiv='content-type' content='text/html; charset=<?php echo $alice['charset'];?>'>
		<link rel="stylesheet" type="text/css" href="../css/index.css?t=<?php echo date('YmdH');?>"/>
		<script type='text/javascript' src='../_helpers/_js/jquery.min.js?t=<?php echo date('YmdH');?>'></script>
		<script type='text/javascript' src='../_helpers/_js/plugin/jquery.cookie.js?t=<?php echo date('YmdH');?>'></script>
	<script>
	var domain = document.domain;
	var popup_Close = function(no){	// 팝업창 닫기
		var popupToday = $('#popupClose_' + no).is(':checked');	 // 하루동안 열지 않기 체크 유무
		if(popupToday==true)	// 체크 했다면
			$.cookie('popupClose_'+no, popupToday, { expires:1, domain:domain, path:'/', secure:0});	// 쿠키 저장
		self.close();
	}
	</script>

	</head>
	<body leftmargin="0" topmargin="0">
		<table width="100%" height="100%" style="border:<?php echo $skin['border_size'];?>px solid #<?php echo $skin['border_color'];?>;">
		<tr>
		<td class="pcontents" style="<?php echo $background;?>;"><?php echo nl2br(stripslashes($popup['popup_content']));?></td>
		</tr>
		<tr>
		<td class="pclose" style="background:#<?php echo $skin['border_color'];?>;">
		<dl>
			<label><input name="popup_CloseNo[]" type="checkbox" value="<?php echo $popup['no'];?>" class="check" id="popupClose_<?php echo $popup['no'];?>">하루동안 열지 않기</label>
			<span class="bar"><a onclick="popup_Close('<?php echo $popup['no'];?>');">close<b class="pl2">x</b></a></span>
		</dl>
		</td>
		</tr>
		</table>
	</body>
	</html>