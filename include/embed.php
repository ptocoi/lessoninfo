<?php
		/*
		* /application/include/embed.php
		* @author Harimao
		* @since 2013/07/02
		* @last update 2013/08/14
		* @Module v3.5 ( Alice )
		* @Brief :: Shockwave flash iframe
		* @Comment :: SWF 동영상 파일도 그냥 출력이 안되서 iframe 으로 출력
		*/
		
		$alice_path = "../../";

		$cat_path = "../";

		include_once $alice_path . "_core.php";

		$no = $_GET['no'];

		$get_banner = $banner_control->get_banner($no);

		$content = $get_banner['content'];

		$swf_file = ($path) ? $path . "/" . $content : $alice['data_banner_path'] . "/" . $content;

		echo "<body topmargin='0' leftmargin='0' style='padding:0px;margin:0px;'>";

		$result  = "<object classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000' width='" . $get_banner['width'] . "' height='" . $get_banner['height'] . "' codebase='http://fpdownload.adobe.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0'>\n";
		$result .= "<param name='movie' value='" . $swf_file . "'>\n";
		$result .= "<param name='wmode' value='opaque'>\n";
		$result .= "<param name='play' value='true'>\n";
		$result .= "<param name='loop' value='true'>\n";
		$result .= "<param name='quality' value='high'>\n";
		$result .= "<embed src='" . $swf_file . "' width='" . $get_banner['width'] . "' height='" . $get_banner['height'] . "' play='true' loop='true' quality='high' pluginspage='http://www.adobe.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash'></embed>\n";
		$result .= "</object>";

		echo $result;

		echo "</body>";
?>