<?php
		/*
		* /application/member/views/_ajax/member.php
		* @author Harimao
		* @since 2013/07/03
		* @last update 2013/07/15
		* @Module v3.5 ( Alice )
		* @Brief :: Member ajax
		* @Comment :: 회원 관련 ajax 체크
		*/

		$alice_path = "../../../";

		$cat_path = "../../../";

		include_once $alice_path . "_core.php";

		$mode = $_POST['mode'];
		$mb_id = $_POST['mb_id'];
		$mb_nick = $_POST['mb_nick'];


		switch($mode){

			## 회원 id 중복 확인
			case 'mb_id_duplicate':

				$result = $user_control->checkUid_member( $mb_id );
				
				echo $result;

			break;

			## 회원 닉네임 중복 확인
			case 'mb_nick_duplicate':

				$result = $user_control->checkNick_member( $mb_nick, $mb_id );
				
				echo $result;

			break;

		}

?>